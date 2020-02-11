<?php
	class Database {
		private static $instance = NULL;

		private function __construct() {}

		private function __clone() {}

		public static function getInstance() {

			$host = '127.0.0.1';
			$db   = 'nutrient_tracker';
			$user = 'root';
			$pass = '';
			$charset = 'utf8mb4';

			if (!isset(self::$instance)) {

				mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

				try {
					self::$instance = new mysqli($host, $user, $pass, $db);
					self::$instance->set_charset($charset);
				} catch (\mysqli_sql_exception $e) {
					throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
				}

				unset($host, $db, $user, $pass, $charset); // we don't need them anymore
			}
			return self::$instance;
		}
	}
?>
