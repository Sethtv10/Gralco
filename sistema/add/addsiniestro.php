<?php  
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");
$mensaje="";

$permisos=strstr($_SESSION['perm'], 'agregar');
$zonas=strstr($_SESSION['zonas'], 'polizas');
if (($permisos!="") && ($zonas!=""))
{

if (isset($_POST['submit']))
 {
	 $nomtempfoto=$_FILES['archivo']['tmp_name'];
		 if ((!empty($nomtempfoto)))
		   {
		 	if (is_uploaded_file($_FILES['archivo']['tmp_name']))
		      {
					$archivo=time().".jpg";
					move_uploaded_file($_FILES['archivo']['tmp_name'], "../siniestros/".$archivo);
					$campos="numero,ramo,dia,mes,anio,status,observaciones,archivo";
					$valor = "'".$_POST['numero']."','".$_POST['categoria']."','".$_POST['dia']."','".$_POST['mes']."','".$_POST['anio']."','".$_POST['status']."','".$_POST['observaciones']."','".$archivo."'";
					$cnx=conectar();
					$sql = "INSERT INTO siniestros ($campos) VALUES ($valor)";
					$res = mysql_query($sql) or die (mysql_error());
					mysql_close($cnx);
					$mensaje="Se agrego con &eacute;xito el siniestro";
					$camposbit="usuario,accion,poliza,fecha,hora";
					 $valorbit = "'".$_SESSION['usera']."','Subio siniestro','".$_POST['numero']."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
					 $sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
					 $resbit = mysql_query($sqlbit) or die (mysql_error());
	   		  }
		 	else
		      {
		   		$archivo="";
				$mensaje="Error al tratar de subir el archivo: ".$_FILES['archivo']['name'];
		      }
			}//if (!empty)
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