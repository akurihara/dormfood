<?php
define('SITE_ROOT', './');
require SITE_ROOT . 'common.php';

function add_user($dbh, $name, $email, $password){
	$query = $dbh->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
	$query->execute(array(':name' => $name, ':email' => $email, ':password' => $password));
}

function add_dinner($dbh, $host_id, $name, $price, $menu, $street, $city, $state, $zip, $time, $extra){
	$query = $dbh->prepare('INSERT INTO dinners (host_id, name, price, menu, street, city, state, zip, time, additional_info)
		VALUES (:host_id, :name, :price, :menu, :street, :city, :state, :zip, :time, :additional_info)');
	$query->execute(array(':host_id' => $host_id, ':name' => $name, ':price' => $price,':menu' => $menu, ':street' => $street, ':city' => $city, ':state' => $state,
		':zip' => $zip, ':time' => $time, ':additional_info' => $extra));
}

function add_attendee($dbh, $dinner_id, $user_id, $time){
	$query = $dbh->prepare('INSERT INTO is_attending (dinner_id, user_id, time) VALUES (:dinner_id, :user_id, :time)');
	$query->execute(array(':dinner_id' => $dinner_id, ':user_id' => $user_id, ':time' => $time));
}

//debugging
var_dump($_POST);
echo '<br>';

$type = isset($_POST['type']) ? urldecode($_POST['type']) : '';

switch($type){
	case '':
		break;
	case 'new_user':
		$host_id = isset($_POST['name']) ? urldecode($_POST['name']) : '';
		$email = isset($_POST['email']) ? urldecode($_POST['email']) : '';
		$password = isset($_POST['password']) ? urldecode($_POST['password']) : '';
		add_user($dbh, $name, $email, $password);
		echo 'New User Added';
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
		add_dinner($dbh, $host_id, $name, $price, $menu, $street, $city, $state, $zip, $time, $extra);
		echo 'New Dinner Added';
		break;
	case 'is_attending':
		$dinner_id = isset($_POST['dinner_id']) ? urldecode($_POST['dinner_id']) : '';
		$user_id = isset($_POST['user_id']) ? urldecode($_POST['user_id']) : '';
		$time = date('Y/m/d h:i:s');
		add_attendee($dbh, $dinner_id, $user_id, $time);
		break;
}

