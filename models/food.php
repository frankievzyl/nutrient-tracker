<?php
    class Food {
 
        public $data = array('foodPK' => null, 'Type' => null, 'Name' => null, 'Calories' => null, 'Water' => null, 'Protein' => null, 'Tryptophan' => null, 'Threonine' => null, 'Isoleucine' => null, 'Leucine' => null, 'Lysine' => null, 'Methionine' => null, 'Cystine' => null, 'Phenylalanine' => null, 'Tyrosine' => null, 'Valine' => null, 'Arginine' => null, 'Histidine' => null, 'Alanine' => null, 'Aspartic_Acid' => null, 'Glutamic_Acid' => null, 'Glycine' => null, 'Proline' => null, 'Serine' => null, 'Hydroxyproline' => null, 'Carbohydrates' => null, 'Fiber' => null, 'Starch' => null, 'Sugar' => null, 'Sucrose' => null, 'Glucose' => null, 'Fructose' => null, 'Maltose' => null, 'Galactose' => null, 'Fat' => null, 'Saturated_Fat' => null, 'Monounsaturated_Fat' => null, 'Polyunsaturated_Fat' => null, 'Omega_3' => null, 'Omega_6' => null, 'Vit_A' => null, 'Alpha_Carotene' => null, 'Beta_Carotene' => null, 'Beta_Cryptoxanthin' => null, 'Lycopene' => null, 'Lutein_Zeaxanthin' => null, 'Vit_C' => null, 'Vit_D' => null, 'Vit_E' => null, 'Beta_Tocopherol' => null, 'Gamma_Tocopherol' => null, 'Delta_Tocopherol' => null, 'Vit_K' => null, 'Thiamin' => null, 'Riboflavin' => null, 'Niacin' => null, 'Vit_B6' => null, 'Folate' => null, 'Food_Folate' => null, 'Folic_Acid' => null, 'Dietary_Folate' => null, 'Vit_B12' => null, 'Pantothenic_Acid' => null, 'Choline' => null, 'Betaine' => null, 'Calcium' => null, 'Iron' => null, 'Magnesium' => null, 'Phosphorus' => null, 'Potassium' => null, 'Sodium' => null, 'Zinc' => null, 'Copper' => null, 'Manganese' => null, 'Selenium' => null, 'Fluoride' => null, 'Alcohol' => null, 'Caffeine' => null);

        public function __construct($food_data) {
            
            $this->data = array_replace($this->data, $food_data);
        }

        private static function make($db_data) {

            $food = array();

            if ($db_data) {

                foreach($db_data as $food_data) {

                    $food[] = new Food($food_data);
                }

                return $food;

            } else {

                return null;
            }
        }

        public static function get_one($food_pk) {
        
            return self::make(Database::do_select("SELECT * FROM `food` WHERE `foodPK` = $food_pk"));
        }

        public static function get_all() {
        
            return self::make(Database::do_select("SELECT * FROM `food` ORDER BY `Type`, `Name`"));
        }

        public static function get_food_like($search_text) {

            return self::make(Database::do_select("SELECT * FROM `food` WHERE `Name` LIKE '%$search_text%' ORDER BY `Name`"));
        }

        public static function get_all_types() {

            return Database::do_select("SELECT DISTINCT `Type` FROM `food` ORDER BY `Type`");
        }
        
        public static function get_type($type) {

            return self::make(Database::do_select("SELECT * FROM `food` WHERE `Type` = '$type' ORDER BY `Name`"));
        }

        public static function sorted_by_nutrients($post_data) {
            
            $sorting_pieces = array();

            foreach ($post_data as $field => $direction) {
                $sorting_pieces[] = $field . " ". $direction;
            }

            $sorting_order = implode(",", $sorting_pieces);

            return self::make(Database::do_select("SELECT * FROM `food` ORDER BY " . $sorting_order));
        }
    }
?>