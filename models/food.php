<?php
    class Food {

        public $tuple = array();
        public static $shown_fields = array('Type', 'Name', 'Calories', 'Water', 'Protein', 'Tryptophan', 'Threonine', 'Isoleucine', 'Leucine', 'Lysine', 'Methionine', 'Cystine', 'Phenylalanine', 'Tyrosine', 'Valine', 'Arginine', 'Histidine', 'Alanine', 'Aspartic_Acid', 'Glutamic_Acid', 'Glycine', 'Proline', 'Serine', 'Hydroxyproline', 'Carbohydrates', 'Fiber', 'Starch', 'Sugar', 'Sucrose', 'Glucose', 'Fructose', 'Maltose', 'Galactose', 'Fat', 'Saturated_Fat', 'Monounsaturated_Fat', 'Polyunsaturated_Fat', 'Omega_3', 'Omega_6', 'Vit_A', 'Alpha_Carotene', 'Beta_Carotene', 'Beta_Cryptoxanthin', 'Lycopene', 'Lutein_Zeaxanthin', 'Vit_C', 'Vit_D', 'Vit_E', 'Beta_Tocopherol', 'Gamma_Tocopherol', 'Delta_Tocopherol', 'Vit_K', 'Thiamin', 'Riboflavin', 'Niacin', 'Vit_B6', 'Folate', 'Food_Folate', 'Folic_Acid', 'Dietary_Folate', 'Vit_B12', 'Pantothenic_Acid', 'Choline', 'Betaine', 'Calcium', 'Iron', 'Magnesium', 'Phosphorus', 'Potassium', 'Sodium', 'Zinc', 'Copper', 'Manganese', 'Selenium', 'Fluoride', 'Alcohol', 'Caffeine'); 

        public function __construct($food_pk) { //works

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `food` WHERE `foodPK` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $food_pk);
            $stmt->execute();
            $this->tuple = $stmt->get_result()->fetch_assoc();
            //lines 11 - 14 to be used as new prepared statements
        }

        public static function get_all() {//works

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `food` ORDER BY `name`";
			$result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public static function get_food_like($search_text) { //works

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `food` WHERE `name` LIKE '%$search_text%' ORDER BY `name`";
			$result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);

        }

        public static function sorted_by_nutrients($post_data) {//works
            
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

        public static function get_food_by_type($types) { //works
            $conn = Database::get_connection();
            $sql = "SELECT * FROM `food` WHERE `type` IN (" . str_repeat("?,", count($types) -1) . "?) ORDER BY `type`, `name`";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($types)), ...$types);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        }
    }
?>