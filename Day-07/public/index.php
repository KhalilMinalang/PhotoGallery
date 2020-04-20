<?php
	require_once("../includes/database.php");
	require_once("../includes/user.php");

	// test if database.php is working
	if (isset($database)) { echo 'true'; } else { echo 'false'; }
	echo "<br />";

	// echo "Is this working?";
	echo $database->escape_value("Is's working?<br />");

	// $sql = "INSERT INTO users (id, username, password, first_name, last_name) ";
	// $sql .= "VALUES (1, 'kskoglund', 'secretpwd', 'Kevin', 'Skoglund')";

	// $sql .= ", VALUES (2, 'khalilminalang', 'secretpwd', 'Khalil', 'Minalang')";

	// $result = $database->query($sql);

	$sql = "SELECT * FROM users WHERE id=1";
	$result = $database->query($sql);
	$found_user = $db->fetch_array($result);

	echo "<hr />";

	/* The difference of class method is that static sticks around even when we don't have an instance!! */

	// using instance
	// $User = new User();
	// $found_user = $User->find_by_id(1);
	// echo $found_user['username'];

	// using 'static'
	$found_user = User::find_by_id(1);
	echo $found_user['username'];

	echo "<hr />";

	$user_set = User::find_all();
	while ($user = $database->fetch_array($user_set)) {
		echo "User: " . $user['username'] . "<br />";
		echo "Name: " . $user['first_name'] . " ". $user['last_name'] . "<br /><br />";
	}

?>