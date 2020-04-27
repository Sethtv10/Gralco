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
<script type="text/javascript" src="../ajax/buscapol.js"></script>
<script type="text/javascript" src="../ajax/paypol.js"></script>
<link rel="stylesheet" href="../estilos/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="contenedor">
		<? include("../menu2.php"); ?>
	</div>	

<div id="contenido">
		<p>Reporte historial de poliza.</p>
			<form id="formRegistro">
			  <table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
			  <tr valign="top">
			    <td width="950"><table width="430" align="center" border="0" cellspacing="0" cellpadding="0">
			      <tr></tr>
			    </table>
			      <table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
			        <tr valign="top">
			          <td width="950"><table width="430" align="center" border="0" cellspacing="0" cellpadding="0">
			            <tr>
			              <td><div id="etiqueta">
			                <label>Poliza:</label>
			                </div></td>
			              <td><input type="text" name="txtpoliza" id="txtpoliza" autocomplete="off" size="55" />
            <div id="autopoliza" class="autocomplete" style="display:none"></div></td>
		                </tr>
			            <tr valign="top">
			              <td colspan="2">&nbsp;</td>
		                </tr>
			            <tr valign="top" align="center">
			              <td colspan="2" align="center"><input type="button" value="Consultar" onclick="buscapol('../ajax/rephistorial.php','showpol','poliza='+document.getElementById('txtpoliza').value,'POST');"/></td>
		                </tr>
			            </table></td>
		            </tr>
		          </table>
			      <table width="430" align="center" border="0" cellspacing="0" cellpadding="0">
	            </table></td>
			  </tr>
			  </table>
  </form>
			<br />
			<div id="showpol"></div>
	</div>
</body>
</html>