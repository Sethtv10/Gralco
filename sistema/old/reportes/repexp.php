<?
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");
$cnx=conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
<script type="text/javascript" src="../ajax/prototype.js"></script>
<script type="text/javascript" src="../ajax/AjaxLib.js"></script>
<script type="text/javascript" src="../ajax/scriptaculous.js"></script>    
<script type="text/javascript" src="../ajax/paypol.js"></script>
<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
		<? include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Reporte fecha de expedici&oacute;n.</p>
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
                                            <option value="todos">Todos</option>
										</select></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Año:</label></div></td>
									<td><input type="text" name="anio" id="anio" autocomplete="off" size="10" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Compañia:</label></div></td>
									<td><select name="compania" size="1" id="compania" >
									<option selected="selected" value="AXA">AXA</option>
									<option value="GNP">GNP</option>
									<option value="ABA">ABA</option>
                                    <option value="Bupa">Bupa</option>
                                    <option value="Metlife">Metlife</option>
									<option value="todas">Todas</option>
									</select></td>
								</tr>
								<tr>
									<td><div id="etiqueta"><label>Categoría:</label></div></td>
									<td><select name="categoria" size="1" id="categoria" >
									<option selected="selected" value="autos">Autos</option>
									<option value="gm">Gastos médicos</option>
									<option value="vida">Vida</option>
                                    <option value="daños">Daños</option>
                                    <option value="camiones">Camiones</option>
									<option value="todas">Todas</option>
									</select></td>
								</tr>
                                <tr>
									<td><div id="etiqueta">
									  <label>Subagente:</label></div></td>
									<td>
                                    <select name="subagente" id="subagente" size="1" >
                                    <option value="cualquiera">Todos</option>
									<? 	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%subagente%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
									?>
									<option value="<? echo $nombre; ?>"><? echo $nombre; ?></option>
                                    <? 		}	 ?>
									</select></td>
								</tr>
								<tr valign="top">
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr valign="top" align="center">
									<td colspan="2" align="center"><input type="button" value="Consultar" onclick="buscapol('../ajax/repexp.php','showpol','mes='+document.getElementById('mes').value+'&anio='+document.getElementById('anio').value+'&compania='+document.getElementById('compania').value+'&categoria='+document.getElementById('categoria').value+'&subagente='+document.getElementById('subagente').value,'POST');"/>
</td>
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