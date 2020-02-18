<?php

    class User_Profile_History {

        private $tuple = array('profilePK' => null, 'macroPK' => null, 'StartDate' => null, 'EndDate' => null);
        private $user_pk = null;
        private $nutrient_profile = null;
        private $custom_macros = null;

        public function __construct($history_data) {
            
            $this->user_pk = $history_data['userPK'];
            unset($history_data['userPK']);
            $this->tuple = array_replace($this->tuple, $history_data);
        }

        public static function insert_tuple($post_data) {

            return Database::insert_tuple_core($_table, $post_data);
        }

        public function delete_tuples() {
            
            return Database::delete_tuple_core('userprofilehistory', 'userPK', $this->user);
        }

        public static function select_by_date($post_data) {
            
            $date_conditions = null;
            $date_order = null;
            $replacements_data = array($post_data['userPK']);

            if(isset($post_data['start_date'])) {
                if(isset($post_data['end_date'])) {
                    $date_conditions = " AND `StartDate` >= ? AND `EndDate` <= ?";
                    array_push($replacements_data, $post_data['start_date'], $post_data['end_date']);
                }else {
                    $date_conditions = " AND `StartDate` >= ?";
                    array_push($replacements_data, $post_data['start_date']);
                }
            }elseif (isset($post_data['end_date'])) {
                $date_conditions = " AND `EndDate` <= ?";
                array_push($replacements_data, $post_data['end_date']);
            }elseif (isset($post_data['today'])) {
                $date_conditions = " AND `StartDate` >= ? AND `EndDate` IS NULL";
                array_push($replacements_data, $post_data['today']);
            }

            /*if(isset($post_data['sort'])) {
                if($post_data['ascend']){
                    $date_order = " ORDER BY `Date`";
                }else {
                    $date_order = " ORDER BY `Date` DESC";
                }
            }*/

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `userprofilehistory` WHERE `userPK` = ?" . $date_conditions;// . $date_order;
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($replacements_data)), ...array_values($replacements_data));
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        private static function fill_tuples($history_matrix) {
            
            $new_history = array();
            foreach ($history_matrix as $intakes) {
                array_push($this->intake, new Daily_Intake($intakes));
            }
        }
    }

    class User_Profile_History_List {

        private $list = array();
        private $user_pk = null;

        public function __construct($user_pk) {

            $this->user_pk = $user_pk;
        }
    }
?>