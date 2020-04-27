<?php 
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");
$mensaje="";

$permisos=strstr($_SESSION['perm'], 'consultar');
$zonas=strstr($_SESSION['zonas'], 'polizas');
if (($permisos!="") && ($zonas!=""))
{

if(!isset($_GET['num']))
{
	header("LOCATION: ../index.php");
	exit;
}
$cnx=conectar();
$sql="SELECT * FROM poliza WHERE numpoliza='".$_GET['num']."'";
$res=mysql_query($sql);
if(mysql_num_rows($res)>0)
{
	while(list($id,$numpoliza,$tipopoliza,$contratante,$datos,$deldia,$delmes,$delanio,$aldia,$almes,$alanio,$expdia,$expmes,$expanio,$compania,$moneda,$formapago,$primaneta,$gastoexp,$pagofracc,$derpol,$iva,$importetotal,$agente,$subagente,$polizaant,$status,$motivo,$comsub,$diasub,$messub,$aniosub,$notacredito)=mysql_fetch_array($res))
	{
		$idn=$id;
		$numpol=$numpoliza;
		$tipo=$tipopoliza;
		$contr=$contratante;
		$datosn=$datos;
		$deldian=$deldia;
		$delmesn=$delmes;
		$delanion=$delanio;
		$aldian=$aldia;
		$almesn=$almes;
		$alanion=$alanio;
		$expdian=$expdia;
		$expmesn=$expmes;
		$expanion=$expanio;
		$compan=$compania;
		$monedan=$moneda;
		$formapagon=$formapago;
		$priman=$primaneta;
		$gastoexpn=$gastoexp;
		$pagofraccn=$pagofracc;
		$derpoln=$derpol;
		$ivan=$iva;
		$totaln=$importetotal;
		$agenten=$agente;
		$subn=$subagente;
		$polantn=$polizaant;
		$statusn=$status;
		$motivon=$motivo;
		$comsubn=$comsub;
		$diasubn=$diasub;
		$messubn=$messub;
		$aniosubn=$aniosub;
		$notan=$notacredito;
		$sqle="SELECT * FROM danios WHERE idpol='".$idn."'";
		$rese=mysql_query($sqle);
		if(mysql_num_rows($rese)>0)
		{
			while(list($idq,$idpolq,$calle,$ciudad,$colonia,$cp,$edificio,$contenidos,$riesgos,$escombros,$inflacion,$otras,$seccion3,$seccion4,$seccion5,$seccion6,$seccion7,$seccion8,$seccion9,$seccion10,$seccion11,$mediotrans,$trayecto,$origen,$destino,$valoremb,$tipodist)=mysql_fetch_array($rese))
			{
				$calleh=$calle;
				$ciudadh=$ciudad;
				$coloniah=$colonia;
				$cph=$cp;
				$edificioh=$edificio;
				$contenidosh=$contenidos;
				$riesgosh=$riesgos;
				$escombrosh=$escombros;
				$inflacionh=$inflacion;
				$otrash=$otras;
				$seccion3h=$seccion3;
				$seccion4h=$seccion4;
				$seccion5h=$seccion5;
				$seccion6h=$seccion6;
				$seccion7h=$seccion7;
				$seccion8h=$seccion8;
				$seccion9h=$seccion9;
				$seccion10h=$seccion10;
				$seccion11h=$seccion11;
				$mth=$mediotrans;
				$trah=$trayecto;
				$orih=$origen;
				$desh=$destino;
				$valembh=$valoremb;
				$tipdish=$tipodist;
			}
		}
		
	}
}
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
<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
		<?php  include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Consultar póliza daños</p>
          	<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
                    <td width="153"><div id="etiqueta">Comisión subagente:</div></td>
                    <td width="318"><input type="text" name="comsub" id="comsub" autocomplete="off" size="55" value="<?php  echo $comsubn; ?>" /></td>
                    <td width="241"><select name="diasub" size="1">
									<?php  for ($a=1;$a<=31;$a++)
										{
									?>
											<option <?php  if ($a==$diasubn) {?> selected="selected" <?php  } ?> value="<?php  echo $a; ?>" ><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>
									<select name="messub" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
									?>
											<option <?php  if ($a==$messubn) {?> selected="selected" <?php  } ?> value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="aniosub" name="aniosub" maxlength="4" value="<?php  echo $aniosubn; ?>" /></td>
                    <td width="228">&nbsp;</td>
                    <td width="10"></td>
            	</tr>
                <tr>
                	<td colspan="2" height="40"></td>
                </tr>
			</table>
			<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td width="477">
						<table width="477" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><div id="etiqueta"><label>Contratante:</label></div></td>
									<td><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" value="<?php  echo $contr; ?>" /><img src="../images/lupa.jpg" width="21" height="20" onclick="datos('../ajax/cliente.php','datosclie','nombre='+document.getElementById('txtNombre').value,'POST');" align="top" />
            <div id="autonombre" class="autocomplete" style="display:none"></div></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta"><label>Datos contratante:</label></div></td>
									<td><textarea name="datosclie" id="datosclie"><?php  echo $datosn; ?></textarea></td>
								</tr>
						</table>
					</td> 
					<td width="473">
						<table width="473" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td width="101"><div id="etiqueta"><label>P&oacute;liza</label></div></td>
									<td width="372"><input type="text" size="20" name="poliza" autocomplete="off" value="<?php  echo $numpol; ?>" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta"><label>Vigencia:</label></div></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Del:</label></div></td>
									<td><select name="vigdeldia" size="1">
									<?php  for ($a=1;$a<=31;$a++)
										{
									?>
											<option <?php  if ($a==$deldian) { ?> selected="selected" <?php  } ?> value="<?php  echo $a; ?>" ><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>
									<select name="vigdelmes" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
									?>
											<option <?php  if ($a==$delmesn) { ?> selected="selected" <?php  } ?> value="<?php  echo $a; ?>" ><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="vigdelanio" name="vigdelanio" maxlength="4" value="<?php  echo $delanion; ?>" /></td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Al:</label></div></td>
									<td><select name="vigaldia" size="1">
									<?php  for ($a=1;$a<=31;$a++)
										{
									?>
											<option <?php  if($a==$aldian) { ?> selected="selected" <?php  } ?> value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>
									<select name="vigalmes" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
									?>
											<option <?php  if($a==$almesn) { ?> selected="selected" <?php  } ?> value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
										}
									?>
								  </select>&nbsp;<input type="text" size="4" id="vigalanio" name="vigalanio" maxlength="4" value="<?php  echo $alanion; ?>" /></td>
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
									<?php  for ($a=1;$a<=31;$a++)
										{
									?>
											<option <?php  if($a==$expdian) { ?> selected="selected" <?php  } ?> value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>
									<select name="fechaexpmes" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
									?>
											<option <?php  if($a==$expmesn) { ?> selected="selected" <?php  } ?> value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>&nbsp;<input type="text" size="5" id="fechaexpanio" name="fechaexpanio" maxlength="4" value="<?php  echo $expanion; ?>" />
								</td>
							</tr>
							<tr>
								<td>&nbsp;
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Agente:</label></div>
									<select name="agente" size="1" >
                                    <?php  	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%principal%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
									?>
									<option <?php  if($nombre==$agenten){ ?>selected="selected" <?php  } ?>value="<?php  echo $nombre; ?>"><?php  echo $nombre; ?></option>
                                    <?php  		}	 ?>
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
									<?php  	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%subagente%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
									?>
									<option <?php  if($nombre==$subn){ ?>selected="selected" <?php  } ?>value="<?php  echo $nombre; ?>"><?php  echo $nombre; ?></option>
                                    <?php  		}	 ?>
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
                               	  <option value="0" <?php  if($formapagon=="0"){ ?>selected="selected" <?php  } ?>>Pago único</option>
									<option value="1" <?php  if($formapagon=="1"){ ?>selected="selected" <?php  } ?>>Anual</option>
									<option value="12" <?php  if($formapagon=="12"){ ?>selected="selected" <?php  } ?>>Mensual</option>
									<option value="3" <?php  if($formapagon=="3"){ ?>selected="selected" <?php  } ?>>Trimestral</option>
									<option value="6" <?php  if($formapagon=="6"){ ?>selected="selected" <?php  } ?>>Semestral</option>
									</select>
								</td>
							</tr>
                            <tr>
                            <td>&nbsp;</td>
                            </tr>
							<tr>
								<td><div id="etiqueta"><label>Moneda:</label></div></td>
								<td><select name="moneda" size="1" >
									<option value="Nacional" <?php  if($monedan=="Nacional"){ ?>selected="selected" <?php  } ?>>Nacional</option>
									<option value="Dolares" <?php  if($monedan=="Dolares"){ ?>selected="selected" <?php  } ?>>Dolares</option>
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
									<option value="AXA" <?php  if($compan=="AXA"){ ?>selected="selected" <?php  } ?>>AXA</option>
									<option value="GNP" <?php  if($compan=="GNP"){ ?>selected="selected" <?php  } ?>>GNP</option>
									<option value="ABA" <?php  if($compan=="ABA"){ ?>selected="selected" <?php  } ?>>ABA</option>
                                    <option value="Bupa" <?php  if($compan=="Bupa"){ ?>selected="selected" <?php  } ?>>Bupa</option>
                                    <option value="Metlife" <?php  if($compan=="Metlife"){ ?>selected="selected" <?php  } ?>>Metlife</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Prima Neta:</label></div></td>
								<td><input type="text" size="8" id="primaneta" name="primaneta" value="<?php  echo $priman; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Recargo cargo fraccionado:</label></div></td>
								<td><input type="text" size="8" id="recargo" name="recargo" value="<?php  echo $pagofraccn; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Derecho de p&oacute;liza:</label></div></td>
								<td><input type="text" size="8" id="derechopol" name="derechopol" value="<?php  echo $derpoln; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>IVA:</label></div></td>
								<td><input type="text" size="8" id="iva" name="iva" value="<?php  echo $ivan; ?>" /></td>
							</tr>
                            <tr>
								<td><div id="etiqueta">
								  <label>Nota crédito:</label></div></td>
								<td><input type="text" size="8" id="nota" name="nota" value="<?php  echo $notan; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta">
								  <label>Prima total:</label></div></td>
								<td><input type="text" size="8" id="importe" name="importe" value="<?php  echo $totaln; ?>" /></td>
							</tr>
                            <tr>
								<td><div id="etiqueta">
								  <label>Comisión agente:</label></div></td>
								<td><input type="text" size="8" id="gastoexp" name="gastoexp" value="<?php  echo $gastoexpn; ?>" /></td>
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
                    <td width="280"><input type="text" size="55" id="ubcalle" name="ubcalle" autocomplete="off" value="<?php  echo $calleh; ?>"/></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Ciudad:</label></div></td>
                    <td><input type="text" size="30" name="ubciudad" id="ubciudad" autocomplete="off" value="<?php  echo $ciudadh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Colonia:</label></div></td>
                    <td><input type="text" size="30" name="ubcolonia" id="ubcolonia" autocomplete="off" value="<?php  echo $coloniah; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">C.P.</div></td>
                    <td><input type="text" size="30" name="ubcp" id="ubcp" autocomplete="off" value="<?php  echo $cph; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Medio de transporte</div></td>
                    <td><input type="text" size="30" name="mediotrans" id="mediotrans" autocomplete="off" value="<?php  echo $mth; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Trayecto</div></td>
                    <td><input type="text" size="30" name="trayecto" id="trayecto" autocomplete="off" value="<?php  echo $trah; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Origen</div></td>
                    <td><input type="text" size="30" name="origen" id="origen" autocomplete="off" value="<?php  echo $orih; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Destino</div></td>
                    <td><input type="text" size="30" name="destino" id="destino" autocomplete="off" value="<?php  echo $desh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Valor del embarque </div></td>
                    <td><input type="text" size="30" name="valoremb" id="valoremb" autocomplete="off" value="<?php  echo $valembh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Tipo de distribución</div></td>
                    <td><input type="text" size="30" name="tipodist" id="tipodist" autocomplete="off" value="<?php  echo $tipdish; ?>" /></td>
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
                    <td width="283"><input type="text" size="30" id="sec1edificio" name="sec1edificio" autocomplete="off" value="<?php  echo $edificioh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Contenidos:</label></div></td>
                    <td><input type="text" size="30" name="sec1contenido" id="sec1contenido" autocomplete="off" value="<?php  echo $ccontenidosh; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="blanco">&nbsp;<br />Riesgos adicionales:<br />&nbsp;</span></td>
                </tr>
                <tr>
                  <td colspan="2">
                   <?php  
								if(!empty($riesgosh))
								{
									$talentos = explode(",", $riesgosh);
								}
								else
								{
									$talentos="";
									echo "talentos: ".$talentos;
								}
					?>
                    	<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
							<tr>
                            	<td width="131"><span class="blanco">Hidrómeteorológicos</span></td>
                                <td width="55"><input type="checkbox" name="nombre[1]" id="nombre[1]" value="hidro" 
                               <?php 
							   if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="hidro")
										echo 'checked="checked"'; 
								}
							   }
								?>
                                 /></td>
                                <td width="131"><span class="blanco">500 mts del mar? </span></td>
                                <td width="60"><input type="checkbox" name="nombre[2]" id="nombre[2]" value="500" 
                                <?php 
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="500")
										echo 'checked="checked"'; 
								}
							   }
								?>
                                 /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco"><label>Caída de árboles o antenas</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[3]" id="nombre[3]" value="arboles"
                                <?php 
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="arboles")
										echo 'checked="checked" '; 
								}
							   }
								?>
                                 /></td>
                                <td width="131"><span class="blanco">Naves aéreas, vehículos y humo</span></td>
                                <td width="60"><input type="checkbox" name="nombre[4]" id="nombre[4]" value="naves" 
                                <?php 
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="naves")
										echo 'checked="checked" '; 
								}
							   }
								?>
                                /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Derrame del P.C.I.</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[5]" id="nombre[5]" value="pci" 
                                <?php 
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="pci")
										echo 'checked="checked" '; 
								}
							   }
								?>
                                 /></td>
                                <td width="131"><span class="blanco">Cobertura ámplia de incendio</span></td>
                                <td width="60"><input type="checkbox" name="nombre[6]" id="nombre[6]" value="incendio" 
                                <?php 
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="incendio")
										echo 'checked="checked" '; 
								}
							   }
								?>
                                 /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco"><label>Remoción de escombros</label></span></td>
                                <td width="55"><input type="text" size="1" name="addescombros" maxlength="3" value="<?php  echo $escombrosh; ?>" /><span class="blanco">%</span></td>
                                <td width="131"><span class="blanco">Daños por agua.</span></td>
                                <td width="60"><input type="checkbox" name="nombre[7]" id="nombre[7]" value="agua" 
                                <?php 
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="agua")
										echo 'checked="checked"'; 
								}
							   }
								?>
                                /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Huelgas y Vandalismo</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[8]" id="nombre[8]" value="huelga" 
                                <?php 
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="huelga")
										echo 'checked="checked"'; 
								}
							   }
								?>
                                /></td>
                                <td width="131"><span class="blanco">Inflación</span></td>
                                <td width="60"><input type="text" size="1" name="addinflacion" maxlength="3" value="<?php  echo $inflacionh; ?>" /><span class="blanco">%</span></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Otras:</label></span></td>
                                <td colspan="3"><input type="text" name="addotras" size="40" value="<?php  echo $otrash; ?>"/></td>
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
                            <td width="264"><input type="text" name="sec3" size="40" value="<?php  echo $seccion3h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec4" size="40" value="<?php  echo $seccion4h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec5" size="40" value="<?php  echo $seccion5h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec6" size="40" value="<?php  echo $seccion6h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec7" size="40" value="<?php  echo $seccion7h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec8" size="40" value="<?php  echo $seccion8h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec9" size="40" value="<?php  echo $seccion9h; ?>" /></td>
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
                          <td width="264"><input type="text" name="sec10" size="40" value="<?php  echo $seccion10h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec11" size="40" value="<?php  echo $seccion11h; ?>" /></td>
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
                	<td>
                    </td>
              	</tr>
            </table>
            </td>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="1" align="center" width="850">
                <tr>
                    <td height="41" colspan="5" align="center"><div id="etiqueta2" align="center"><label>Recibos de pago:</label></div></td>
              	</tr>
                <tr>
                    <td width="113"><div id="etiqueta"><label>Pago:</label></div></td>
                    <td width="186"><div id="etiqueta"><label>Fecha vencimiento:</label></div></td>
                    <td width="194"><div id="etiqueta"><label>Fecha pago:</label></div></td>
                    <td width="165"><div id="etiqueta"><label>Monto:</label></div></td>
                    <td width="180"><div id="etiqueta"><label>Estatus:</label></div></td>
                </tr>
            <?php 
		$sqlw="SELECT * FROM recibos WHERE numpol='".$idn."' ORDER BY id ASC";
		$resw=mysql_query($sqlw);
		if(mysql_num_rows($resw)>0)
		{
				$num=0;
			while(list($idw,$numpolw,$numpagow,$diavencw,$mesvencw,$aniovencw,$diapagow,$mespagow,$aniopagow,$statusw,$montow)=mysql_fetch_array($resw))
			{
				$num++;
				?>
                <tr>
                    <td width="113"><input type="text" name="pago<?php  echo $num; ?>" autocomplete="off" value="<?php  echo $numpagow; ?>" size="2" /></td>
                    <td width="186"><select name="fechavencdia<?php  echo $num; ?>" size="1">
									<?php  for ($a=1;$a<=31;$a++)
										{
									?>
											<option <?php  if ($a==$diavencw){ ?>selected="selected" <?php  } ?> value="<?php  echo $a; ?>" ><?php  echo $a; ?></option>
									<?php 
										}
									?>
								</select>
								<select name="fechavencmes<?php  echo $num; ?>" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
									?>
											<option <?php  if ($a==$mesvencw){ ?>selected="selected" <?php  } ?> value="<?php  echo $a; ?>" ><?php  echo $a; ?></option>
									<?php 
										}
									?>
								</select>
								<input type="text" name="fechavencanio<?php  echo $num; ?>" size="4" value="<?php  echo $aniovencw; ?>" /></td>
                    <td width="194">
								<select name="fechapagdia<?php  echo $num; ?>" size="1">
									<?php  for ($a=1;$a<=31;$a++)
										{
									?>
											<option <?php  if ($a==$diapagow){ ?>selected="selected" <?php  } ?> value="<?php  echo $a; ?>" ><?php  echo $a; ?></option>
									<?php 
										}
									?>
								</select>
								<select name="fechapagmes<?php  echo $num; ?>" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
									?>
											<option <?php  if ($a==$mespagow){ ?>selected="selected" <?php  } ?> value="<?php  echo $a; ?>" ><?php  echo $a; ?></option>
									<?php 
										}
									?>
								</select>
								<input type="text" name="fechapaganio<?php  echo $num; ?>" size="4" value="<?php  echo $aniopagow; ?>" />
</td>
                    <td width="165"><div id="etiqueta"><input type="text" size="30" name="monto<?php  echo $num; ?>" autocomplete="off" value="<?php  echo $montow; ?>" /></div></td>
                    <td width="180"><div id="etiqueta">
                    	<select name="status<?php  echo $num; ?>" size="1">
                        	<option value="D" <?php  if($statusw=="D"){ ?>selected="selected" <?php  } ?>>Debe</option>
                            <option value="P" <?php  if($statusw=="P"){ ?>selected="selected" <?php  } ?>>Pagado</option>
                            <option value="C" <?php  if($statusw=="C"){ ?>selected="selected" <?php  } ?>>Cancelado</option>
                            </select>
                    </div></td>
                </tr>
                <?php 
			}
			if ($num<12)
			{
				$nume=$num+1;
				for($a=$nume;$a<=12;$a++)
				{
					?>
                
                <tr>
                    <td width="113"><input type="text" name="pago<?php  echo $a; ?>" autocomplete="off" value="<?php  echo $a; ?>" size="2" /></td>
                    <td width="186">
								<select name="fechavencdia<?php  echo $a; ?>" size="1">
									<?php  for ($b=1;$b<=31;$b++)
										{
									?>
											<option <?php  if ($b==1){ ?>selected="selected" <?php  } ?> value="<?php  echo $b; ?>" ><?php  echo $b; ?></option>
									<?php 
										}
									?>
								</select>
								<select name="fechavencmes<?php  echo $a; ?>" size="1">
									<?php  for ($b=1;$b<=12;$b++)
										{
									?>
											<option <?php  if ($b==1){ ?>selected="selected" <?php  } ?> value="<?php  echo $b; ?>" ><?php  echo $b; ?></option>
									<?php 
										}
									?>
								</select>
								<input type="text" name="fechavencanio<?php  echo $a; ?>" size="4" />
					</td>
                    <td width="194">
								<select name="fechapagdia<?php  echo $a; ?>" size="1">
									<?php  for ($b=1;$b<=31;$b++)
										{
									?>
											<option <?php  if ($b==1){ ?>selected="selected" <?php  } ?> value="<?php  echo $b; ?>" ><?php  echo $b; ?></option>
									<?php 
										}
									?>
								</select>
								<select name="fechapagmes<?php  echo $a; ?>" size="1">
									<?php  for ($b=1;$b<=12;$b++)
										{
									?>
											<option <?php  if ($b==1){ ?>selected="selected" <?php  } ?> value="<?php  echo $b; ?>" ><?php  echo $b; ?></option>
									<?php 
										}
									?>
								</select>
								<input type="text" name="fechapaganio<?php  echo $a; ?>" size="4" />
					</td>
                    <td width="165"><input type="text" size="30" name="monto<?php  echo $a; ?>" autocomplete="off" /></td>
                    <td width="180"><div id="etiqueta">
                    	<select name="status<?php  echo $a; ?>" size="1">
                        	<option value="D" selected="selected">Debe</option>
                            <option value="P">Pagado</option>
                            <option value="C">Cancelado</option>
                            </select>
                    </div></td>
                </tr>
                <?php 	
				}
			}
		} ?>
				 <tr align="center">
                    <td colspan="2" align="center"></td>
                </tr>
                <tr>
                	<td><div id="etiqueta">Status</div></td>
					<td><select name="statuspol" size="1">
                        	<option value="D" <?php  if ($statusn=="D") { ?>selected="selected" <?php  } ?>>Por pagar</option>
                            <option value="P" <?php  if ($statusn=="P") { ?>selected="selected" <?php  } ?>>Pagada</option>
                            <option value="C" <?php  if ($statusn=="C") { ?>selected="selected" <?php  } ?>>Cancelada</option>
                         </select>
                    </td>
                    <td><div id="etiqueta">Observaciones:</div></td>
                    <td colspan="2"><textarea name="motivo" cols="10" rows="3"><?php  echo $motivon; ?></textarea></td>
                </tr>
        		<tr align="center">
                    <td colspan="5" align="center"><div id="btn"></div></td>
                </tr>
            </table>
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