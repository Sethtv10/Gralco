<?php
include("config.php");
include("funciones.php");
include("secure.php");
/*$HOSTNAME = "localhost";//SERVIDOR
$USERNAME = "root";		//USUARIO
$PASSWORD = "root";		//CONTRASEÑA
$DATABASE = "gralco";

function conectar()
{
	global $HOSTNAME,$USERNAME,$PASSWORD,$DATABASE;
	$idcnx = mysql_connect($HOSTNAME, $USERNAME, $PASSWORD) or die(mysql_error());
	mysql_select_db($DATABASE, $idcnx);
	return $idcnx;
}
*/
$cnx=conectar();
$tableName="cliente";
$campos="direccion,colonia,cp,ciudad,estado,rfc";
if (isset($_POST['nombre']))
{
	$filter="nombre='".$_POST['nombre']."'";
	$sqlu="SELECT $campos FROM $tableName WHERE $filter LIMIT 1";
	$resu = mysql_query($sqlu) or die (mysql_error());
	if (mysql_num_rows($resu)>0)
	  {
		while(list($direccion,$colonia,$cp,$ciudad,$estado,$rfc) = mysql_fetch_array($resu))
			{
				echo $direccion."\nCol.".$colonia."\n".$ciudad." ".$estado." C.P.".$cp."\n".$rfc;
			}
	  }
	else
	{
		echo "No se encontro el cliente. \nFavor de verificar o dar de alta en la seccion clientes.";	
	}
}
?>