<?php 
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

class User {

	//  
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;


	// public function find_all() {
	// OLD
	// public static function find_all() {
	// 	global $database;
	// 	// $result_set = $database->query("SELECT * FROM users");
	// 	// we can also do:
	// 	// $result_set = User::find_by_sql("SELECT * FROM users");
	// 	// or:
	// 	$result_set = self::find_by_sql("SELECT * FROM users");

	// 	return $result_set;
	// }
	// NEW
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM users");
	}

	// public function find_by_id($id = 0) {
	// OLD
	// public static function find_by_id($id = 0) {
	// 	global $database;
	// 	// $result_set = $database->query("SELECT * FROM users WHERE id={$id}");
	// 	// we can also do:
	// 	// $result_set = User::find_by_sql("SELECT * FROM users WHERE id={$id}");
	// 	// or:
	// 	$result_set = self::find_by_sql("SELECT * FROM users WHERE id={$id}");

	// 	$found = $database->fetch_array($result_set);
	// 	return $found;
	// }
	// NEW
	public static function find_by_id($id = 0) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");

		return !empty($result_array) ? array_shift($result_array) : false;
	}


	// OLD
	// public static function find_by_sql($sql="") {
	// 	global $database;
	// 	$result_set = $database->query($sql);
	// 	return $result_set;
	// }
	// NEW
	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}

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

	// create an instance of user object
	private static function instantiate($record) {
		// Could check that $record exist and is an array
		$object = new self;
		// Simple, long-form approach:
		// $object->username 		= $record['username'];
		// $object->password 		= $record['password'];
		// $object->first_name 	= $record['first_name'];
		// $object->last_name 		= $record['last_name'];

		// More dynamic, short-form approach:
		foreach ($record as $attribute => $value) {
			if ($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}

	// 
	private function has_attribute($attribute) {
		// get_object_vars returns an associative array with all attributes
		// (incl. private ones!) as the keys and their current values as the values
		$object_vars = get_object_vars($this);
		// We don't care about the value, we just want to know if the key exists
		// Will return true or false
		return array_key_exists($attribute, $object_vars);
	}

}

?>