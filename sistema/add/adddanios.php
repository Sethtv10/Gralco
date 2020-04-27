<?php  
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");
$mensaje="";

$permisos=strstr($_SESSION['perm'], 'agregar');
$zonas=strstr($_SESSION['zonas'], 'polizas');
if (($permisos!="") && ($zonas!=""))
{


if (isset($_POST['submit']))
 {
	$campos="numpoliza,tipopoliza,contratante,datos,deldia,delmes,delanio,aldia,almes,alanio,expdia,expmes,expanio,compania,moneda,formapago,primaneta,gastoexp,pagofracc,derpol,iva,importetotal,agente,subagente,polizaant,status,motivo,comsub,diasub,messub,aniosub,notacredito";
	$valor = "'".$_POST['poliza']."','".$_POST['tipopol']."','".$_POST['txtNombre']."','".$_POST['datosclie']."','".$_POST['vigdeldia']."','".$_POST['vigdelmes']."','".$_POST['vigdelanio']."','".$_POST['vigaldia']."','".$_POST['vigalmes']."','".$_POST['vigalanio']."','".$_POST['fechaexpdia']."','".$_POST['fechaexpmes']."','".$_POST['fechaexpanio']."','".$_POST['compania']."','".$_POST['moneda']."','".$_POST['formapago']."','".$_POST['primaneta']."','".$_POST['gastoexp']."','".$_POST['recargo']."','".$_POST['derechopol']."','".$_POST['iva']."','".$_POST['importe']."','".$_POST['agente']."','".$_POST['subagente']."','0','D','','','','','','".$_POST['nota']."'";
	$cnx=conectar();
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
	/*********** variables en comuna ****************************/ 
	$monto=$_POST['subsecuente'];
	$mes=$_POST['vigdelmes'];
	$anio=$_POST['vigdelanio'];
	/********** fin variables ******************************/
	if ($_POST['formapago']==12)
	 {	
		$valorrecibo="'".$ultimoid."','1','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$_POST['mensualidad']."'";
		$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
		$res3 = mysql_query($sql3) or die (mysql_error());
		for ($a=2;$a<=12;$a++)
		  {
			  $mes++;
			if ($mes==13)
              {
				$mes=1;
				$anio++;
			  }
				
			$valorrecibo="'".$ultimoid."','".$a."','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$monto."'";
			$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
			$res3 = mysql_query($sql3) or die (mysql_error());
			
		  }
	 }
	if ($_POST['formapago']==3)
	 {
		$valorrecibo="'".$ultimoid."','1','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$_POST['mensualidad']."'";
		$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
		$res3 = mysql_query($sql3) or die (mysql_error());
		for ($a=2;$a<=4;$a++)
		  {
			  $mes=$mes+3;
			if ($mes>12)
              {
				$mes=$mes-12;
				$anio++;
			  }
				
			$valorrecibo="'".$ultimoid."','".$a."','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$monto."'";
			$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
			$res3 = mysql_query($sql3) or die (mysql_error());
			
		  }
	 }
	if ($_POST['formapago']==6)
	 {
		$valorrecibo="'".$ultimoid."','1','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$_POST['mensualidad']."'";
		$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
		$res3 = mysql_query($sql3) or die (mysql_error());
		for ($a=2;$a<=2;$a++)
		  {
			  $mes=$mes+6;
			if ($mes>12)
              {
				$mes=$mes-12;
				$anio++;
			  }
				
			$valorrecibo="'".$ultimoid."','".$a."','".$_POST['vigdeldia']."','".$mes."','".$anio."','','','','D','".$monto."'";
			$sql3 = "INSERT INTO recibos ($camprecibo) VALUES ($valorrecibo)";
			$res3 = mysql_query($sql3) or die (mysql_error());
		  }
	 }
	 $camposbit="usuario,accion,poliza,fecha,hora";
	 $valorbit = "'".$_SESSION['usera']."','Agrego poliza daños','".$_POST['poliza']."/".$ultimoid."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
	 $sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
	 $resbit = mysql_query($sqlbit) or die (mysql_error());
	mysql_close($cnx);
	$mensaje="Se agrego con éxito la póliza";
 }
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
		<?php  include("../menu2.php"); ?>
	</div>
	<div id="contenido">
		<p><?php  echo $mensaje; ?></p>
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