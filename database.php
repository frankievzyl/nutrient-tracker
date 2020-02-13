<?php
	class Database {
		private static $connection = NULL;

		private function __construct() {}

		private function __clone() {}

		public static function get_connection() {

			$host = '127.0.0.1';
			$db   = 'nutrient_tracker';
			$user = 'root';
			$pass = '';
			$charset = 'utf8mb4';

			if (!isset(self::$connection)) {

				mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

				try {
					self::$connection = new mysqli($host, $user, $pass, $db);
					self::$connection->set_charset($charset);
				} catch (\mysqli_sql_exception $e) {
					throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
				}

				unset($host, $db, $user, $pass, $charset); // we don't need them anymore
			}
			return self::$connection;
		}

		private static function escape_mysql_identifier($field){
			return "`".str_replace("`", "``", $field)."`";
		}

		//only to be used if users, not admins, are going to add foods. 
		/*public static function multiple_insert($table, $data) {
			self::get_connection();
			$keys = array_keys($data);
			$keys = array_map('escape_mysql_identifier', $keys);
			$fields = implode(",", $keys);
			$table = escape_mysql_identifier($table);
			$placeholders = str_repeat('?,', count($keys) - 1) . '?';
			$sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
			prepared_query(self::$connection, $sql, array_values($data));
		}	*/	

		/* MAYBE NOT USE THIS, KEEP FOR NOW
		public static function exec_prepared_statement($table, $data, $type, ...$conditions) {

			self::get_connection();
			$keys = array_keys($data);
			$keys = array_map('escape_mysql_identifier', $keys);
			$fields = implode(",", $keys);
			$table = escape_mysql_identifier($table);
			$placeholders = str_repeat('?,', count($keys) - 1) . '?';
			
			switch ($type) {
				case 'insert':
					$sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
					break;
				case 'update':
					
					$changes = array();
					$checks = array();

					foreach ($data as $field => $value) {
						$changes[] = escape_mysql_identifier($field) . " = ?";
					}
					
					foreach ($conditions as $field => $condition) {
						$checks[] = escape_mysql_identifier($field) . " " . $condition;
					}
					$sql = "UPDATE $table SET " . implode(",", $changes) . " WHERE " . implode(",");

					
				break;
				case 'delete':
					$sql = "DELETE FROM $table WHERE $fields = $placeholders";
					break;
				default:
					# code...
					break;
			}

			prepared_query(self::$connection, $sql, array_values($data));
		}*/
		
	}
?>
