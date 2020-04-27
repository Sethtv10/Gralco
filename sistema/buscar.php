<?
	include("ajax/config.php");
	include("ajax/funciones.php");
	include("ajax/secure.php");
	$cnx=conectar();
	if (empty($_POST['busca']))
	{
		header("LOCATION: mensaje.php?mensaje=Busqueda vacia");
		exit;
	}
	$encontro="no";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
	<link rel="stylesheet" href="estilos/style.css" type="text/css" media="screen" />
<style type="text/css">
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
</style>
</head>

<body>
	<div id="contenedor">
		<? include("menu.php"); ?>
	</div>
	<div id="contenido">
   <table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
        <tr>
            <td height="40" align="center"><div id="etiqueta"><label>Resultados con la busqueda: <? echo $_POST['busca']; ?></label></div></td>
        </tr>
    </table>
    <?
    $sqlc="SELECT nombre FROM cliente WHERE nombre LIKE '%".$_POST['busca']."%' ORDER BY nombre ASC";
	$resc=mysql_query($sqlc) or die("error busc cliente ".mysql_error());
	if(mysql_num_rows($resc)>0)
	{
		$encontro="si";
		$contador=1;
	?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td width="158" height="30" bgcolor="#FFFFFF" align="center"><label>Clientes</label></td>
                <td width="742"></td>
            </tr>
            <tr>
            	<td colspan="2"><div id='etiqueta'><label>Nombre</label></div></td>
            </tr>
        </table>
		<?
		while(list($nombre)=mysql_fetch_array($resc))
		{		
		?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
        	<tr>
                <td <? if ($contador%2!=0) { echo 'bgcolor="#333333"'; } ?> height="20"><a href="consultar/histcliente.php?nombre=<? echo $nombre; ?>" class="blanco"><? echo $nombre; ?></a></td>
            </tr>
        </table>
	<?	$contador++;
		} ?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td width="94" height="30" ></td>
            </tr>
        </table>
<?	} ?>
	<?
    $sqlp="SELECT id,numpoliza,tipopoliza,contratante,compania FROM poliza WHERE numpoliza LIKE '%".$_POST['busca']."%' ORDER BY numpoliza ASC";
	$resp=mysql_query($sqlp) or die("error busc numpoliza ".mysql_error());
	if(mysql_num_rows($resp)>0)
	{
		$encontro="si";
		$contador=1;?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td width="139" height="30" bgcolor="#FFFFFF" align="center"><label>Polizas</label></td>
                <td colspan="4"></td>
            </tr>
            <tr>
            	<td width="139"><div id='etiqueta'><label>N&uacute;mero de p&oacute;liza</label></div></td>
                <td width="235"><div id='etiqueta'><label>Contratante</label></div></td>
                <td width="110"><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>
                <td width="120"><div id='etiqueta'><label>Compañ&iacute;a</label></div></td>
                <td width="296"><div id='etiqueta'><label>Descripci&oacute;n</label></div></td>
            </tr>
        </table>
		<?
		while(list($id,$numpoliza,$tipopoliza,$contratante,$compania)=mysql_fetch_array($resp))
		{
			if($tipopoliza=="vida")
			{
				$enlace="consultar/vida.php?num=".$numpoliza;
				$sqldeta="SELECT plan FROM vida WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle vida ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['plan'];
			}
			if($tipopoliza=="gm")
			{
				$enlace="consultar/gm.php?num=".$numpoliza;
				$sqldeta="SELECT plan FROM gm WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle gm ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['plan'];
			}
			if($tipopoliza=="daños")
			{
				$enlace="consultar/danios.php?num=".$numpoliza;
				$sqldeta="SELECT calle FROM danios WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle daños ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['calle'];
			}
			if($tipopoliza=="autos")
			{
				$enlace="consultar/autos.php?num=".$numpoliza;
				$sqldeta="SELECT marca FROM autos WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle autos ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['marca'];
			}
			if($tipopoliza=="camiones")
			{
				$enlace="consultar/camiones.php?num=".$numpoliza;
				$sqldeta="SELECT marca FROM camiones WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle camiones ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['marca'];
			}
		?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
        	<tr <? if ($contador%2!=0) { echo 'bgcolor="#333333"'; } ?> height="20">
          		<td width="139"><a href="<? echo $enlace; ?>" class="blanco"><? echo $numpoliza; ?></a></td>
                <td width="235"><a href="consultar/histcliente.php?nombre=<? echo $contratante; ?>" class="blanco"><? echo $contratante; ?></a></td>
                <td width="110"><div id='etiqueta'><? echo $tipopoliza; ?></div></td>
                <td width="120"><div id='etiqueta'><? echo $compania; ?></div></td>
                <td width="296"><div id='etiqueta'><? echo $detalle; ?></div></td>
            </tr>
        </table>
	<?	$contador++;
		} ?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td height="30" ></td>
            </tr>
        </table>
<?	} ?>
	<? //Buscar placas o numero de serie
    $sqla="SELECT idpol,marca,serie,placas,modelo FROM autos WHERE serie LIKE '%".$_POST['busca']."%' OR placas LIKE '%".$_POST['busca']."%' ORDER BY marca ASC";
	$resa=mysql_query($sqla) or die("error busc autos ".mysql_error());
	if(mysql_num_rows($resa)>0)
	{
		$encontro="si";
		$contador=1;?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td width="140" height="30" bgcolor="#FFFFFF" align="center"><label>Autos</label></td>
                <td colspan="4"></td>
            </tr>
            <tr>
            	<td width="140"><div id='etiqueta'><label>N&uacute;mero de p&oacute;liza</label></div></td>
                <td width="236"><div id='etiqueta'><label>Contratante</label></div></td>
                <td width="101"><div id='etiqueta'><label>Compañ&iacute;a</label></div></td>
                <td width="92"><div id='etiqueta'><label>Placas</label></div></td>
                <td width="331"><div id='etiqueta'><label>Descripci&oacute;n</label></div></td>
            </tr>
        </table>
		<?
		while(list($idpol,$marca,$serie,$placas,$modelo)=mysql_fetch_array($resa))
		{
				$sqldetaa="SELECT numpoliza,contratante,compania FROM poliza WHERE id='".$idpol."' LIMIT 1";
				$resdetaa=mysql_query($sqldetaa) or die("error detalle poliza aut ".mysql_error());
				$resd=mysql_fetch_array($resdetaa);
				$enlace="consultar/autos.php?num=".$resd['numpoliza'];
		?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
        	<tr <? if ($contador%2!=0) { echo 'bgcolor="#333333"'; } ?> height="20">
          		<td width="140"><a href="<? echo $enlace; ?>" class="blanco"><? echo $resd['numpoliza']; ?></a></td>
                <td width="236"><a href="consultar/histcliente.php?nombre=<? echo $resd['contratante']; ?>" class="blanco"><? echo $resd['contratante']; ?></a></td>
                <td width="101"><div id='etiqueta'><? echo $resd['compania'] ?></div></td>
                <td width="92"><div id='etiqueta'><? echo $placas; ?></div></td>
                <td width="331"><div id='etiqueta'><? echo $marca."<br>".$modelo."<br>".$serie; ?></div></td>
            </tr>
        </table>
	<?	$contador++;
		} ?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td height="30" ></td>
            </tr>
        </table>
<?	} ?>
	<? //Buscar placas o numero de serie
    $sqlac="SELECT idpol,marca,serie,placas,modelo FROM camiones WHERE serie LIKE '%".$_POST['busca']."%' OR placas LIKE '%".$_POST['busca']."%' ORDER BY marca ASC";
	$resac=mysql_query($sqlac) or die("error busc camiones ".mysql_error());
	if(mysql_num_rows($resac)>0)
	{
		$encontro="si";
		$contador=1;?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td width="140" height="30" bgcolor="#FFFFFF" align="center"><label>Camiones</label></td>
                <td colspan="4"></td>
            </tr>
            <tr>
            	<td width="140"><div id='etiqueta'><label>N&uacute;mero de p&oacute;liza</label></div></td>
                <td width="236"><div id='etiqueta'><label>Contratante</label></div></td>
                <td width="101"><div id='etiqueta'><label>Compañ&iacute;a</label></div></td>
                <td width="92"><div id='etiqueta'><label>Placas</label></div></td>
                <td width="331"><div id='etiqueta'><label>Descripci&oacute;n</label></div></td>
            </tr>
        </table>
		<?
		while(list($idpol,$marca,$serie,$placas,$modelo)=mysql_fetch_array($resac))
		{
				$sqldetaa="SELECT numpoliza,contratante,compania FROM poliza WHERE id='".$idpol."' LIMIT 1";
				$resdetaa=mysql_query($sqldetaa) or die("error detalle poliza aut ".mysql_error());
				$resd=mysql_fetch_array($resdetaa);
				$enlace="consultar/camiones.php?num=".$resd['numpoliza'];
		?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
        	<tr <? if ($contador%2!=0) { echo 'bgcolor="#333333"'; } ?> height="20">
          		<td width="140"><a href="<? echo $enlace; ?>" class="blanco"><? echo $resd['numpoliza']; ?></a></td>
                <td width="236"><a href="consultar/histcliente.php?nombre=<? echo $resd['contratante']; ?>" class="blanco"><? echo $resd['contratante']; ?></a></td>
                <td width="101"><div id='etiqueta'><? echo $resd['compania'] ?></div></td>
                <td width="92"><div id='etiqueta'><? echo $placas; ?></div></td>
                <td width="331"><div id='etiqueta'><? echo $marca."<br>".$modelo."<br>".$serie; ?></div></td>
            </tr>
        </table>
	<?	$contador++;
		} ?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td height="30" ></td>
            </tr>
        </table>
<?	} ?>
	</div>
    <? 
if ($encontro=="no")
{
	?>
	<script language="javascript">
        alert('No se encontraron coincidencias');
    </script>
	<?	
}
?>
</body>
</html>