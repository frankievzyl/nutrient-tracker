<?php require_once("usersignup.php"); ?>
<div class="login-container">        
    <form name="loginform" class="log-in-form" method="get">
        <?php
            
            foreach (User_Controller::$current_users as $user) {
                echo <<<"LOG"
                <button class="user-login-button" type="submit" name="userPK" value="{$user->data['userPK']}"><img src="images/icons/{$user->data['Icon']}" alt=""><span>{$user->data['FirstName']} {$user->data['LastName']}</span></button>\n
LOG;
            }
        ?>
        <input type="hidden" name="action" value="log_in_user">
        <input type="hidden" name="controller" value="user">
    </form>
    <button id="sign-up-link" class="v-btn" onclick="display_signup()">New user? Click here to sign up</button>
</div>