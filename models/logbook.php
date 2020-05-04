<?php

    include_once("food.php");

    class Logbook {
    
        public $intake_history = array();
        public $intake_today = array();
        private $user_pk = null;

        function __construct($user_pk) {

            $this->user_pk = $user_pk;
        }

        public static function select_range($start_date, $end_date, $order = 'ASC') {

            $result = Database::do_select("SELECT `intakePK`, `foodPK`, `Date`, `Weight` FROM `dailyintake` WHERE `Date` BETWEEN '$end_date' AND '$start_date' AND `userPK` = $this->user_pk ORDER BY `Date` $order");

            if ($result) {

                foreach($result as $row) {
                    $intake_history[] = new Entry($row);
                }
            } else {

                return false;
            }
        }
    }

    class Entry {

        public $data = array('intakePK' => null, 'foodPK' => null, 'Date' => null, 'Weight' => null);
        public $food_item = null;

        function __construct($entry_data) {

            $this->data = array_replace($this->data, $entry_data);
            $this->food_item = Food::get_one($entry_data['foodPK']);
        }

        public function insert() {

        }

        public function update() {

        }

        public function delete() {
            
        }
    }
?>