<?php
	// require_once("config.php");
	require_once(LIB_PATH.DS."config.php");

	// my SQL-specific function
	class MySQLDatabase {

		// we won't be able access $connection through the open_connection() , so we're gonna add a private attribute.
		private $connection;

		// constructor
		function __construct() {
			// automatically calls open_connection upon creation of instance
			$this->open_connection();
		}

		//function open_connection() {
		// make it 'public' if you wanna call it from outside the class
		public function open_connection() 
		{
			// 1. Create a dabase connection
			$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

			// Test if connection occurred.
			if(mysqli_connect_errno()) {
			    die("Database connection failed: " .
			        mysqli_connect_error() .
			        " (" . mysqli_connect_errno() . ")"
			    );
			}
		}

		public function close_connection() 
		{
			if(isset($this->connection)) {
				mysqli_close($this->connection);
				unset($this->connection);
			}
		}

		public function query($sql) 
		{
			$result = mysqli_query($this->connection, $sql);
			
			// remove this
			// if (!$result) {
			// 	die("Database query failed");
			// }
			// and call this instead
			// var_dump($result);
			$this->confirm_query($result);

			// because we moved our code from being proceedural into being an OOP function, we need to make sure that we return a value
			return $result;
		}

		private function confirm_query($result_set) 
		{
		    if (!$result_set) {
		        die("Database query failed.");
		    }
		}

		// public function mysql_prep($string) 
		// renamed to
		public function escape_value($string) 
		{
		    // global $connection;
		    $escaped_string = mysqli_real_escape_string($this->connection, $string);
		    return $escaped_string;
		}

		// "database neutral" functions
		// renamed
		public function fetch_array($result_set) 
		{
			return mysqli_fetch_array($result_set);
		}

		public function num_rows($result_set)
		{
			return mysqli_num_rows($result_set);
		}

		public function insert_id()
		{
			// get the last id inserted over the current db connection
			return mysqli_insert_id($this->connection);
		}

		public function affected_rows()
		{
			return mysqli_affected_rows($this->connection);
		}

	}

	// create an instance
	$database = new MySQLDatabase();

	// calls the function
	// $database->open_connection();

	// with this, $db can be use as a 'reference' to the $database variable, so that you can use either one.
	$db =& $database;

?>