<?php
    class Daily_Intake {

        public $tuple = array('intakePK' => null, 'userPK'=> null, 'foodPK'=> null, 'Date'=> null, 'Weight' => null);
        public static $shown_fields = array('Date', 'Weight'); 

        public function __construct($intake_data) {
            $this->tuple = array_replace($this->tuple, $intake_data);           
        }

        public static function get_all() {

            return Database::get_all_core('dailyintake');
        }

        public static function get_by_pk($intake_pk) {

            return Database::get_by_pk_core('dailyintake', 'intakePK', $intake_pk);
        }

        //obsolete
        public static function select_tuple($post_data) {

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `dailyintake` WHERE `userPK` = ? AND `foodPK` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $food_pk);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        public static function select_tuples($post_data) {
            
            $food_in = NULL;
            $date_conditions = NULL;
            $date_order = NULL;
            $replacements_data = array($post_data['userPK']);
            
            if(isset($post_data['selected_foods'])) {
                if($keys = count($post_data['selected_foods']) > 1){
                    $food_in = " AND `foodPK` IN (" . str_repeat("?,", count($keys) - 1) . "?)";
                }else {
                    $food_in = " AND `foodPK` = ?";
                }
                array_push($replacements_data, $post_data['selected_foods']);
            }

            if(isset($post_data['start_date'])) {
                if(isset($post_data['end_date'])) {
                    $date_conditions = " AND `Date` BETWEEN ? AND ?";
                    array_push($replacements_data, $post_data['start_date'], $post_data['end_date']);
                }else {
                    $date_conditions = " AND `Date` >= ?";
                    array_push($replacements_data, $post_data['start_date']);
                }
            }elseif (isset($post_data['end_date'])) {
                $date_conditions = " AND `Date` <= ?";
                array_push($replacements_data, $post_data['end_date']);
            }elseif (isset($post_data['date'])) {
                $date_conditions = " AND `Date` = ?";
                array_push($replacements_data, $post_data['date']);
            }

            if(isset($post_data['sort'])) {
                if($post_data['ascend']){
                    $date_order = " ORDER BY `Date`";
                }else {
                    $date_order = " ORDER BY `Date` DESC";
                }
            }

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `dailyintake` WHERE `userPK` = ?" . $food_in . $date_conditions . $date_order;
            echo($sql);
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($replacements_data)), ...array_values($replacements_data));
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public static function insert_tuple($post_data) {

            $conn = Database::get_connection();
			$keys = array_keys($post_data);
			$keys = array_map(array('Database','escape_mysql_identifier'), $keys);
			$fields = implode(",", $keys);
			$placeholders = str_repeat('?,', count($keys) - 1) . '?';
			$sql = "INSERT INTO `dailyintake` ($fields) VALUES ($placeholders)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($post_data)), ...array_values($post_data));
            if($stmt->execute()) {
                return new Daily_Intake(self::get_by_pk($conn->insert_id));
            }
            return false;
        }

        public function delete_tuple() {
            
            return Database::delete_tuple_core('dailyintake', 'intakePK', $this->tuple['intakePK']);
        }

        public function update_tuple($post_data) {
            
            if(Database::update_tuple_core('dailyintake', 'intakePK', $this->tuple['intakePK'], $post_data)) {
                $this->tuple = array_replace($this->tuple, $post_data);
                return true;
            }
            return false;
        }
    }
?>