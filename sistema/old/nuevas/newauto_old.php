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
<script type="text/javascript" src="../ajax/formulario.js"></script>
<script type="text/javascript" src="../ajax/mundo.js"></script>
<Script language="JavaScript" type="text/javascript">
function checamens(forma)
{
	if(document.getElementById('formapago').value>1)
	{
		if((document.getElementById('mensualidad').value=="")&&(document.getElementById('subsecuente').value==""))
			{
				alert('Debes de llenar el campo de primera mensualidad y mensualidad subsecuente');
				return false;	
			}
		else if (document.getElementById('mensualidad').value=="")
			{
				alert('Debes de llenar el campo de primera mensualidad');	
				return false;
			}
		else if (document.getElementById('subsecuente').value=="")
			{
				alert('Debes de llenar el campo de mensualidad subsecuente');
				return false;	
			}
		else
			{
				return true;	
			}
	}
	else
	{
		if (document.getElementById('importe').value=="")
			{
				alert('Debes de llenar el campo de prima total');	
				return false;
			}
		else
			{
				return true;
			}
	}
}
function calculaiva()
{
	var primaneta=document.getElementById('primaneta').value;
	var derecho=document.getElementById('derechopol').value;
	var recargo=document.getElementById('recargo').value;
	var nota=document.getElementById('nota').value;
	if (primaneta==""){primaneta=0;}else{primaneta=parseFloat(primaneta);}
	if (derecho==""){derecho=0;}else{derecho=parseFloat(derecho);}
	if (recargo==""){recargo=0;}else{recargo=parseFloat(recargo);}
	if (nota==""){nota=0;}else{nota=parseFloat(nota);}
	
	if((document.getElementById('formapago').value==0)||(document.getElementById('formapago').value==1))
	{
		var resiva=(primaneta+derecho)*.16;
		resiva=(Math.floor(resiva*100))/100;
		document.getElementById('iva').value=resiva;
	}
	else
	{
		var resiva=(primaneta+derecho+recargo)*.16;
		var result=(Math.floor(resiva*100))/100 ;
		document.getElementById('iva').value=result;
	}
}
function calculatotal()
{
	var primaneta=document.getElementById('primaneta').value;
	var derecho=document.getElementById('derechopol').value;
	var recargo=document.getElementById('recargo').value;
	var nota=document.getElementById('nota').value;
	var iva=document.getElementById('iva').value;
	if (primaneta==""){primaneta=0;}else{primaneta=parseFloat(primaneta);}
	if (derecho==""){derecho=0;}else{derecho=parseFloat(derecho);}
	if (recargo==""){recargo=0;}else{recargo=parseFloat(recargo);}
	if (nota==""){nota=0;}else{nota=parseFloat(nota);}
	if (iva==""){iva=0;}else{iva=parseFloat(iva);}
	var totala=(iva+derecho+primaneta+recargo)-nota;
	var resulta=Math.round(totala*100)/100;
	document.getElementById('importe').value=resulta;
}
</script>
<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
	  <? include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Nueva póliza autos</p>
			<form id="formaddauto" name="formaddauto" action="../add/addauto.php" method="post" onsubmit="return checamens(this);">
			<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td width="477">
						<table width="477" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><div id="etiqueta"><label>Contratante:</label></div></td>
									<td><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" /><img src="../images/lupa.jpg" width="21" height="20" onclick="datos('../ajax/cliente.php','datosclie','nombre='+document.getElementById('txtNombre').value,'POST');" align="top" />
            <div id="autonombre" class="autocomplete" style="display:none"></div></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta"><label>Datos contratante:</label></div></td>
									<td><textarea name="datosclie" id="datosclie"></textarea></td>
								</tr>
						</table>
					</td> 
					<td width="473">
						<table width="473" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td width="101"><div id="etiqueta"><label>P&oacute;liza</label></div></td>
									<td width="372"><input type="text" size="20" name="poliza" autocomplete="off" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta"><label>Vigencia:</label></div></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Del:</label></div></td>
									<td><select name="vigdeldia" size="1">
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
									<select name="vigdelmes" size="1">
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
									</select>&nbsp;<input type="text" size="4" id="vigdelanio" name="vigdelanio" maxlength="4" /></td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Al:</label></div></td>
									<td><select name="vigaldia" size="1">
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
									<select name="vigalmes" size="1">
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
								  </select>&nbsp;<input type="text" size="4" id="vigalanio" name="vigalanio" maxlength="4" /></td>
								</tr>
								<tr>
                                	<td colspan="2">&nbsp;</td>
                                </tr>
						</table>
					</td>
				</tr>
			</table>
			<br />
			<table width="950" align="center" border="1" cellspacing="0" cellpadding="0">
				<tr valign="middle">
					<td width="316">
						<table cellpadding="0" cellspacing="0" border="0" align="center">
							<tr>
								<td><div id="etiqueta"><label>Fecha de expedici&oacute;n:</label></div><select name="fechaexpdia" size="1">
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
									<select name="fechaexpmes" size="1">
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
									</select>&nbsp;<input type="text" size="5" id="fechaexpanio" name="fechaexpanio" maxlength="4" />
								</td>
							</tr>
							<tr>
								<td>&nbsp;
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Tipo de cobertura:</label></div>
									<select name="cobertura" size="1" >
									<option selected="selected" value="Amplia">Amplia</option>
									<option value="Amplia GL">Amplia GL</option>
									<option value="Limitada">Limitada</option>
									<option value="RC">RC</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>&nbsp;
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Agente:</label></div>
									<select name="agente" size="1" >
                                    <? 	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%principal%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
												$cuenta++;
									?>
									<option <? if($cuenta==1){ ?>selected="selected" <? } ?>value="<? echo $nombre; ?>"><? echo $nombre; ?></option>
                                    <? 		}	 ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>&nbsp;
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Sub-Agente:</label></div>
									<select name="subagente" size="1" >
									<? 	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%subagente%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
												$cuenta++;
									?>
									<option <? if($cuenta==1){ ?>selected="selected" <? } ?>value="<? echo $nombre; ?>"><? echo $nombre; ?></option>
                                    <? 		}	 ?>
									</select>
								</td>
							</tr>
						</table>
					</td>
					<td width="316">
						<table cellpadding="0" cellspacing="0" border="0" align="center">
							<tr>
								<td><div id="etiqueta"><label>Forma de pago:</label></div></td>
								<td><select name="formapago" size="1" id="formapago">
                                	<option selected="selected" value="0">Pago único</option>
									<option value="1">Anual</option>
									<option value="12">Mensual</option>
									<option value="3">Trimestral</option>
									<option value="6">Semestral</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Moneda:</label></div></td>
								<td><select name="moneda" size="1" >
									<option selected="selected" value="Nacional">Nacional</option>
									<option value="Dolares">Dolares</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Origen:</label></div></td>
								<td><select name="origen" size="1" >
									<option selected="selected" value="Nacional">Nacional</option>
									<option value="Legalizado">Legalizado</option>
									</select>
								</td>
							</tr>
						</table>
					</td>
					<td width="318">
						<table cellpadding="0" cellspacing="0" border="1" align="center">
							<tr>
								<td width="125"><div id="etiqueta"><label>Compa&ntilde;&iacute;a:</label></div></td>
								<td width="107"><select name="compania" size="1" >
									<option selected="selected" value="AXA">AXA</option>
									<option value="GNP">GNP</option>
									<option value="ABA">ABA</option>
                                    <option value="Bupa">Bupa</option>
                                    <option value="Metlife">Metlife</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Prima Neta:</label></div></td>
								<td><input type="text" size="8" id="primaneta" name="primaneta" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Recargo cargo fraccionado:</label></div></td>
								<td><input type="text" size="8" id="recargo" name="recargo" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Derecho de p&oacute;liza:</label></div></td>
								<td><input type="text" size="8" id="derechopol" name="derechopol" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>IVA:</label></div></td>
								<td><input type="text" size="8" id="iva" name="iva" onfocus="calculaiva();" /></td>
							</tr>
                            <tr>
								<td><div id="etiqueta">
								  <label>Nota crédito:</label></div></td>
								<td><input type="text" size="8" id="nota" name="nota" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta">
								  <label>Prima total:</label></div></td>
								<td><input type="text" size="8" id="importe" name="importe" onfocus="calculatotal();" /></td>
							</tr>
                            <tr>
								<td><div id="etiqueta">
								  <label>Comisión agente:</label></div></td>
								<td><input type="text" size="8" id="gastoexp" name="gastoexp" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>1era Mensualidad:</label></div></td>
								<td><input type="text" size="8" id="mensualidad" name="mensualidad" /></td>
							</tr>
                            <tr>
								<td><div id="etiqueta"><label>Mens. sub:</label></div></td>
								<td><input type="text" size="8" id="subsecuente" name="subsecuente" /></td>
							</tr>
					  </table>
					</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                <tr>
                    <td height="41" colspan="2" align="center"><div id="etiqueta2" align="center"><label>Datos del autom&oacute;vil:</label></div></td>
              </tr>
                <tr>
                    <td width="101"><div id="etiqueta">
                      <label>Marca:</label></div></td>
                    <td width="280"><input type="text" size="55" id="marca" name="marca" autocomplete="off" /><div id="automarca" class="autocomplete" style="display:none"></div></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Motor:</label></div></td>
                    <td><input type="text" size="30" name="motor" id="motor" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Serie:</label></div></td>
                    <td><input type="text" size="30" id="serie" name="serie" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Modelo:</label></div></td>
                    <td><input type="text" size="30" id="modelo" name="modelo" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Placas:</label></div></td>
                    <td><input type="text" size="30" id="placas" name="placas" autocomplete="off"/></td>
                </tr>
				 <tr align="center">
                    <td colspan="2" align="center"><? echo $mensaje; ?></td>
                </tr>
		   <tr align="center">
                    <td colspan="2" align="center"><div id="btn"><input type="submit" name="submit" value="Guardar póliza" /></div><input type="hidden" name="tipopol" value="autos" /></td>
                </tr>
            </table>
			</form>
	</div>
</body>
</html>