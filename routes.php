<?php
	function call($controller, $action) {

		require_once('controllers/'.$controller.'_controller.php');

		switch($controller) {
			case 'logbook':
				require_once('models/logbook.php');
				$controller = new Logbook_Controller();
				break;
			case 'food':
				require_once('models/food.php');
				$controller = new Food_Controller();
				break;
			case 'user':
				require_once('models/user.php');
				$controller = new User_Controller();
				break;
			case 'userprofilehistory':
				require_once('models/userprofilehistory.php');
				$controller = new UserProfileHistory_Controller();
				break;
			default:
			break;
		}

		// call the action
		$controller->{ $action }();
	}

	// just a list of the controllers we have and their actions
  // we consider those "allowed" values

	$controllers = array('logbook' => ['get_entries_by_date', 'get_entries_in_date_range', 'add_entry', 'update_entry', 'delete_entry'],
						 'food' => ['get_all', 'get_by_name', 'get_by_type', 'get_by_pk', 'order_by'],
						 'user' => ['get_all', 'get_by_pk', 'log_in_user', 'sign_up', 'delete_user', 'get_macros', 'enter_macro', 'update_macro', 'get_nutrient_profile', 'set_nutrient_profile']);

  	if (array_key_exists($controller, $controllers)) {
  		if (in_array($action, $controllers[$controller])) {
  			call($controller, $action);
  		} else {
  			call('pages', 'error');
  		}
  	} else {
  		call('pages', 'error');
	}
?>