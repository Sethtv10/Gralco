<?php  
include ("../ajax/config.php");
include ("../ajax/funciones.php");
include("../ajax/secure.php");
$cnx=conectar();

$mensaje="";

$permisos=strstr($_SESSION['perm'], 'renovar');
$zonas=strstr($_SESSION['zonas'], 'polizas');
if (($permisos!="") && ($zonas!=""))
{

if (isset($_POST['submit']))
 {
	$campos="numpoliza,tipopoliza,contratante,datos,deldia,delmes,delanio,aldia,almes,alanio,expdia,expmes,expanio,compania,moneda,formapago,primaneta,gastoexp,pagofracc,derpol,iva,importetotal,agente,subagente,polizaant,status,motivo,comsub,diasub,messub,aniosub";
	$valor = "'".$_POST['polizanew']."','".$_POST['tipopol']."','".$_POST['txtNombre']."','".$_POST['datosclie']."','".$_POST['vigdeldia']."','".$_POST['vigdelmes']."','".$_POST['vigdelanio']."','".$_POST['vigaldia']."','".$_POST['vigalmes']."','".$_POST['vigalanio']."','".$_POST['fechaexpdia']."','".$_POST['fechaexpmes']."','".$_POST['fechaexpanio']."','".$_POST['compania']."','".$_POST['moneda']."','".$_POST['formapago']."','".$_POST['primaneta']."','".$_POST['gastoexp']."','".$_POST['recargo']."','".$_POST['derechopol']."','".$_POST['iva']."','".$_POST['importe']."','".$_POST['agente']."','".$_POST['subagente']."','".$_POST['poliza']."','D','','".$_POST['comsub']."','".$_POST['diasub']."','".$_POST['messub']."','".$_POST['aniosub']."'";
	$sql = "INSERT INTO poliza ($campos) VALUES ($valor)";
	$res = mysql_query($sql) or die (mysql_error());

	$ultimoid=mysql_insert_id();
	$campauto="idpol,marca,motor,serie,placas,modelo,cobertura,origen";
	$valorauto="'".$ultimoid."','".$_POST['marca']."','".$_POST['motor']."','".$_POST['serie']."','".$_POST['placas']."','".$_POST['modelo']."','".$_POST['cobertura']."','".$_POST['origen']."'";
	$sql2 = "INSERT INTO autos ($campauto) VALUES ($valorauto)";
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
			$mes=$mes+6;
		  }
	 }
	$sqlnvo2 = "UPDATE poliza SET ";
	$sqlnvo2.= "status='R'";
	$sqlnvo2.= " WHERE id='".$_POST['id']."'";
	$resnvo2 = mysql_query($sqlnvo2) or die (mysql_error());
	$camposbit="usuario,accion,poliza,fecha,hora";
	$valorbit = "'".$_SESSION['usera']."','Renovo poliza auto','".$_POST['poliza']."/".$_POST['polizanew']."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
	$sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
	$resbit = mysql_query($sqlbit) or die (mysql_error());
	mysql_close($cnx);
	header("Location: ../mensaje.php?mensaje=Se renovó con éxito la póliza");
 }
$sql1="SELECT * FROM autos WHERE idpol='".$_GET['id']."'";
$res1=mysql_query($sql1) or die (mysql_error());
if (mysql_num_rows($res1)>0)
  {
	while(list($id,$idpol,$marca,$motor,$serie,$placas,$modelo,$cobertura,$origen) = mysql_fetch_array($res1))
	{
	 	$marcaauto=$marca;
	 	$motorauto=$motor;
		$serieauto=$serie;
		$placasauto=$placas;
		$modeloauto=$modelo;
		$coberauto=$cobertura;
		$origenauto=$origen;
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
		<?php  include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Renovación póliza autos</p>
			<form id="formRegistro" action="auto.php" method="post">
            <table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
                    <td width="153"><font color="#FFFFFF">Comisión subagente:</font></td>
                    <td width="299"><input type="text" name="comsub" id="comsub" autocomplete="off" size="20" value="<?php echo $comsubn; ?>" /></td>
                    <td width="189"><select name="diasub" size="1">
									<?php  for ($a=1;$a<=31;$a++)
										{
									?>
											<option <?php  if ($a==$diasubn) { ?> selected="selected" <?php  } ?> value="<?php echo $a; ?>" ><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>
									<select name="messub" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
									?>
											<option <?php  if ($a==$messubn) {?> selected="selected" <?php  } ?> value="<?php echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="aniosub" name="aniosub" maxlength="4" value="<?php echo $aniosubn+1; ?>" /></td>
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
									<td><input type="text" name="txtNombre" id="txtNombre" value="<?php  echo $contratante; ?>" autocomplete="off" size="55" /><img src="../images/lupa.jpg" width="21" height="20" onclick="datos('../ajax/cliente.php','datosclie','nombre='+document.getElementById('txtNombre').value,'POST');" align="top" />
            <div id="autonombre" class="autocomplete" style="display:none"></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta"><label>Datos contratante:</label></div></td>
									<td><textarea name="datosclie" id="datosclie"><?php  echo $datos; ?></textarea></td>
								</tr>
						</table>
					</td> 
					<td width="473">
						<table width="473" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td width="101"><div id="etiqueta"><label>P&oacute;liza</label> 
									anterior</div></td>
									<td width="372"><input type="text" size="20" name="poliza" autocomplete="off" readonly="readonly" value="<?php  echo $numpoliza; ?>" /></td>
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
									<?php  for ($a=1;$a<=31;$a++)
										{
											if ($a==$deldia)
											{
									?>
											<option selected="selected" value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
											}
											else
												{
									?>
											<option value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
												}
										}
									?>
									</select>
									<select name="vigdelmes" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
											if ($a==$delmes)
											{
									?>
											<option selected="selected" value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
											}
											else
												{
									?>
											<option value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
												}
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="vigdelanio" name="vigdelanio" maxlength="4" value="<?php  echo $alanio; ?>" /></td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Al:</label></div></td>
									<td><select name="vigaldia" size="1">
									<?php  for ($a=1;$a<=31;$a++)
										{
											if ($a==$aldia)
											{
									?>
											<option selected="selected" value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
											}
											else
												{
									?>
											<option value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
												}
										}
									?>
									</select>
									<select name="vigalmes" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
											if ($a==$almes)
											{
									?>
											<option selected="selected" value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
											}
											else
												{
									?>
											<option value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
												}
										}
									?>
								  </select>&nbsp;<input type="text" size="4" id="vigalanio" name="vigalanio" maxlength="4" value="<?php  echo $alanio+1; ?>" /></td>
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
											if ($a==1)
											{
									?>
											<option selected="selected" value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
											}
											else
												{
									?>
											<option value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
												}
										}
									?>
									</select>
									<select name="fechaexpmes" size="1">
									<?php  for ($a=1;$a<=12;$a++)
										{
											if ($a==1)
											{
									?>
											<option selected="selected" value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
									<?php 
											}
											else
												{
									?>
											<option value="<?php  echo $a; ?>"><?php  echo $a; ?></option>
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
								<td><div id="etiqueta"><label>Tipo de cobertura:</label></div>
									<select name="cobertura" size="1" >
									<option value="Amplia" <?php  if($coberturah=="Amplia"){ ?>selected="selected" <?php  } ?>>Amplia</option>
									<option value="Amplia GL" <?php  if($coberturah=="Amplia GL"){ ?>selected="selected" <?php  } ?>>Amplia GL</option>
									<option value="Limitada" <?php  if($coberturah=="Limitada"){ ?>selected="selected" <?php  } ?>>Limitada</option>
									<option value="RC" <?php  if($coberturah=="RC"){ ?>selected="selected" <?php  } ?>>RC</option>
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
                                    <?php  	$sqlmarca="SELECT nombre FROM agentes WHERE categoria LIKE '%principal%'";
                                    	$resmarca=mysql_query($sqlmarca) or die (mysql_error());
										$cuenta=0;
                                        while(list($nombre)=mysql_fetch_array($resmarca))
                                          	{
									?>
									<option <?php  if($nombre==$agente){ ?>selected="selected" <?php  } ?>value="<?php  echo $nombre; ?>"><?php  echo $nombre; ?></option>
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
									<option <?php  if($nombre==$subagente){ ?>selected="selected" <?php  } ?>value="<?php  echo $nombre; ?>"><?php  echo $nombre; ?></option>
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
								<td><select name="formapago" size="1">
                                	<option value="0" <?php  if($formapago=="0"){ ?>selected="selected" <?php  } ?>>Pago único</option>
									<option value="1" <?php  if($formapago=="1"){ ?>selected="selected" <?php  } ?>>Anual</option>
									<option value="12" <?php  if($formapago=="12"){ ?>selected="selected" <?php  } ?>>Mensual</option>
									<option value="3" <?php  if($formapago=="3"){ ?>selected="selected" <?php  } ?>>Trimestral</option>
									<option value="6" <?php  if($formapago=="6"){ ?>selected="selected" <?php  } ?>>Semestral</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Moneda:</label></div></td>
								<td><select name="moneda" size="1" >
									<option value="Nacional" <?php  if ($moneda=="Nacional"){ echo "selected='selected'";} ?>>Nacional</option>
									<option value="Dolares" <?php  if ($moneda=="Dolares"){ echo "selected='selected'";} ?>>Dolares</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Origen:</label></div></td>
								<td><select name="origen" size="1" readonly="readonly">
									<option value="Nacional" <?php  if ($origenauto=="Nacional"){ echo "selected='selected'";} ?>>Nacional</option>
									<option value="Legalizado" <?php  if ($origenauto=="Legalizado"){ echo "selected='selected'";} ?>>Legalizado</option>
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
								<td><input type="text" size="8" id="primaneta" name="primaneta" value="<?php  echo $primaneta; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta">
								  <label>Comision agente:</label></div></td>
								<td><input type="text" size="8" id="gastoexp" name="gastoexp" value="<?php  echo $gastoexp; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Recargo cargo fraccionado:</label></div></td>
								<td><input type="text" size="8" id="recargo" name="recargo" value="<?php  echo $pagofracc; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Derecho de p&oacute;liza:</label></div></td>
								<td><input type="text" size="8" id="derechopol" name="derechopol" value="<?php  echo $derpol; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>IVA:</label></div></td>
								<td><input type="text" size="8" id="iva" name="iva" value="<?php  echo $iva; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Importe a pagar:</label></div></td>
								<td><input type="text" size="8" id="importe" name="importe" value="<?php  echo $importetotal; ?>" /></td>
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
                    <td width="280"><input type="text" size="55" id="marca" name="marca" autocomplete="off" value="<?php  echo $marcaauto; ?>"/></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Motor:</label></div></td>
                    <td><input type="text" size="30" name="motor" id="motor" autocomplete="off" value="<?php  echo $motorauto; ?>"/></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Serie:</label></div></td>
                    <td><input type="text" size="30" id="serie" name="serie" autocomplete="off" value="<?php  echo $serieauto; ?>"/></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Modelo:</label></div></td>
                    <td><input type="text" size="30" id="modelo" name="modelo" autocomplete="off" value="<?php  echo $modeloauto; ?>"/></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Placas:</label></div></td>
                    <td><input type="text" size="30" id="placas" name="placas" autocomplete="off" value="<?php  echo $placasauto; ?>"/></td>
                </tr>
				 <tr align="center">
                    <td colspan="2" align="center">&nbsp;</td>
                </tr>
		   <tr align="center">
                    <td colspan="2" align="center"><div id="btn">
                      <input type="submit" name="submit" value="Guardar póliza" />
						<input type="hidden" name="tipopol" value="autos"/><input type="hidden" name="id" value="<?php  echo $_GET['id']; ?>"/>
                    </div></td>
                </tr>
            </table>

			</form>
	</div>
</body>
</html>
<?php 
  		}
  }
?>
<?php }
	else
	{
		header("LOCATION: ../index.php");
		exit();
	}
 //Permiso para agregar ?>