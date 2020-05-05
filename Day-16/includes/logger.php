<?php
class Logger {
	private static $log_file = 'log.txt';
	private static $file_handle;
	private static $end_of_file = 0;

	private static function check_logs_directory() {
		chdir('..');

		if (!is_dir(SITE_ROOT.DS.'logs')) {
			mkdir('logs', 0777);
			chmod('logs', 0777);
			chown('logs', 'www');
		}

		chdir(SITE_ROOT.DS.'logs');
	}

	private static function check_file_exists() {
		return file_exists(self::$log_file);
	}

	private static function check_logs_file_write() {

		self::check_logs_directory();

		if (!self::check_file_exists()) {
			fopen(self::$log_file, 'w');
		}

		if (!is_writable(self::$log_file)) {
			die('logfile is not writable');
		}
	}

	private static function check_logs_file_read() {

		self::check_logs_directory();

		if (!self::check_file_exists()) {
			die('logfile does not exist.');
		}

		if (!is_readable(self::$log_file)) {
			die('logfile is not readable.');
		}

	}

	private static function close_file() {
		fclose(self::$file_handle);
	}

	public static function log_action($action, $message="") {
		self::check_logs_file_write();

		self::$file_handle = fopen(self::$log_file, 'a');
		
		$dt = time();
		$mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);
		$content = "{$mysql_datetime} | {$action}: {$message}\n";
		
		fwrite(self::$file_handle, $content);
		
		self::close_file();
	}

	public static function log_read() {
		self::check_logs_file_read();

		$content = file_get_contents(self::$log_file);

		return $content;
	}

	public static function log_clear($username) {
		self::check_logs_directory();
		file_put_contents(self::$log_file, '');
		
		$message = "{$username} cleared the logfile.";
		self::log_action('Clear Log', $message);
	}


}

// $logger = new Logger();

?>