<?
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");
$cnx=conectar();
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
		<p>Nueva circular</p>
			<form id="formRegistro" action="../add/addcircular.php" method="post" enctype="multipart/form-data">
			<table width="950" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top">
                	<td width="17"></td>
					<td width="138"><font color="#FFFFFF">Fecha de la circular:</font></td>
      <td width="306"><select name="mes" size="1" tabindex="4">
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
									</select>&nbsp;<input type="text" size="6" id="anio" name="anio" maxlength="4" tabindex="5" /></td>
                    <td width="15"></td>
                    <td width="77"><font color="#FFFFFF">A</font><font color="#FFFFFF">rchivo:</font></td>
                    <td width="397"><input type="file" name="archivo" size="29" tabindex="8"/></td>
                </tr>
                <tr>
                	<td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                	<td colspan="6" align="center" valign="middle"><div id="btn"><input type="submit" name="submit" value="Guardar" /></div></td>
                </tr>
            </table>
			</form>
	</div>
</body>
</html>