<?PHP
class jrad_mysql_dql extends jrad_mysql_agg
{
	final public function sel_like ($field, $keyword, $table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.' LIKE "%'.$this->esc_str($keyword).'%" ORDER BY id ASC';
		return $this->query($sql_stmt);
	}		
	final public function sel_not_like ($field, $keyword, $table = NULL)
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.' NOT LIKE "%'.$this->esc_str($keyword).'%" ORDER BY id ASC';
		return $this->query($sql_stmt);
	}	
	final public function sel_in ($field, $in_array, $table = NULL)
	{
		$in_csv = '';
		foreach ($in_array as $e) 
			$in_csv .= '"'.$e.'", ';
		$in_csv = rtrim($in_csv,', ');
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.' IN ('.$in_csv.')';
		return $this->query($sql_stmt);
	}		
	final public function sel_not_in ($field, $in_array, $table = NULL)
	{
		$in_csv = '';
		foreach ($in_array as $e) 
			$in_csv .= '"'.$e.'", ';
		$in_csv = rtrim($in_csv,', ');		
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.' NOT IN ('.$in_csv.')';
		return $this->query($sql_stmt);
	}		
	final public function sel_null ($field, $table = NULL)
	{
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.' IS NULL';
		return $this->query($sql_stmt);
	}
	public function sel_not_null ($field, $table = NULL)
	{
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.' IS NOT NULL';
		return $this->query($sql_stmt);
	}	
  final public function sel_limit ($limit = 25, $table = NULL)
  {
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY id ASC LIMIT '.$limit;
		return $this->query($sql_stmt);
  }		
  final public function sel_offset ($offset, $limit = 25, $table = NULL)
  {
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY id ASC LIMIT '.$limit.' OFFSET '.$offset;
		return $this->query($sql_stmt);
  }		
  final public function sel_top ($num_rows = 5, $table = NULL)
  {		
		$table = $this->ini_table($table);	
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY id ASC LIMIT '.$num_rows;
		return $this->query($sql_stmt);
  }	
  final public function sel_top_percent ($perc = 10, $table = NULL)
  {		
		$table = $this->ini_table($table);		
		$count = $this->get_num_rows($table);
		$limit = ceil(($perc * $count) / 100);
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY id ASC LIMIT '.$limit;
		return $this->query($sql_stmt);
  }		
  final public function sel_bottom ($num_rows = 5, $table = NULL)
  {		
		$table = $this->ini_table($table);	
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY id DESC LIMIT '.$num_rows;
		return $this->query($sql_stmt);
  }		
  final public function sel_random ($num_rows = 1, $table = NULL)
  {
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT * FROM `'.$table.'` ORDER BY RAND() LIMIT '.$num_rows;		
		return $this->query($sql_stmt,true);
  }	
  final public function sel_recent ($table = NULL)
  {
		$table = $this->ini_table($table);
		$last_row = $this->get_last($table);
		$date_arr = explode(' ',$last_row['date']);
		return $this->sel_where_date($date_arr[0],$table);
  }	
	final public function sel_page ($sql_stmt, $page = 1, $per_page = 25) 
	{
		$table = $this->ini_table($table);
		$i = is_null($page) || $page < 1? 1: $page;
		$offset = ($i * $per_page) - $per_page;
		$sql_stmt .= ' LIMIT '.$per_page.' OFFSET '.$offset;
		return $this->query($sql_stmt);		
	}				
  final public function sel_where ($field, $value, $table = NULL)
	{
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE '.$field.'="'.$this->esc_str($value).'" ORDER BY id ASC';
		return $this->query($sql_stmt);
  } 	
  final public function sel_where_status ($status, $table = NULL)
	{
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE status="'.$status.'"';
		return $this->query($sql_stmt);
  } 
  final public function sel_where_date ($date = NULL, $table = NULL)
	{
		$now = is_null($date)? date('Y-m-d'): $date;
		$table = $this->ini_table($table);		
		$sql_stmt = 'SELECT * FROM `'.$table.'` WHERE DATE(date)>="'.$now.'" ORDER BY id ASC';
		return $this->query($sql_stmt);
  } 
  final public function sel_distinct_keys ($field, $table = NULL) 
	{
		$table = $this->ini_table($table);
		$sql_stmt = 'SELECT DISTINCT '.$field.' FROM `'.$table.'` ORDER BY id ASC';
		$result = $this->query($sql_stmt);
		return is_array($result)? array_map(current,$result): NULL;		
	}		
  final public function sel_distinct_rows ($field, $table = NULL) 
	{
		$keys = $this->sel_distinct_keys($field,$table);
		$outer = $inner = array();
		foreach ($keys as $value)
		{
			$inner = $this->sel_where($field,$value,$table);
			array_push($outer,$inner);
		}
		return $outer;
	}					
		
}
?>
