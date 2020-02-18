<?php

    class Custom_Macros {

        public static $ui_fields = array('Calories', 'Protein', 'Carbohydrates', 'Sugar', 'Fat', 'Fiber', 'Sodium');
        private $tuple = array('macroPK' => null, 'Calories'=> null, 'Protein'=> null, 'Carbohydrates'=> null, 'Sugar'=> null, 'Fat'=> null, 'Fiber'=> null, 'Sodium'=> null);
        private $primary_key = null;

        public function __construct($macro_pk) {
            
            if($data = get_by_pk($macro_pk)) {
                $this->tuple = array_replace($this->tuple, $data);
                $this->primary_key = $macro_pk;
            }
        }

        public function get_pk () { return $this->primary_key; }

        public function get_tuple() { return $this->tuple; }

        public static function insert_tuple($post_data) {

            return Database::insert_tuple_core('custommacros', $post_data);
        }

        public function delete_tuple() {
            
            return Database::delete_tuple_core('custommacros', array('macroPK' => $this->primary_key));
        }

        public static function get_by_pk($macro_pk) {

            return Database::get_by_keys_core('custommacros', array('macroPK' => $macro_pk));
        } 
    }
?>