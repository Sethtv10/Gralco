<?php
function conectar()
{
	global $HOSTNAME,$USERNAME,$PASSWORD,$DATABASE;
	$idcnx = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
	return $idcnx;
}
?>