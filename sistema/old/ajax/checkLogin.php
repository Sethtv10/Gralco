<?php
// revisamos si es login por sesiones o por formulario
if (!isset($_POST['usuario_digitado']) && !isset($_POST['clave_digitada'])) {
	session_start();
	//usamos los valores de las sesiones
	$usuario = $_SESSION['usera'];
	$clave = $_SESSION['password'];
}else{
	// usamos los datos ingresados
	session_start();
	//borramos las sessiones por si existen
	unset($_SESSION['usera']);
	unset($_SESSION['password']);
		
	$usuario = $_POST['usuario_digitado'];
	$clave = $_POST['clave_digitada'];
	$_SESSION['usera'] = $usuario;
	$_SESSION['password'] = $clave;
}

if (!$usuario) {
	// no hay login disponible
	include("interface.php");
	exit;
}
if (!$clave) {
	// no hay contraseña
	$mensaje = "contraseña incorrecta";
	include("interface.php");
	exit;
}
// nos conectamos a la bd
$cnx = conectar();
//buscamos al usuario
$userQuery = mysql_query("SELECT * FROM users WHERE user = '$usuario'") or die(mysql_error());
// revisamos usuario y password
if (mysql_num_rows($userQuery) > 0) {
	// usuario existe, seguimos
	$userArray = mysql_fetch_array($userQuery);
		
	if ($usuario != $userArray['user']) {
		// caso sensitivo, usuario no está presente en bd
		$message = "Usuario no Existe";
		echo $message;
		//session_destroy();
		include("interface.php");
		exit;
	}
	if (!$userArray['password']) {
		// no tiene clave en bd, no entra
		$message = "No se encontró contraseña para el usuario";
		include("interface.php");
		exit;
	}
	if ($userArray['password'] != $clave) {
		// contraseña es incorrecta
		$message = "Contraseña es incorrecta";
		include("interface.php");
		exit;
	}
}else{
	// usuario no existe del todo.
	$message = "Usuario no Existe";
	include("interface.php");
	exit;
}
//si hemos llegado hasta aqui significa que el login es correcto.
mysql_close($cnx);
?>