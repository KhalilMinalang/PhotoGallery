<?php 
// If it's going to need the database, then it's 
// probably smart to require it before we start.
// require_once('database.php');
require_once(LIB_PATH.DS.'database.php');

// class User {
class User extends DatabaseObject {
	
	//  
	protected static $table_name = 'users';
	//  
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;

	// 
	public function full_name() {
		// this is no longer working!! :(
		// if (isset($this->first_name && isset($this->last_name))) {
		// use this instead:
		if ($this->first_name !== null && $this->last_name !== null) {
			return $this->first_name . " " . $this->last_name;
		} else {
			return "";
		}
	}

	// 
	public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1;";
		$result_array = self::find_by_sql($sql);
		
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	// 
	public function save() {
		// A new record won't have an id yet.
		return isset($this->id) ? $this->update() : $this->create();
	}

	// 
	public function create() {
		
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$sql = "INSERT INTO users (";
		$sql .= "username, password, first_name, last_name";
		$sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->username) ."', '";
		$sql .= $database->escape_value($this->password) ."', '";
		$sql .= $database->escape_value($this->first_name) ."', '";
		$sql .= $database->escape_value($this->last_name) ."')";

		if ($database->query($sql)) {
			$this->id = $database->insert_id();
			return true;
		} else {
			return false;
		}
	}

	// 
	public function update() {
		
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$sql = "UPDATE users SET ";
		$sql .= "username='" . $database->escape_value($this->username) . "', ";
		$sql .= "password='" . $database->escape_value($this->password) . "', ";
		$sql .= "first_name='" . $database->escape_value($this->first_name) . "', ";
		$sql .= "last_name='" . $database->escape_value($this->last_name) . "' ";
		$sql .= "WHERE id='" . $database->escape_value($this->id) . "'";

		$database->query($sql);

		return ($database->affected_rows() == 1) ? true : false;
	}

	// 
	public function delete() {

		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
		$sql = "DELETE from users ";
		$sql .= " WHERE id =" . $database->escape_value($this->id);
		$sql .= " LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}

}

?>