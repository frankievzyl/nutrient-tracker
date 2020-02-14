
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    require_once('database.php');
    require_once('models/food.php');
    require_once('models/user.php');
    require_once('models/nutrientprofile.php');
    require_once('models/dailyintake.php');
    require_once('models/post.php');
?>

    <p>Hello world! We are testing the food table</p>
    <p>The food model works, yay!</p><br>
    <?php
        /*$food = Food::get_by_pk(3);
        
            print_r(new Food($food));*/
        
        
        
        
    ?>
    <p>Now let's test the nutrientprofile model</p><br>
    <p>nutrient model works!</p>
    
    <p>Now let's test the user model</p><br>
    <p>user model works!</p>
    
    <p>Now let's test the dailyintake model</p>
    <?php
        
       
            $diary = User::get_all();
            foreach ($diary as $intake) {
                
                $my_intake = new User($intake);
                print_r($my_intake);

                
                
            }
        

        
        /*
        }*/
            
        
        
            
        
    ?>
    <p>get foods, display objects</p>
    
</body>
</html>