<?php 
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('database.php');

class User {

	// public function find_all() {
	public static function find_all() {
		global $database;
		$result_set = $database->query("SELECT * FROM users");
		return $result_set;
	}

	// public function find_by_id($id = 0) {
	public static function find_by_id($id = 0) {
		global $database;
		$result_set = $database->query("SELECT * FROM users WHERE id={$id}");
		$found = $database->fetch_array($result_set);
		return $found;
	}

	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		return $result_set;
	}

}

?>