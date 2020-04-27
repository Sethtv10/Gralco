<?php
include("ajax/config.php");
include("ajax/funciones.php");
include("ajax/secure.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
	<link rel="stylesheet" href="estilos/style.css" type="text/css" media="screen" />
<style type="text/css">
<!--
a:link {
	color: #FFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	text-decoration: none;
	color: #FFF;
}
a:active {
	text-decoration: none;
	color: #FFF;
}
-->
</style></head>
<body>
	<div id="contenedor">
		<? include("menu.php"); ?>
	</div>
	<div id="contenidonew">
		<p><a href="reportes/repvencmesanio.php">Reporte de vencimiento de pólizas por mes y año</a></p>
		<p><a href="reportes/reprenypag.php">Reporte pólizas a renovar y por pagar</a></p>
		<p><a href="reportes/repcanceladas.php">P&oacute;lizas canceladas</a></p>
        <p><a href="reportes/repprimas.php">Primas neta y total</a></p>
		<p><a href="reportes/repagente.php">Reporte por categor&iacute;a y subagente</a></p>
		<p><a href="reportes/rephistoria.php">Historial de p&oacute;liza</a></p>
		<p><a href="reportes/reprecpagypor.php">Recibos pagados y por pagar</a></p>
		<p><a href="reportes/repexp.php">Reporte fecha de expedición</a></p>
		<p><a href="reportes/repcumple.php">Cumplea&ntilde;os clientes</a></p>
        <p><a href="reportes/repcomision.php">Comisión subagente</a></p>
	</div>
</body>
</html>
