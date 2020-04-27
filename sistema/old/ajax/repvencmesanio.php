<?php
include("config.php");
include("funciones.php");
include("secure.php");

$compania=$_POST['compania'];
$categoria=$_POST['categoria'];
$mes=$_POST['mes'];
$anio=$_POST['anio'];
if($anio=="")
{
	?>
	<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td><div id='etiqueta'><label>Debes de poner un a&ntilde;o</label></div></td>
		</tr>
	</table>
<?
exit;
}
if ($mes=="todos")
{
	$where="alanio=".$anio;
}
else
{
$where="almes<=".$mes." AND alanio<=".$anio;
}
if ($compania!="todas")
{
	$where.=" AND compania='".$compania."'";
}
if ($categoria!="todas")
{
	$where.=" AND tipopoliza='".$categoria."'";
}
$where.=" AND (status='D' OR status='P')";
$order.=" ORDER BY tipopoliza ASC, compania ASC, aldia ASC";
$cnx=conectar();
$sql="SELECT id,numpoliza,tipopoliza,contratante,compania,aldia,almes,alanio,formapago,importetotal,subagente FROM poliza WHERE ".$where.$order;
$res=mysql_query($sql) or die (mysql_error());
$cuan=mysql_num_rows($res);
if (mysql_num_rows($res)>0)
 { 
 $numautos=0;
 $numcamiones=0;
 $numgm=0;
 $numdanios=0;
 $numvida=0;
 ?>
	 	<table width='900' cellpadding='0' cellspacing='0' border='1' align='center'>
            <tr>
            <td width="56"><font color="#FFFFFF">P&oacute;liza</font></td>
            <td width="91"><font color="#FFFFFF">Aseguradora</font></td>
            <td width="104"><font color="#FFFFFF">Asegurado</font></td>
            <td width="60"><font color="#FFFFFF">Importe</font></td>
            <td width="74"><font color="#FFFFFF">Forma de pago</font></td>
            <td width="144"><font color="#FFFFFF">Descripci&oacute;n</font></td>
            <td width="90"><font color="#FFFFFF">Tel&eacute;fono</font></td>
            <td width="83"><font color="#FFFFFF">Fecha vencimiento</font></td>
            <td width="92"><font color="#FFFFFF">Cobertura</font></td>
            <td width="84"><font color="#FFFFFF">Subagente</font></td>
            </tr>
            <tr bgcolor="#FFFFFF">
            <td>&nbsp;</td>
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
		while (list($id,$numpoliza,$tipopoliza,$contratante,$compania,$aldia,$almes,$alanio,$formapago,$importetotal,$subagente) = mysql_fetch_array($res))
			{
				$gid=$id;
				$gnum=$numpoliza;
				$gtipo=$tipopoliza;
				$gcontra=$contratante;
				$gcompa=$compania;
				$galdia=$aldia;
				$galmes=$almes;
				$galanio=$alanio;
				$gimporte=$importetotal;
				$gsub=$subagente;
				if ($formapago==1)
				{
					$gforma="Anual";
				}
				if ($formapago==12)
				{
					$gforma="Mensual";
				}
				if ($formapago==3)
				{
					$gforma="Trimestral";
				}
				if ($formapago==6)
				{
					$gforma="Semestral";
				}
				$sql3="SELECT tel FROM cliente WHERE nombre='".$gcontra."'";
				$res3=mysql_query($sql3) or die (mysql_error());
				if (mysql_num_rows($res3)>0)
					{
						while (list($tel) = mysql_fetch_array($res3))
							{
								$telefono=$tel;
							}
					}
				if ($gtipo=="autos")
				{
					
					$sql4="SELECT * FROM autos WHERE idpol='".$gid."'";
					$res4=mysql_query($sql4) or die(mysql_error());
					$row = mysql_fetch_array($res4);
					if($numautos==0)
					{?>
					<tr>
                    <td colspan="10" bgcolor="#0000FF"><font color="#FFFFFF">&nbsp;Autos</font></td>
                    </tr>
                    <? } $numautos=1; ?>
                    <tr>
                    <td><font color="#FFFFFF"><? echo $gnum; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcompa; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcontra; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gimporte; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gforma; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['marca']." ".$row['placas']; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $telefono; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $galdia."/".$galmes."/".$galanio; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['cobertura']; ?></font></td>
					<td><font color="#FFFFFF"><? echo $gsub; ?></font></td>
                    </tr>
<?				}
				if ($gtipo=="camiones")
				{
					
					$sql4="SELECT * FROM camiones WHERE idpol='".$gid."'";
					$res4=mysql_query($sql4) or die(mysql_error());
					$row = mysql_fetch_array($res4);
					if($numcamiones==0)
					{?>
					<tr>
                    <td colspan="10" bgcolor="#0000FF"><font color="#FFFFFF">&nbsp;Camiones</font></td>
                    </tr>
                    <? } $numcamiones=1; ?>
                    <tr>
                   	<td><font color="#FFFFFF"><? echo $gnum; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcompa; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcontra; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gimporte; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gforma; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['marca']." ".$row['placas']; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $telefono; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $galdia."/".$galmes."/".$galanio; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['cobertura']; ?></font></td>
					<td><font color="#FFFFFF"><? echo $gsub; ?></font></td>
                    </tr>
                    
<?				}
				if ($gtipo=="gm")
				{
					
					$sql4="SELECT * FROM gm WHERE idpol='".$gid."'";
					$res4=mysql_query($sql4) or die(mysql_error());
					$row = mysql_fetch_array($res4);
					if($numgm==0)
					{?>
					<tr>
                    <td colspan="10" bgcolor="#0000FF"><font color="#FFFFFF">&nbsp;Gastos medicos</font></td>
                    </tr>
                    <? } $numgm=1; ?>
                    <tr>
                   	<td><font color="#FFFFFF"><? echo $gnum; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcompa; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcontra; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gimporte; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gforma; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['plan']; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $telefono; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $galdia."/".$galmes."/".$galanio; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['dependientes']; ?></font></td>
					<td><font color="#FFFFFF"><? echo $gsub; ?></font></td>
                    </tr>
                 <?
				}
				if ($gtipo=="vida")
				{
					
					$sql4="SELECT * FROM vida WHERE idpol='".$gid."'";
					$res4=mysql_query($sql4) or die(mysql_error());
					$row = mysql_fetch_array($res4);
					if($numvida==0)
					{?>
					<tr>
                    <td colspan="10" bgcolor="#0000FF"><font color="#FFFFFF">&nbsp;Vida</font></td>
                    </tr>
                    <? } $numvida=1; ?>
                    <tr>
                   	<td><font color="#FFFFFF"><? echo $gnum; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcompa; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcontra; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gimporte; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gforma; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['plan']; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $telefono; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $galdia."/".$galmes."/".$galanio; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['asegurado']; ?></font></td>
					<td><font color="#FFFFFF"><? echo $gsub; ?></font></td>
                    </tr>
                 <?
				}
				if (($gtipo!="autos")&&($gtipo!="camiones")&&($gtipo!="gm")&&($gtipo!="vida"))
				{
					$sql4="SELECT * FROM danios WHERE idpol='".$gid."'";
					$res4=mysql_query($sql4) or die(mysql_error());
					$row = mysql_fetch_array($res4);
					if($numdanios==0)
					{?>
					<tr>
                    <td colspan="10" bgcolor="#0000FF"><font color="#FFFFFF">&nbsp;Da&ntilde;os</font></td>
                    </tr>
                    <? } $numdanios=1; ?>
                    <tr>
                    <td><font color="#FFFFFF"><? echo $gnum; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcompa; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gcontra; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gimporte; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $gforma; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['edificio']; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $telefono; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $galdia."/".$galmes."/".$galanio; ?></font></td>
                    <td><font color="#FFFFFF"><? echo $row['contenidos']; ?></font></td>
					<td><font color="#FFFFFF"><? echo $gsub; ?></font></td>
                    </tr>
<?				} }
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
		<td><div id='etiqueta'><label>No se encontro p&oacute;lizas con vencimiento.</label></div></td>
		</tr>
	</table>
<?
	}
?>