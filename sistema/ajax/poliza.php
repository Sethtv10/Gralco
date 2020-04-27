<?php
include("BD.php");

$caracteres=$_POST['caracteres'];

if ($caracteres!="")
  {
	$aLocalidades=$bd->ExecuteField("poliza","numpoliza","numpoliza LIKE '%%$caracteres%%'");
	$respuesta="<ul>";
	foreach ($aLocalidades as $localidad)
		{
			$respuesta.="<li>".$localidad."</li>";
		}
	$respuesta.="</ul>";
	echo $respuesta;
  }
?>