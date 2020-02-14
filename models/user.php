<?php
    class User {

        public $tuple = array('userPK'=> null, 'Name'=> null, 'Kilojoules'=> null, 'Carbs'=> null, 'Protein'=> null, 'Sugar'=> null, 'Fat'=> null, 'Fiber'=> null, 'Salt'=> null, 'profilePK' => null);
        public static $shown_fields = array('Name','Kilojoules','Carbs','Protein','Sugar','Fat','Fiber','Salt','profilePK');
        private $profile = NULL;
        private $intake = array(); 

        public function __construct($user_data) {
            
            $this->tuple = array_replace($this->tuple, $user_data);
            $this->profile = new Nutrient_Profile(Nutrient_Profile::get_by_pk($user_data['profilePK']));
            $all_intakes = Daily_Intake::select_tuples(array('userPK' => $this->tuple['userPK']));
            foreach ($all_intakes as $intakes) {
                array_push($this->intake, new Daily_Intake($intakes));
            }
        }

        public static function get_all() {

            return Database::get_all_core('user');
        }

        public static function insert_tuple($post_data) {

            $conn = Database::get_connection();
			$keys = array_keys($post_data);
			$keys = array_map(array('Database','escape_mysql_identifier'), $keys);
			$fields = implode(",", $keys);
			$placeholders = str_repeat('?,', count($keys) - 1) . '?';
			$sql = "INSERT INTO `user` ($fields) VALUES ($placeholders)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($post_data)), ...array_values($post_data));
            if($stmt->execute()) {
                return new User(self::get_by_pk($conn->insert_id));
            }
            return false;
        }

        public function delete_tuple() {
            
            return Database::delete_tuple_core('user', 'userPK', $this->tuple['userPK']);
        }

        public function update_tuple($post_data) {
            
            if(Database::update_tuple_core('dailyintake', 'intakePK', $this->tuple['intakePK'], $post_data)) {
                $this->tuple = array_replace($this->tuple, $post_data);
                return true;
            }
            return false;
        }

        public static function get_by_pk($user_pk) {

            return Database::get_by_pk_core('user', 'userPK', $user_pk);
        }
    }
?>