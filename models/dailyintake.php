<?php
    class Daily_Intake {
        
        private $tuple = array('Weight' => null);
        private $primary_key = array('userPK'=> null, 'foodPK'=> null, 'Date'=> null);

        public function __construct($ufd) {
            
            $this->tuple = array_replace($this->tuple, $ufd['Weight']);
            unset($ufd['Weight']);
            $this->primary_key = array_replace($this->primary_key, $ufd);
        }

        public function get_tuple() { return $this->tuple; }

        public function get_pk () { return $this->primary_key; }

        public static function select_tuples($post_data) {
            
            $date_conditions = null;
            $date_order = null;
            $replacements_data = array($post_data['userPK']);

            if(isset($post_data['start_date'])) {
                if(isset($post_data['end_date'])) {
                    $date_conditions = " AND `Date` BETWEEN ? AND ?";
                    array_push($replacements_data, $post_data['start_date'], $post_data['end_date']);
                }else {
                    $date_conditions = " AND `Date` <= ?";
                    array_push($replacements_data, $post_data['start_date']);
                }
            }elseif (isset($post_data['end_date'])) {
                $date_conditions = " AND `Date` >= ?";
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
            $sql = "SELECT * FROM `dailyintake` WHERE `userPK` = ?" . $date_conditions . $date_order;
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($replacements_data)), ...array_values($replacements_data));
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public static function insert_tuple($post_data) {

            return Database::insert_tuple_core('dailyintake', $post_data);
        }

        public function delete_tuple() {
            
            return Database::delete_tuple_core('dailyintake', $primary_key);
        }

        public function update_tuple($post_data) {
            
            if(Database::update_tuple_core('dailyintake', $primary_key , $post_data)) {
                $this->tuple = array_replace($this->tuple, $post_data);
                return true;
            }
            return false;
        }
    }

    class Daily_Intake_List {

        private $list = array();
        private $user_pk = null;
        private $today = null;

        public function __construct($user_pk, $date) {

            $this->user_pk = $user_pk;
            $this->today = $date;
            $intake_for_today = Database::get_by_keys_core(`dailyintake`, array('userPK' => $user_pk, 'Date' => $date));

            foreach ($intake_for_today as $food_item) {
                $list[] = new Daily_Intake($food_item);
            }
        }
    }
?>