<?
include("../ajax/config.php");
include("../ajax/funciones.php");
include("../ajax/secure.php");	
if(!isset($_POST['mundo']))
{
	header("LOCATION: ../index.php");
	exit;
}
$cnx=conectar();
$sQuery="DELETE FROM autos WHERE idpol='".$_POST['mundo']."'";
mysql_query($sQuery);

$opti="OPTIMIZE TABLE `autos`";
mysql_query($opti);
$sQuery="DELETE FROM camiones WHERE idpol='".$_POST['mundo']."'";
mysql_query($sQuery);

$opti="OPTIMIZE TABLE `camiones`";
mysql_query($opti);
$sQuery="DELETE FROM danios WHERE idpol='".$_POST['mundo']."'";
mysql_query($sQuery);

$opti="OPTIMIZE TABLE `danios`";
mysql_query($opti);
$sQuery="DELETE FROM gm WHERE idpol='".$_POST['mundo']."'";
mysql_query($sQuery);

$opti="OPTIMIZE TABLE `gm`";
mysql_query($opti);
$sQuery="DELETE FROM poliza WHERE id='".$_POST['mundo']."'";
mysql_query($sQuery);

$opti="OPTIMIZE TABLE `poliza`";
mysql_query($opti);

$sQuery="DELETE FROM vida WHERE idpol='".$_POST['mundo']."'";
mysql_query($sQuery);

$opti="OPTIMIZE TABLE `vida`";
mysql_query($opti);
$sQuery="DELETE FROM recibos WHERE numpol='".$_POST['mundo']."'";
mysql_query($sQuery);

$opti="OPTIMIZE TABLE `recibos`";
mysql_query($opti);
$camposbit="usuario,accion,poliza,fecha,hora";
$valorbit = "'".$_SESSION['usera']."','Elimino poliza','".$_POST['poliza']."/".$_POST['mundo']."','".date("j")."/".date("n")."/".date("Y")."','".date("g:i a")."'";
$sqlbit = "INSERT INTO bitacora ($camposbit) VALUES ($valorbit)";
$resbit = mysql_query($sqlbit) or die (mysql_error());

header("LOCATION: ../mensaje.php?mensaje=Se elimino la poliza");
exit;
?>