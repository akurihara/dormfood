<?php
define('SITE_ROOT', './');
require SITE_ROOT . 'common.php';

//debugging
var_dump($_POST);
echo '<br>';

$type = isset($_POST['type']) ? urldecode($_POST['type']) : '';

switch($type){
	case '':
		break;
	case 'new_user':
		$first_name = isset($_POST['name']) ? urldecode($_POST['first_name']) : '';
		$last_name = isset($_POST['name']) ? urldecode($_POST['last_name']) : '';
		$email = isset($_POST['email']) ? urldecode($_POST['email']) : '';
		$password = isset($_POST['password']) ? urldecode($_POST['password']) : '';
		$user_id = add_user($dbh, $first_name, $last_name, $email, $password);

		$result = array();
		$result['user_id'] = $user_id;
		echo json_encode($result);
		break;
	case 'new_dinner':
		$host_id = isset($_POST['host_id']) ? urldecode($_POST['host_id']) : '';
		$name = isset($_POST['name']) ? urldecode($_POST['name']) : '';
		$price = isset($_POST['price']) ? urldecode($_POST['price']) : '';
		$menu = isset($_POST['menu']) ? urldecode($_POST['menu']) : '';
		$street = isset($_POST['street']) ? urldecode($_POST['street']) : '';
		$city = isset($_POST['city']) ? urldecode($_POST['city']) : '';
		$state = isset($_POST['state']) ? urldecode($_POST['state']) : '';
		$zip = isset($_POST['zip']) ? urldecode($_POST['zip']) : '';
		$time = date('Y/m/d h:i:s');
		//$time = isset($_POST['time']) ? urldecode($_POST['time']) : '';
		$extra = isset($_POST['extra']) ? urldecode($_POST['extra']) : '';
		$dinner_id = add_dinner($dbh, $host_id, $name, $price, $menu, $street, $city, $state, $zip, $time, $extra);
		
		$result = array();
		$result['dinner_id'] = $dinner_id;
		echo json_encode($result);
		break;
	case 'is_attending':
		$dinner_id = isset($_POST['dinner_id']) ? urldecode($_POST['dinner_id']) : '';
		$user_id = isset($_POST['user_id']) ? urldecode($_POST['user_id']) : '';
		$time = date('Y/m/d h:i:s');
		add_attendee($dbh, $dinner_id, $user_id, $time);
		break;
	case 'login':
		$email = isset($_POST['email']) ? urldecode($_POST['email']) : '';
		$password = isset($_POST['password']) ? urldecode($_POST['password']) : '';

		$verified = verify_user($dbh, $email, $password);
		if($verified){
			echo 'success';
		} else {
			echo 'failure';
		}
}

