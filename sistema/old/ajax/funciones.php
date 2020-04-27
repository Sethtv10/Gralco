<?
function conectar()
{
	global $HOSTNAME,$USERNAME,$PASSWORD,$DATABASE;
	$idcnx = mysql_connect($HOSTNAME, $USERNAME, $PASSWORD) or die(mysql_error());
	mysql_select_db($DATABASE, $idcnx);
	return $idcnx;
}
?>