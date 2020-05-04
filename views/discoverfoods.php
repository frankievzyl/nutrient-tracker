    
    <main class="discoverfoods">
        <div id="food-filter">
            <form id="search-food-form" name="search-food-form" method="get">
                <input type="hidden" name="controller" value="food">
                <input type="hidden" name="action" value="get_by_name">
                <input type="search" name="food-title" id="food-title" list="all-titles">
                <button type="submit">Search</button>
                <datalist id="all-titles">
<?php
    $col_names = Food_Controller::$column_names;
    $col_classnames = Food_Controller::$qualified_column_classes;
    $foods = Food_Controller::$food_list;
    $types = Food_Controller::$food_types;

    foreach($foods as $food) {

        echo "<option value=\"{$food->data['Name']}\">";
    }
?>
                </datalist>
            </form>
            <div id="hs-columns">
                <div class="hs-column tierA" onclick="hide_show_column('macros', this)"><span>Macros</span>
                    <div class="hs-column tierB" onclick="hide_show_column('calories', this)"><span>Calories</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('water', this)"><span>Water</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('protein', this)"><span>Protein</span>
                        <div class="hs-column tierC" onclick="hide_show_column('essential', this)"><span>Essential</span>
                            <div class="hs-column tierD" onclick="hide_show_column('tryptophan', this)"><span>Tryptophan</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('threonine', this)"><span>Threonine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('isoleucine', this)"><span>Isoleucine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('leucine', this)"><span>Leucine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('lysine', this)"><span>Lysine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('methionine', this)"><span>Methionine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('phenylalanine', this)"><span>Phenylalanine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('valine', this)"><span>Valine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('histidine', this)"><span>Histidine</span></div>
                        </div>
                        <div class="hs-column tierC" onclick="hide_show_column('non', this)"><span>Non-Essential</span>
                            <div class="hs-column tierD" onclick="hide_show_column('cystine', this)"><span>Cystine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('tyrosine', this)"><span>Tyrosine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('arginine', this)"><span>Arginine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('alanine', this)"><span>Alanine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('aspartic_acid', this)"><span>Aspartic_Acid</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('glutamic_acid', this)"><span>Glutamic_Acid</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('glycine', this)"><span>Glycine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('proline', this)"><span>Proline</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('serine', this)"><span>Serine</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('hydroxyproline', this)"><span>Hydroxyproline</span></div>
                        </div>
                    </div>
                    <div class="hs-column tierB" onclick="hide_show_column('carbohydrates', this)"><span>Carbohydrates</span>
                        <div class="hs-column tierC" onclick="hide_show_column('fiber', this)"><span>Fiber</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('starch', this)"><span>Starch</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('sugar', this)"><span>Sugar</span>
                            <div class="hs-column tierD" onclick="hide_show_column('sucrose', this)"><span>Sucrose</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('glucose', this)"><span>Glucose</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('fructose', this)"><span>Fructose</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('maltose', this)"><span>Maltose</span></div>
                            <div class="hs-column tierD" onclick="hide_show_column('galactose', this)"><span>Galactose</span></div>
                        </div>
                    </div>
                    <div class="hs-column tierB" onclick="hide_show_column('fat', this)"><span>Fat</span>
                        <div class="hs-column tierC" onclick="hide_show_column('saturated_fat', this)"><span>Saturated_Fat</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('monounsaturated_fat', this)"><span>Monounsaturated_Fat</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('polyunsaturated_fat', this)"><span>Polyunsaturated_Fat</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('omega_3', this)"><span>Omega_3</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('omega_6', this)"><span>Omega_6</span></div>
                    </div>
                </div>
                <div class="hs-column tierA" onclick="hide_show_column('vitamins', this)"><span>Vitamins</span>
                    <div class="hs-column tierB" onclick="hide_show_column('vit_a', this)"><span>Vit_A</span>
                        <div class="hs-column tierC" onclick="hide_show_column('alpha_carotene', this)"><span>Alpha_Carotene</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('beta_carotene', this)"><span>Beta_Carotene</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('beta_cryptoxanthin', this)"><span>Beta_Cryptoxanthin</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('lycopene', this)"><span>Lycopene</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('lutein_zeaxanthin', this)"><span>Lutein_Zeaxanthin</span></div>
                    </div>
                    <div class="hs-column tierB" onclick="hide_show_column('vit_c', this)"><span>Vit_C</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('vit_d', this)"><span>Vit_D</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('vit_e', this)"><span>Vit_E</span>
                        <div class="hs-column tierC" onclick="hide_show_column('beta_tocopherol', this)"><span>Beta_Tocopherol</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('gamma_tocopherol', this)"><span>Gamma_Tocopherol</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('delta_tocopherol', this)"><span>Delta_Tocopherol</span></div>
                    </div>
                    <div class="hs-column tierB" onclick="hide_show_column('vit_k', this)"><span>Vit_K</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('thiamin', this)"><span>Thiamin</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('riboflavin', this)"><span>Riboflavin</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('niacin', this)"><span>Niacin</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('vit_b6', this)"><span>Vit_B6</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('folate', this)"><span>Folate</span>
                        <div class="hs-column tierC" onclick="hide_show_column('food_folate', this)"><span>Food_Folate</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('folic_acid', this)"><span>Folic_Acid</span></div>
                        <div class="hs-column tierC" onclick="hide_show_column('dietary_folate', this)"><span>Dietary_Folate</span></div>
                    </div>
                    <div class="hs-column tierB" onclick="hide_show_column('vit_b12', this)"><span>Vit_B12</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('pantothenic_acid', this)"><span>Pantothenic_Acid</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('choline', this)"><span>Choline</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('betaine', this)"><span>Betaine</span></div>
                </div>
                <div class="hs-column tierA" onclick="hide_show_column('minerals', this)"><span>Minerals</span>
                    <div class="hs-column tierB" onclick="hide_show_column('calcium', this)"><span>Calcium</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('iron', this)"><span>Iron</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('magnesium', this)"><span>Magnesium</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('phosphorus', this)"><span>Phosphorus</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('potassium', this)"><span>Potassium</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('sodium', this)"><span>Sodium</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('zinc', this)"><span>Zinc</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('copper', this)"><span>Copper</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('manganese', this)"><span>Manganese</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('selenium', this)"><span>Selenium</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('fluoride', this)"><span>Fluoride</span></div>
                </div>
                <div class="hs-column tierA" onclick="hide_show_column('other', this)"><span>Other</span>
                    <div class="hs-column tierB" onclick="hide_show_column('alcohol', this)"><span>Alcohol</span></div>
                    <div class="hs-column tierB" onclick="hide_show_column('caffeine', this)"><span>Caffeine</span></div>
                </div>
            </div>
        </div>
    <div id="food-types">
        <div class="type-tab alcohol" onclick="show_tab('alcohol', this)"><span>Alcohol</span></div>
        <div class="type-tab anonymous" onclick="show_tab('anonymous', this)"><span>Anonymous</span></div>
        <div class="type-tab coffee" onclick="show_tab('coffee', this)"><span>Coffee</span></div>
        <div class="type-tab fats" onclick="show_tab('fats', this)"><span>Fats</span></div>
        <div class="type-tab fruits" onclick="show_tab('fruits', this)"><span>Fruits</span></div>
        <div class="type-tab grains" onclick="show_tab('grains', this)"><span>Grains</span></div>
        <div class="type-tab herbs" onclick="show_tab('herbs', this)"><span>Herbs</span></div>
        <div class="type-tab legumes" onclick="show_tab('legumes', this)"><span>Legumes</span></div>
        <div class="type-tab nuts" onclick="show_tab('nuts', this)"><span>Nuts</span></div>
        <div class="type-tab seeds" onclick="show_tab('seeds', this)"><span>Seeds</span></div>
        <div class="type-tab spices" onclick="show_tab('spices', this)"><span>Spices</span></div>
        <div class="type-tab tea" onclick="show_tab('tea', this)"><span>Tea</span></div>
        <div class="type-tab vegetables" onclick="show_tab('vegetables', this)"><span>Vegetables</span></div>
        <div class="type-tab water" onclick="show_tab('water', this)"><span>Water</span></div>
    </div>
    <div id="table-display">
        <div class="header row">
            <div class="cell empty">name</div>
            <div class="cell macros calories">Calories</div>
            <div class="cell macros water">Water</div>
            <div class="cell macros protein">Protein</div>
            <div class="cell macros protein essential tryptophan">Tryptophan</div>
            <div class="cell macros protein essential threonine">Threonine</div>
            <div class="cell macros protein essential isoleucine">Isoleucine</div>
            <div class="cell macros protein essential leucine">Leucine</div>
            <div class="cell macros protein essential lysine">Lysine</div>
            <div class="cell macros protein essential methionine">Methionine</div>
            <div class="cell macros protein non cystine">Cystine</div>
            <div class="cell macros protein essential phenylalanine">Phenylalanine</div>
            <div class="cell macros protein non tyrosine">Tyrosine</div>
            <div class="cell macros protein essential valine">Valine</div>
            <div class="cell macros protein non arginine">Arginine</div>
            <div class="cell macros protein essential histidine">Histidine</div>
            <div class="cell macros protein non alanine">Alanine</div>
            <div class="cell macros protein non aspartic_acid">Aspartic_Acid</div>
            <div class="cell macros protein non glutamic_acid">Glutamic_Acid</div>
            <div class="cell macros protein non glycine">Glycine</div>
            <div class="cell macros protein non proline">Proline</div>
            <div class="cell macros protein non serine">Serine</div>
            <div class="cell macros protein non hydroxyproline">Hydroxyproline</div>
            <div class="cell macros carbohydrates">Carbohydrates</div>
            <div class="cell macros carbohydrates fiber">Fiber</div>
            <div class="cell macros carbohydrates starch">Starch</div>
            <div class="cell macros carbohydrates sugar">Sugar</div>
            <div class="cell macros carbohydrates sugar sucrose">Sucrose</div>
            <div class="cell macros carbohydrates sugar glucose">Glucose</div>
            <div class="cell macros carbohydrates sugar fructose">Fructose</div>
            <div class="cell macros carbohydrates sugar maltose">Maltose</div>
            <div class="cell macros carbohydrates sugar galactose">Galactose</div>
            <div class="cell macros fat">Fat</div>
            <div class="cell macros fat saturated_fat">Saturated_Fat</div>
            <div class="cell macros fat monounsaturated_fat">Monounsaturated_Fat</div>
            <div class="cell macros fat polyunsaturated_fat">Polyunsaturated_Fat</div>
            <div class="cell macros fat omega_3">Omega_3</div>
            <div class="cell macros fat omega_6">Omega_6</div>
            <div class="cell vitamins vit_a">Vit_A</div>
            <div class="cell vitamins vit_a alpha_carotene">Alpha_Carotene</div>
            <div class="cell vitamins vit_a beta_carotene">Beta_Carotene</div>
            <div class="cell vitamins vit_a beta_cryptoxanthin">Beta_Cryptoxanthin</div>
            <div class="cell vitamins vit_a lycopene">Lycopene</div>
            <div class="cell vitamins vit_a lutein_zeaxanthin">Lutein_Zeaxanthin</div>
            <div class="cell vitamins vit_c">Vit_C</div>
            <div class="cell vitamins vit_d">Vit_D</div>
            <div class="cell vitamins vit_e">Vit_E</div>
            <div class="cell vitamins vit_e beta_tocopherol">Beta_Tocopherol</div>
            <div class="cell vitamins vit_e gamma_tocopherol">Gamma_Tocopherol</div>
            <div class="cell vitamins vit_e delta_tocopherol">Delta_Tocopherol</div>
            <div class="cell vitamins vit_k">Vit_K</div>
            <div class="cell vitamins thiamin">Thiamin</div>
            <div class="cell vitamins riboflavin">Riboflavin</div>
            <div class="cell vitamins niacin">Niacin</div>
            <div class="cell vitamins vit_b6">Vit_B6</div>
            <div class="cell vitamins folate">Folate</div>
            <div class="cell vitamins folate food_folate">Food_Folate</div>
            <div class="cell vitamins folate folic_acid">Folic_Acid</div>
            <div class="cell vitamins folate dietary_folate">Dietary_Folate</div>
            <div class="cell vitamins vit_b12">Vit_B12</div>
            <div class="cell vitamins pantothenic_acid">Pantothenic_Acid</div>
            <div class="cell vitamins choline">Choline</div>
            <div class="cell vitamins betaine">Betaine</div>
            <div class="cell minerals calcium">Calcium</div>
            <div class="cell minerals iron">Iron</div>
            <div class="cell minerals magnesium">Magnesium</div>
            <div class="cell minerals phosphorus">Phosphorus</div>
            <div class="cell minerals potassium">Potassium</div>
            <div class="cell minerals sodium">Sodium</div>
            <div class="cell minerals zinc">Zinc</div>
            <div class="cell minerals copper">Copper</div>
            <div class="cell minerals manganese">Manganese</div>
            <div class="cell minerals selenium">Selenium</div>
            <div class="cell minerals fluoride">Fluoride</div>
            <div class="cell other alcohol">Alcohol</div>
            <div class="cell other caffeine">Caffeine</div>
        </div>
<?php
    for ($i=0; $i < count($foods); $i++) {

        $food = $foods[$i];
        $broken = explode(",", $food->data['Name']);
        
        foreach($broken as $piece) {
            $piece = trim($piece);
        }

        $title = array_shift($broken);
        $subtext = implode("&#x25E6;", $broken);
        $food_type = strtolower($food->data['Type']);

        echo <<<"ROWSTART"
        <div id="fpk_{$food->data['foodPK']}" class="row food $food_type">
            <div class="cell name">
                <span class="title">$title</span>
                <span class="subtitle">$subtext</span>
                <div class="percent-of_day">
                    <div class="gradient"></div>
                    <div class="numbers">
                        <span class="grams"></span>&#x21E8;
                        <span class="percent"></span>&percnt;
                    </div>
                </div>
                <div class="score">
                    <div class="gradient"></div>
                    <span class="grams"></span>
                </div>    
            </div>
ROWSTART;

        $food_values = array_values($food->data);

        for ($k=3; $k < count($food_values); $k++) { 
            
            $value = $food_values[$k] == null ? "&mdash;" : $food_values[$k];
            echo <<<"VALUE"
            <div class="cell {$col_classnames[$k-3]}">
                <div class="amount">$value</div>
                <div class="percent-of_day">
                    <div class="gradient"></div>
                    <div class="numbers">
                        <span class="grams"></span>&#x21E8;
                        <span class="percent"></span>&percnt;
                    </div>
                </div>
                <div class="score">
                    <div class="gradient"></div>
                    <span class="grams"></span>
                </div>
            </div>
VALUE;
        }

        echo "</div>";//end row data
    }

    echo "</div>";//end table
?>
    </main>
<script>
    
</script>