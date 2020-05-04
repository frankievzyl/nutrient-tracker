<?php
	require_once('database.php');

	if (isset($_GET['controller']) && isset($_GET['action'])) {
		$controller = $_GET['controller'];
		$action		= $_GET['action'];
	} else {
		$controller = 'food';
		$action		= 'get_all';
	}

	require_once('views/layout.php');
?>