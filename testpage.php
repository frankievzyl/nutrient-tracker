
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
    <p>Now let's test the nutrientprofile model</p><br>
    <p>Now let's test the user model</p><br>
    <p>Now let's test the dailyintake model</p>
    <p>get foods, display objects</p>
    <?php
        $all_food = Food::get_food_like('apple');
        foreach($all_food as $food) {
            print_r(new Food($food));
           
        }
    ?>
</body>
</html>