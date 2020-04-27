<?
include("../ajax/config.php");
include("../ajax/funciones.php");	
include("../ajax/secure.php");
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
		$sqle="SELECT * FROM vida WHERE idpol='".$idn."'";
		$rese=mysql_query($sqle);
		if(mysql_num_rows($rese)>0)
		{
			while(list($idq,$idpolq,$planq,$contratanteq,$aseguradoq,$aseguramanq,$aseguramenq)=mysql_fetch_array($rese))
			{
				$planh=$planq;
				$contratanteh=$contratanteq;
				$aseguradoh=$aseguradoq;
				$asegumanh=$aseguramanq;
				$asegumenh=$aseguramenq;
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
	  <? include("../menu2.php"); ?>
	</div>
<div id="contenido">
<form action="eliminar.php" method="post" name="form1">
		<p>Eliminar póliza vida</p>
        	<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
                    <td width="153"><div id="etiqueta">Comisión subagente:</div></td>
                    <td width="318"><input type="text" name="comsub" id="comsub" autocomplete="off" size="55" value="<? echo $comsubn; ?>" /></td>
                    <td width="241"><select name="diasub" size="1">
									<? for ($a=1;$a<=31;$a++)
										{
									?>
											<option <? if ($a==$diasubn) {?> selected="selected" <? } ?> value="<? echo $a; ?>" ><? echo $a; ?></option>
									<?
										}
									?>
									</select>
									<select name="messub" size="1">
									<? for ($a=1;$a<=12;$a++)
										{
									?>
											<option <? if ($a==$messubn) {?> selected="selected" <? } ?> value="<? echo $a; ?>"><? echo $a; ?></option>
									<?
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="aniosub" name="aniosub" maxlength="4" value="<? echo $aniosubn; ?>" /></td>
                    <td width="228"><input type="hidden" name="mundo" value="<? echo $idn; ?>" /></td>
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
									<td><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" value="<? echo $contr; ?>" /><img src="../images/lupa.jpg" width="21" height="20" onclick="datos('../ajax/cliente.php','datosclie','nombre='+document.getElementById('txtNombre').value,'POST');" align="top" />
            <div id="autonombre" class="autocomplete" style="display:none"></div></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta"><label>Datos contratante:</label></div></td>
									<td><textarea name="datosclie" id="datosclie"><? echo $datosn; ?></textarea></td>
								</tr>
						</table>
					</td> 
					<td width="473">
						<table width="473" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td width="101"><div id="etiqueta"><label>P&oacute;liza</label></div></td>
									<td width="372"><input type="text" size="20" name="poliza" autocomplete="off" value="<? echo $numpol; ?>" readonly="readonly" /></td>
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
											if ($a==$deldian)
											{
									?>
											<option selected="selected" value="<? echo $a; ?>" ><? echo $a; ?></option>
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
											if ($a==$delmesn)
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
									</select>&nbsp;<input type="text" size="4" id="vigdelanio" name="vigdelanio" maxlength="4" value="<? echo $delanion; ?>" /></td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Al:</label></div></td>
									<td><select name="vigaldia" size="1">
									<? for ($a=1;$a<=31;$a++)
										{
											if ($a==$aldian)
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
											if ($a==$almesn)
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
								  </select>&nbsp;<input type="text" size="4" id="vigalanio" name="vigalanio" maxlength="4" value="<? echo $alanion; ?>" /></td>
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
											if ($a==$expdian)
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
											if ($a==$expmesn)
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
									</select>&nbsp;<input type="text" size="5" id="fechaexpanio" name="fechaexpanio" maxlength="4" value="<? echo $expanion; ?>" />
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Agente:</label></div>
									<select name="agente" size="1" >
                                    <? 	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%principal%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
									?>
									<option <? if($nombre==$agenten){ ?>selected="selected" <? } ?>value="<? echo $nombre; ?>"><? echo $nombre; ?></option>
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
									?>
									<option <? if($nombre==$subn){ ?>selected="selected" <? } ?>value="<? echo $nombre; ?>"><? echo $nombre; ?></option>
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
								<td><select name="formapago" size="1" >
									<option value="0" <? if($formapagon=="0"){ ?>selected="selected" <? } ?>>Pago único</option>
                                    <option value="1" <? if($formapagon=="1"){ ?>selected="selected" <? } ?>>Anual</option>
									<option value="12" <? if($formapagon=="12"){ ?>selected="selected" <? } ?>>Mensual</option>
									<option value="3" <? if($formapagon=="3"){ ?>selected="selected" <? } ?>>Trimestral</option>
									<option value="6" <? if($formapagon=="6"){ ?>selected="selected" <? } ?>>Semestral</option>
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
									<option value="Nacional" <? if($monedan=="Nacional"){ ?>selected="selected" <? } ?>>Nacional</option>
									<option value="Dolares" <? if($monedan=="Dolares"){ ?>selected="selected" <? } ?>>Dolares</option>
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
									<option value="AXA" <? if($compan=="AXA"){ ?>selected="selected" <? } ?>>AXA</option>
									<option value="GNP" <? if($compan=="GNP"){ ?>selected="selected" <? } ?>>GNP</option>
									<option value="ABA" <? if($compan=="ABA"){ ?>selected="selected" <? } ?>>ABA</option>
                                    <option value="Bupa" <? if($compan=="Bupa"){ ?>selected="selected" <? } ?>>Bupa</option>
                                    <option value="Metlife" <? if($compan=="Metlife"){ ?>selected="selected" <? } ?>>Metlife</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Prima Neta:</label></div></td>
								<td><input type="text" size="8" id="primaneta" name="primaneta" value="<? echo $priman; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Recargo cargo fraccionado:</label></div></td>
								<td><input type="text" size="8" id="recargo" name="recargo" value="<? echo $pagofraccn; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Derecho de p&oacute;liza:</label></div></td>
								<td><input type="text" size="8" id="derechopol" name="derechopol" value="<? echo $derpoln; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>IVA:</label></div></td>
								<td><input type="text" size="8" id="iva" name="iva" value="<? echo $ivan; ?>" /></td>
							</tr>
                            <tr>
								<td><div id="etiqueta">
								  <label>Nota crédito:</label></div></td>
								<td><input type="text" size="8" id="nota" name="nota" value="<? echo $notan; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta">
								  <label>Prima total:</label></div></td>
								<td><input type="text" size="8" id="importe" name="importe" value="<? echo $totaln; ?>" /></td>
							</tr>
                            <tr>
								<td><div id="etiqueta">
								  <label>Comisión agente:</label></div></td>
								<td><input type="text" size="8" id="gastoexp" name="gastoexp" value="<? echo $gastoexpn; ?>" /></td>
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
                    <td width="280"><input type="text" size="55" id="plan" name="plan" autocomplete="off" value="<? echo $planh; ?>" /><div id="automarca" class="autocomplete" style="display:none"></div></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Contratante:</label></div></td>
                    <td><input type="text" size="30" name="contratante" id="contratante" autocomplete="off" value="<? echo $contratanteh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Asegurado:</label></div></td>
                    <td><input type="text" size="30" id="asegurado" name="asegurado" autocomplete="off" value="<? echo $aseguradoh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Asegurado mancomunado:</label></div></td>
                    <td><input type="text" size="30" id="aseguradoman" name="aseguradoman" autocomplete="off" value="<? echo $asegumanh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Asegurado menor:</label></div></td>
                    <td><input type="text" size="30" id="aseguradomenor" name="aseguradomenor" autocomplete="off" value="<? echo $asegumenh; ?>"/></td>
                </tr>
				 <tr align="center">
                    <td colspan="2" align="center"><? echo $mensaje; ?></td>
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
            <?
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
                    <td width="113"><input type="text" name="pago<? echo $num; ?>" autocomplete="off" value="<? echo $numpagow; ?>" size="2" /></td>
                    <td width="186"><select name="fechavencdia<? echo $num; ?>" size="1">
									<? for ($a=1;$a<=31;$a++)
										{
									?>
											<option <? if ($a==$diavencw){ ?>selected="selected" <? } ?> value="<? echo $a; ?>" ><? echo $a; ?></option>
									<?
										}
									?>
								</select>
								<select name="fechavencmes<? echo $num; ?>" size="1">
									<? for ($a=1;$a<=12;$a++)
										{
									?>
											<option <? if ($a==$mesvencw){ ?>selected="selected" <? } ?> value="<? echo $a; ?>" ><? echo $a; ?></option>
									<?
										}
									?>
								</select>
								<input type="text" name="fechavencanio<? echo $num; ?>" size="4" value="<? echo $aniovencw; ?>" /></td>
                    <td width="194">
								<select name="fechapagdia<? echo $num; ?>" size="1">
									<? for ($a=1;$a<=31;$a++)
										{
									?>
											<option <? if ($a==$diapagow){ ?>selected="selected" <? } ?> value="<? echo $a; ?>" ><? echo $a; ?></option>
									<?
										}
									?>
								</select>
								<select name="fechapagmes<? echo $num; ?>" size="1">
									<? for ($a=1;$a<=12;$a++)
										{
									?>
											<option <? if ($a==$mespagow){ ?>selected="selected" <? } ?> value="<? echo $a; ?>" ><? echo $a; ?></option>
									<?
										}
									?>
								</select>
								<input type="text" name="fechapaganio<? echo $num; ?>" size="4" value="<? echo $aniopagow; ?>" />
</td>
                    <td width="165"><div id="etiqueta"><input type="text" size="30" name="monto<? echo $num; ?>" autocomplete="off" value="<? echo $montow; ?>" /></div></td>
                    <td width="180"><div id="etiqueta">
                    	<select name="status<? echo $num; ?>" size="1">
                        	<option value="D" <? if($statusw=="D"){ ?>selected="selected" <? } ?>>Debe</option>
                            <option value="P" <? if($statusw=="P"){ ?>selected="selected" <? } ?>>Pagado</option>
                            <option value="C" <? if($statusw=="C"){ ?>selected="selected" <? } ?>>Cancelado</option>
                            </select>
                    </div></td>
                </tr>
                <?
			}
			if ($num<12)
			{
				$nume=$num+1;
				for($a=$nume;$a<=12;$a++)
				{
					?>
                
                <tr>
                    <td width="113"><input type="text" name="pago<? echo $a; ?>" autocomplete="off" value="<? echo $a; ?>" size="2" /></td>
                    <td width="186">
								<select name="fechavencdia<? echo $a; ?>" size="1">
									<? for ($b=1;$b<=31;$b++)
										{
									?>
											<option <? if ($b==1){ ?>selected="selected" <? } ?> value="<? echo $b; ?>" ><? echo $b; ?></option>
									<?
										}
									?>
								</select>
								<select name="fechavencmes<? echo $a; ?>" size="1">
									<? for ($b=1;$b<=12;$b++)
										{
									?>
											<option <? if ($b==1){ ?>selected="selected" <? } ?> value="<? echo $b; ?>" ><? echo $b; ?></option>
									<?
										}
									?>
								</select>
								<input type="text" name="fechavencanio<? echo $a; ?>" size="4" />
					</td>
                    <td width="194">
								<select name="fechapagdia<? echo $a; ?>" size="1">
									<? for ($b=1;$b<=31;$b++)
										{
									?>
											<option <? if ($b==1){ ?>selected="selected" <? } ?> value="<? echo $b; ?>" ><? echo $b; ?></option>
									<?
										}
									?>
								</select>
								<select name="fechapagmes<? echo $a; ?>" size="1">
									<? for ($b=1;$b<=12;$b++)
										{
									?>
											<option <? if ($b==1){ ?>selected="selected" <? } ?> value="<? echo $b; ?>" ><? echo $b; ?></option>
									<?
										}
									?>
								</select>
								<input type="text" name="fechapaganio<? echo $a; ?>" size="4" />
					</td>
                    <td width="165"><input type="text" size="30" name="monto<? echo $a; ?>" autocomplete="off" /></td>
                    <td width="180"><div id="etiqueta">
                    	<select name="status<? echo $a; ?>" size="1">
                        	<option value="D" selected="selected">Debe</option>
                            <option value="P">Pagado</option>
                            <option value="C">Cancelado</option>
                            </select>
                    </div></td>
                </tr>
                <?	
				}
			}
		} ?>
				 <tr align="center">
                    <td colspan="2" align="center"></td>
                </tr>
                <tr>
                	<td><div id="etiqueta">Status</div></td>
					<td><select name="statuspol" size="1">
                        	<option value="D" <? if ($statusn=="D") { ?>selected="selected" <? } ?>>Por pagar</option>
                            <option value="P" <? if ($statusn=="P") { ?>selected="selected" <? } ?>>Pagada</option>
                            <option value="C" <? if ($statusn=="C") { ?>selected="selected" <? } ?>>Cancelada</option>
                         </select>
                    </td>
                    <td><div id="etiqueta">Observaciones:</div></td>
                    <td colspan="2"><textarea name="motivo" cols="10" rows="3"><? echo $motivon; ?></textarea></td>
                </tr>
        		<tr align="center">
                    <td colspan="5" align="center"><div id="btn"><input type="button" value="Eliminar" onClick="if(confirm('Seguro de que desea eliminar la póliza?')){ form.submit();}" /></div></td>
                </tr>
            </table>
</form>
	</div>
</body>
</html>