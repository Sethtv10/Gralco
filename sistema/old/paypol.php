<?php
include("ajax/config.php");
include("ajax/funciones.php");
include("ajax/secure.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
<script type="text/javascript" src="ajax/prototype.js"></script>
<script type="text/javascript" src="ajax/AjaxLib.js"></script>
<script type="text/javascript" src="ajax/scriptaculous.js"></script>    
<script type="text/javascript" src="ajax/buscapaypol.js"></script>
<script type="text/javascript" src="ajax/paypol.js"></script>
<link rel="stylesheet" href="estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
		<? include("menu.php"); ?>
	</div>	

<div id="contenido">
		<p>Pagar póliza</p>
			<form id="formRegistro">
			<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td width="950">
						<table width="430" align="center" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><div id="etiqueta">
									  <label>Mes:</label></div></td>
									<td><select name="mes" size="1" id="mes">
											<option selected="selected" value="1">Enero</option>
											<option value="2">Febrero</option>
											<option value="3">Marzo</option>
											<option value="4">Abril</option>
											<option value="5">Mayo</option>
											<option value="6">Junio</option>
											<option value="7">Julio</option>
											<option value="8">Agosto</option>
											<option value="9">Septiembre</option>
											<option value="10">Octubre</option>
											<option value="11">Noviembre</option>
											<option value="12">Diciembre</option>
										</select></td>
								</tr>
								<tr>
									<td><div id="etiqueta"><label>Contratante:</label></div></td>
									<td><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" />
            <div id="autonombre" class="autocomplete" style="display:none"></div></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta">
						      <label>Número de póliza:</label></div></td>
									<td><input type="text" name="txtpoliza" id="txtpoliza" autocomplete="off" size="55" />
            <div id="autopoliza" class="autocomplete" style="display:none"></div></td>
								</tr>
								<tr valign="top">
									<td colspan="2">&nbsp;<input type="hidden" value="<? echo date("Y"); ?>" name="anio" id="anio"/></td>
								</tr>
								<tr valign="top" align="center">
									<td colspan="2" align="center"><input type="button" value="Consultar" onclick="buscapol('ajax/buscapol.php','showpol','nombre='+document.getElementById('txtNombre').value+'&poliza='+document.getElementById('txtpoliza').value+'&anio='+document.getElementById('anio').value+'&mes='+document.getElementById('mes').value,'POST');"/>
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