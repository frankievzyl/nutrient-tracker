<?php
    class Nutrient_Profile {

        public $tuple = array('profilePK'=> null, 'Name'=> null,  'Calories'=> null,  'Water'=> null,  'Protein'=> null,  'Tryptophan'=> null,  'Threonine'=> null,  'Isoleucine'=> null,  'Leucine'=> null,  'Lysine'=> null,  'Methionine_Cystine'=> null,  'Phenylalanine_Tyrosine'=> null,  'Valine'=> null,  'Histidine'=> null,  'Carbohydrates'=> null,  'Fiber'=> null,  'Omega_3'=> null,  'Omega_6'=> null,  'Vit_A'=> null,  'Vit_C'=> null,  'Vit_D'=> null,  'Vit_E'=> null,  'Vit_K'=> null,  'Thiamin'=> null,  'Riboflavin'=> null,  'Niacin'=> null,  'Vit_B6'=> null,  'Folate'=> null,  'Vit_B12'=> null,  'Pantothenic_Acid'=> null,  'Choline'=> null,  'Calcium'=> null,  'Iron'=> null,  'Magnesium'=> null,  'Phosphorus'=> null,  'Potassium'=> null,  'Sodium'=> null,  'Zinc'=> null,  'Copper'=> null,  'Manganese'=> null,  'Selenium'=> null,  'Fluoride' => null);
        public static $shown_fields = array('Name', 'Calories', 'Water', 'Protein', 'Tryptophan', 'Threonine', 'Isoleucine', 'Leucine', 'Lysine', 'Methionine_Cystine', 'Phenylalanine_Tyrosine', 'Valine', 'Histidine', 'Carbohydrates', 'Fiber', 'Omega_3', 'Omega_6', 'Vit_A', 'Vit_C', 'Vit_D', 'Vit_E', 'Vit_K', 'Thiamin', 'Riboflavin', 'Niacin', 'Vit_B6', 'Folate', 'Vit_B12', 'Pantothenic_Acid', 'Choline', 'Calcium', 'Iron', 'Magnesium', 'Phosphorus', 'Potassium', 'Sodium', 'Zinc', 'Copper', 'Manganese', 'Selenium', 'Fluoride'); 

        public function __construct($profile_data) {

            $this->tuple = array_replace($this->tuple, $profile_data);
        }

        public static function get_all() {

            return Database::get_all_core('nutrientprofile');
        }

        public static function get_by_pk($profile_pk) {

            return Database::get_by_pk_core('nutrientprofile', 'profilePK', $profile_pk);
        }

        //up to here everything works
    }
?>