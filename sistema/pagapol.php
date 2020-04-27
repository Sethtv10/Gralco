<?php
include("ajax/config.php");
include("ajax/funciones.php");
include("ajax/secure.php");
$mensaje="";

	$permisos=strstr($_SESSION['perm'], 'pagar');
	$zonas=strstr($_SESSION['zonas'], 'polizas');
	if (($permisos!="") && ($zonas!=""))
	{
//id es el id del recibo a pagar
//numpol es el id de la poliza en tabla poliza
$cnx=conectar();
if (isset($_POST['dia']))
	$dia=$_POST['dia'];
else
	$dia=date("d");
if (isset($_POST['mes']))
	$mes=$_POST['mes'];
else
	$mes=date("m");
if (isset($_POST['anio']))
	$anio=$_POST['anio'];
else
	$anio=date("Y");
foreach ($_POST['campos'] as $indice => $valor) 
{
	$sqlnvo = "UPDATE recibos SET ";
	$sqlnvo.= "status='P',";
	//$sqlnvo.= "diapago='".date("d")."',";
	//$sqlnvo.= "mespago='".date("m")."',";
	//$sqlnvo.= "aniopago='".date("Y")."'";
	$sqlnvo.= "diapago='".$dia[$indice]."',";
	$sqlnvo.= "mespago='".$mes[$indice]."',";
	$sqlnvo.= "aniopago='".$anio[$indice]."'";
	$sqlnvo.= " WHERE id='".$valor."'";
	$resnvo = mysql_query($sqlnvo) or die (mysql_error());
	$sql2="SELECT numpol FROM recibos WHERE id='".$valor."'";
	$res2=mysql_query($sql2) or die (mysql_error());
	if (mysql_num_rows($res2)>0)
		{
			while(list($numpol) = mysql_fetch_array($res2))
			{
				$sql3="SELECT numpol FROM recibos WHERE numpol='".$numpol."' AND status='D'";
				$res3=mysql_query($sql3) or die (mysql_error());
				if (mysql_num_rows($res3)==0)
					{
						$sqlnvo2 = "UPDATE poliza SET ";
						$sqlnvo2.= "status='P'";
						$sqlnvo2.= " WHERE id='".$numpol."'";
						$resnvo2 = mysql_query($sqlnvo2) or die (mysql_error());
						$camposbit="usuario,accion,poliza,fecha,hora";
						$valorbit = "'".$_SESSION['usera']."','Pago la poliza','".$numpol."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
						$sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
						$resbit = mysql_query($sqlbit) or die (mysql_error());
						$camposbit="usuario,accion,poliza,fecha,hora";
						$valorbit = "'".$_SESSION['usera']."','Pago recibos poliza id','".$numpol."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
						$sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
						$resbit = mysql_query($sqlbit) or die (mysql_error());
					}
			}
		}
}
/*
				$sqlnvo = "UPDATE recibos SET ";
				$sqlnvo.= "status='P',";
				$sqlnvo.= "diapago='".date("d")."',";
				$sqlnvo.= "mespago='".date("m")."',";
				$sqlnvo.= "aniopago='".date("Y")."'";
				$sqlnvo.= " WHERE id='".$_POST['id']."'";
				$resnvo = mysql_query($sqlnvo) or die (mysql_error());
		$sql2="SELECT numpol FROM recibos WHERE numpol='".$_POST['numpol']."' AND status='D'";
		$res2=mysql_query($sql2) or die (mysql_error());
		if (mysql_num_rows($res2)==0)
			{
				$sqlnvo2 = "UPDATE poliza SET ";
				$sqlnvo2.= "status='P'";
				$sqlnvo2.= " WHERE id='".$_POST['numpol']."'";
				$resnvo2 = mysql_query($sqlnvo2) or die (mysql_error());
			}*/
mysql_close($cnx);
header("Location: mensaje.php?mensaje=Se pago la poliza.");
?>
<?php }
	else
	{
		header("LOCATION: index.php");
		exit();
	}
 //Permiso para agregar ?>