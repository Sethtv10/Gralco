<?
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");
$cnx=conectar();
if (isset($_POST['submit']))
 {
	$campos="numpoliza,tipopoliza,contratante,datos,deldia,delmes,delanio,aldia,almes,alanio,expdia,expmes,expanio,compania,moneda,formapago,primaneta,gastoexp,pagofracc,derpol,iva,importetotal,agente,subagente,polizaant,status,motivo,comsub,diasub,messub,aniosub";
	$valor = "'".$_POST['polizanew']."','".$_POST['tipopol']."','".$_POST['txtNombre']."','".$_POST['datosclie']."','".$_POST['vigdeldia']."','".$_POST['vigdelmes']."','".$_POST['vigdelanio']."','".$_POST['vigaldia']."','".$_POST['vigalmes']."','".$_POST['vigalanio']."','".$_POST['fechaexpdia']."','".$_POST['fechaexpmes']."','".$_POST['fechaexpanio']."','".$_POST['compania']."','".$_POST['moneda']."','".$_POST['formapago']."','".$_POST['primaneta']."','".$_POST['gastoexp']."','".$_POST['recargo']."','".$_POST['derechopol']."','".$_POST['iva']."','".$_POST['importe']."','".$_POST['agente']."','".$_POST['subagente']."','".$_POST['poliza']."','D','','".$_POST['comsub']."','".$_POST['diasub']."','".$_POST['messub']."','".$_POST['aniosub']."'";
	$sql = "INSERT INTO poliza ($campos) VALUES ($valor)";
	$res = mysql_query($sql) or die (mysql_error());

	$ultimoid=mysql_insert_id($cnx);
	if(isset($_POST['nombre']))
	{
	$aLista=$_POST['nombre'];
	$sQuery=implode(',',$aLista);
	}
	else
	{
	$sQuery="";	
	}
	$campauto="idpol,calle,ciudad,colonia,cp,edificio,contenidos,riesgos,escombros,inflacion,otras,seccion3,seccion4,seccion5,seccion6,seccion7,seccion8,seccion9,seccion10,seccion11,mediotrans,trayecto,origen,destino,valoremb,tipodist";
	$valorauto="'".$ultimoid."','".$_POST['ubcalle']."','".$_POST['ubciudad']."','".$_POST['ubcolonia']."','".$_POST['ubcp']."','".$_POST['sec1edificio']."','".$_POST['sec1contenido']."','".$sQuery."','".$_POST['addescombros']."','".$_POST['addinflacion']."','".$_POST['addotras']."','".$_POST['sec3']."','".$_POST['sec4']."','".$_POST['sec5']."','".$_POST['sec6']."','".$_POST['sec7']."','".$_POST['sec8']."','".$_POST['sec9']."','".$_POST['sec10']."','".$_POST['sec11']."','".$_POST['mediotrans']."','".$_POST['trayecto']."','".$_POST['origen']."','".$_POST['destino']."','".$_POST['valoremb']."','".$_POST['tipodist']."'";
	$sql2 = "INSERT INTO danios ($campauto) VALUES ($valorauto)";
	$res2 = mysql_query($sql2) or die (mysql_error());

	$camprecibo="numpol,numpago,diavenc,mesvenc,aniovenc,diapago,mespago,aniopago,status,monto";
	if ($_POST['formapago']==0)
	 {
		$monto=$_POST['importe'];
		$valorrecibo="'".$ultimoid."','1','".$_POST['vigdeldia']."','".$_POST['vigdelmes']."','".$_POST['vigdelanio']."','','','','D','".$monto."'";
		$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
		$res3 = mysql_query($sql3) or die (mysql_error());
	 }
	if ($_POST['formapago']==1)
	 {
		$monto=$_POST['importe'];
		$valorrecibo="'".$ultimoid."','1','".$_POST['vigdeldia']."','".$_POST['vigdelmes']."','".$_POST['vigdelanio']."','','','','D','".$monto."'";
		$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
		$res3 = mysql_query($sql3) or die (mysql_error());
	 }
	if ($_POST['formapago']==12)
	 {
		$monto=$_POST['mensualidad'];
		$mes=$_POST['vigdelmes'];
		$anio=$_POST['vigdelanio'];
		for ($a=1;$a<=12;$a++)
		  {
			if ($mes==13)
              {
				$mes=1;
				$anio++;
			  }
				
			$valorrecibo="'".$ultimoid."','".$a."','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$monto."'";
			$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
			$res3 = mysql_query($sql3) or die (mysql_error());
			$mes++;
		  }
	 }
	if ($_POST['formapago']==3)
	 {
		$monto=$_POST['mensualidad'];
		$mes=$_POST['vigdelmes'];
		$anio=$_POST['vigdelanio'];
		for ($a=1;$a<=4;$a++)
		  {
			if ($mes>12)
              {
				$mes=$mes-12;
				$anio++;
			  }
				
			$valorrecibo="'".$ultimoid."','".$a."','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$monto."'";
			$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
			$res3 = mysql_query($sql3) or die (mysql_error());
			$mes=$mes+3;
		  }
	 }
	if ($_POST['formapago']==6)
	 {
		$monto=$_POST['mensualidad'];
		$mes=$_POST['vigdelmes'];
		$anio=$_POST['vigdelanio'];
		for ($a=1;$a<=2;$a++)
		  {
			if ($mes>12)
              {
				$mes=$mes-12;
				$anio++;
			  }
				
			$valorrecibo="'".$ultimoid."','".$a."','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$monto."'";
			$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
			$res3 = mysql_query($sql3) or die (mysql_error());
			$mes=$mes+2;
		  }
	 }
	$sqlnvo2 = "UPDATE poliza SET ";
	$sqlnvo2.= "status='R'";
	$sqlnvo2.= " WHERE id='".$_POST['id']."'";
	$resnvo2 = mysql_query($sqlnvo2) or die (mysql_error());
	$camposbit="usuario,accion,poliza,fecha,hora";
	$valorbit = "'".$_SESSION['usera']."','Renovo poliza daños','".$_POST['poliza']."/".$_POST['polizanew']."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
	$sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
	$resbit = mysql_query($sqlbit) or die (mysql_error());
	mysql_close($cnx);
	header("Location: ../mensaje.php?mensaje=Se renovó; con éxito la póliza");
 }
$sqle="SELECT * FROM danios WHERE idpol='".$_GET['id']."'";
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
$sql="SELECT * FROM poliza WHERE id='".$_GET['id']."'";
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)>0)
  {
	while(list($id,$numpoliza,$tipopoliza,$contratante,$datos,$deldia,$delmes,$delanio,$aldia,$almes,$alanio,$expdia,$expmes,$expanio,$compania,$moneda,$formapago,$primaneta,$gastoexp,$pagofracc,$derpol,$iva,$importetotal,$agente,$subagente,$polizaant,$status,$comsubn,$diasubn,$messubn,$aniosubn) = mysql_fetch_array($res))
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
<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
		<? include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Renovar póliza daños</p>
			<form id="formRegistro" action="danios.php" method="post">
            <table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
                    <td width="153"><font color="#FFFFFF">Comisión subagente:</font></td>
                    <td width="299"><input type="text" name="comsub" id="comsub" autocomplete="off" size="20" value="<? echo $comsubn; ?>" /></td>
                    <td width="189"><select name="diasub" size="1">
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
									</select>&nbsp;<input type="text" size="4" id="aniosub" name="aniosub" maxlength="4" value="<? echo $aniosubn+1; ?>" /></td>
                    <td width="299">&nbsp;</td>
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
									<td><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" value="<? echo $contratante; ?>" /><img src="../images/lupa.jpg" width="21" height="20" onclick="datos('../ajax/cliente.php','datosclie','nombre='+document.getElementById('txtNombre').value,'POST');" align="top" />
            <div id="autonombre" class="autocomplete" style="display:none"></div></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta"><label>Datos contratante:</label></div></td>
									<td><textarea name="datosclie" id="datosclie"><? echo $datos; ?></textarea></td>
								</tr>
						</table>
					</td> 
					<td width="473">
						<table width="473" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td width="101"><div id="etiqueta"><label>P&oacute;liza</label> 
									anterior</div></td>
									<td width="372"><input type="text" size="20" name="poliza" autocomplete="off" readonly="readonly" value="<? echo $numpoliza; ?>" /></td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta"><label>P&oacute;liza</label> 
									nueva</div></td>
									<td width="372"><input type="text" size="20" name="polizanew" autocomplete="off" /></td>
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
									?>
											<option <? if ($a==$deldia) { ?> selected="selected" <? } ?> value="<? echo $a; ?>" ><? echo $a; ?></option>
									<?
										}
									?>
									</select>
									<select name="vigdelmes" size="1">
									<? for ($a=1;$a<=12;$a++)
										{
									?>
											<option <? if ($a==$delmes) { ?> selected="selected" <? } ?> value="<? echo $a; ?>" ><? echo $a; ?></option>
									<?
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="vigdelanio" name="vigdelanio" maxlength="4" value="<? echo $delanio+1; ?>" /></td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Al:</label></div></td>
									<td><select name="vigaldia" size="1">
									<? for ($a=1;$a<=31;$a++)
										{
									?>
											<option <? if($a==$aldia) { ?> selected="selected" <? } ?> value="<? echo $a; ?>"><? echo $a; ?></option>
									<?
										}
									?>
									</select>
									<select name="vigalmes" size="1">
									<? for ($a=1;$a<=12;$a++)
										{
									?>
											<option <? if($a==$almes) { ?> selected="selected" <? } ?> value="<? echo $a; ?>"><? echo $a; ?></option>
									<?
										}
									?>
								  </select>&nbsp;<input type="text" size="4" id="vigalanio" name="vigalanio" maxlength="4" value="<? echo $alanio+1; ?>" /></td>
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
								<td><div id="etiqueta"><label>Agente:</label></div>
									<select name="agente" size="1" >
                                    <? 	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%principal%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
									?>
									<option <? if($nombre==$agente){ ?>selected="selected" <? } ?>value="<? echo $nombre; ?>"><? echo $nombre; ?></option>
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
									<option <? if($nombre==$subagente){ ?>selected="selected" <? } ?>value="<? echo $nombre; ?>"><? echo $nombre; ?></option>
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
								<td><select name="formapago" size="1">
                                	<option value="0" <? if($formapago=="0"){ ?>selected="selected" <? } ?>>Pago único</option>
									<option value="1" <? if($formapago=="1"){ ?>selected="selected" <? } ?>>Anual</option>
									<option value="12" <? if($formapago=="12"){ ?>selected="selected" <? } ?>>Mensual</option>
									<option value="3" <? if($formapago=="3"){ ?>selected="selected" <? } ?>>Trimestral</option>
									<option value="6" <? if($formapago=="6"){ ?>selected="selected" <? } ?>>Semestral</option>
									</select>
								</td>
							</tr>
                            <tr>
                            <td>&nbsp;</td>
                            </tr>
							<tr>
								<td><div id="etiqueta"><label>Moneda:</label></div></td>
								<td><select name="moneda" size="1" >
									<option value="Nacional" <? if($moneda=="Nacional"){ ?>selected="selected" <? } ?>>Nacional</option>
									<option value="Dolares" <? if($moneda=="Dolares"){ ?>selected="selected" <? } ?>>Dolares</option>
									</select>
								</td>
							</tr>
						</table>
					</td>
					<td width="318">
						<table cellpadding="0" cellspacing="0" border="1" align="center">
							<tr>
								<td><div id="etiqueta"><label>Compa&ntilde;&iacute;a:</label></div></td>
								<td><select name="compania" size="1" >
									<option value="AXA" <? if($compania=="AXA"){ ?>selected="selected" <? } ?>>AXA</option>
									<option value="GNP" <? if($compania=="GNP"){ ?>selected="selected" <? } ?>>GNP</option>
									<option value="ABA" <? if($compania=="ABA"){ ?>selected="selected" <? } ?>>ABA</option>
                                    <option value="Bupa" <? if($compania=="Bupa"){ ?>selected="selected" <? } ?>>Bupa</option>
                                    <option value="Metlife" <? if($compania=="Metlife"){ ?>selected="selected" <? } ?>>Metlife</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Prima Neta:</label></div></td>
								<td><input type="text" size="8" id="primaneta" name="primaneta" value="<? echo $primaneta; ?>"/></td>
							</tr>
							<tr>
								<td><div id="etiqueta">
								  <label>Comision agente:</label></div></td>
								<td><input type="text" size="8" id="gastoexp" name="gastoexp" value="<? echo $gastoexp; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Recargo cargo fraccionado:</label></div></td>
								<td><input type="text" size="8" id="recargo" name="recargo" value="<? echo $pagofracc; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Derecho de p&oacute;liza:</label></div></td>
								<td><input type="text" size="8" id="derechopol" name="derechopol" value="<? echo $derpol; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>IVA:</label></div></td>
								<td><input type="text" size="8" id="iva" name="iva" value="<? echo $iva; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Importe a pagar:</label></div></td>
								<td><input type="text" size="8" id="importe" name="importe" value="<? echo $total; ?>" /></td>
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
                    <td width="280"><input type="text" size="55" id="ubcalle" name="ubcalle" autocomplete="off" value="<? echo $calleh; ?>"/></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Ciudad:</label></div></td>
                    <td><input type="text" size="30" name="ubciudad" id="ubciudad" autocomplete="off" value="<? echo $ciudadh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Colonia:</label></div></td>
                    <td><input type="text" size="30" name="ubcolonia" id="ubcolonia" autocomplete="off" value="<? echo $coloniah; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">C.P.</div></td>
                    <td><input type="text" size="30" name="ubcp" id="ubcp" autocomplete="off" value="<? echo $cph; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Medio de transporte</div></td>
                    <td><input type="text" size="30" name="mediotrans" id="mediotrans" autocomplete="off" value="<? echo $mth; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Trayecto</div></td>
                    <td><input type="text" size="30" name="trayecto" id="trayecto" autocomplete="off" value="<? echo $trah; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Origen</div></td>
                    <td><input type="text" size="30" name="origen" id="origen" autocomplete="off" value="<? echo $orih; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Destino</div></td>
                    <td><input type="text" size="30" name="destino" id="destino" autocomplete="off" value="<? echo $desh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Valor del embarque </div></td>
                    <td><input type="text" size="30" name="valoremb" id="valoremb" autocomplete="off" value="<? echo $valembh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">Tipo de distribución</div></td>
                    <td><input type="text" size="30" name="tipodist" id="tipodist" autocomplete="off" value="<? echo $tipdish; ?>" /></td>
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
                    <td width="283"><input type="text" size="30" id="sec1edificio" name="sec1edificio" autocomplete="off" value="<? echo $edificioh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Contenidos:</label></div></td>
                    <td><input type="text" size="30" name="sec1contenido" id="sec1contenido" autocomplete="off" value="<? echo $ccontenidosh; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="blanco">&nbsp;<br />Riesgos adicionales:<br />&nbsp;</span></td>
                </tr>
                <tr>
                  <td colspan="2">
                   <? 
								if(!empty($riesgosh))
								{
									$talentos = explode(",", $riesgosh);
								}
					?>
                    	<table cellpadding="0" cellspacing="0" border="1" align="center" width="387">
							<tr>
                            	<td width="131"><span class="blanco">Hidrómeteorológicos</span></td>
                                <td width="55"><input type="checkbox" name="nombre[1]" id="nombre[1]" value="hidro"
                               <?
							   if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="hidro")
										echo 'checked="checked"'; 
								}}
								?>
                                 /></td>
                                <td width="131"><span class="blanco">500 mts del mar? </span></td>
                                <td width="60"><input type="checkbox" name="nombre[2]" id="nombre[2]" value="500" 
                                <?
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="500")
										echo 'checked="checked"'; 
								}}
								?>
                                 /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco"><label>Caída de árboles o antenas</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[3]" id="nombre[3]" value="arboles"
                                <?
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="arboles")
										echo 'checked="checked"'; 
								}}
								?>
                                 /></td>
                                <td width="131"><span class="blanco">Naves aéreas, vehículos y humo</span></td>
                                <td width="60"><input type="checkbox" name="nombre[4]" id="nombre[4]" value="naves" 
                                <?
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="naves")
										echo 'checked="checked"'; 
								}}
								?>
                                /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Derrame del P.C.I.</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[5]" id="nombre[5]" value="pci" 
                                <?
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="pci")
										echo 'checked="checked"'; 
								}}
								?>
                                 /></td>
                                <td width="131"><span class="blanco">Cobertura ámplia de incendio</span></td>
                                <td width="60"><input type="checkbox" name="nombre[6]" id="nombre[6]" value="incendio" 
                                <?
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="incendio")
										echo 'checked="checked"'; 
								}}
								?>
                                 /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco"><label>Remoción de escombros</label></span></td>
                                <td width="55"><input type="text" size="1" name="addescombros" maxlength="3" value="<? echo $escombrosh; ?>" /><span class="blanco">%</span></td>
                                <td width="131"><span class="blanco">Daños por agua.</span></td>
                                <td width="60"><input type="checkbox" name="nombre[7]" id="nombre[7]" value="agua" 
                                <?
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="agua")
										echo 'checked="checked"'; 
								}}
								?>
                                /></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Huelgas y Vandalismo</label></span></td>
                                <td width="55"><input type="checkbox" name="nombre[8]" id="nombre[8]" value="huelga" 
                                <?
								if ($talentos!="")
							   {
							   foreach ($talentos as $clave) 
								{
									if($clave=="huelga")
										echo 'checked="checked"'; 
								}}
								?>
                                /></td>
                                <td width="131"><span class="blanco">Inflación</span></td>
                                <td width="60"><input type="text" size="1" name="addinflacion" maxlength="3" value="<? echo $inflacionh; ?>" /><span class="blanco">%</span></td>
                            </tr>
                            <tr>
                            	<td width="131"><span class="blanco">
                            	<label>Otras:</label></span></td>
                                <td colspan="3"><input type="text" name="addotras" size="40" value="<? echo $otrash; ?>"/></td>
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
                            <td width="264"><input type="text" name="sec3" size="40" value="<? echo $seccion3h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec4" size="40" value="<? echo $seccion4h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec5" size="40" value="<? echo $seccion5h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec6" size="40" value="<? echo $seccion6h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec7" size="40" value="<? echo $seccion7h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec8" size="40" value="<? echo $seccion8h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec9" size="40" value="<? echo $seccion9h; ?>" /></td>
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
                          <td width="264"><input type="text" name="sec10" size="40" value="<? echo $seccion10h; ?>" /></td>
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
                            <td width="264"><input type="text" name="sec11" size="40" value="<? echo $seccion11h; ?>" /></td>
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
					<td height="46" colspan="2" align="center"><input type="submit" name="submit" value="Guardar póliza" />
				    <input type="hidden" name="tipopol" value="daños" /><input type="hidden" name="id" value="<? echo $_GET['id']; ?>"/></td>
              	</tr>
              	<tr>
                	<td>
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
<? }} ?>