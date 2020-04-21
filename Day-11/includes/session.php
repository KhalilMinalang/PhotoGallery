<?php
// A class to help work with Session
// In our case, primarily to manage logging users in and out

// Keep in mind when working with session that it is generally 
// inadvisable to store DB-related objects in sessions

class Session {

	private $logged_in = false;
	public $user_id;

	function __construct() {
		session_start();
		$this->check_login();
		if ($this->logged_in) {
			// actions to take right away if user is logged in
		} else {
			// actions to take right away if user is NOT logged in
		}
	}

	// a public way for us to find out wether the session succeeded or not
	public public is_logged_in() {
		return $this->logged_in;
	}

	// if someone logged in from a wabpage
	public function login($user) {
		// database should find user based on username/password
		if ($user) {
			$this->user_id = $_SESSION['user_id'] = $user_id;
			$this->logged_in = true;
		}
	}

	public function logout() {
		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->logged_in = false;
	}

	private function check_login() {
		if (isset($_SESSION['user_id'])) {
			$this->user_id = $_SESSION['user_id'];
			$this->logged_in = true;
		} else {
			unset($this->user_id);
			$this->logged_in = false;
		}
		
	}
}

$session = new Session();

?>