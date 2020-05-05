<?php 
	// Define the core paths
	// Define them as absolution paths to make sure that require_once works as expected

	// DIRECTORY_SEPARATOR is a PHP pre-defined constant
	// (/ for Windows, / for Unix)
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

	// file system path
	defined('SITE_ROOT') ? null : 
		define('SITE_ROOT', 't:'.DS.'xampp'.DS.'htdocs'.DS.'lynda.php'.DS.'photo_gallary'.DS.'Day-17'); // /t/xampp/htdocs/lynda.php/photo_gallary/Day-15

	defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
	// echo LIB_PATH;
	// var_dump(LIB_PATH);

	// load config file first
	require_once(LIB_PATH.DS."config.php");

	// load basic function next so that everything after cas use them
	require_once(LIB_PATH.DS."functions.php");

	// load core objects
	require_once(LIB_PATH.DS."session.php");
	require_once(LIB_PATH.DS."database.php");
	require_once(LIB_PATH.DS."database_object.php");

	// load database-related classes
	require_once(LIB_PATH.DS."user.php");
?>
