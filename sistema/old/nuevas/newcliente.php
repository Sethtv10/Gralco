<?
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
<script type="text/javascript" src="../ajax/prototype.js"></script>
<script type="text/javascript" src="../ajax/AjaxLib.js"></script>
<script type="text/javascript" src="../ajax/scriptaculous.js"></script>    
<script type="text/javascript" src="../ajax/formulario.js"></script>
<script type="text/javascript" src="../ajax/mundo.js"></script>
<Script language="JavaScript" type="text/javascript">
function checamens(forma)
{
	var error="";
	if(document.getElementById('txtNombre').value=="")
	{
		error+="Debes de escribir el nombre del cliente \n";
		
	}
	if(document.getElementById('domicilio').value=="")
	{
		error+="Debes de escribir el domicilio del cliente \n";
		
	}
	if(document.getElementById('colonia').value=="")
	{
		error+="Debes de escribir la colonia del domicilio del cliente \n";
		
	}
	if(document.getElementById('cp').value=="")
	{
		error+="Debes de escribir el codigo postal del domicilio del cliente \n";
		
	}
	if(document.getElementById('ciudad').value=="")
	{
		error+="Debes de escribir la ciudad del cliente \n";
		
	}
	if(document.getElementById('estado').value=="")
	{
		error+="Debes de escribir el estado del domicilio del cliente \n";
		
	}
	if(error=="")
	{
		return true;
	}
	else
	{
		alert(error);
		return false;
	}
}
</script>
<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
		<? include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Nuevo cliente</p>
			<form id="formRegistro" action="../add/addcliente.php" method="post" onsubmit="return checamens(this);">
			<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td width="477">
						<table width="477" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><div id="etiqueta">
									  <label>Nombre:</label></div></td>
									<td><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" />
            <div id="autonombre" class="autocomplete" style="display:none"></div></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta">
									  <label>Domicilio:</label></div></td>
									<td><textarea name="domicilio" id="domicilio"></textarea></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Colonia:</label></div></td>
								  <td><input type="text" name="colonia" id="colonia" autocomplete="off" size="55" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>C.P:</label></div></td>
								  <td>
									<table width="370" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="59">
				<input type="text" name="cp" id="cp" autocomplete="off" size="5" maxlength="5" /></td>
											<td width="100" align="left"><div id="etiqueta">
									  <label>RFC:</label></div></td>
											<td width="211"><input type="text" name="rfc" id="rfc" autocomplete="off" size="22" /></td>
										</tr>
									</table>
								  </td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Ciudad:</label></div></td>
								  <td>
									<table width="370" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="75">
				<input type="text" name="ciudad" id="ciudad" autocomplete="off" size="15" /></td>
											<td width="100" align="left"><div id="etiqueta">
									  <label>Estado:</label></div></td>
											<td width="195"><input type="text" name="estado" id="estado" autocomplete="off" size="12" /></td>
										</tr>
									</table>
								  </td>
								</tr>
						</table>
					</td> 
					<td width="473">
						<table width="473" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td width="101"><div id="etiqueta">Número de cliente:</div></td>
									<td width="372"><input type="text" size="20" name="numcliente" autocomplete="off" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Fecha de cumpleaños:</label></div></td>
									<td><select name="dia" size="1">
									<? for ($a=1;$a<=31;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<? echo $a; ?>"><? echo $a; ?></option>
									<?
											}
											else
												{
									?>
											<option value="<? echo $a; ?>"><? echo $a; ?></option>
									<?
												}
										}
									?>
									</select>
									<select name="mes" size="1">
									<? for ($a=1;$a<=12;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<? echo $a; ?>"><? echo $a; ?></option>
									<?
											}
											else
												{
									?>
											<option value="<? echo $a; ?>"><? echo $a; ?></option>
									<?
												}
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="anio" name="anio" maxlength="4" /></td>
								</tr>
								<tr>
                                	<td colspan="2">&nbsp;</td>
                                </tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Telefono fijo:</div></td>
									<td width="372"><input type="text" size="20" name="tel" autocomplete="off" /></td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Telefono móvil:</div></td>
									<td width="372"><input type="text" size="20" name="telcel" autocomplete="off" /></td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">&nbsp;</div></td>
									<td width="372">&nbsp;</td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Tipo de cliente:</div></td>
									<td width="372"><select name="tipoclie" size="1">
													<option value="particular" selected="selected">Particular</option>
													<option value="empresa">Empresa</option>
													</select>
									</td>
								</tr>
						</table>
					</td>
				</tr>
			</table>
			<br />
			<table cellpadding="0" cellspacing="0" border="0" align="center" width="387">
		   		<tr align="center">
                    <td colspan="2" align="center"><div id="btn">
                      <input type="submit" name="submit" value="Agregar cliente" />
                    </div></td>
                </tr>
            </table>
			</form>
	</div>
</body>
</html>