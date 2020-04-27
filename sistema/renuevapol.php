<?php
$id=$_POST['id'];
$tipopol=$_POST['tipo'];

if ($tipopol=="autos")
{
	header("Location: renovar/auto.php?id=$id");
	exit;
}
if ($tipopol=="vida")
{
	header("Location: renovar/vida.php?id=$id");
	exit;
}
if ($tipopol=="daños")
{
	header("Location: renovar/danios.php?id=$id");
	exit;
}
if ($tipopol=="gm")
{
	header("Location: renovar/gm.php?id=$id");
	exit;
}
if ($tipopol=="camiones")
{
	header("Location: renovar/camiones.php?id=$id");
	exit;
}

?>