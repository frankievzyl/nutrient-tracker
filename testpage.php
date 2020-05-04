
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .key {background-color: yellow;}
        .value {background-color: lightgray;}
    </style>
</head>
<body>
<?php



function get_column_classname($column_name) {

    $column_name = strtolower($column_name);
    $classname = array($column_name);
    $found_root = false;
    $primary = array(
        "macros" => [   "calories",
                        "water",
                        "protein" => [      "essential" => [    "tryptophan","threonine","isoleucine","leucine","lysine","methionine","phenylalanine","valine","histidine"],
                                            "non" => [          "cystine","tyrosine","arginine","alanine","aspartic_acid","glutamic_acid","glycine","proline","serine","hydroxyproline"]],
                        "carbohydrates" => ["fiber",
                                            "starch",
                                            "sugar" => [        "sucrose","glucose","fructose","maltose","galactose"]],
                        "fat" => [          "saturated_fat","monounsaturated_fat","polyunsaturated_fat","omega_3","omega_6"]],
        "vitamins" => [ "vit_a" => [        "alpha_carotene","beta_carotene","beta_cryptoxanthin","lycopene","lutein_zeaxanthin"],
                        "vit_c",
                        "vit_d",
                        "vit_e" => [        "beta_tocopherol","gamma_tocopherol","delta_tocopherol"],
                        "vit_k",
                        "thiamin",
                        "riboflavin",
                        "niacin",
                        "vit_b6",
                        "folate" => [       "food_folate","folic_acid","dietary_folate"],
                        "vit_b12","pantothenic_acid","choline","betaine"],
        "minerals" => [ "calcium","iron","magnesium","phosphorus","potassium","sodium","zinc","copper","manganese","selenium","fluoride"],
        "other" => [    "alcohol","caffeine"]);

    foreach ($primary as $prime_key => $prime_val) {

        foreach ($prime_val as $sec_key => $sec_val) {
            
            if(is_array($sec_val)) {
                
                foreach ($sec_val as $ter_key => $ter_val) {
                        
                    if(is_array($ter_val)){
                        
                        foreach ($ter_val as $base_val) {
                            
                            if ($found_root = $column_name == $base_val) {     
                            break;
                            }
                        }

                        if ($found_root) { 
                            $classname[] = $ter_key; 
                        break;
                        }

                        if ($found_root = $column_name == $ter_key) {
                        break;
                        }

                    } elseif ($found_root = $column_name == $ter_val) {
                    break;
                    }
                }

                if ($found_root) { 
                    $classname[] = $sec_key; 
                break;
                }

                if ($found_root = $column_name == $sec_key) {
                break;
                }

            } elseif ($found_root = $column_name == $sec_val) {
            break;
            }
        }

        if ($found_root) {
            $classname[] = $prime_key;
        break; 
        } 
    }
    
    return implode(" ", array_reverse($classname));
}


    require ("database.php");
    require ("controllers/food_controller.php");
    require ("models/food.php");
    $fc = new Food_Controller();
    $col_names = $fc::$column_names;
    $col_classnames = $fc::$qualified_column_classes;
    $foods = $fc::$food_list;
    $types = $fc::$food_types;
    $classifieds = array();
/*  
    qualified class names for columns    
    for ($x = 3; $x < count($col_names); $x++) {
        $classifieds[] = get_column_classname($col_names[$x]);
    }

    display buttons for column hierarchy
    for ($x = 3; $x < count($col_names); $x++) {

        echo "<div class=\"hs-column\" data-vis-state=\"vis\" onclick=\"hide_show_column('{$col_classnames[$x-3]}')\">{$col_names[$x]}</div>";
    }

    tabs for food types
    foreach ($types as $name) {
        echo "<div class=\"type-tab\" onclick=\"show_tab('" . strtolower($name) . "')\" >$name</div>";
    }

    column header row for table
    for ($y = 3; $y < count($col_names); $y++) {

        echo "<div class=\"cell {$classifieds[$y-3]}\">$col_names[$y]</div>";
    }*/
    ?>
  
</body>
</html>