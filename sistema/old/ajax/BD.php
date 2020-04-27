<?php

$bd=new BD();

class BD
{
	var $host="localhost";
	var $user="seguros_mundo";
	var $password="DontKnow$";
	var $database="seguros_gralco";
	var $conn;
	
	const ABIERTA=1;
	const CERRADA=0;

	var $status=CERRADA;

	public function open()
	{
		$this->conn = mysql_connect($this->host,$this->user,$this->password) or die (mysql_error());
		mysql_select_db($this->database, $this->conn) or die(mysql_error());
	}

	public function close()
	{
		mysql_close($this->conn);
	}

	public function ExecuteNonQuery($sql)
	{
		if ($this->status==BD::CERRADA)
			$this->open();
		$rs=mysql_query($sql, $this->conn);
		settype($rs,"null");
	}

	public function Execute($query)
	{
		if ($this->status==BD::CERRADA)
			$this->open();
		$rs=mysql_query($query,$this->conn);
		//$registros=array();
		while ($reg=mysql_fetch_array($rs))
			{
				$registros[]=$reg;
			}
		return $registros;
	}

	public function ExecuteRecord($tableName, $filter)
	{
		$todos=$this->Execute("SELECT * FROM $tableName WHERE $filter");
		return $todos[0];
	}

	public function ExecuteRecorde($tableName, $campos, $filter)
	{
		$todos=$this->Execute("SELECT $campos FROM $tableName WHERE $filter");
		return $todos[0];
	}

	public function ExecuteField($tableName,$field,$filter)
	{
		$todos=$this->Execute("SELECT $field FROM $tableName WHERE $filter");
		$aux=array();
		foreach ($todos as $uno)
		{
			$aux[]=$uno[0];
		}
		return $aux;
	}

	public function ExecuteTable($tableName, $orden="")
	{
		if ($orden!="")
			return $this->Execute("SELECT * FROM ".$tableName." ORDER BY ".$orden);
		else
			return $this->Execute("SELECT * FROM ".$tableName);
	}

	public function ExecuteScalar($query)
	{
		if ($this->status==BD::CERRADA)
			$this->open();
		$rs=mysql_query($query, $this->conn) or die(mysql_error());
		$reg=mysql_fetch_array($rs);
		return $reg[0];
	}

	public function RecordCount($tableName)
	{
		return $this->ExecuteScalar("SELECT COUNT(*) FROM ".$tableName);
	}
}
?>