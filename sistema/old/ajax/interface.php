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
<style type="text/css">
@charset "utf-8";
/* CSS Document */
body{
	/*background:url(images/fondo.jpg);*/
	background-color:#666;
	text-align: center;
}
body * { text-align: left; }

#contenedor{	
	width:954px;
	margin: 0 auto;
}

#bordegris{
	background:#333 no-repeat;
	height:4px;
	clear:both;
}
#bordegrisizq{
	background:#333 no-repeat;
	width:4px;
	height:98px;
	float:right;
}
#bordegrisder{
	background:#333 no-repeat;
	width:4px;
	height:98px;
}
#banner{
	background-image:url(../images/banner.jpg);
	background-repeat:no-repeat;
	width:946px;
	height:98px;
	float:right;
}
#contenedorbanner{
	width:954px;
}
#menu{
	width:954px;
}
#bordegrisizqmenu{
	background:#333 no-repeat;
	width:4px;
	height:37px;
	float:right;
}
#bordegrisdermenu{
	background:#333 no-repeat;
	width:4px;
	height:37px;
}
#btnmenu{
	width:946px;
	height:37px;
	background:url(../images/menu.jpg) repeat-x;
	float:right;
}

/************  menu horizontal **************/

ul#submenus {
  margin: 10px;
  border: 0 none;
  padding: 0;
/*  width: 500px;*/ /*For KHTML*/
	width:760px;/*360*/
  list-style: none;
  height: 20px;
  /*border:1px solid #eee;*/
  padding-bottom:5px;
}
 
ul#submenus li {
  margin: 0;
  border: 0 none;
  padding: 0;
  float: left; /*For Gecko*/
  display: inline;
  list-style: none;
  position: relative;
  height: 20px;
}
ul#submenus li{
  padding-bottom:5px;
}
ul#submenus li:hover{
  background:#ddd;
}
 
ul#submenus  ul {
  margin: 0;
  border: 0 none;
  padding: 0;
  width: 160px;
  list-style: none;
  display: none;
  position: absolute;
  top: 25px;
  left: 10px;
  background: #eee;
  border: none;
  opacity: 0.8;
  -moz-opacity: 0.8;
  filter:alpha(opacity=80);
}
 
ul#submenus ul:after /*From IE 7 lack of compliance*/{
  clear: both;
  display: block;
  font: 1px/0px serif;
  content: ".";
  height: 0;
  visibility: hidden;
}
 
ul#submenus ul li {
  width: 160px;
  float: left; /*For IE 7 lack of compliance*/
  display: block !important;
  display: inline; /*For IE*/
}
 
/* Root Menu */
ul#submenus a {
  padding: 5px 15px 5px;
  float: none !important; /*For Opera*/
  float: left; /*For IE*/
  display: block;
  color: #FFF;
  text-decoration: none;
  font-weight: bold;
  font-family:Arial, Helvetica, sans-serif;
  font-size:12px;
  font-weight:bold;
/*  border-right:1px solid #818181;*/
  text-decoration: none;
  height: auto !important;
  height: 1%; /*For IE*/
}
 
/* Root Menu Hover Persistence */
ul#submenus a:hover,
ul#submenus li:hover a,
ul#submenus li.iehover a {
color: #003300;
 
}
 
/* 2nd Menu */
ul#submenus li:hover li a,
ul#submenus li.iehover li a {
  float: none;
  border:none;
}
 
/* 2nd Menu Hover Persistence */
ul#submenus li:hover li a:hover,
ul#submenus li:hover li:hover a,
ul#submenus li.iehover li a:hover,
ul#submenus li.iehover li.iehover a {
 background:#ddd;
  color: #003300;
}
 
/* 3rd Menu */
ul#submenus li:hover li:hover li a,
ul#submenus li.iehover li.iehover li a {
  background: #EEE;
  color: #666;
}
 
/* 3rd Menu Hover Persistence */
 
ul#submenus li:hover li:hover li a:hover,
ul#submenus li:hover li:hover li:hover a,
ul#submenus li.iehover li.iehover li a:hover,
ul#submenus li.iehover li.iehover li.iehover a {
background:#ddd;
  color: #FFF;
}
 
/* 4th Menu */
ul#submenus li:hover li:hover li:hover li a,
ul#submenus li.iehover li.iehover li.iehover li a {
background:#ddd;
  color: #666;
}
 
/* 4th Menu Hover */
ul#submenus li:hover li:hover li:hover li a:hover,
ul#submenus li.iehover li.iehover li.iehover li a:hover {
  background: #CCC;
  color: #FFF;
}
 
ul#submenus ul ul,
ul#submenus ul ul ul {
  display: none;
  position: absolute;
  top: 0;
  left: 160px;
}
 
/* Do Not Move – Must Come Before display:block for Gecko */
ul#submenus li:hover ul ul,
ul#submenus li:hover ul ul ul,
ul#submenus li.iehover ul ul,
ul#submenus li.iehover ul ul ul {
  display: none;
}
 
ul#submenus li:hover ul,
ul#submenus ul li:hover ul,
ul#submenus ul ul li:hover ul,
ul#submenus li.iehover ul,
ul#submenus ul li.iehover ul,
ul#submenus ul ul li.iehover ul {
  display: block;
}
ul#submenus .selected{
  color: #003300;
}

/********************* aqui termina el menu *****************************************/

#contenido{
	clear:both;
	width:954px;
	height:auto;
	margin: 15px auto;
	border:#333 solid 4px;
	background-color:#000;
}
#contenido p{
	text-align:center;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bold;
	color:#FFF;
}
#etiqueta{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	width:100px;
	color:#CCC;
	float:left;
}
#etiqueta2{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	width:100%;
	color:#CCC;
	float:none;
}
#datosclie{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#000;
	width:300px;
	height:80px;
	float:left;
}
#btn{
	clear:none;
	text-align: center;
}
input{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}

textarea{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	width:300px;
	height:80px;
	color:#000;
}
fieldset{
	padding:5px;
}

div.autocomplete
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:10px;
	clear:both;
	position:absolute;
	width:250px;
	background-color:white;
	border:1px solid #888;
	margin:0px;
	padding:0px;
}

div.autocomplete ul
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:10px;
	list-style-type:none;
	margin:0px;
	padding:0px;
}

div.autocomplete ul li.selected
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:10px;
	background-color:#ffb;
}

div.autocomplete ul li
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:10px;
	list-style-type:none;
	display:block;
	margin:0px;
	padding:2px;
	height:24px;
	cursor:pointer;
}

#derecha{
	width:50%;
	float:right;
}

#izquierda{
	width:50%;
	clear:both;
}

#inputs{
	float:right;
}
#contenidonew{
	clear:both;
	width:954px;
	height:auto;
	margin: 15px auto;
	border:#333 solid 4px;
	background-color:#000;
}
#contenidonew p{
	text-align:left;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bold;
	color:#FFF;
}
.blanco {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color: #FFF;
}
</style>
</head>
<body>
	<div id="contenedor">
		<div id="bordegris"></div>
		<div id="contenedorbanner">
			<div id="bordegrisizq"></div>
			<div id="banner"></div>
			<div id="bordegrisder"></div>
		</div>
        <div id="bordegris"></div>
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
