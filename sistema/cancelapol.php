<?php
include("ajax/config.php");
include("ajax/funciones.php");
include("ajax/secure.php");

$mensaje="";

	$permisos=strstr($_SESSION['perm'], 'cancelar');
	$zonas=strstr($_SESSION['zonas'], 'polizas');
	if (($permisos!="") && ($zonas!=""))
	{
//id es el id del recibo a pagar
//numpol es el id de la poliza en tabla poliza
$cnx=conectar();

		$sql2="SELECT numpoliza,status FROM poliza WHERE id='".$_POST['id']."'";
		$res2=mysql_query($sql2) or die (mysql_error());
		if (mysql_num_rows($res2)>0)
			{
				$sqlnvo2 = "UPDATE poliza SET ";
				$sqlnvo2.= "aldia='".date("d")."',";
				$sqlnvo2.= "almes='".date("m")."',";
				$sqlnvo2.= "alanio='".date("Y")."',";
				$sqlnvo2.= "status='C',";
				$sqlnvo2.= "motivo='".$_POST['motivo']."'";
				$sqlnvo2.= " WHERE id='".$_POST['id']."'";
				$resnvo2 = mysql_query($sqlnvo2) or die (mysql_error());
				$camposbit="usuario,accion,poliza,fecha,hora";
				$valorbit = "'".$_SESSION['usera']."','Cancelo poliza','".$numpoliza."/".$_POST['id']."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
				$sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
				$resbit = mysql_query($sqlbit) or die (mysql_error());
			}
			
mysql_close($cnx);
header("Location: mensaje.php?mensaje=Se cancelo la poliza.");
?>
<?php }
	else
	{
		header("LOCATION: index.php");
		exit();
	}
 //Permiso para agregar ?>