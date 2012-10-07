<?php
define('SITE_ROOT', './');
require SITE_ROOT . 'common.php';

$type = isset($_GET['type']) ? urldecode($_GET['type']) : '';

switch($type){
	case '':
		break;
	case 'get_dinners':
		$dinners = get_dinners($dbh);
		echo json_encode($dinners);
		break;
	case 'get_dinner':
		$dinner_id = isset($_GET['dinner_id']) ? urldecode($_GET['dinner_id']) : '';
		$dinner = get_dinner($dbh, $dinner_id);
		echo json_encode($dinner);
}