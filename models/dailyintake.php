<?php
    class Daily_Intake {

        public $tuple = array();
        public static $shown_fields = array('Date', 'Weight'); 

        public function __construct($intake_data) {
            $this->tuple = $intake_data;            
        }

        public static function select_tuple($post_data) {

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `dailyintake` WHERE `userPK` = ? AND `foodPK` = ?";
			$stmt = prepared_query($conn, $sql, array_values($post_data));
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
			$stmt = prepared_query($conn, $sql, $replacements_data);
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public static function insert_tuple($post_data) {

            $conn = Database::get_connection();
			$keys = array_keys($post_data);
			$keys = array_map(array('Database','escape_mysql_identifier'), $keys);
			$fields = implode(",", $keys);
			$placeholders = str_repeat('?,', count($keys) - 1) . '?';
			$sql = "INSERT INTO `dailyintake` ($fields) VALUES ($placeholders)";
            prepared_query($conn, $sql, array_values($post_data));
        }

        public function delete_tuple() {
            
            $conn = Database::get_connection();
            $sql = "DELETE FROM `dailyintake` WHERE `userPK` = ? AND `foodPK`= ? AND `Date` = ? AND `Weight` = ?";
            prepared_query($conn, $sql, array_values($this->tuple));
        }

        public function update_tuple($post_data) {
            
            $conn = Database::get_connection();
            $sql = "UPDATE `dailyintake` SET `Date` = ?, `Weight` = ? WHERE `userPK` = ? AND `foodPK` = ?";
            prepared_query($conn, $sql, array($post_data['Date'], $post_data['Weight'], $this->tuple['userPK'], $this->tuple['foodPK']));
        }
    }
?>