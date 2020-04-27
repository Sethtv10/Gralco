<?
$documentLocation = $_SERVER['PHP_SELF'];
if ( $_SERVER['QUERY_STRING'] ) {
  $documentLocation .= "?" . $_SERVER['QUERY_STRING'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gralco</title>
<SCRIPT LANGUAGE="JavaScript">
<!--
function checkData() {
  var f1 = document.forms[0];
  var wm = "Ocurrieron los siguientes Errores :\n\r\n";
  var noerror = 1;
  var t1 = f1.usuario_digitado;
  if (t1.value == "" || t1.value == " ") {
    wm += "Digite su nombre de Usuario\r\n";
    noerror = 0;
  }
  var t1 = f1.clave_digitada;
  if (t1.value == "" || t1.value == " ") {
    wm += "Digite la contraseña\r\n";
    noerror = 0;
  }
  if (noerror == 0) {
    alert(wm);
    return false;
  }
  else return true;
}
//-->

</SCRIPT>
	<link rel="stylesheet" href="estilos/style.css" type="text/css" media="screen" />
</head>
<body>
	<div id="contenedor">
		<? include("menu.php"); ?>
	</div>
	<div id="contenido">
		<form id="FORM_LOGIN" name="form1" action="<?PHP echo $documentLocation?>" onSubmit="return checkData()" METHOD="post">
            <table cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
            	<td align="center">
                <font color="#FFFFFF">usuario</font><br />
                <input name="usuario_digitado" id="usuario_digitado" size="30" maxlength="30" value="" type="text" />
                <br />
                <font color="#FFFFFF">contrase&ntilde;a</font><br />
                <input name="clave_digitada" id="clave_digitada" size="30" maxlength="30" value="" type="password"><br /><br />
                <input type="submit" value="Ingresar" class="boton"><br />
                <font color="#FFFFFF"><? echo $message; ?></font>
              	</td>
             </tr>
           </table>
        </form>
	</div>
</body>
</html>
