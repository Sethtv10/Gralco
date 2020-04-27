<?php

$bd=new BD();

class BD
{
	var $host="localhost";
	var $user="u465395934_gralcosistem";
	var $password="gralcosistem_1";
	var $database="u465395934_gralcosistem";
	var $conn;
	
	const ABIERTA=1;
	const CERRADA=0;

	var $status=CERRADA;

	public function open()
	{
		$this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
	}

	public function close()
	{
		mysqli_close($this->conn);
	}

	public function ExecuteNonQuery($sql)
	{
		if ($this->status==BD::CERRADA)
			$this->open();
		$rs=mysqli_query($this->conn, $sql);
		settype($rs,"null");
	}

	public function Execute($query)
	{
		if ($this->status==BD::CERRADA)
			$this->open();
		$rs=mysqli_query($this->conn, $query);
		//$registros=array();
		while ($reg=mysqli_fetch_array($rs))
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
		$rs=mysqli_query($this->conn, $query);
		$reg=mysqli_fetch_array($rs);
		return $reg[0];
	}

	public function RecordCount($tableName)
	{
		return $this->ExecuteScalar("SELECT COUNT(*) FROM ".$tableName);
	}
}
?>