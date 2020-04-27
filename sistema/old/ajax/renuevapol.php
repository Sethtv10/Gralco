<?php
include("config.php");
include("funciones.php");
include("secure.php");

$nombre=$_POST['nombre'];
$numpol=$_POST['poliza'];
$mes=$_POST['mes'];
$anio=$_POST['anio'];
/*$nombre="";
$numpol="";
$mes=8;
$anio=2009;*/
$where="status='P' AND almes='$mes' AND alanio='$anio'";

if ($nombre!="")
 {
	$where.=" AND contratante='".$nombre."'";
 }
if ($numpol!="")
{
	$where.=" AND numpoliza='".$numpol."'";
}

$cnx=conectar();
$sql="SELECT id,numpoliza,tipopoliza,contratante,aldia,almes,alanio FROM poliza WHERE ".$where." ORDER BY numpoliza ASC, almes ASC";
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)>0)
 {
?>
	<table width='700' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td width="108"><div id='etiqueta'><label>P&oacute;liza</label></div></td>
		<td width="273"><div id='etiqueta'><label>Contratante</label></div></td>
		<td width="94"><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>
		<td width="119"><div id='etiqueta'><label>Fecha vencimiento</label></div></td>
		<td width="94"><div id='etiqueta'>
		  <label>Renovar</label></div></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		</tr>
<?
		$cont=1;
		while (list($id,$numpoliza,$tipopoliza,$contratante,$aldia,$almes,$alanio) = mysql_fetch_array($res))
			{
?>
				<form name='paypoliza' method='POST' action='renuevapol.php'>
                <tr <? if ($cont%2==0){ echo "bgcolor='#333333'";}?>>
                <td><div id='etiqueta'><label><? echo $numpoliza; ?></label></div></td>
                <td><div id='etiqueta'><label><? echo $contratante; ?></label></div></td>
                <td><div id='etiqueta'><label><? echo $tipopoliza; ?><input type="hidden" name="tipo" value="<? echo $tipopoliza; ?>" /></label></div></td>
                <td><div id='etiqueta'><label><? echo $aldia."/".$almes."/".$alanio; ?></label></div></td>
                <td><div id='etiqueta'><label><input type="hidden" name="id" value="<? echo $id; ?>" /><input name='submit' type='submit' id='submit' value='Renovar' /></label></div></td>
                </tr>
				</form>
<?
				$cont++;
			}
?>								
			</table>
<?
 }
else
	{
?>
	<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td><div id='etiqueta'>
		  <label>No se encontraron p&oacute;lizas para renovar.</label></div></td>
		</tr>
	</table>
<?
	}
?>