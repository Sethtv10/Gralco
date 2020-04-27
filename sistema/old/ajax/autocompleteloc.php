<?php
include("BD.php");

$caracteres=$_POST['caracteres'];

if ($caracteres!="")
  {
	$aLocalidades=$bd->ExecuteField("localidades","localidad","localidad LIKE '%%$caracteres%%' ");
	$respuesta="<ul>";
	foreach ($aLocalidades as $localidad)
		{
			$respuesta.="<li>".$localidad."</li>";
		}
	$respuesta.="</ul>";
	echo $respuesta;
  }
?>