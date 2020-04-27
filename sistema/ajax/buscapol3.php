<?php
include("config.php");
include("funciones.php");
include("secure.php");

$nombre=$_POST['nombre'];
$numpol=$_POST['poliza'];

if ((isset($_POST['nombre']))&&($nombre!="")&&(isset($_POST['poliza']))&&($numpol!=""))
{
	$cnx=conectar();
	$sql="SELECT id,numpoliza,tipopoliza,contratante,status FROM poliza WHERE contratante='".$nombre."' AND numpoliza='".$numpol."' AND status='P' ORDER BY numpoliza ASC";
	$res=mysql_query($sql) or die (mysql_error());
	if (mysql_num_rows($res)>0)
	  {
		
		echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
		echo "<tr>\n";
		echo "<td><div id='etiqueta'><label>P&oacute;liza</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Status</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Nuevo n&uacute;mero</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Acci&oacute;n</label></div></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "</tr>\n";
		while (list($id,$numpoliza,$tipopoliza,$contratante,$status) = mysql_fetch_array($res))
			{
				if ($status=='D')
					$estado="No liquidada";
				if ($status=='P')
					$estado="Pagada";
				if ($status=='R')
					$estado="Renovada";
				echo "<form name='paypoliza' method='POST' action='renewpol.php'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>$numpoliza</label></div></td>\n";
				echo "<td><div id='etiqueta'><label>$tipopoliza</label></div></td>\n";
				echo "<td><div id='etiqueta'><label>$estado</label></div></td>\n";
				echo "<td><div id='etiqueta'><label><input type='text' name='newnumber' size='15'/></label></div></td>\n";
				echo "<td><div id='etiqueta'><label><input type='hidden' name='id' value='$id' /><input type='submit' name='submit' value='Renovar'/></label></div></td>\n";
				echo "</tr>\n";
				echo "</form>\n";
			}
		 echo "</table>\n";
		
		}
		else
			{
				echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>No se encontr&oacute; la p&oacute;liza, puede tener adeudo.</label></div></td></tr></table>\n";
			}
}
if (($nombre=="")&&($numpol!=""))//enviaron numero de poliza
{
	$cnx=conectar();
	$sql="SELECT id,numpoliza,tipopoliza,contratante,status FROM poliza WHERE numpoliza='".$numpol."' AND status='P' ORDER BY numpoliza ASC";
	$res=mysql_query($sql) or die (mysql_error());
	if (mysql_num_rows($res)>0)
	  {
		//echo "<form name='paypoliza' method='POST' action='pagapol.php'>\n";
		echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
		echo "<tr>\n";
		echo "<td><div id='etiqueta'><label>P&oacute;liza</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Contratante</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Status</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Nuevo n&uacute;mero</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Acci&oacute;n</label></div></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "</tr>\n";
		while (list($id,$numpoliza,$tipopoliza,$contratante,$status) = mysql_fetch_array($res))
			{
				if ($status=='D')
					$estado="No liquidada";
				if ($status=='P')
					$estado="Pagada";
				if ($status=='R')
					$estado="Renovada";
				echo "<form name='paypoliza' method='POST' action='renewpol.php'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>$numpoliza</label></div></td>\n";
				echo "<td><div id='etiqueta'><label>$tipopoliza</label></div></td>\n";
				echo "<td><div id='etiqueta'><label>$contratante</label></div></td>\n";
				echo "<td><div id='etiqueta'><label><input type='text' name='newnumber' size='15'/></label></div></td>\n";
				echo "<td><div id='etiqueta'><label><input type='hidden' name='id' value='$id' /><input type='submit' name='submit' value='Renovar'/></label></div></td>\n";
				echo "</tr>\n";
				echo "</form>\n";
			}
		 echo "</table>\n";
		// echo "</form>\n";
		}
		else
			{
				echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>>No se encontr&oacute; la p&oacute;liza, puede tener adeudo</label></div></td></tr></table>\n";
			}
}
if (($nombre!="")&&($numpol==""))//enviaron numero de poliza
{
	$cnx=conectar();
	$sql="SELECT id,numpoliza,tipopoliza,contratante,status FROM poliza WHERE contratante='".$nombre."' AND status='P' ORDER BY numpoliza ASC";
	$res=mysql_query($sql) or die (mysql_error());
	if (mysql_num_rows($res)>0)
	  {
		//echo "<form name='paypoliza' method='POST' action='pagapol.php'>\n";
		echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
		echo "<tr>\n";
		echo "<td><div id='etiqueta'><label>P&oacute;liza</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Tipo p&oacute;liza</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Contratante</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Status</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Nuevo n&uacute;mero</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>Acci&oacute;n</label></div></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "<td><div id='etiqueta'><label>&nbsp;</label></div></td>\n";
		echo "</tr>\n";
		while (list($id,$numpoliza,$tipopoliza,$contratante,$status) = mysql_fetch_array($res))
			{
				if ($status=='D')
					$estado="No liquidada";
				if ($status=='P')
					$estado="Pagada";
				if ($status=='R')
					$estado="Renovada";
				echo "<form name='paypoliza' method='POST' action='renewpol.php'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>$numpoliza</label></div></td>\n";
				echo "<td><div id='etiqueta'><label>$tipopoliza</label></div></td>\n";
				echo "<td><div id='etiqueta'><label>$contratante</label></div></td>\n";
				echo "<td><div id='etiqueta'><label>$estado</label></div></td>\n";
				echo "<td><div id='etiqueta'><label><input type='text' name='newnumber' size='15'/></label></div></td>\n";
				echo "<td><div id='etiqueta'><label><input type='hidden' name='id' value='$id' /><input type='submit' name='submit' value='Renovar'/></label></div></td>\n";
				echo "</tr>\n";
				echo "</form>\n";
						
			}
		 echo "</table>\n";
		 //echo "</form>\n";
		}
		else
			{
				echo "<table width='600' cellpadding='0' cellspacing='0' border='1' align='center'>\n";
				echo "<tr>\n";
				echo "<td><div id='etiqueta'><label>>No se encontraron polizas con ese contratante, puede tener adeudo</label></div></td></tr></table>\n";
			}
}
?>
