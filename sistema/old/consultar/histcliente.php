<?
	include("../ajax/config.php");
	include("../ajax/funciones.php");
	include("../ajax/secure.php");
	$cnx=conectar();
	if (empty($_GET['nombre']) || !isset($_GET['nombre']))
	{
		header("LOCATION: ../index.php");
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
	<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
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
		<? include("../menu2.php"); ?>
	</div>
	<div id="contenido">
   <table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
        <tr>
            <td height="40" align="center"><div id="etiqueta">
              <label>Historial cliente: <? echo $_GET['nombre']; ?></label></div></td>
        </tr>
    </table>
    <table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td width="139" height="30" bgcolor="#FFFFFF" align="center"><label>Datos generales</label></td>
                <td colspan="4"></td>
            </tr>
        </table>
    <?
    $sql="SELECT * FROM cliente WHERE nombre='".$_GET['nombre']."' LIMIT 1";
	$res=mysql_query($sql);
	if(mysql_num_rows($res)>0)
	{
		while(list($id,$numcliente,$nombre,$direccion,$edad,$dia,$mes,$anio,$colonia,$cp,$ciudad,$estado,$rfc,$tel,$telmov,$tipoclie)=mysql_fetch_array($res))
		{
	?>
		<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td width="477">
						<table width="477" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><div id="etiqueta">
									  <label>Nombre:</label></div></td>
									<td><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" value="<? echo $nombre; ?>" /></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta">
									  <label>Domicilio:</label></div></td>
									<td><textarea name="domicilio" id="domicilio"><? echo $direccion; ?></textarea></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Colonia:</label></div></td>
								  <td><input type="text" name="colonia" id="colonia" autocomplete="off" size="55" value="<? echo $colonia; ?>" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>C.P:</label></div></td>
								  <td>
									<table width="370" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="59">
				<input type="text" name="cp" id="cp" autocomplete="off" size="5" maxlength="5" value="<? echo $cp; ?>" /></td>
											<td width="100" align="left"><div id="etiqueta">
									  <label>RFC:</label></div></td>
											<td width="211"><input type="text" name="rfc" id="rfc" autocomplete="off" size="22" value="<? echo $rfc; ?>" /></td>
										</tr>
									</table>
								  </td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Ciudad:</label></div></td>
								  <td>
									<table width="370" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="75">
				<input type="text" name="ciudad" id="ciudad" autocomplete="off" size="15" value="<? echo $ciudad; ?>" /></td>
											<td width="100" align="left"><div id="etiqueta">
									  <label>Estado:</label></div></td>
											<td width="195"><input type="text" name="estado" id="estado" autocomplete="off" size="12" value="<? echo $estado; ?>" /></td>
										</tr>
									</table>
								  </td>
								</tr>
						</table>
					</td> 
					<td width="473">
						<table width="473" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td width="101"><div id="etiqueta">Número de cliente:</div></td>
									<td width="372"><input type="text" size="20" name="numcliente" autocomplete="off" value="<? echo $numcliente; ?>" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Fecha de cumpleaños:</label></div></td>
									<td><select name="dia" size="1">
									<? for ($a=1;$a<=31;$a++)
										{
									?>
											<option value="<? echo $a; ?>" <? if ($dia==$a){ ?> selected="selected" <? } ?>><? echo $a; ?></option>
									<?
										}
									?>
									</select>
									<select name="mes" size="1">
									<? for ($a=1;$a<=12;$a++)
										{
									?>
											<option value="<? echo $a; ?>" <? if ($mes==$a){ ?> selected="selected" <? } ?>><? echo $a; ?></option>
									<?
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="anio" name="anio" maxlength="4" value="<? echo $anio; ?>" /></td>
								</tr>
								<tr>
                                	<td colspan="2">&nbsp;</td>
                                </tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Telefono fijo:</div></td>
									<td width="372"><input type="text" size="20" name="tel" autocomplete="off" value="<? echo $tel; ?>" /></td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Telefono móvil:</div></td>
									<td width="372"><input type="text" size="20" name="telcel" autocomplete="off" value="<? echo $telmov; ?>" /></td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">&nbsp;</div></td>
									<td width="372">&nbsp;</td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Tipo de cliente:</div></td>
									<td width="372"><select name="tipoclie" size="1">
													<option value="particular" <? if ($tipoclie=="particular"){ ?> selected="selected" <? } ?>>Particular</option>
													<option value="empresa" <? if ($tipoclie=="empresa"){ ?> selected="selected" <? } ?>>Empresa</option>
													</select>
									</td>
								</tr>
						</table>
					</td>
				</tr>
			</table>
<?			}
	}?>
	<?
    $sqlp="SELECT id,numpoliza,tipopoliza,contratante,compania,status FROM poliza WHERE contratante LIKE '%".$_GET['nombre']."%' ORDER BY numpoliza DESC, compania ASC";
	$resp=mysql_query($sqlp) or die("error busc numpoliza ".mysql_error());
	if(mysql_num_rows($resp)>0)
	{
		$encontro="si";
		$contador=1;?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
            <tr>
                <td width="139" height="30" align="center">&nbsp;</td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td width="139" height="30" bgcolor="#FFFFFF" align="center"><label>Polizas</label></td>
                <td colspan="4"></td>
            </tr>
            <tr>
            	<td width="139"><div id='etiqueta'><label>N&uacute;mero de p&oacute;liza</label></div></td>
                <td width="112"><div id='etiqueta'><label>Status</label></div></td>
                <td width="127"><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>
                <td width="130"><div id='etiqueta'><label>Compañ&iacute;a</label></div></td>
                <td width="392"><div id='etiqueta'><label>Descripci&oacute;n</label></div></td>
            </tr>
        </table>
		<?
		while(list($id,$numpoliza,$tipopoliza,$contratante,$compania,$status)=mysql_fetch_array($resp))
		{
			if($tipopoliza=="vida")
			{
				$enlace="vida.php?num=".$numpoliza;
				$sqldeta="SELECT plan FROM vida WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle vida ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['plan'];
			}
			if($tipopoliza=="gm")
			{
				$enlace="gm.php?num=".$numpoliza;
				$sqldeta="SELECT plan FROM gm WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle gm ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['plan'];
			}
			if($tipopoliza=="daños")
			{
				$enlace="danios.php?num=".$numpoliza;
				$sqldeta="SELECT calle FROM danios WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle daños ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['calle'];
			}
			if($tipopoliza=="autos")
			{
				$enlace="autos.php?num=".$numpoliza;
				$sqldeta="SELECT marca FROM autos WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle autos ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['marca'];
			}
			if($tipopoliza=="camiones")
			{
				$enlace="camiones.php?num=".$numpoliza;
				$sqldeta="SELECT marca FROM camiones WHERE idpol='".$id."' LIMIT 1";
				$resdeta=mysql_query($sqldeta) or die("error detalle camiones ".mysql_error());
				$resd=mysql_fetch_array($resdeta);
				$detalle=$resd['marca'];
			}
		?>
		<table width='900' cellpadding='0' cellspacing='0' border='0' align='center'>
        	<tr <? if ($contador%2!=0) { echo 'bgcolor="#333333"'; } ?> height="20">
          		<td width="139"><a href="<? echo $enlace; ?>" class="blanco"><? echo $numpoliza; ?></a></td>
                <td width="112"><div id='etiqueta'><? echo $status; ?></div></td>
                <td width="127"><div id='etiqueta'><? echo $tipopoliza; ?></div></td>
                <td width="130"><div id='etiqueta'><? echo $compania; ?></div></td>
                <td width="392"><div id='etiqueta'><? echo $detalle; ?></div></td>
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