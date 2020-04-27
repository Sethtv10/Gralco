<?php
include("config.php");
include("funciones.php");
include("secure.php");

$poliza=$_POST['poliza'];
$cnx=conectar();

function buscaant($polizabus)
{
	$sqlbus="SELECT numpoliza,tipopoliza,contratante,deldia,delmes,delanio,compania,primaneta,importetotal,polizaant,status FROM poliza WHERE numpoliza='".$polizabus."' ORDER BY delanio DESC";
	$resbus=mysql_query($sqlbus) or die (mysql_error());
	if (mysql_num_rows($resbus)>0)
 	{	
		while (list($numpoliza,$tipopoliza,$contratante,$deldia,$delmes,$delanio,$compania,$primaneta,$importetotal,$polizaant,$status) = mysql_fetch_array($resbus))
		{
?>
				<tr>
				<td width="102"><font color="#FFFFFF"><? echo $numpoliza; ?></font></td>
				<td width="102"><font color="#FFFFFF"><? echo $polizaant; ?></font></td>
				<td width="87"><font color="#FFFFFF"><? echo $tipopoliza; ?></font></td>
				<td width="208"><font color="#FFFFFF"><? echo $contratante; ?></font></td>
				<td width="79"><font color="#FFFFFF"><? echo $deldia." / ".$delmes." / ".$delanio; ?></font></td>
				<td width="111"><font color="#FFFFFF"><? echo $compania; ?></font></td>
				<td width="87"><font color="#FFFFFF"><? echo $primaneta; ?></font></td>
				<td width="106"><font color="#FFFFFF"><? echo $importetotal; ?></font></td>
				</tr>
<?
		if($polizaant!="0")
			buscaant($polizaant);
		}
	}
}

$sql="SELECT numpoliza,tipopoliza,contratante,deldia,delmes,delanio,compania,primaneta,importetotal,polizaant,status FROM poliza WHERE numpoliza='".$poliza."' ORDER BY delanio DESC";
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)>0)
 {
?>
		<table width='900' cellpadding='0' cellspacing='0' border='1' align='center'>
        <tr bgcolor="#999999">
        <td width="102"><font color="#FFFFFF">Poliza</font></td>
        <td width="102"><font color="#FFFFFF">Poliza Anterior</font></td>
        <td width="81"><font color="#FFFFFF">Tipo</font></td>
        <td width="207"><font color="#FFFFFF">Contratante</font></td>
        <td width="104"><font color="#FFFFFF">Vigencia del</font></td>
        <td width="93"><font color="#FFFFFF">Compañia</font></td>
        <td width="87"><font color="#FFFFFF">Prima neta</font></td>
        <td width="106"><font color="#FFFFFF">Prima total</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
        <td>&nbsp;</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>	
        </tr>
<?
		while (list($numpoliza,$tipopoliza,$contratante,$deldia,$delmes,$delanio,$compania,$primaneta,$importetotal,$polizaant,$status) = mysql_fetch_array($res))
			{
?>
                    <tr>
                    <td width="102"><font color="#FFFFFF"><? echo $numpoliza; ?></font></td>
                    <td width="102"><font color="#FFFFFF"><? echo $polizaant; ?></font></td>
                    <td width="81"><font color="#FFFFFF"><? echo $tipopoliza; ?></font></td>
                    <td width="207"><font color="#FFFFFF"><? echo $contratante; ?></font></td>
                    <td width="104"><font color="#FFFFFF"><? echo $deldia." / ".$delmes." / ".$delanio; ?></font></td>
                    <td width="93"><font color="#FFFFFF"><? echo $compania; ?></font></td>
                    <td width="87"><font color="#FFFFFF"><? echo $primaneta; ?></font></td>
                    <td width="106"><font color="#FFFFFF"><? echo $importetotal; ?></font></td>
                    </tr>
<?
			if($polizaant!="0")
				buscaant($polizaant);
			}//while
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
		<td><div id='etiqueta'><label>No se encontraron polizas.</label></div></td>
		</tr>
	</table>
<?
	}
?>