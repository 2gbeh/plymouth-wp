<?PHP
abstract class jrad_mysql_connect
{
	protected $database, $table;
  public $mysqli, $error;
	function __construct ($database, $username, $password)
	{
		$this->database = $database;
    $this->mysqli = new MySQLi('localhost',$username,$password,$database);
    if ($this->mysqli->connect_error) 
      die($this->mysqli->connect_error);
  }		
	function __destruct ()
	{
    $this->mysqli->close();
  }
  final public function get_table () 
	{
		return $this->table;
	}
  final public function set_table ($table) 
	{
		$this->table = $table;
	}	
  final public function ini_table ($table = NULL) 
	{
		if (is_null($table))
			return $this->table;
		else
			return $table;
//			return $this->table = $table;
	}	
	final public function log_err ($mysqli = NULL)
	{
		if (is_null($mysqli))
			return $this->error;
		else 
			$this->error = $mysqli->error;
	}
  final public function esc_str ($str)
	{
		return $this->mysqli->real_escape_string($str);
	}	  	
}

?>
