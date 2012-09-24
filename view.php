<?php
define('SITE_ROOT', './');
require SITE_ROOT . 'common.php';

function get_dinners($dbh){
	$query = $dbh->prepare('SELECT * FROM dinners ORDER BY time ASC');
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_ASSOC);

	return $results;
}

$type = isset($_GET['type']) ? urldecode($_GET['type']) : '';

switch($type){
	case '':
		break;
	case 'get_dinners':
		$dinners = get_dinners($dbh);
		echo json_encode($dinners);
		break;
}