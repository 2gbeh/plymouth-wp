<?PHP
class jrad_mysql_crud extends jrad_mysql_schema
{
  final public function insert ($post)
  {
		$keys = array_keys($post); // get fields
		$field_set = implode(', ',$keys);
    $values = array_values($post); // get records
    $record_set = '';
    foreach ($values as $v)
      $record_set .= '"'.$this->esc_str($v).'", ';
		$record_set = rtrim($record_set,', ');
    // execute sql command
    $sql_stmt = 'INSERT INTO `'.$this->table.'` ('.$field_set.') VALUES ('.$record_set.')';
    $result = $this->mysqli->query($sql_stmt);
		$this->log_err($this->mysqli);		
    if ($result === TRUE)
		{
			$_POST = NULL;
      $insert_id = $this->mysqli->insert_id;
			return $insert_id;
		}
  }  
  final public function select ($field = NULL, $value = NULL)
  {
		$WHERE = is_null($field)? '': 'WHERE '.$field.'="'.$this->esc_str($value).'"';
		$sql_stmt = 'SELECT * FROM `'.$this->table.'` '.$WHERE.' ORDER BY id ASC';
		$result = $this->mysqli->query($sql_stmt);
		$this->log_err($this->mysqli);	
    if ($result->num_rows > 0)
    {
      $array = array();
      while ($row = $result->fetch_assoc()) 
        array_push($array,$row);
      return $array;
    }
  }	
  final public function update ($post, $field, $value)
	{		
    $buffer = '';
    foreach ($post as $k => $v)  // prepare set clause
      $buffer .= $k.'="'.$this->esc_str($v).'", ';
    $buffer = rtrim($buffer,', ');
    // execute sql command
    $sql_stmt = 'UPDATE `'.$this->table.'` SET '.$buffer.' WHERE '.$field.'="'.$this->esc_str($value).'"';
    $result = $this->mysqli->query($sql_stmt); 
		$this->log_err($this->mysqli);
    if ($result === TRUE) 
      return $this->mysqli->affected_rows;	
  }
  final public function delete ($field, $value)
	{		
	  $sql_stmt = 'DELETE FROM `'.$this->table.'` WHERE '.$field.'="'.$this->esc_str($value).'"';
    $result = $this->mysqli->query($sql_stmt);
		$this->log_err($this->mysqli);
    if ($result === TRUE) 
      return $this->mysqli->affected_rows;	
  }
	final public function query ($sql_stmt, $strict = FALSE)
	{
		$query_type = substr($sql_stmt,0,6);
		$result = $this->mysqli->query($sql_stmt);
		$this->log_err($this->mysqli);
		if ($query_type == 'SELECT') // READ
		{
			if ($result->num_rows > 0)
			{
				$array = array();
				while ($row = $result->fetch_assoc()) 
					array_push($array,$row);
				$output = ($strict === TRUE && count($array) == 1)? current($array): $array;
				return $output;
			}
		}
		else
		{ 
			if ($result === TRUE)
			{
				if ($query_type == 'INSERT') // CREATE
					return $this->mysqli->insert_id;
				else
					return $this->mysqli->affected_rows; // UPADTE & DELETE
			}
		}	
	}	
  final public function seed ($map) 
	{	
		// $map = array('table_name' => row_array(),...);
		$report = array();
		foreach ($map as $table => $rows)
		{
			$this->set_table($table);
			foreach ($rows as $post)
				$report[$table][] = $this->insert($post);
		}
		return $report;
	}			
}

?>