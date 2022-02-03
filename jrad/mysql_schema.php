<?PHP
class jrad_mysql_schema extends jrad_mysql_connect
{
  final public function show_tables ()
	{
		$sql_stmt = 'SHOW TABLES IN `'.$this->database.'`';
		$result = $this->mysqli->query($sql_stmt);
		$this->log_err($this->mysqli);	
    if ($result->num_rows > 0)
    {
      $output = array();
      while ($row = $result->fetch_assoc()) 
        array_push($output,current($row));
      return $output;
		}
  }
	final public function show_fields ($table = NULL)
	{
		$assoc = $this->tb_struct($table);
		$output = array();
		foreach ($assoc as $row) 
			array_push($output,$row['Field']);
    return $output;
  }	
  final public function tb_size ($table = NULL) 
	{		
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT (DATA_LENGTH + INDEX_LENGTH) AS bytes 
		FROM information_schema.TABLES 
		WHERE TABLE_SCHEMA="'.$this->database.'" 
		AND TABLE_NAME="'.$table.'"';
		$result = $this->mysqli->query($sql_stmt);
		$count = '0';
		if ($result->num_rows > 0)
			$count = current($result->fetch_assoc());
		return (int)$count;
	}		
  final public function tb_struct ($table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SHOW FIELDS IN `'.$table.'`';
		$result = $this->mysqli->query($sql_stmt);		
		$this->log_err($this->mysqli);	
    if ($result->num_rows > 0)
    {
      $output = array();
      while ($row = $result->fetch_assoc()) 
        array_push($output,$row);
      return $output;
		}
  } 	
  final public function db_struct ()
	{
		$outer = $inner = array();
		foreach ($this->show_tables() as $table)	
		{
			$sql_stmt = 'SELECT * FROM `'.$table.'`';
			$result = $this->mysqli->query($sql_stmt);
			$this->log_err($this->mysqli);
			$count = $result->num_rows;
			$inner['Table'] = $table;
			$inner['Columns'] = count($this->show_fields($table));
			$inner['Rows'] = $count;
			$inner['Size'] = $this->tb_size($table);
			array_push($outer,$inner);
		}
		return $outer;
  } 	
  final public function create_table ($table, $struct = array())
	{	
		$struct = array_merge($struct, array (	
			'status INT(1) DEFAULT 0 NOT NULL',		
			'date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL',
			'id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT'
		));	
		$buffer = implode(', ',$struct);
		$sql_stmt = 'CREATE TABLE `'.$table.'` ('.$buffer.')';
		$result = $this->mysqli->query($sql_stmt);
    return $result === TRUE? true: $this->mysqli->error;
	}
  final public function trunc_table ($table)
	{	
		$sql_stmt = 'TRUNCATE TABLE `'.$table.'`';
		$result = $this->mysqli->query($sql_stmt);
    return $result === TRUE? true: $this->mysqli->error;
	}	
  final public function drop_table ($table)
	{	
		$sql_stmt = 'DROP TABLE `'.$table.'`';
		$result = $this->mysqli->query($sql_stmt);
    return $result === TRUE? true: $this->mysqli->error;
	}	
  final public function build_table ($map)
	{	
		// $map = array('table_name' => struct_array(),...);
		$report = array();
		foreach ($map as $table => $struct)
			$report[$table] = $this->create_table($table,$struct);
		return $report;
	}
  final public function delete_row ($id, $table = NULL)
	{
		$table = $this->ini_table($table);		
		$sql_stmt = 'DELETE FROM `'.$table.'` WHERE id="'.$id.'"';
		$result = $this->mysqli->query($sql_stmt);		
    return $result === TRUE? $this->mysqli->affected_rows: $this->mysqli->error;
  } 		
}

?>
