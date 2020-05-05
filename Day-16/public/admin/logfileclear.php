<?php
	require_once("../../includes/initialize.php");

	if (!$session->is_logged_in()) { redirect_to('login.php'); }

	if ($_GET['clear'] == 'true') {
		$user = User::find_by_id($_SESSION['user_id']);
		Logger::log_clear($user->username);
		redirect_to('logfile.php');
	} else {
		redirect_to('logfile.php');
	}
?>