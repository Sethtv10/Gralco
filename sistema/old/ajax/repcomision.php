<?php
include("config.php");
include("funciones.php");
include("secure.php");

$compania=$_POST['compania'];
$categoria=$_POST['categoria'];
$mes=$_POST['mes'];
$anio=$_POST['anio'];

$where="delmes='".$mes."' AND delanio='".$anio."' AND subagente='".$_POST['subagente']."'";

if ($compania!="todas")
{
	$where.=" AND compania='".$compania."'";
}
if ($categoria!="todas")
{
	$where.=" AND tipopoliza='".$categoria."'";
}
$where.=" AND status!='C'";

$order.=" ORDER BY tipopoliza ASC, compania ASC";
$cnx=conectar();
$sql="SELECT id,numpoliza,tipopoliza,contratante,compania,subagente,primaneta,gastoexp,importetotal FROM poliza WHERE ".$where.$order;
echo "SQL: ".$sql;
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)>0)
 {
?>
		<table width='900' cellpadding='0' cellspacing='0' border='1' align='center'>
        <tr>
        <td width="88" align="center" bgcolor="#666666"><font color="#FFFFFF">P&oacute;liza</font></td>
        <td width="179" align="center" bgcolor="#666666"><font color="#FFFFFF">Contratante</font></td>
        <td width="68" align="center" bgcolor="#666666"><font color="#FFFFFF">Compa&ntilde;&iacute;a</font></td>
        <td width="96" align="center" bgcolor="#666666"><font color="#FFFFFF">Tipo p&oacute;liza</font></td>
        <td width="166" align="center" bgcolor="#666666"><font color="#FFFFFF">Subagente</font></td>
        <td width="97" align="center" bgcolor="#666666"><font color="#FFFFFF">Prima neta</font></td>
        <td width="91" align="center" bgcolor="#666666"><font color="#FFFFFF">Comision</font></td>
        <td width="97" align="center" bgcolor="#666666"><font color="#FFFFFF">Prima total</font></td>
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
		$neta=0;
		$total=0;
		$comision=0;
		while (list($id,$numpoliza,$tipopoliza,$contratante,$compania,$subagente,$primaneta,$gastoexp,$importetotal) = mysql_fetch_array($res))
			{
				$neta=$neta+$primaneta;
				$total=$total+$importetotal;
				$comision=$comision+$gastoexp;
?>
                    <tr>
                    <td><font color="#FFFFFF"><? echo $numpoliza; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $contratante; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $compania; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $tipopoliza; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $subagente; ?></font></td>
                    <td><font color="#FFFFFF">$<? echo $primaneta; ?></font></td>
                    <td><font color="#FFFFFF">$<? echo $gastoexp; ?></font></td>
                    <td><font color="#FFFFFF">$<? echo $importetotal; ?></font></td>
                    </tr>
<?				
			}
?>
			<tr>
            	<td colspan="7">&nbsp;</td>
            </tr>
            <tr>
            	<td colspan="5" bgcolor="#666666">&nbsp;</td>
                <td bgcolor="#666666"><font color="#FFFFFF">$<? echo $neta; ?></font></td>
                <td bgcolor="#666666"><font color="#FFFFFF">$<? echo $comision; ?></font></td>
                <td bgcolor="#666666"><font color="#FFFFFF">$<? echo $total; ?></font></td>
            </tr>
			</table>
			<br>
<?
 }
else
	{
?>
	<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td><font color="#FFFFFF">No se encontro p&oacute;lizas capturadas.</font></td>
		</tr>
	</table>
<?
	}
?>