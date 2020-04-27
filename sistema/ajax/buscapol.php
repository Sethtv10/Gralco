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
$where="status='D'";

if ($nombre!="")
 {
	$where.=" AND contratante='".$nombre."'";
 }
if ($numpol!="")
{
	$where.=" AND numpoliza='".$numpol."'";
}

$cnx=conectar();
$sql="SELECT id,numpoliza,tipopoliza,contratante FROM poliza WHERE ".$where." ORDER BY numpoliza ASC";
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)>0)
 {
?>
	<form name='paypoliza' method='POST' action='pagapol.php'>
	<table width='700' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td width="68"><div id='etiqueta'><label>P&oacute;liza</label></div></td>
		<td width="164"><div id='etiqueta'><label>Contratante</label></div></td>
		<td width="67"><div id='etiqueta'><label>Telefono</label></div></td>
		<td width="75"><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>
		<td width="71"><div id='etiqueta'><label>Fecha vencimiento</label></div></td>
        <td width="190"><div id='etiqueta'>
          <label>Fecha pago</label></div></td>
		<td width="49"><div id='etiqueta'><label>Pagar</label></div></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
        <td><div id='etiqueta'>&nbsp;</div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		</tr>
<?
		while (list($id,$numpoliza,$tipopoliza,$contratante) = mysql_fetch_array($res))
			{
				$idant=$id;
				$contra=$contratante;
				$tipo=$tipopoliza;
				$num=$numpoliza;
				$sql2="SELECT id,numpol,diavenc,mesvenc,aniovenc,monto FROM recibos WHERE numpol='".$idant."' AND status='D' AND mesvenc<='".$mes."' AND aniovenc<='".$anio."' ORDER BY diavenc ASC, mesvenc ASC";
				$res2=mysql_query($sql2) or die (mysql_error());
				if (mysql_num_rows($res2)>0)
					{
						$cont=1;
						while (list($id,$numpol,$diavenc,$mesvenc,$aniovenc,$monto) = mysql_fetch_array($res2))
							{
								$idnew=$id;
								$sql3="SELECT tel FROM cliente WHERE nombre='".$contra."'";
								$res3=mysql_query($sql3) or die (mysql_error());
								if (mysql_num_rows($res3)>0)
									{
										while (list($tel) = mysql_fetch_array($res3))
											{
												$telefono=$tel;
											}
									}
?>
								<tr <? if ($cont%2==0){ echo "bgcolor='#333333'";}?>>
								<td><div id='etiqueta'><label><? echo $num; ?></label></div></td>
								<td><div id='etiqueta'><label><? echo $contra; ?></label></div></td>
								<td><div id='etiqueta'><label><? echo $telefono; ?></label></div></td>
								<td><div id='etiqueta'><label><? echo $tipo; ?></label></div></td>
								<td><div id='etiqueta'><label><? echo $diavenc."/".$mesvenc."/".$aniovenc; ?></label></div></td>
                                <td><div id='etiqueta'><input type="text" name="dia[<? echo $idnew; ?>]" size="1" maxlength="2" />&nbsp;<input type="text" name="mes[<? echo $idnew; ?>]" size="1" maxlength="2" />&nbsp;<input type="text" name="anio[<? echo $idnew; ?>]" size="2" maxlength="4" /></div></td>
								<td><div id='etiqueta'><label><input name='campos[<? echo $idnew; ?>]' type='checkbox' id='campos[<? echo $idnew; ?>]' value='<? echo $idnew; ?>' /></label></div></td>
								</tr>
<?
						$cont++;
							}
?>
								<tr bgcolor="#FFFFFF">
								<td colspan="6">&nbsp;</td>
								<td><div id='etiqueta'><label><input name='submit' type='submit' id='submit' value='Pagar' /></label></div></td>
								</tr>
<?
					}
			}
?>
			</table>
			</form>
<?
 }
else
	{
?>
	<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td><div id='etiqueta'>
		  <label>No se encontraron p&oacute;lizas para pagar.</label></div></td>
		</tr>
	</table>
<?
	}
?>