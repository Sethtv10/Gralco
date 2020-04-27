<?
include("ajax/config.php");
include("ajax/funciones.php");
include("ajax/secure.php");
if(isset($_POST['submit']))
{

$numpol=$_POST['txtNombre'];
$cnx=conectar();

$sql="SELECT id FROM cliente WHERE nombre='".$numpol."'";
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)>0)
 {
	while(list($id)=mysql_fetch_array($res))
	{
			header("LOCATION: editar/cliente.php?num=$id");
			exit;
	}
 }
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
<script type="text/javascript" src="ajax/prototype.js"></script>
<script type="text/javascript" src="ajax/AjaxLib.js"></script>
<script type="text/javascript" src="ajax/scriptaculous.js"></script>
<script type="text/javascript" src="ajax/cliente.js"></script>
<script type="text/javascript" src="ajax/mundo.js"></script>
<link rel="stylesheet" href="estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
		<? include("menu.php"); ?>
	</div>	

<div id="contenido">
		<p>Editar cliente</p>
			<form id="formRegistro" action="editcliente.php" method="post">
			<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td width="950">
						<table width="430" align="center" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td width="142">
						      <font color="#FFFFFF">Nombre del cliente:</font></td>
									<td width="288"><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" />
            							<div id="autonombre" class="autocomplete" style="display:none"></div></td>
								</tr>
								<tr valign="top">
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr valign="top" align="center">
									<td colspan="2" align="center"><input type="submit" value="Consultar" name="submit"/>
<div id="autopoliza" class="autocomplete" style="display:none"></div></td>
								</tr>
						</table>
					</td> 
				</tr>
			</table>
			</form>
			<br />
			<div id="showpol"></div>
	</div>
</body>
</html>