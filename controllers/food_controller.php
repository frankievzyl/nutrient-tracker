<?php

    class Food_Controller {

        public static $food_list = array();
        public static $column_names = array("foodPK","Type","Name","Calories","Water","Protein","Tryptophan","Threonine","Isoleucine","Leucine","Lysine","Methionine","Cystine","Phenylalanine",
                                            "Tyrosine","Valine","Arginine","Histidine","Alanine","Aspartic_Acid","Glutamic_Acid","Glycine","Proline","Serine","Hydroxyproline","Carbohydrates","Fiber",
                                            "Starch","Sugar","Sucrose","Glucose","Fructose","Maltose","Galactose","Fat","Saturated_Fat","Monounsaturated_Fat","Polyunsaturated_Fat","Omega_3","Omega_6",
                                            "Vit_A","Alpha_Carotene","Beta_Carotene","Beta_Cryptoxanthin","Lycopene","Lutein_Zeaxanthin","Vit_C","Vit_D","Vit_E","Beta_Tocopherol","Gamma_Tocopherol",
                                            "Delta_Tocopherol","Vit_K","Thiamin","Riboflavin","Niacin","Vit_B6","Folate","Food_Folate","Folic_Acid","Dietary_Folate","Vit_B12","Pantothenic_Acid","Choline",
                                            "Betaine","Calcium","Iron","Magnesium","Phosphorus","Potassium","Sodium","Zinc","Copper","Manganese","Selenium","Fluoride","Alcohol","Caffeine");
        public static $food_types = array("Alcohol","Anonymous","Coffee","Fats","Fruits","Grains","Herbs","Legumes","Nuts","Seeds","Spices","Tea","Vegetables","Water");
        public static $qualified_column_classes = array("macros calories","macros water","macros protein","macros protein essential tryptophan","macros protein essential threonine",
                                                        "macros protein essential isoleucine","macros protein essential leucine","macros protein essential lysine","macros protein essential methionine",
                                                        "macros protein non cystine","macros protein essential phenylalanine","macros protein non tyrosine","macros protein essential valine",
                                                        "macros protein non arginine","macros protein essential histidine","macros protein non alanine","macros protein non aspartic_acid",
                                                        "macros protein non glutamic_acid","macros protein non glycine","macros protein non proline","macros protein non serine",
                                                        "macros protein non hydroxyproline","macros carbohydrates","macros carbohydrates fiber","macros carbohydrates starch","macros carbohydrates sugar",
                                                        "macros carbohydrates sugar sucrose","macros carbohydrates sugar glucose","macros carbohydrates sugar fructose","macros carbohydrates sugar maltose",
                                                        "macros carbohydrates sugar galactose","macros fat","macros fat saturated_fat","macros fat monounsaturated_fat","macros fat polyunsaturated_fat",
                                                        "macros fat omega_3","macros fat omega_6","vitamins vit_a","vitamins vit_a alpha_carotene","vitamins vit_a beta_carotene",
                                                        "vitamins vit_a beta_cryptoxanthin","vitamins vit_a lycopene","vitamins vit_a lutein_zeaxanthin","vitamins vit_c","vitamins vit_d",
                                                        "vitamins vit_e","vitamins vit_e beta_tocopherol","vitamins vit_e gamma_tocopherol","vitamins vit_e delta_tocopherol","vitamins vit_k",
                                                        "vitamins thiamin","vitamins riboflavin","vitamins niacin","vitamins vit_b6","vitamins folate","vitamins folate food_folate",
                                                        "vitamins folate folic_acid","vitamins folate dietary_folate","vitamins vit_b12","vitamins pantothenic_acid","vitamins choline","vitamins betaine",
                                                        "minerals calcium","minerals iron","minerals magnesium","minerals phosphorus","minerals potassium","minerals sodium","minerals zinc","minerals copper",
                                                        "minerals manganese","minerals selenium","minerals fluoride","other alcohol","other caffeine");

        public function get_all() {

            self::$food_list = Food::get_all();
            require_once("views/discoverfoods.php");
        }

        public function get_by_name() {

            $search_text = $_GET['food-title'];
            self::$food_list = Food::get_food_like ($search_text);
            require_once("views/discoverfoods.php");
        }

        public function get_by_pk() {

            $food_pk = $_GET['food_pk'];
            self::$food_list = Food::get_one($food_pk);
            require_once("views/discoverfoods.php");
        }
    }
?>