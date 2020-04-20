<?php
	require_once("config.php");

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
		public function open_connection() {

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

		public function close_function() {
			if(isset($this->connection)) {
				mysqli_close($this->connection);
				unset($this->connection);
			}
		}


	}

	// create an instance
	$database = new MySQLDatabase();

	// calls the function
	// $database->open_connection();

	// with this, $db can be use as a 'reference' to the $database variable, so that you can use either one.
	$db =& $database;

?>