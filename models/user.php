<?php
    class User {

        public $tuple = array();
        public static $shown_fields = array('Name','Kilojoules','Carbs','Protein','Sugar','Fat','Fiber','Salt','profilePK');
        private $profile = NULL;
        private $intake = NULL; 

        public function __construct($user_pk) {
            
            $conn = Database::get_connection();
            $sql = "SELECT * FROM `user` WHERE `userPK` = " . $user_pk;
			$result = $conn->query($sql);
            $this->$tuple = $result->fetch_assoc();
            /*perhaps this will work, but then shown_fields must become non-static
            $shown_fields = array_slice(array_keys($tuple), 1);*/
            $this->$profile = new Nutrient_Profile($this->$tuple[`profilePK`]);
        }

        public static function get_all_keys() {

            $conn = Database::get_connection();
            $sql = "SELECT `userPK` FROM `user`";
			$result = $conn->query($sql);
            return array_values($result->fetch_all(MYSQLI_ASSOC));
        }

        public static function insert_tuple($post_data) {

            $conn = Database::get_connection();
			$keys = array_keys($post_data);
			$keys = array_map(array('Database','escape_mysql_identifier'), $keys);
			$fields = implode(",", $keys);
			$placeholders = str_repeat('?,', count($keys) - 1) . '?';
			$sql = "INSERT INTO `user` ($fields) VALUES ($placeholders)";
            prepared_query($conn, $sql, array_values($post_data));
            return new User($conn->insert_id);
        }

        public function delete_tuple() {
            
            $conn = Database::get_connection();
            $sql = "DELETE FROM `user` WHERE `userPK` = ?";
            prepared_query($conn, $sql, $this->$tuple[`userPK`]);
        }

        public function update_tuple($post_data) {
            
            $conn = Database::get_connection();
            $changes = array();

            foreach ($post_data as $field => $value) {
                $changes[] = Database::escape_mysql_identifier($field) . " = ?";
            }

            $sql = "UPDATE `user` SET " . implode(",", $changes) . " WHERE `userPK` = ?";
            prepared_query($conn, $sql, $this->$tuple[`userPK`]);
        }
    }
?>