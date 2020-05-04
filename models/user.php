<?php
    class User {
       
        public $data = array('userPK' => null, 'FirstName' => null, 'LastName' => null, 'Email' => null, 'Password' => null, 'Icon' => null, 'UseCalories' => null);
        public $customMacros = array('macroPK' => null, 'Calories'=> null, 'Protein'=> null, 'Carbohydrates'=> null, 'Sugar'=> null, 'Fat'=> null, 'Fiber'=> null, 'Sodium'=> null);
        public $nutrientProfile = array('profilePK' => null, 'Name'=> null,  'Calories'=> null,  'Water'=> null,  'Protein'=> null,  'Tryptophan'=> null,  'Threonine'=> null,  'Isoleucine'=> null,  'Leucine'=> null,  'Lysine'=> null,  'Methionine_Cystine'=> null,  'Phenylalanine_Tyrosine'=> null,  'Valine'=> null,  'Histidine'=> null,  'Carbohydrates'=> null,  'Fiber'=> null,  'Omega_3'=> null,  'Omega_6'=> null,  'Vit_A'=> null,  'Vit_C'=> null,  'Vit_D'=> null,  'Vit_E'=> null,  'Vit_K'=> null,  'Thiamin'=> null,  'Riboflavin'=> null,  'Niacin'=> null,  'Vit_B6'=> null,  'Folate'=> null,  'Vit_B12'=> null,  'Pantothenic_Acid'=> null,  'Choline'=> null,  'Calcium'=> null,  'Iron'=> null,  'Magnesium'=> null,  'Phosphorus'=> null,  'Potassium'=> null,  'Sodium'=> null,  'Zinc'=> null,  'Copper'=> null,  'Manganese'=> null,  'Selenium'=> null,  'Fluoride' => null);
        public static $users = array();

        public function __construct($user_data) {
            
            $this->data = array_replace($this->data, $user_data);
            $this->get_custom_macros();
            $this->get_nutrient_profile();     
        }

        public static function get_one($user_pk) {

            $result = Database::do_select("SELECT * FROM `user` WHERE `userPK` = ?", "i", $user_pk);
            
            if ($result) {
                
                return new User($result[0]);
            } else {
                
                return false;
            }
        }

        public static function get_all() {
            
            $result = Database::do_select("SELECT * FROM `user`");
            #$result = Database::do_select("SELECT * FROM `user` WHERE `userPK` != ?", "i", 1);
        
            if ($result) {

                foreach($result as $row) {
                    self::$users[] = new User($row);
                }

                return self::$users;
            } else {

                return false;
            }
        }
    
        public static function insert($post_data) {
    
            if ($new_user_pk = Database::do_insert('user', array_keys($post_data), array_values($post_data))) {

                $new_user_data = Database::do_select("SELECT * FROM `user` WHERE `userPK` = ?", "i", $new_user_pk);
                $new_user = new User($new_user_data);
                self::$users[] = $new_user;
                return $new_user;
            }

            return false;
        }
    
        public function update($post_data) {
            
            if( Database::do_update('user', $post_data, "`userPK` = ?", "i", $this->data['userPK'])) {
                $this->data = array_replace($this->data, $post_data);
                return true;
            }
            return false;
        }

        public function delete() {
            
            $consensus = Database::do_delete('user', "`userPK` = ?", "i", $this->data['userPK']);
            $consensus = Database::do_delete('custommacros', "`macroPK` = ?", "i", $this->customMacros['macroPK']);
            $consensus = Database::do_delete('dailyintake', "`userPK` = ?", "i", $this->data['userPK']);
            $consensus = Database::do_delete('userprofilehistory', "`userPK` = ?", "i", $this->data['userPK']);
            
            return $consensus;
        }

        private function get_custom_macros() {

            $result = Database::do_select("SELECT * FROM `custommacros` WHERE `macroPK` = (SELECT `macroPK` FROM `userprofilehistory` WHERE `userPK` = ? AND `EndDate` IS NULL)", "i", $this->data['userPK']);
            
            if ($result) {
                
                $this->customMacros = array_replace($this->customMacros, $result[0]);
            }
        }

        public function create_custom_macros($post_data) {

            if (!$this->customMacros['macroPK']) {

                if ($new_macro_pk = Database::do_insert('custommacros', array_keys($post_data), array_values($post_data))) {

                    $new_user_data = Database::do_update('userprofilehistory', array('macroPK', $new_macro_pk), "`userPK` = ? AND `EndDate` IS NULL", "i", $this->data['userPK']);
                }
            } else {

                update_custom_macros($post_data);
            }

            get_custom_macros();
        }

        public function update_custom_macros($post_data) {

            if ($new_macro_pk = Database::do_insert('custommacros', array_keys($post_data), array_values($post_data))) {

                Database::do_update('userprofilehistory', array('EndDate' => date('Y-m-d H:i:s')), "`userPK` = ? AND `EndDate` IS NULL", "i", $this->data['userPK']);
                Database::do_insert('userprofilehistory', array('userPK', 'profilePK', 'macroPK'), array($this->data['userPK'], $new_macro_pk, $this->nutrientProfile['profilePK']));
            }

            get_custom_macros($post_data);
        }

        private function get_nutrient_profile() {
            
            $result = Database::do_select("SELECT * FROM `nutrientprofile` WHERE `profilePK` = (SELECT `profilePK` FROM `userprofilehistory` WHERE `userPK` = ? AND `EndDate` IS NULL)", "i", $this->data['userPK']);
            
            if ($result) {
                
                $this->nutrientProfile = array_replace($this->nutrientProfile, $result[0]);
            }
        }

        public function set_nutrient_profile($post_data) {

            if($post_data['profilePK'] != $this->nutrientProfile['profilePK']) {

                Database::do_update('userprofilehistory', array('EndDate' => date('Y-m-d H:i:s')), "`userPK` = ? AND `EndDate` IS NULL", "i", $this->data['userPK']);
                Database::do_insert('userprofilehistory', array('userPK', 'profilePK', 'macroPK'), array($this->data['userPK'], $post_data['profilePK'], $this->customMacros['macroPK']));
                get_nutrient_profile();
            }
        }
    }
?>