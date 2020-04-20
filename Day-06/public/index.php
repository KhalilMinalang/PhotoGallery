<?php
	require_once("../includes/database.php");

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
	echo $found_user['username'];
?>