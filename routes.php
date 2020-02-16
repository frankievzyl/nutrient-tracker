<?php
	function call($controller, $action) {

		require_once('controllers/'.$controller.'_controller.php');

		switch($controller) {
			case 'pages':
				$controller = new PagesController();
				break;
			case 'posts':
			// we need the model to query the database later in the controller
			require_once('models/post.php'); //again, inserting post models' code
			$controller = new PostsController();
				break;
			default:
			break;
		}

		// call the action
		$controller->{ $action }();
	}

	// just a list of the controllers we have and their actions
  // we consider those "allowed" values

	$controllers = array('pages' => ['home', 'error'],
						 'posts' => ['index', 'show']);

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