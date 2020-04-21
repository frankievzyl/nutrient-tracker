<?php
	class Database {
		private static $connection = null;

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

				unset($host, $db, $user, $pass, $charset);
			}
			return self::$connection;
		}

		public static function do_select($sql, $types = null, ...$values){

			self::get_connection();
			$stmt = self::$connection->prepare($sql);
			
			if($types && $values) {
				$stmt->bind_param($types, ...$values);
			}

            $stmt->execute();
			$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			if(count($result) == 0) {
				return false;
			}else {
				return $result;
			}
		}

		#doesn't work yet
		public static function get_last_inserted($table, $top = null, ...$fields) {

			$field_part = implode(",", array_map(self::escape_field(),$fields));

			if($top) {
				return do_select("SELECT $field_part FROM `$table` ORDER BY {$fields[0]} DESC LIMIT ?", "i", $top);
			}else {
				return do_select("SELECT MAX(`$fields`) FROM `$table`"); 
			}	
		}
		
		public static function escape_field($field){
			return "`".str_replace("`", "``", $field)."`";
		}

		public static function do_insert($table, $fields, $values) {

			$unique_fields = array();

			foreach ($fields as $f) {
				if (!in_array($f, $unique_fields)) {
					$unique_fields[] = $f;
				} else {
					break;
				}
			}

			self::get_connection();
			$fields_len = count($unique_fields);
			$values_len = count($values);
			$escaped = array_map('self::escape_field',$unique_fields);
			$escaped = implode(",",$escaped);
			$placeholders = "(" . str_repeat("?,", $fields_len - 1) . "?)";
			$sql = "INSERT INTO `$table` ($escaped) VALUES " . str_repeat($placeholders.",", $values_len / $fields_len - 1) . $placeholders;
            $stmt = self::$connection->prepare($sql);
            $stmt->bind_param(str_repeat("s", $values_len), ...$values);
			
			if($stmt->execute()) {
				return self::$connection->insert_id;
            }
            return false;
		}

		public static function do_delete($table, $where, $types, ...$where_values) {
			
			self::get_connection();
			$sql = "DELETE FROM `$table` WHERE " . $where;
            $stmt = self::$connection->prepare($sql);
            $stmt->bind_param($types, ...$where_values);
            return $stmt->execute();
		}
		
		public static function do_update($table, $post_data, $where = null, $types = "", ...$where_values) {
			
			self::get_connection();
			$changes = array();

            foreach ($post_data as $field => $value) {
                $changes[] = self::escape_field($field) . " = ?";
			}  

			$all_data = array_merge($post_data, $where_values);
			$sql = "UPDATE `$table` SET " . implode(",", $changes);
			
			if ($where) {
				$sql .= " WHERE $where"; 
			}

			$stmt = self::$connection->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($post_data)) . $types, ...array_values($all_data));
			return $stmt->execute();      
		}
	}
?>