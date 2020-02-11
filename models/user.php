<?php
    class User {

        private $user_fields = array('userPK' => NULL,
                                    'Name' => NULL,
                                    'Kilojoules' => NULL,
                                    'Carbs' => NULL,
                                    'Protein' => NULL,
                                    'Sugar' => NULL,
                                    'Fat' => NULL,
                                    'Fiber' => NULL,
                                    'Salt' => NULL,
                                    'profilePK' => NULL );

        public function __construct($user) {
            foreach ($user as $field => $value) {
                $user_fields[$field] = $value;
            }
        }

        public static function select_user($user_pk) {
            $sql = "SELECT * FROM user WHERE id = ?";
			$stmt = prepared_query($conn, $sql, [$user_pk]);
            $user = $stmt->get_result()->fetch_assoc();
            return new User($user);
        }

        public static function insert_user($user) {
            Database::multiple_insert("user", $user);
        }

        public static function delete_user() {
            
        }

        public static function update_user() {

        }
    }
?>