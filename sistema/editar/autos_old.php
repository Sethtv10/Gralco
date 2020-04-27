<?php 
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");

$mensaje="";

$permisos=strstr($_SESSION['perm'], 'editar');
$zonas=strstr($_SESSION['zonas'], 'polizas');
if (($permisos!="") && ($zonas!=""))
{

if(!isset($_GET['num']))
{
	header("LOCATION: ../index.php");
	exit;
}
$cnx=conectar();
$mensaje="";
if(isset($_POST['idpol']))
{
	//Saber cual fue el modo original de pago (anual, mensual...) y recuperar ese numero de recibos
	$desde=1;
	if($_POST['formapagoorg']>$_POST['formapago'])//Si es la forma de pago anterior era mayor a la actual, (12>3) editar los que correspondan (4) y los demas eliminarlos
	{
		if($_POST['formapago']==0){$hasta=1;}//pago unico
		if($_POST['formapago']==1){$hasta=1;}//anual
		if($_POST['formapago']==6){$hasta=2;}//semestral
		if($_POST['formapago']==3){$hasta=4;}//trimestral
		if($_POST['formapago']==12){$hasta=12;}//mensual
		for($a=1;$a<=$hasta;$a++)
		{ //$idw,$numpolw,$numpagow,$diavencw,$mesvencw,$aniovencw,$diapagow,$mespagow,$aniopagow,$statusw,$monto
			$sqlnvo = "UPDATE recibos SET ";
			$sqlnvo.= "diavenc='".$_POST['fechavencdia'.$a]."',";
			$sqlnvo.= "mesvenc='".$_POST['fechavencmes'.$a]."',";
			$sqlnvo.= "aniovenc='".$_POST['fechavencanio'.$a]."',";
			$sqlnvo.= "diapago='".$_POST['fechapagdia'.$a]."',";
			$sqlnvo.= "mespago='".$_POST['fechapagmes'.$a]."',";
			$sqlnvo.= "aniopago='".$_POST['fechapaganio'.$a]."',";
			$sqlnvo.= "status='".$_POST['status'.$a]."',";
			$sqlnvo.= "monto='".$_POST['monto'.$a]."'";
			$sqlnvo.= " WHERE id='".$_POST['id'.$a]."'";
			$resnvo = mysql_query($sqlnvo) or die (mysql_error());	
		}
		//ahora borrar los sobrantes (12>3) borrar 8 for(5;5<=12;6)
		if($_POST['formapagoorg']==0){$hastan=1;}//pago unico
		if($_POST['formapagoorg']==1){$hastan=1;}//anual
		if($_POST['formapagoorg']==6){$hastan=2;}//semestral
		if($_POST['formapagoorg']==3){$hastan=4;}//trimestral
		if($_POST['formapagoorg']==12){$hastan=12;}//mensual
		for($a=$hasta+1;$a<=$hastan;$a++)
		{
			$sql="DELETE FROM recibos WHERE id='".$_POST['id'.$a]."'";
			$res = mysql_query($sql) or die (mysql_error());
			$sql1="OPTIMIZE TABLE recibos";
			$res1 = mysql_query($sql1) or die (mysql_error());
		}
	}
	if($_POST['formapago']>$_POST['formapagoorg'])//si la forma de pago actual es mayor a la anterior (12>1) antes habia 1 ahora habra 12, editar cuantos habia y añadir los faltantes
	{
		if($_POST['formapagoorg']==0){$hasta=1;}//pago unico
		if($_POST['formapagoorg']==1){$hasta=1;}//anual
		if($_POST['formapagoorg']==6){$hasta=2;}//semestral
		if($_POST['formapagoorg']==3){$hasta=4;}//trimestral
		if($_POST['formapagoorg']==12){$hasta=12;}//mensual
		for($a=1;$a<=$hasta;$a++)
		{
			$sqlnvo = "UPDATE recibos SET ";
			$sqlnvo.= "diavenc='".$_POST['fechavencdia'.$a]."',";
			$sqlnvo.= "mesvenc='".$_POST['fechavencmes'.$a]."',";
			$sqlnvo.= "aniovenc='".$_POST['fechavencanio'.$a]."',";
			$sqlnvo.= "diapago='".$_POST['fechapagdia'.$a]."',";
			$sqlnvo.= "mespago='".$_POST['fechapagmes'.$a]."',";
			$sqlnvo.= "aniopago='".$_POST['fechapaganio'.$a]."',";
			$sqlnvo.= "status='".$_POST['status'.$a]."',";
			$sqlnvo.= "monto='".$_POST['monto'.$a]."'";
			$sqlnvo.= " WHERE id='".$_POST['id'.$a]."'";
			$resnvo = mysql_query($sqlnvo) or die (mysql_error());	
		}
		if($_POST['formapago']==0){$hastan=1;}//pago unico
		if($_POST['formapago']==1){$hastan=1;}//anual
		if($_POST['formapago']==6){$hastan=2;}//semestral
		if($_POST['formapago']==3){$hastan=4;}//trimestral
		if($_POST['formapago']==12){$hastan=12;}//mensual
		for($a=$hasta+1;$a<=$hastan;$a++)
		{
			$campos="numpol,numpago,diavenc,mesvenc,aniovenc,diapago,mespago,aniopago,status,monto";
			$valor = "'".$_POST['idpol']."','".$_POST['pago'.$a]."','".$_POST['fechavencdia'.$a]."','".$_POST['fechavencmes'.$a]."','".$_POST['fechavencanio'.$a]."','".$_POST['fechapagdia'.$a]."','".$_POST['fechapagmes'.$a]."','".$_POST['fechapaganio'.$a]."','".$_POST['status'.$a]."','".$_POST['monto'.$a]."'";
			$sql = "INSERT INTO recibos ($campos) VALUES ($valor)";
			$res = mysql_query($sql) or die (mysql_error());
		}	
	}
	if($_POST['formapagoorg']==$_POST['formapago'])//Es igual el tipo de pago, revisar el numero de pagos y actualizar
	{
		if($_POST['formapagoorg']==0){$hasta=1;}//pago unico
		if($_POST['formapagoorg']==1){$hasta=1;}//anual
		if($_POST['formapagoorg']==6){$hasta=2;}//semestral
		if($_POST['formapagoorg']==3){$hasta=4;}//trimestral
		if($_POST['formapagoorg']==12){$hasta=12;}//mensual
		for($a=1;$a<=$_POST['numrecibos'];$a++)
		{
			$sqlnvo = "UPDATE recibos SET ";
			$sqlnvo.= "diavenc='".$_POST['fechavencdia'.$a]."',";
			$sqlnvo.= "mesvenc='".$_POST['fechavencmes'.$a]."',";
			$sqlnvo.= "aniovenc='".$_POST['fechavencanio'.$a]."',";
			$sqlnvo.= "diapago='".$_POST['fechapagdia'.$a]."',";
			$sqlnvo.= "mespago='".$_POST['fechapagmes'.$a]."',";
			$sqlnvo.= "aniopago='".$_POST['fechapaganio'.$a]."',";
			$sqlnvo.= "status='".$_POST['status'.$a]."',";
			$sqlnvo.= "monto='".$_POST['monto'.$a]."'";
			$sqlnvo.= " WHERE id='".$_POST['id'.$a]."'";
			$resnvo = mysql_query($sqlnvo) or die (mysql_error());	
		}
		if($_POST['numrecibos']<$hasta)
		{
			for($a=$_POST['numrecibos']+1;$a<=$hasta;$a++)
			{
				$campos="numpol,numpago,diavenc,mesvenc,aniovenc,diapago,mespago,aniopago,status,monto";
				$valor = "'".$_POST['idpol']."','".$_POST['pago'.$a]."','".$_POST['fechavencdia'.$a]."','".$_POST['fechavencmes'.$a]."','".$_POST['fechavencanio'.$a]."','".$_POST['fechapagdia'.$a]."','".$_POST['fechapagmes'.$a]."','".$_POST['fechapaganio'.$a]."','".$_POST['status'.$a]."','".$_POST['monto'.$a]."'";
				$sql = "INSERT INTO recibos ($campos) VALUES ($valor)";
				$res = mysql_query($sql) or die (mysql_error());
			}	
		}
	}
	//Editar la poliza y la tabla autos
			$sqlnvo = "UPDATE poliza SET ";
			$sqlnvo.= "numpoliza='".$_POST['poliza']."',";
			$sqlnvo.= "contratante='".$_POST['txtNombre']."',";
			$sqlnvo.= "datos='".$_POST['datosclie']."',";
			$sqlnvo.= "deldia='".$_POST['vigdeldia']."',";
			$sqlnvo.= "delmes='".$_POST['vigdelmes']."',";
			$sqlnvo.= "delanio='".$_POST['vigdelanio']."',";
			$sqlnvo.= "aldia='".$_POST['vigaldia']."',";
			$sqlnvo.= "almes='".$_POST['vigalmes']."',";
			$sqlnvo.= "alanio='".$_POST['vigalanio']."',";
			$sqlnvo.= "expdia='".$_POST['fechaexpdia']."',";
			$sqlnvo.= "expmes='".$_POST['fechaexpmes']."',";
			$sqlnvo.= "expanio='".$_POST['fechaexpanio']."',";
			$sqlnvo.= "compania='".$_POST['compania']."',";
			$sqlnvo.= "moneda='".$_POST['moneda']."',";
			$sqlnvo.= "formapago='".$_POST['formapago']."',";
			$sqlnvo.= "primaneta='".$_POST['primaneta']."',";
			$sqlnvo.= "gastoexp='".$_POST['gastoexp']."',";
			$sqlnvo.= "pagofracc='".$_POST['recargo']."',";
			$sqlnvo.= "derpol='".$_POST['derechopol']."',";
			$sqlnvo.= "iva='".$_POST['iva']."',";
			$sqlnvo.= "importetotal='".$_POST['importe']."',";
			$sqlnvo.= "agente='".$_POST['agente']."',";
			$sqlnvo.= "subagente='".$_POST['subagente']."',";
			$sqlnvo.= "status='".$_POST['statuspol']."',";
			$sqlnvo.= "motivo='".$_POST['motivo']."',";
			$sqlnvo.= "comsub='".$_POST['comsub']."',";
			$sqlnvo.= "diasub='".$_POST['diasub']."',";
			$sqlnvo.= "messub='".$_POST['messub']."',";
			$sqlnvo.= "aniosub='".$_POST['aniosub']."',";
			$sqlnvo.= "notacredito='".$_POST['nota']."'";
			$sqlnvo.= " WHERE id='".$_POST['idpol']."'";
			$resnvo = mysql_query($sqlnvo) or die (mysql_error());
			//actualizar tabla autos
			$sqlnvo = "UPDATE autos SET ";
			$sqlnvo.= "marca='".$_POST['marca']."',";
			$sqlnvo.= "motor='".$_POST['motor']."',";
			$sqlnvo.= "serie='".$_POST['serie']."',";
			$sqlnvo.= "placas='".$_POST['placas']."',";
			$sqlnvo.= "modelo='".$_POST['modelo']."',";
			$sqlnvo.= "cobertura='".$_POST['cobertura']."',";
			$sqlnvo.= "origen='".$_POST['origen']."'";
			$sqlnvo.= " WHERE idpol='".$_POST['idpol']."'";
			$resnvo = mysql_query($sqlnvo) or die (mysql_error());
			$mensaje="Se guardaron los cambios.";
			$camposbit="usuario,accion,poliza,fecha,hora";
			$valorbit = "'".$_SESSION['usera']."','Edito poliza autos','".$_POST['poliza']."/".$_POST['idpol']."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
			$sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
			$resbit = mysql_query($sqlbit) or die (mysql_error());			
}
$sql="SELECT * FROM poliza WHERE numpoliza='".$_GET['num']."'";
$res=mysql_query($sql) or die(mysql_error());
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
		$sqle="SELECT * FROM autos WHERE idpol='".$idn."'";
		$rese=mysql_query($sqle);
		if(mysql_num_rows($rese)>0)
		{
			while(list($idq,$idpolq,$marcaq,$motorq,$serieq,$placasq,$modeloq,$coberturaq,$origenq)=mysql_fetch_array($rese))
			{
				$idauto=$idq;
				$marcah=$marcaq;
				$motorh=$motorq;
				$serieh=$serieq;
				$placash=$placasq;
				$modeloh=$modeloq;
				$coberturah=$coberturaq;
				$origenh=$origenq;
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
<Script language="JavaScript" type="text/javascript">
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
		var result=(Math.floor(resiva*100))/100;
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
	  <?php  include("../menu2.php"); ?>
	</div>
<div id="contenido">
		<p>Editar póliza autos</p>
			<form id="formRegistro" action="autos.php<?php  echo "?".$_SERVER['QUERY_STRING']; ?>" method="post">
            <table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
                    <td width="153"><div id="etiqueta">Comisión subagente:</div></td>
                    <td width="320"><input type="text" name="comsub" id="comsub" autocomplete="off" size="55" value="<?php  echo $comsubn; ?>" /></td>
                    <td width="197"><select name="diasub" size="1">
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
                    <td width="270">&nbsp;</td>
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
											if ($a==$deldian)
											{
									?>
											<option selected="selected" value="<?php  echo $a; ?>" ><?php  echo $a; ?></option>
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
											if ($a==$delmesn)
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
									</select>&nbsp;<input type="text" size="4" id="vigdelanio" name="vigdelanio" maxlength="4" value="<?php  echo $delanion; ?>" /></td>
								</tr>
								<tr>
									<td align="right"><div id="etiqueta"><label>Al:</label></div></td>
									<td><select name="vigaldia" size="1">
									<?php  for ($a=1;$a<=31;$a++)
										{
											if ($a==$aldian)
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
											if ($a==$almesn)
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
											if ($a==$expdian)
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
											if ($a==$expmesn)
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
									</select>&nbsp;<input type="text" size="5" id="fechaexpanio" name="fechaexpanio" maxlength="4" value="<?php  echo $expanion; ?>" />
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
								<td><select name="formapago" size="1">
                                	<option value="0" <?php  if($formapagon=="0"){ ?>selected="selected" <?php  } ?>>Pago único</option>
									<option value="1" <?php  if($formapagon=="1"){ ?>selected="selected" <?php  } ?>>Anual</option>
									<option value="12" <?php  if($formapagon=="12"){ ?>selected="selected" <?php  } ?>>Mensual</option>
									<option value="3" <?php  if($formapagon=="3"){ ?>selected="selected" <?php  } ?>>Trimestral</option>
									<option value="6" <?php  if($formapagon=="6"){ ?>selected="selected" <?php  } ?>>Semestral</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Moneda:</label></div></td>
								<td><select name="moneda" size="1" >
									<option value="Nacional" <?php  if($monedan=="Nacional"){ ?>selected="selected" <?php  } ?>>Nacional</option>
									<option value="Dolares" <?php  if($monedan=="Dolares"){ ?>selected="selected" <?php  } ?>>Dolares</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><div id="etiqueta"><label>Origen:</label></div></td>
								<td><select name="origen" size="1" >
									<option value="Nacional" <?php  if($origenh=="Nacional"){ ?>selected="selected" <?php  } ?>>Nacional</option>
									<option value="Legalizado" <?php  if($origenh=="Legalizado"){ ?>selected="selected" <?php  } ?>>Legalizado</option>
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
								<td><input type="text" size="8" id="iva" name="iva" value="<?php  echo $ivan; ?>" onfocus="calculaiva();" /></td>
							</tr>
                            <tr>
								<td><div id="etiqueta">
								  <label>Nota crédito:</label></div></td>
								<td><input type="text" size="8" id="nota" name="nota" value="<?php  echo $notan; ?>" /></td>
							</tr>
							<tr>
								<td><div id="etiqueta">
								  <label>Prima total:</label></div></td>
								<td><input type="text" size="8" id="importe" name="importe" value="<?php  echo $totaln; ?>" onfocus="calculatotal();" /></td>
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
                    <td height="41" colspan="2" align="center"><div id="etiqueta2" align="center"><label>Datos del autom&oacute;vil:</label></div></td>
              </tr>
                <tr>
                    <td width="101"><div id="etiqueta">
                      <label>Marca:</label></div></td>
                    <td width="280"><input type="text" size="55" id="marca" name="marca" autocomplete="off" value="<?php  echo $marcah; ?>" /><div id="automarca" class="autocomplete" style="display:none"></div></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Motor:</label></div></td>
                    <td><input type="text" size="30" name="motor" id="motor" autocomplete="off" value="<?php  echo $motorh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Serie:</label></div></td>
                    <td><input type="text" size="30" id="serie" name="serie" autocomplete="off" value="<?php  echo $serieh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Modelo:</label></div></td>
                    <td><input type="text" size="30" id="modelo" name="modelo" autocomplete="off" value="<?php  echo $modeloh; ?>" /></td>
                </tr>
                <tr>
                    <td><div id="etiqueta">
                      <label>Placas:</label></div></td>
                    <td><input type="text" size="30" id="placas" name="placas" autocomplete="off" value="<?php  echo $placash; ?>"/></td>
                </tr>
				 <tr align="center">
                    <td colspan="2" align="center"><?php  echo $mensaje; ?></td>
                </tr>
            </table>
      		<table cellpadding="0" cellspacing="0" border="1" align="center" width="750">
                <tr>
                    <td height="41" colspan="5" align="center"><div id="etiqueta2" align="center"><label>Recibos de pago:</label></div></td>
              	</tr>
                <tr>
                    <td width="72"><div id="etiqueta"><label>Pago:</label></div></td>
                    <td width="175"><div id="etiqueta"><label>Fecha vencimiento:</label></div></td>
                    <td width="185"><div id="etiqueta"><label>Fecha pago:</label></div></td>
                    <td width="150"><div id="etiqueta"><label>Monto:</label></div></td>
                    <td width="156"><div id="etiqueta"><label>Estatus:</label></div></td>
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
                    <td width="72"><input type="hidden" name="id<?php  echo $num; ?>" value="<?php  echo $idw; ?>" /><input type="text" name="pago<?php  echo $num; ?>" autocomplete="off" value="<?php  echo $numpagow; ?>" size="2" /></td>
                    <td width="175"><select name="fechavencdia<?php  echo $num; ?>" size="1">
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
                    <td width="185">
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
                    <td width="150"><div id="etiqueta"><input type="text" size="30" name="monto<?php  echo $num; ?>" autocomplete="off" value="<?php  echo $montow; ?>" /></div></td>
                    <td width="156"><div id="etiqueta">
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
                    <td width="72"><input type="text" name="pago<?php  echo $a; ?>" autocomplete="off" value="<?php  echo $a; ?>" size="2" /></td>
                    <td width="175">
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
                    <td width="185">
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
                    <td width="150"><input type="text" size="30" name="monto<?php  echo $a; ?>" autocomplete="off" /></td>
                    <td width="156"><div id="etiqueta">
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
                    <td colspan="5" align="center">&nbsp;</td>
                </tr>
                <tr>
                	<td><div id="etiqueta">Status</div></td>
					<td><select name="statuspol" size="1">
                        	<option value="D" <?php  if ($statusn=="D") { ?>selected="selected" <?php  } ?>>Por pagar</option>
                            <option value="P" <?php  if ($statusn=="P") { ?>selected="selected" <?php  } ?>>Pagada</option>
                            <option value="C" <?php  if ($statusn=="C") { ?>selected="selected" <?php  } ?>>Cancelada</option>
                         </select>
                    </td>
                    <td><div id="etiqueta">Observaciones</div></td>
                    <td colspan="2"><textarea name="motivo" cols="10" rows="3"><?php  echo $motivon; ?></textarea></td>
                </tr>
        		<tr align="center">
                    <td colspan="5" align="center"><div id="btn">
                      <input type="submit" name="submit" value="Editar póliza" />
						<input type="hidden" name="tipopol" value="autos" />
                        <input type="hidden" name="idpol" value="<?php  echo $idn; ?>" />
                        <input type="hidden" name="numrecibos" value="<?php  echo $num; ?>" />
                        <input type="hidden" name="formapagoorg" value="<?php  echo $formapagon; ?>" />
                    </div></td>
                </tr>
            </table>
</form>
	</div>
    <?php  
if ($mensaje!="")
{
	?>
	<script language="javascript">
        alert("<?php  echo $mensaje; ?>");
    </script>
	<?php 	
}
?>
</body>
</html>
<?php }
	else
	{
		header("LOCATION: ../index.php");
		exit();
	}
 //Permiso para agregar ?>