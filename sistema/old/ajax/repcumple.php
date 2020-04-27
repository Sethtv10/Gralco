<?php
include("config.php");
include("funciones.php");
include("secure.php");

$mes=$_POST['mes'];

$cnx=conectar();
$sql="SELECT nombre,dia,tel,telmov FROM cliente WHERE tipoclie='particular' AND mes='".$mes."'";
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)>0)
 {
?>
		<table width='900' cellpadding='0' cellspacing='0' border='1' align='center'>
        <tr>
        <td width="318"><div id='etiqueta'>
          <label>Nombre</label></div></td>
        <td width="71"><div id='etiqueta'>
          <label>Dia</label></div></td>
        <td width="129"><div id='etiqueta'>
          <label>Teléfono</label></div></td>
        <td width="372"><div id='etiqueta'>
          <label>Tel Móvil</label></div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>
        <td><div id='etiqueta'><label>&nbsp;</label></div></td>	
        </tr>
<?
		while (list($nombre,$dia,$tel,$telcel) = mysql_fetch_array($res))
			{
?>
                    <tr>
                    <td><div id='etiqueta'><label><? echo $nombre; ?></label></div></td>
                    <td><div id='etiqueta'><label><? echo $dia; ?></label></div></td>
                    <td><div id='etiqueta'><label><? echo $tel; ?></label></div></td>
                    <td><div id='etiqueta'><label><? echo $telcel; ?></label></div></td>
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
		<td><div id='etiqueta'><label>No se encontraron clientes que cumplan años en este mes.</label></div></td>
		</tr>
	</table>
<?
	}
?>