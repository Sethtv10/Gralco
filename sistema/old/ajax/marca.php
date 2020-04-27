<?php
include("BD.php");

$caracteres=$_POST['caracteres'];

if ($caracteres!="")
  {
	$aLocalidades=$bd->ExecuteField("marca","nombre","nombre LIKE '%%$caracteres%%' ");
	$respuesta="<ul>";
	foreach ($aLocalidades as $localidad)
		{
			$respuesta.="<li>".$localidad."</li>";
		}
	$respuesta.="</ul>";
	echo $respuesta;
  }
?>