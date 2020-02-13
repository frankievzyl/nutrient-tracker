<?php
    class Food {

        public $tuple = array();
        public static $shown_fields = array('Type', 'Name', 'Calories', 'Water', 'Protein', 'Tryptophan', 'Threonine', 'Isoleucine', 'Leucine', 'Lysine', 'Methionine', 'Cystine', 'Phenylalanine', 'Tyrosine', 'Valine', 'Arginine', 'Histidine', 'Alanine', 'Aspartic_Acid', 'Glutamic_Acid', 'Glycine', 'Proline', 'Serine', 'Hydroxyproline', 'Carbohydrates', 'Fiber', 'Starch', 'Sugar', 'Sucrose', 'Glucose', 'Fructose', 'Maltose', 'Galactose', 'Fat', 'Saturated_Fat', 'Monounsaturated_Fat', 'Polyunsaturated_Fat', 'Omega_3', 'Omega_6', 'Vit_A', 'Alpha_Carotene', 'Beta_Carotene', 'Beta_Cryptoxanthin', 'Lycopene', 'Lutein_Zeaxanthin', 'Vit_C', 'Vit_D', 'Vit_E', 'Beta_Tocopherol', 'Gamma_Tocopherol', 'Delta_Tocopherol', 'Vit_K', 'Thiamin', 'Riboflavin', 'Niacin', 'Vit_B6', 'Folate', 'Food_Folate', 'Folic_Acid', 'Dietary_Folate', 'Vit_B12', 'Pantothenic_Acid', 'Choline', 'Betaine', 'Calcium', 'Iron', 'Magnesium', 'Phosphorus', 'Potassium', 'Sodium', 'Zinc', 'Copper', 'Manganese', 'Selenium', 'Fluoride', 'Alcohol', 'Caffeine'); 

        public function __construct($food_pk) {

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `food` WHERE `foodPK` = ?";
            $stmt = prepared_query($conn, $sql, $food_pk);
            $this->$tuple = $stmt->get_result()->fetch_assoc();
        }
}
?>