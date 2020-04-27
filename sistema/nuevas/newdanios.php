<?php
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");
$cnx=conectar();
$mensaje="";

$permisos=strstr($_SESSION['perm'], 'agregar');
$zonas=strstr($_SESSION['zonas'], 'polizas');
if (($permisos!="") && ($zonas!=""))
{
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
		<?php include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Nueva póliza daños</p>
			<form id="formRegistro" action="../add/adddanios.php" method="post" onsubmit="return checamens(this);">
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
									<?php for ($a=1;$a<=31;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
											}
											else
												{
									?>
											<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
												}
										}
									?>
									</select>
									<select name="vigdelmes" size="1">
									<?php for ($a=1;$a<=12;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
											}
											else
												{
									?>
											<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?
												}
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="vigdelanio" name="vigdelanio" maxlength="4" /></td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Al:</label></div></td>
									<td><select name="vigaldia" size="1">
									<?php for ($a=1;$a<=31;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
											}
											else
												{
									?>
											<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
												}
										}
									?>
									</select>
									<select name="vigalmes" size="1">
									<?php for ($a=1;$a<=12;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
											}
											else
												{
									?>
											<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
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
									<?php for ($a=1;$a<=31;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
											}
											else
												{
									?>
											<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
												}
										}
									?>
									</select>
									<select name="fechaexpmes" size="1">
									<?php for ($a=1;$a<=12;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
											}
											else
												{
									?>
											<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
									<?php
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
								<td><div id="etiqueta"><label>Agente:</label></div>
									<select name="agente" size="1" >
                                    <?php 	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%principal%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
												$cuenta++;
									?>
									<option <?php if($cuenta==1){ ?>selected="selected" <?php } ?>value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
                                    <?php 	}	 ?>
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
									<?php 	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%subagente%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
												$cuenta++;
									?>
									<option <?php if($cuenta==1){ ?>selected="selected" <?php } ?>value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
                                    <?php 		}	 ?>
									</select>
								</td>
							</tr>
						</table>
					</td>
					<td width="316">
						<table cellpadding="0" cellspacing="0" border="0" align="center">
							<tr>
								<td><div id="etiqueta"><label>Forma de pago:</label></div></td>
								<td><select name="formapago" size="1" >
                                	<option selected="selected" value="0">Pago único</option>
									<option value="1">Anual</option>
									<option value="12">Mensual</option>
									<option value="3">Trimestral</option>
									<option value="6">Semestral</option>
									</select>
								</td>
							</tr>
                            <tr>
                            <td>&nbsp;</td>
                            </tr>
							<tr>
								<td><div id="etiqueta"><label>Moneda:</label></div></td>
								<td><select name="moneda" size="1" >
									<option selected="selected" value="Nacional">Nacional</option>
									<option value="Dolares">Dolares</option>
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
            <table cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>
                    <td>
			<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                <tr>
                    <td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
                      <label>Ubicación del riesgo:</label></div></td>
              	</tr>
                <tr>
                    <td width="101"><div id="etiqueta">
                      <label>Calle:</label></div></td>
                    <td width="280"><input type="text" size="55" id="ubcalle" name="ubcalle" autocomplete="off"/></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Ciudad:</label></div></td>
                    <td><input type="text" size="30" name="ubciudad" id="ubciudad" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Colonia:</label></div></td>
                    <td><input type="text" size="30" name="ubcolonia" id="ubcolonia" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">C.P.</div></td>
                    <td><input type="text" size="30" name="ubcp" id="ubcp" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Medio de transporte</div></td>
                    <td><input type="text" size="30" name="mediotrans" id="mediotrans" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Trayecto</div></td>
                    <td><input type="text" size="30" name="trayecto" id="trayecto" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Origen</div></td>
                    <td><input type="text" size="30" name="origen" id="origen" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Destino</div></td>
                    <td><input type="text" size="30" name="destino" id="destino" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Valor del embarque </div></td>
                    <td><input type="text" size="30" name="valoremb" id="valoremb" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Tipo de distribución</div></td>
                    <td><input type="text" size="30" name="tipodist" id="tipodist" autocomplete="off" /></td>
                </tr>
            </table>
            </td>
            <td width="20"></td>
            <td>
			<table cellpadding="0" cellspacing="0" border="1" align="center" width="393">
                <tr>
                    <td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
                      <label>Sección I y II:</label></div></td>
              </tr>
                <tr>
                    <td width="102"><div id="etiqueta">
                      <label>Edificio:</label></div></td>
                    <td width="283"><input type="text" size="30" id="sec1edificio" name="sec1edificio" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Contenidos:</label></div></td>
                    <td><input type="text" size="30" name="sec1contenido" id="sec1contenido" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="blanco">&nbsp;<br />Riesgos adicionales:<br />&nbsp;</span></td>
                </tr>
                <tr>
                  <td colspan="2">
                    	<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
							<tr>
                            	<td width="131"><span class="blanco">Hidrómeteorológicos</span></td>
                                <td width="55"><input type="checkbox" name="nombre[1]" id="nombre[1]" value="hidro" /></td>
                                <td width="131"><span class="blanco">500 mts del mar? </span></td>
                                <td width="60"><input type="checkbox" name="nombre[2]" id="nombre[2]" value="500" /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco"><label>Caída de árboles o antenas</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[3]" id="nombre[3]" value="arboles" /></td>
                                <td width="131"><span class="blanco">Naves aéreas, vehículos y humo</span></td>
                                <td width="60"><input type="checkbox" name="nombre[4]" id="nombre[4]" value="naves"/></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Derrame del P.C.I.</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[5]" id="nombre[5]" value="pci" /></td>
                                <td width="131"><span class="blanco">Cobertura ámplia de incendio</span></td>
                                <td width="60"><input type="checkbox" name="nombre[6]" id="nombre[6]" value="incendio" /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco"><label>Remoción de escombros</label></span></td>
                                <td width="55"><input type="text" size="1" name="addescombros" maxlength="3" /><span class="blanco">%</span></td>
                                <td width="131"><span class="blanco">Daños por agua.</span></td>
                                <td width="60"><input type="checkbox" name="nombre[7]" id="nombre[7]" value="agua"/></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Huelgas y Vandalismo</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[8]" id="nombre[8]" value="huelga"/></td>
                                <td width="131"><span class="blanco">Inflación</span></td>
                                <td width="60"><input type="text" size="1" name="addinflacion" maxlength="3" /><span class="blanco">%</span></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Otras:</label></span></td>
                                <td colspan="3"><input type="text" name="addotras" size="40"/></td>
                            </tr>
						</table>
				  </td>
                </tr>
            </table>
            </td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center"><label>Sección III:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117"><span class="blanco">Suma asegurada:</span></td>
                            <td width="264"><input type="text" name="sec3" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            <td width="20"></td>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
					  <label>Sección IV:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117"><span class="blanco">Suma asegurada:</span></td>
                            <td width="264"><input type="text" name="sec4" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
					  <label>Sección V:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117"><span class="blanco">Suma asegurada:</span></td>
                            <td width="264"><input type="text" name="sec5" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            <td width="20"></td>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
					  <label>Sección VI:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117"><span class="blanco">Suma asegurada:</span></td>
                            <td width="264"><input type="text" name="sec6" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
					  <label>Sección VII:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117"><span class="blanco">Suma asegurada:</span></td>
                            <td width="264"><input type="text" name="sec7" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            <td width="20"></td>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
					  <label>Sección VIII:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117"><span class="blanco">Suma asegurada:</span></td>
                            <td width="264"><input type="text" name="sec8" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
					  <label>Sección IX:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117"><span class="blanco">Suma asegurada:</span></td>
                            <td width="264"><input type="text" name="sec9" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            <td width="20"></td>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
					  <label>Sección X:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117" height="29"><span class="blanco">Suma asegurada:</span></td>
                          <td width="264"><input type="text" name="sec10" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"><div id="etiqueta2" align="center">
					  <label>Sección XI:</label></div></td>
              	</tr>
              	<tr>
                	<td>
					<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                        <tr>
                            <td width="117"><span class="blanco">Suma asegurada:</span></td>
                            <td width="264"><input type="text" name="sec11" size="40" /></td>
                        </tr>
					</table>
                    </td>
              	</tr>
            </table>
            </td>
            <td width="20"></td>
            <td>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
              	<tr>
					<td height="46" colspan="2" align="center"></td>
              	</tr>
              	<tr>
                	<td><div id="btn">
                      <input type="submit" name="submit" value="Guardar póliza" />
						<input type="hidden" name="tipopol" value="daños" />
                    </div>
                    </td>
              	</tr>
            </table>
            </td>
            </tr>
            </table>
			</form>
	</div>
</body>
</html>
<?php }
	else
	{
		header("LOCATION: ../index.php");
		exit();
	}
 //Permiso para agregar ?>