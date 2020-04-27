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

if(isset($_POST['submit']))
{
	//numcliente,nombre,direccion,edad,dia,mes,anio,colonia,cp,ciudad,estado,rfc,tel,telmov,tipoclie	
	$sqlnvo = "UPDATE cliente SET ";
	$sqlnvo.= "numcliente='".$_POST['numcliente']."',";
	$sqlnvo.= "nombre='".$_POST['txtNombre']."',";
	$sqlnvo.= "direccion='".$_POST['domicilio']."',";
	$sqlnvo.= "dia='".$_POST['dia']."',";
	$sqlnvo.= "mes='".$_POST['mes']."',";
	$sqlnvo.= "anio='".$_POST['anio']."',";
	$sqlnvo.= "colonia='".$_POST['colonia']."',";
	$sqlnvo.= "cp='".$_POST['cp']."',";
	$sqlnvo.= "ciudad='".$_POST['ciudad']."',";
	$sqlnvo.= "estado='".$_POST['estado']."',";
	$sqlnvo.= "rfc='".$_POST['rfc']."',";
	$sqlnvo.= "tel='".$_POST['tel']."',";
	$sqlnvo.= "telmov='".$_POST['telcel']."',";
	$sqlnvo.= "tipoclie='".$_POST['tipoclie']."'";
	$sqlnvo.= " WHERE id='".$_GET['num']."'";
	$resnvo = mysql_query($sqlnvo) or die (mysql_error());
	$mensaje="Se guardaron los cambios";
	$camposbit="usuario,accion,poliza,fecha,hora";
	$valorbit = "'".$_SESSION['usera']."','Edito cliente','".$_POST['txtNombre']."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
	$sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
	$resbit = mysql_query($sqlbit) or die (mysql_error());	
}

$sql="SELECT * FROM cliente WHERE id='".$_GET['num']."' LIMIT 1";
$res=mysql_query($sql);
if(mysql_num_rows($res)>0)
{
	while(list($id,$numcliente,$nombre,$direccion,$edad,$dia,$mes,$anio,$colonia,$cp,$ciudad,$estado,$rfc,$tel,$telmov,$tipoclie)=mysql_fetch_array($res))
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
		<? include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Editar cliente</p>
			<form id="formRegistro" action="<? echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" method="post">
			<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td width="477">
						<table width="477" align="left" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><div id="etiqueta">
									  <label>Nombre:</label></div></td>
									<td><input type="text" name="txtNombre" id="txtNombre" autocomplete="off" size="55" value="<? echo $nombre; ?>" /></td>
								</tr>
								<tr valign="top">
									<td><div id="etiqueta">
									  <label>Domicilio:</label></div></td>
									<td><textarea name="domicilio" id="domicilio"><? echo $direccion; ?></textarea></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Colonia:</label></div></td>
								  <td><input type="text" name="colonia" id="colonia" autocomplete="off" size="55" value="<? echo $colonia; ?>" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>C.P:</label></div></td>
								  <td>
									<table width="370" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="59">
				<input type="text" name="cp" id="cp" autocomplete="off" size="5" maxlength="5" value="<? echo $cp; ?>" /></td>
											<td width="100" align="left"><div id="etiqueta">
									  <label>RFC:</label></div></td>
											<td width="211"><input type="text" name="rfc" id="rfc" autocomplete="off" size="22" value="<? echo $rfc; ?>" /></td>
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
				<input type="text" name="ciudad" id="ciudad" autocomplete="off" size="15" value="<? echo $ciudad; ?>" /></td>
											<td width="100" align="left"><div id="etiqueta">
									  <label>Estado:</label></div></td>
											<td width="195"><input type="text" name="estado" id="estado" autocomplete="off" size="12" value="<? echo $estado; ?>" /></td>
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
									<td width="372"><input type="text" size="20" name="numcliente" autocomplete="off" value="<? echo $numcliente; ?>" /></td>
								</tr>
								<tr>
									<td><div id="etiqueta">
									  <label>Fecha de cumpleaños:</label></div></td>
									<td><select name="dia" size="1">
									<? for ($a=1;$a<=31;$a++)
										{
									?>
											<option value="<? echo $a; ?>" <? if ($dia==$a){ ?> selected="selected" <? } ?>><? echo $a; ?></option>
									<?
										}
									?>
									</select>
									<select name="mes" size="1">
									<? for ($a=1;$a<=12;$a++)
										{
									?>
											<option value="<? echo $a; ?>" <? if ($mes==$a){ ?> selected="selected" <? } ?>><? echo $a; ?></option>
									<?
										}
									?>
									</select>&nbsp;<input type="text" size="4" id="anio" name="anio" maxlength="4" value="<? echo $anio; ?>" /></td>
								</tr>
								<tr>
                                	<td colspan="2">&nbsp;</td>
                                </tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Telefono fijo:</div></td>
									<td width="372"><input type="text" size="20" name="tel" autocomplete="off" value="<? echo $tel; ?>" /></td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Telefono móvil:</div></td>
									<td width="372"><input type="text" size="20" name="telcel" autocomplete="off" value="<? echo $telmov; ?>" /></td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">&nbsp;</div></td>
									<td width="372">&nbsp;</td>
								</tr>
								<tr valign="top">
									<td width="101"><div id="etiqueta">Tipo de cliente:</div></td>
									<td width="372"><select name="tipoclie" size="1">
													<option value="particular" <? if ($tipoclie=="particular"){ ?> selected="selected" <? } ?>>Particular</option>
													<option value="empresa" <? if ($tipoclie=="empresa"){ ?> selected="selected" <? } ?>>Empresa</option>
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
                      <input type="submit" name="submit" value="Editar cliente" />
                    </div></td>
                </tr>
            </table>
			</form>
	</div>
    <? 
if ($mensaje!="")
{
	?>
	<script language="javascript">
        alert("<? echo $mensaje; ?>");
    </script>
	<?	
}
?>
</body>
</html>
<?
	}
}
?>