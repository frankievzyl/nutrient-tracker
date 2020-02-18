<?php
    class User {

        public static $ui_fields = array('Firstname', 'Lastname', 'Email', 'Password', 'Icon', 'UseCalories');        
        private $tuple = array('userPK' => null, 'Firstname' => null, 'Lastname' => null, 'Email' => null, 'Password' => null, 'Icon' => null, 'UseCalories' => null);
        private $primary_key = null;
        private $profile_history_list = null;
        private $daily_intake_list = null; 

        public function __construct($user_data) {
            
            $this->tuple = array_replace($this->tuple, $user_data);
            $this->primary_key = $user_data['userPK'];
            $this->profile_history_list = new User_Profile_History_List($this->primary_key);
            $this->daily_intake_list = new Daily_Intake_List($user_pk);
             
        }

        public function get_pk () { return $this->primary_key; }

        public function get_tuple() { return $this->tuple; }

        public function get_profile_history() { return $this->profile_history; }

        public function get_daily_intake() { return $this->daily_intake; }

        public static function get_all() {

            return Database::get_all_core('user');
        }

        public static function insert_tuple($post_data) {

            return Database::insert_tuple_core('user', $post_data);
        }

        public function delete_tuple() {
            
            return Database::delete_tuple_core('user', 'userPK', $primary_key);
        }

        public function update_tuple($post_data) {
            
            if(Database::update_tuple_core('user', 'userPK', $primary_key, $post_data)) {
                $this->tuple = array_replace($this->tuple, $post_data);
                return true;
            }
            return false;
        }

        public static function get_by_pk($user_pk) {

            return Database::get_by_keys_core('user', 'userPK', $user_pk);
        }
    }
?>