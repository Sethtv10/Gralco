<?php  
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");

$mensaje="";

$permisos=strstr($_SESSION['perm'], 'agregar');
$zonas=strstr($_SESSION['zonas'], 'clientes');
if (($permisos!="") && ($zonas!=""))
{


if (isset($_POST['submit']))
 {
	
	$campos="numcliente,nombre,direccion,edad,dia,mes,anio,colonia,cp,ciudad,estado,rfc,tel,telmov,tipoclie";
	$valor = "'".$_POST['numcliente']."','".$_POST['txtNombre']."','".$_POST['domicilio']."','0','".$_POST['dia']."','".$_POST['mes']."','".$_POST['anio']."','".$_POST['colonia']."','".$_POST['cp']."','".$_POST['ciudad']."','".$_POST['estado']."','".$_POST['rfc']."','".$_POST['tel']."','".$_POST['telcel']."','".$_POST['tipoclie']."'";
	$cnx=conectar();
	$sql = "INSERT INTO cliente ($campos) VALUES ($valor)";
	$res = mysql_query($sql) or die (mysql_error());

	
	//echo $valor;
//echo "entro";
	$camposbit="usuario,accion,poliza,fecha,hora";
	 $valorbit = "'".$_SESSION['usera']."','Agrego cliente','".$_POST['txtNombre']."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
	 $sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
	 $resbit = mysql_query($sqlbit) or die (mysql_error());
	$mensaje="Se agrego con exito el cliente";
	mysql_close($cnx);
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
	<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
</head>
<body>
	<div id="contenedor">
		<?php  include("../menu2.php"); ?>
	</div>
	<div id="contenido">
		<p><?php  echo $mensaje; ?></p>
	</div>
</body>
</html>
<?php }
	else
	{
		header("LOCATION: ../index.php");
		exit();
	}
 //Permiso para agregar ?>