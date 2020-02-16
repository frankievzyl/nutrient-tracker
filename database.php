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

		public static function escape_mysql_identifier($field){
			return "`".str_replace("`", "``", $field)."`";
		}

		public static function get_field_subset($table, $fields) {

			$fields = array_map(self::escape_mysql_identifier(), $fields);
			$fieldset = implode(",", $fields);
			$table = self::escape_mysql_identifier($table);
			self::get_connection();
			$sql = "SELECT $fieldset FROM $table";
			$result = self::$connection->query($sql);
			return $result->fetch_all(MYSQLI_ASSOC);
		}

		public static function get_by_pk_core($table, $field, $pk) {

			self::get_connection();
            $sql = "SELECT * FROM $table WHERE $field = ?";
			$stmt = self::$connection->prepare($sql);
            $stmt->bind_param("i", $pk);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
		}

		public static function get_all_core($table) {

            self::get_connection();
            $sql = "SELECT * FROM $table";
			$result = self::$connection->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
		}
		
		public static function delete_tuple_core($table, $pk_field, $pk) {
            
            self::get_connection();
            $sql = "DELETE FROM `$table` WHERE `$pk_field` = ?";
            $stmt = self::$connection->prepare($sql);
            $stmt->bind_param("i", $pk);
            return $stmt->execute();
		}
		
		public static function update_tuple_core($table, $pk_field, $pk, $post_data) {
            
            self::get_connection();
            $changes = array();

            foreach ($post_data as $field => $value) {
                $changes[] = self::escape_mysql_identifier($field) . " = ?";
            }

			array_push($post_data, $pk);
            $sql = "UPDATE `$table` SET " . implode(",", $changes) . " WHERE `$pk_field` = ?";
            $stmt = self::$connection->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($post_data)), ...array_values($post_data));
			return $stmt->execute();         
		}
		
		//up to here works

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
	}
?>
