<?php
	// helper function
	function strip_zeros_from_date($marked_string="") {
		// remove the marked zeros
		$no_zeros = str_replace('*0', '', $marked_string);
		// remove any remaining marks
		$cleaned_string = str_replace('*', '', $no_zeros);
		return $cleaned_string;
	}

	// OLDER redirect_to
	/*function redirect_to($new_location) {
	    header("Location: " . $new_location); // uses a header() request. We can't send any white space before we make this call, unless we've output buffering turned on.
	    exit;
	}*/

	// NEWER redirect_to
	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

	// messages
	function output_message($message="") {
		if (!empty($message)) {
			return "<p class=\"message\">{$message}</p>";
		} else {
			return "";
		}
	}

	// using __autoload() function
	// IT'S DEPRICATED BTW!!
	function __autoload($class_name) {
		$class_name = strtolower($class_name);
		// $path = "../includes/{$class_name}.php";
		$path = LIB_PATH.DS."{$class_name}.php";
		if (file_exists($path)) {
			require_once($path);
		} else {
			die("The file {$class_name}.php could not be found.");
		}
	}

	// template helper function
	function include_layout_template($template='')
	{
		include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
	}

	//
	function log_action($action, $message="") {
		$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
		$new = file_exists($logfile) ? false : true;
		if ($handle = fopen($logfile, 'a')) { // append
			$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
			$content = "{$timestamp} | {$action}: {$message}\n";
			fwrite($handle, $content);
			fclose($handle);
			if($new) { chmod($logfile, 755); }
		} else {
			echo "Could not open file for writing.";
		}
		
	}

?>