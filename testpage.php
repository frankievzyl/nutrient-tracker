
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

    <p>Hello world! We are testing.</p>
    <?php
    $profile = Nutrient_Profile::get_by_pk(7);
    
    
        print_r(new Nutrient_Profile($profile));
    
    
        
    ?>
    
</body>
</html>