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
		$sqle="SELECT * FROM gm WHERE idpol='".$idn."'";
		$rese=mysql_query($sqle);
		if(mysql_num_rows($rese)>0)
		{
			while(list($idq,$idpolq,$planq,$titularq,$dependientesq)=mysql_fetch_array($rese))
			{
				$planh=$planq;
				$titularh=$titularq;
				$dependientesh=$dependientesq;
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
		<p>Consultar póliza gastos médicos</p>
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
								<td>&nbsp;</td>
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
								<td><div id="etiqueta"></div></td>
								<td></td>
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
			<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
                <tr>
                    <td height="41" colspan="2" align="center"><div id="etiqueta2" align="center">
                      <label>Datos:</label></div></td>
              </tr>
                <tr>
                    <td width="101"><div id="etiqueta">
                      <label>Plan:</label></div></td>
                    <td width="280"><input type="text" size="55" id="plan" name="plan" autocomplete="off" value="<?php  echo $planh; ?>" /><div id="automarca" class="autocomplete" style="display:none"></div></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Titular:</label></div></td>
                    <td><input type="text" size="30" name="titular" id="titular" autocomplete="off" value="<?php  echo $titularh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Dependiente(s):</label></div></td>
                    <td><textarea name="dependientes" rows="25" cols="5"><?php  echo $dependientesh; ?></textarea></td>
                </tr>
				 <tr align="center">
                    <td colspan="2" align="center">&nbsp;</td>
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