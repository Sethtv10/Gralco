<?php
include("config.php");
include("funciones.php");
include("secure.php");

$nombre=$_POST['nombre'];
$numpol=$_POST['poliza'];

if ((isset($_POST['nombre']))&&($nombre!="")&&(isset($_POST['poliza']))&&($numpol!=""))
{
	$cnx=conectar();
	$sql="SELECT id,numpoliza,tipopoliza,contratante,status FROM poliza WHERE contratante='".$nombre."' AND numpoliza='".$numpol."' AND status!='C' ORDER BY numpoliza ASC";
	$res=mysql_query($sql) or die (mysql_error());
	if (mysql_num_rows($res)>0)
	  {
		?>
		<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td width="89"><div id='etiqueta'><label>P&oacute;liza</label></div></td>
		<td width="76"><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>
		<td width="69"><div id='etiqueta'><label>Status</label></div></td>
		<td width="265"><div id='etiqueta'><label>Motivo</label></div></td>
		<td width="89"><div id='etiqueta'><label>Acci&oacute;n</label></div></td>
		</tr>
		<tr>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		</tr>
<?
		while (list($id,$numpoliza,$tipopoliza,$contratante,$status) = mysql_fetch_array($res))
			{
				if ($status=='D')
					$estado="No liquidada";
				if ($status=='P')
					$estado="Pagada";
				if ($status=='R')
					$estado="Renovada";
?>
				<form name='paypoliza' method='POST' action='cancelapol.php'>
				<tr>
				<td><div id='etiqueta'><label><? echo $numpoliza; ?></label></div></td>
				<td><div id='etiqueta'><label><? echo $tipopoliza; ?></label></div></td>
				<td><div id='etiqueta'><label><? echo $estado; ?></label></div></td>
				<td><div id='etiqueta'><label><textarea name='motivo' cols='3' rows='1'></textarea></label></div></td>
				<td><div id='etiqueta'><label><input type='hidden' name='id' value='<? echo $id; ?>' /><input type='submit' name='submit' value='Cancelar'/></label></div></td>
				</tr>
				</form>
<?
			}
?>
		 </table>
	<?
		}
		else
			{
				echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>No se encontr&oacute; la p&oacute;liza, puede estar cancelada</label></div></td></tr></table>\n";
			}
}
if (($nombre=="")&&($numpol!=""))//enviaron numero de poliza
{
	$cnx=conectar();
	$sql="SELECT id,numpoliza,tipopoliza,contratante,status FROM poliza WHERE numpoliza='".$numpol."' AND status!='C' ORDER BY numpoliza ASC";
	$res=mysql_query($sql) or die (mysql_error());
	if (mysql_num_rows($res)>0)
	  {
		?>
		<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td width="82"><div id='etiqueta'><label>P&oacute;liza</label></div></td>
		<td width="84"><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>
		<td width="103"><div id='etiqueta'><label>Contratante</label></div></td>
		<td width="102"><div id='etiqueta'><label>Status</label></div></td>
		<td width="128"><div id='etiqueta'><label>Motivo</label></div></td>
		<td width="87"><div id='etiqueta'><label>Acci&oacute;n</label></div></td>
		</tr>
		<tr>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		</tr>
<?
		while (list($id,$numpoliza,$tipopoliza,$contratante,$status) = mysql_fetch_array($res))
			{
				if ($status=='D')
					$estado="No liquidada";
				if ($status=='P')
					$estado="Pagada";
				if ($status=='R')
					$estado="Renovada";
?>
				<form name='paypoliza' method='POST' action='cancelapol.php'>
				<tr>
				<td><div id='etiqueta'><label><? echo $numpoliza; ?></label></div></td>
				<td><div id='etiqueta'><label><? echo $tipopoliza; ?></label></div></td>
				<td><div id='etiqueta'><label><? echo $contratante; ?></label></div></td>
				<td><div id='etiqueta'><label><? echo $estado; ?></label></div></td>
				<td><textarea name='motivo' cols='3' rows='1'></textarea></td>
				<td><div id='etiqueta'><label><input type='hidden' name='id' value='$id' /><input type='submit' name='submit' value='Cancelar'/></label></div></td>
				</tr>
				</form>
<?
			}
?>
		</table>
<?		
		}
		else
			{
				echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>>No se encontr&oacute; la p&oacute;liza, puede estar cancelada</label></div></td></tr></table>\n";
			}
}
if (($nombre!="")&&($numpol==""))//enviaron numero de poliza
{
	$cnx=conectar();
	$sql="SELECT id,numpoliza,tipopoliza,contratante,status FROM poliza WHERE contratante='".$nombre."' AND status!='C' ORDER BY numpoliza ASC";
	$res=mysql_query($sql) or die (mysql_error());
	if (mysql_num_rows($res)>0)
	  {
?>
		<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>
		<tr>
		<td width="81"><div id='etiqueta'><label>P&oacute;liza</label></div></td>;
		<td width="83"><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>
		<td width="106"><div id='etiqueta'><label>Contratante</label></div></td>
		<td width="99"><div id='etiqueta'><label>Status</label></div></td>
		<td width="130"><div id='etiqueta'><label>Motivo</label></div></td>
		<td width="87"><div id='etiqueta'><label>Acci&oacute;n</label></div></td>
		</tr>
		<tr>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		<td><div id='etiqueta'><label>&nbsp;</label></div></td>
		</tr>
<?
		while (list($id,$numpoliza,$tipopoliza,$contratante,$status) = mysql_fetch_array($res))
			{
				if ($status=='D')
					$estado="No liquidada";
				if ($status=='P')
					$estado="Pagada";
				if ($status=='R')
					$estado="Renovada";
?>
				<form name='paypoliza' method='POST' action='cancelapol.php'>
				<tr>
				<td><div id='etiqueta'><label><? echo $numpoliza; ?></label></div></td>
				<td><div id='etiqueta'><label><? echo $tipopoliza; ?></label></div></td>
				<td><div id='etiqueta'><label><? echo $contratante; ?></label></div></td>
				<td><div id='etiqueta'><label><? echo $estado; ?></label></div></td>
				<td><textarea name='motivo' cols='3' rows='1'></textarea></td>
				<td><div id='etiqueta'><label><input type='hidden' name='id' value='$id' /><input type='submit' name='submit' value='Cancelar'/></label></div></td>
				</tr>
				</form>
<?						
			}
?>
		 </table>
<?
		}
		else
			{
				echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>>No se encontr&oacute; la p&oacute;liza, puede estar cancelada</label></div></td></tr></table>\n";
			}
}
?>
