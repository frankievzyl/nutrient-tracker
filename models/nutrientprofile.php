<?php
    class Nutrient_Profile {

        public $tuple = array();
        public static $shown_fields = array('Name', 'Calories', 'Water', 'Protein', 'Tryptophan', 'Threonine', 'Isoleucine', 'Leucine', 'Lysine', 'Methionine_Cystine', 'Phenylalanine_Tyrosine', 'Valine', 'Histidine', 'Carbohydrates', 'Fiber', 'Omega_3', 'Omega_6', 'Vit_A', 'Vit_C', 'Vit_D', 'Vit_E', 'Vit_K', 'Thiamin', 'Riboflavin', 'Niacin', 'Vit_B6', 'Folate', 'Vit_B12', 'Pantothenic_Acid', 'Choline', 'Calcium', 'Iron', 'Magnesium', 'Phosphorus', 'Potassium', 'Sodium', 'Zinc', 'Copper', 'Manganese', 'Selenium', 'Fluoride'); 

        public function __construct($profile_pk) {

            $conn = Database::get_connection();
            $sql = "SELECT * FROM `nutrientprofile` WHERE `profilePK` = ?";
			$stmt = prepared_query($conn, $sql, $profile_pk);
            $this->$tuple = $stmt->get_result()->fetch_assoc();
        }
    }
?>