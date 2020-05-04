<?php

    class User_Controller {

        public static $current_users;
        public static $this_user;

        public function get_all() {

            self::$current_users = User::get_all();
            
            if (self::$current_users) {
                
                if (count(self::$current_users) > 1) {

                    $page_title = "User Login";
                    require_once("views/userlogin.php");

                } else {
                
                    self::$this_user = self::$current_users[0];
                    header("location: ?action=get_all&controller=album&userPK=".self::$this_user->data['userPK']);
                }

            } else {

                global $page_title;
                $page_title = "User Sign-up";
                require_once("views/usersignup.php");
                echo "<script>(display_signup())();</script>";
            }
            
        }

        public function get_user() {

            self::$this_user = User::get_one($_GET["userPK"]);
        }

        public function log_in_user() {

            foreach (User::$users as $user) {
                
                if ($user->data["userPK"] == $_GET["userPK"]) {

                    self::$this_user = $user;  
                }
            }
            
            $url = "location: ?action=get_all&controller=logbook&userPK=" . self::$this_user->data["userPK"];
            header($url);
            
        }

        public function sign_up() {

            if ($new_user = User::insert($_GET)) {
                
                self::$this_user = serialize($new_user);
                header("location: ?action=get_all&controller=logbook&userPK={$new_user->data['userPK']}");

            } else {

                pop_up("Your account could not be created. Please try again.");
            }
            
        }

        public function profile() {

            require_once("views/editprofile.php");
        }

        public function update_settings() {

            self::$this_user->update($_GET);
            #return in javascript
        }

        public function delete_user() {

            self::$this_user->delete();
            get_all();
        }
    }
?>