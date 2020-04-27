<?php
include("config.php");
include("funciones.php");
include("secure.php");
$cnx=conectar();
$mes=$_POST['mes'];
$anio=$_POST['anio']; ?>
<h1 style="color:#FFF">Pagados</h1>
<?
$sqla="SELECT id,numpol,numpago,diavenc,mesvenc,aniovenc,diapago,mespago,aniopago,monto FROM recibos WHERE status='P' AND mesvenc='".$mes."' AND aniovenc='".$anio."' ORDER BY diavenc ASC, mesvenc ASC";
$resa=mysql_query($sqla) or die (mysql_error());
if (mysql_num_rows($resa)>0)
 { ?>
 					<table width='900' cellpadding='0' cellspacing='0' border='1' align='center'>
                        <tr bgcolor="#CCCCCC">
                        <td width="71"><font color="#FFFFFF">P&oacute;liza</font></td>
                        <td width="73"><font color="#FFFFFF">Tipo poliza</font></td>
                        <td width="83"><font color="#FFFFFF">Aseguradora</font></td>
                        <td width="170"><font color="#FFFFFF">Asegurado</font></td>
                        <td width="56"><font color="#FFFFFF">Importe</font></td>
                        <td width="121"><font color="#FFFFFF">Fecha vencimiento</font></td>
                        <td width="97"><font color="#FFFFFF">Fecha de pago</font></td>
                        <td width="86"><font color="#FFFFFF">Tel&eacute;fono</font></td>
                        <td width="123"><font color="#FFFFFF">Subagente</font></td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>	
                        <td>&nbsp;</td>
                        </tr>
  <?
		while (list($id,$numpol,$numpago,$diavenc,$mesvenc,$aniovenc,$diapago,$mespago,$aniopago,$monto) = mysql_fetch_array($resa))
			{
				$sqlpol="SELECT numpoliza,tipopoliza,contratante,compania,subagente FROM poliza WHERE id='".$numpol."' LIMIT 1";
				$respol=mysql_query($sqlpol) or die(mysql_error());
				$resu=mysql_fetch_array($respol);
				$sql3="SELECT tel FROM cliente WHERE nombre='".$resu['contratante']."'";
				$res3=mysql_query($sql3) or die (mysql_error());
				if (mysql_num_rows($res3)>0)
					{
						while (list($tel) = mysql_fetch_array($res3))
							{
								$telefono=$tel;
							}
					}
?>
						<tr>
						<td><font color="#FFFFFF"><? echo $resu['numpoliza']; ?></font></td>
						<td><font color="#FFFFFF"><? echo $resu['tipopoliza']; ?></font></td>
						<td><font color="#FFFFFF"><? echo $resu['compania']; ?></font></td>
						<td><font color="#FFFFFF"><? echo $resu['contratante']; ?></font></td>
						<td><font color="#FFFFFF"><? echo $monto; ?></font></td>
						<td><font color="#FFFFFF"><? echo $diavenc."/".$mesvenc."/".$aniovenc; ?></font></td>
						<td><font color="#FFFFFF"><? echo $diapago."/".$mespago."/".$aniopago; ?></font></td>
						<td><font color="#FFFFFF"><? echo $telefono; ?></font></td>
						<td><font color="#FFFFFF"><? echo $resu['subagente']; ?></font></td>
						</tr>
<?
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
		<td><font color="#FFFFFF">No se encontraron recibos pagados.</font></td>
		</tr>
	</table>
<?
	}
?>
<h1 style="color:#FFF">Por pagar</h1>
<?
$sqlab="SELECT id,numpol,numpago,diavenc,mesvenc,aniovenc,diapago,mespago,aniopago,monto FROM recibos WHERE status='D' AND mesvenc='".$mes."' AND aniovenc='".$anio."' ORDER BY diavenc ASC, mesvenc ASC";
$resab=mysql_query($sqlab) or die (mysql_error());
if (mysql_num_rows($resab)>0)
 { ?>
 					<table width='900' cellpadding='0' cellspacing='0' border='1' align='center'>
                        <tr bgcolor="#CCCCCC">
                        <td width="71"><font color="#FFFFFF">P&oacute;liza</font></td>
                        <td width="73"><font color="#FFFFFF">Tipo poliza</font></td>
                        <td width="83"><font color="#FFFFFF">Aseguradora</font></td>
                        <td width="170"><font color="#FFFFFF">Asegurado</font></td>
                        <td width="56"><font color="#FFFFFF">Importe</font></td>
                        <td width="121"><font color="#FFFFFF">Fecha vencimiento</font></td>                        
                        <td width="86"><font color="#FFFFFF">Tel&eacute;fono</font></td>
                        <td width="123"><font color="#FFFFFF">Subagente</font></td>
                        </tr>
                        <tr bgcolor="#CCCCCC">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>	
                        <td>&nbsp;</td>
                        </tr>
  <?
		while (list($id,$numpol,$numpago,$diavenc,$mesvenc,$aniovenc,$monto) = mysql_fetch_array($resab))
			{
				$sqlpolb="SELECT numpoliza,tipopoliza,contratante,compania,subagente FROM poliza WHERE id='".$numpol."' LIMIT 1";
				$respolb=mysql_query($sqlpolb) or die(mysql_error());
				$resub=mysql_fetch_array($respolb);
				$sql3b="SELECT tel FROM cliente WHERE nombre='".$resub['contratante']."'";
				$res3b=mysql_query($sql3b) or die (mysql_error());
				if (mysql_num_rows($res3b)>0)
					{
						while (list($telb) = mysql_fetch_array($res3b))
							{
								$telefonob=$telb;
							}
					}
?>
						<tr>
						<td><font color="#FFFFFF"><? echo $resub['numpoliza']; ?></font></td>
						<td><font color="#FFFFFF"><? echo $resub['tipopoliza']; ?></font></td>
						<td><font color="#FFFFFF"><? echo $resub['compania']; ?></font></td>
						<td><font color="#FFFFFF"><? echo $resub['contratante']; ?></font></td>
						<td><font color="#FFFFFF"><? echo $monto; ?></font></td>
						<td><font color="#FFFFFF"><? echo $diavenc."/".$mesvenc."/".$aniovenc; ?></font></td>
						<td><font color="#FFFFFF"><? echo $telefonob; ?></font></td>
						<td><font color="#FFFFFF"><? echo $resub['subagente']; ?></font></td>
						</tr>
<?
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
		<td><font color="#FFFFFF">No se encontraron recibos por pagar.</font></td>
		</tr>
	</table>
<?
	}
?>