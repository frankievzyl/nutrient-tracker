<?php

    class Pages_Controller {

        function error() {
            require_once ("views/error.html");
        }

        function view_foods() {
            require_once ("views/discoverfoods.php");
        }

        function log_foods() {
            require_once ("views/logfood.php");
        }

        function view_logbook() {
            require_once ("views/logbookhistory.php");
        }

        function edit_profile() {
            require_once ("views/editprofile.php");
        }

        function sign_up() {
            require_once ("views/usersignup.php");
        }

        function log_in() {
            require_once ("views/userlogin.php");
        }
    }
    
?>