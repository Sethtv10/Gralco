<?php
include("config.php");
include("funciones.php");
include("secure.php");

$compania=$_POST['compania'];
$categoria=$_POST['categoria'];
$mes=$_POST['mes'];
$anio=$_POST['anio'];

$where="almes=".$mes." AND alanio=".$anio;

if ($compania!="todas")
{
	$where.=" AND compania='".$compania."'";
}
if ($categoria!="todas")
{
	$where.=" AND tipopoliza='".$categoria."'";
}
$where.=" AND status='C'";
$order.=" ORDER BY tipopoliza ASC, compania ASC, aldia ASC";
$cnx=conectar();
$sql="SELECT id,numpoliza,tipopoliza,contratante,compania,subagente,motivo FROM poliza WHERE ".$where.$order;
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)>0)
 {
?>
		<table width='900' cellpadding='0' cellspacing='0' border='1' align='center'>
        <tr>
        <td width="94"><div id='etiqueta'><label>P&oacute;liza</label></div></td>
        <td width="172"><div id='etiqueta'><label>Contratante</label></div></td>
        <td width="86"><div id='etiqueta'><label>Compa&ntilde;&iacute;a</label></div></td>
        <td width="88"><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>
        <td width="174"><div id='etiqueta'><label>Subagente</label></div></td>
        <td width="272"><div id='etiqueta'><label>Motivo</label></div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>	
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>
        </tr>
<?
		while (list($id,$numpoliza,$tipopoliza,$contratante,$compania,$subagente,$motivo) = mysql_fetch_array($res))
			{
?>
                    <tr>
                    <td><div id='etiqueta'><label><? echo $numpoliza; ?></label></div></td>
                    <td><div id='etiqueta'><label><? echo $contratante; ?></label></div></td>
                    <td><div id='etiqueta'><label><? echo $compania; ?></label></div></td>
                    <td><div id='etiqueta'><label><? echo $tipopoliza; ?></label></div></td>
                    <td><div id='etiqueta'><label><? echo $subagente; ?></label></div></td>
                    <td><div id='etiqueta'><label><? echo $motivo; ?></label></div></td>
                    </tr>
<?				
			}
?>
			</table>
			<br>
<?
 }
else
	{
?>
	<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td><div id='etiqueta'><label>No se encontro p&oacute;lizas canceladas.</label></div></td>
		</tr>
	</table>
<?
	}
?>