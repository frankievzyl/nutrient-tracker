<?php
    class Food {

        public $tuple = array('foodPK' => null, 'Type' => null, 'Name' => null, 'Calories' => null, 'Water' => null, 'Protein' => null, 'Tryptophan' => null, 'Threonine' => null, 'Isoleucine' => null, 'Leucine' => null, 'Lysine' => null, 'Methionine' => null, 'Cystine' => null, 'Phenylalanine' => null, 'Tyrosine' => null, 'Valine' => null, 'Arginine' => null, 'Histidine' => null, 'Alanine' => null, 'Aspartic_Acid' => null, 'Glutamic_Acid' => null, 'Glycine' => null, 'Proline' => null, 'Serine' => null, 'Hydroxyproline' => null, 'Carbohydrates' => null, 'Fiber' => null, 'Starch' => null, 'Sugar' => null, 'Sucrose' => null, 'Glucose' => null, 'Fructose' => null, 'Maltose' => null, 'Galactose' => null, 'Fat' => null, 'Saturated_Fat' => null, 'Monounsaturated_Fat' => null, 'Polyunsaturated_Fat' => null, 'Omega_3' => null, 'Omega_6' => null, 'Vit_A' => null, 'Alpha_Carotene' => null, 'Beta_Carotene' => null, 'Beta_Cryptoxanthin' => null, 'Lycopene' => null, 'Lutein_Zeaxanthin' => null, 'Vit_C' => null, 'Vit_D' => null, 'Vit_E' => null, 'Beta_Tocopherol' => null, 'Gamma_Tocopherol' => null, 'Delta_Tocopherol' => null, 'Vit_K' => null, 'Thiamin' => null, 'Riboflavin' => null, 'Niacin' => null, 'Vit_B6' => null, 'Folate' => null, 'Food_Folate' => null, 'Folic_Acid' => null, 'Dietary_Folate' => null, 'Vit_B12' => null, 'Pantothenic_Acid' => null, 'Choline' => null, 'Betaine' => null, 'Calcium' => null, 'Iron' => null, 'Magnesium' => null, 'Phosphorus' => null, 'Potassium' => null, 'Sodium' => null, 'Zinc' => null, 'Copper' => null, 'Manganese' => null, 'Selenium' => null, 'Fluoride' => null, 'Alcohol' => null, 'Caffeine' => null);
        public static $shown_fields = array('Type', 'Name', 'Calories', 'Water', 'Protein', 'Tryptophan', 'Threonine', 'Isoleucine', 'Leucine', 'Lysine', 'Methionine', 'Cystine', 'Phenylalanine', 'Tyrosine', 'Valine', 'Arginine', 'Histidine', 'Alanine', 'Aspartic_Acid', 'Glutamic_Acid', 'Glycine', 'Proline', 'Serine', 'Hydroxyproline', 'Carbohydrates', 'Fiber', 'Starch', 'Sugar', 'Sucrose', 'Glucose', 'Fructose', 'Maltose', 'Galactose', 'Fat', 'Saturated_Fat', 'Monounsaturated_Fat', 'Polyunsaturated_Fat', 'Omega_3', 'Omega_6', 'Vit_A', 'Alpha_Carotene', 'Beta_Carotene', 'Beta_Cryptoxanthin', 'Lycopene', 'Lutein_Zeaxanthin', 'Vit_C', 'Vit_D', 'Vit_E', 'Beta_Tocopherol', 'Gamma_Tocopherol', 'Delta_Tocopherol', 'Vit_K', 'Thiamin', 'Riboflavin', 'Niacin', 'Vit_B6', 'Folate', 'Food_Folate', 'Folic_Acid', 'Dietary_Folate', 'Vit_B12', 'Pantothenic_Acid', 'Choline', 'Betaine', 'Calcium', 'Iron', 'Magnesium', 'Phosphorus', 'Potassium', 'Sodium', 'Zinc', 'Copper', 'Manganese', 'Selenium', 'Fluoride', 'Alcohol', 'Caffeine'); 

        public function __construct($food_data) {

            $this->tuple = array_replace($this->tuple, $food_data);
        }

        public static function get_all() {

            return Database::get_all_core('food');
        }

        public static function get_food_like($search_text) {

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `food` WHERE `name` LIKE '%$search_text%' ORDER BY `name`";
			$result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);

        }

        public static function sorted_by_nutrients($post_data) {
            
            $sorting_pieces = array();

            foreach ($post_data as $field => $direction) {
                $sorting_pieces[] = $field . " ". $direction;
            }

            $sorting_order = implode(",", $sorting_pieces);

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `food` ORDER BY " . $sorting_order;
			$result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public static function get_food_by_type($types) {

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `food` WHERE `type` IN (" . str_repeat("?,", count($types) -1) . "?) ORDER BY `type`, `name`";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($types)), ...$types);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public static function get_by_pk($food_pk) {

            return Database::get_by_pk_core('food', 'foodPK', $food_pk);
        }

        //everything up to here works
    }
?>