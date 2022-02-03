<?PHP
class jrad_mysql_agg extends jrad_mysql_crud
{
  final public function get_count ($column, $table = NULL)
  {
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT COUNT('.$column.') AS var FROM `'.$table.'`';
		$result = $this->query($sql_stmt,true);
		return (int)$result['var'];
  }		
  final public function get_sum ($column, $table = NULL)
  {
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT SUM('.$column.') AS var FROM `'.$table.'`';
		$result = $this->query($sql_stmt,true);
		return (int)$result['var'];
  }
  final public function get_avg ($column, $table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT AVG('.$column.') AS var FROM `'.$table.'`';
		$result = $this->query($sql_stmt,true);
		return (int)$result['var'];
  } 
  final public function get_min ($column, $table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT MIN('.$column.') AS var FROM `'.$table.'`';
		$result = $this->query($sql_stmt,true);
		return (int)$result['var'];
  } 	
  final public function get_max ($column, $table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT MAX('.$column.') AS var FROM `'.$table.'`';
		$result = $this->query($sql_stmt,true);
		return (int)$result['var'];
  }
  final public function get_num_rows ($table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT id FROM `'.$table.'`';
		$result = $this->query($sql_stmt);
    return is_null($result)? 0: count($result);
  } 
  final public function get_last_id ($table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT id FROM `'.$table.'` ORDER BY id DESC LIMIT 1';
		$result = $this->query($sql_stmt,true);
    return (int)$result['id'];
  }		
  final public function get_row ($id, $table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE id="'.$id.'"';
		return $this->query($sql_stmt,true);
  }	
  final public function get_column ($column, $table = NULL)
	{
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT '.$column.' FROM `'.$table.'` ORDER BY id ASC';
		$result = $this->query($sql_stmt);
		return is_array($result)? array_map(current,$result): NULL;
  }		
  final public function get_cell ($cell, $id, $table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT '.$cell.' FROM `'.$table.'` WHERE id="'.$id.'"';
		$result = $this->query($sql_stmt,true);
		return is_array($result)? current($result): NULL;
  }			
  final public function get_relation ($id, $relation, $table = NULL)
	{
		/*
			$prikey = 1;
			$relation = array('customer_id'=>'customers','product_id'=>'products');
			$table = 'orders';
		*/
		$table = $this->ini_table($table);
		$row = $this->get_row($id,$table);
		$outer[$table] = $row;
		foreach ($relation as $foreign_key => $foreign_table)
		{
			$foreign_id = $row[$foreign_key];
			$outer[$foreign_table] = $this->get_row($foreign_id,$foreign_table);
		}
		return $outer;
	}		
  final public function get_first ($table = NULL)	
  {
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY id ASC LIMIT 1';
		return $this->query($sql_stmt,true);
  }	
  final public function get_first_where ($field, $value, $table = NULL)	
  {
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.'="'.$this->esc_str($value).'" ORDER BY id ASC LIMIT 1';
		return $this->query($sql_stmt,true);
  }		
  final public function get_last ($table = NULL)	
  {
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY id DESC LIMIT 1';
		return $this->query($sql_stmt,true);
  }
  final public function get_last_where ($field, $value, $table = NULL)	
  {
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.'="'.$this->esc_str($value).'" ORDER BY id DESC LIMIT 1';
		return $this->query($sql_stmt,true);
  }	
  final public function get_nth ($n, $table = NULL)	
  {
		$offset = $n - 1;
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY id ASC LIMIT 1 OFFSET '.$offset;
		return $this->query($sql_stmt,true);
  }
  final public function get_nth_where ($n, $field, $value, $table = NULL)	
  {
		$offset = $n - 1;
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.'="'.$this->esc_str($value).'" ORDER BY id ASC LIMIT 1 OFFSET '.$offset;
		return $this->query($sql_stmt,true);
  }	
}

?>
