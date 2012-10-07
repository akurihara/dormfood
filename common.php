<?php


//mySQL Settings
define('DB_NAME', 'db_chefme');
define('DB_USER', 'root');	 
define('DB_PASSWORD', ''); 
define('DB_HOST', 'localhost');

// Enable error reporting
error_reporting(E_ALL);

// Try to connect to the database
try
{
	$dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
	print "Error!: " . $e->getMessage() . "<br/>";
	exit;
}

function get_dinners($dbh){
	$query = $dbh->prepare('SELECT id, host_id, name, price, menu, street, city, state, zip, time, count(user_id) as count
							FROM dinners as d, is_attending as a
							WHERE d.id = a.dinner_id
							GROUP BY dinner_id');
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_ASSOC);

	return $results;
}

function get_dinner($dbh, $dinner_id){
	$query = $dbh->prepare('SELECT id, host_id, name, price, menu, street, city, state, zip, time, count(user_id) as count
							FROM dinners as d, is_attending as a
							WHERE d.id = a.dinner_id
							AND d.id = :dinner_id
							GROUP BY dinner_id');
	$query->execute(array(':dinner_id' => $dinner_id));
	$results = $query->fetchAll(PDO::FETCH_ASSOC);

	return $results;
}

function add_user($dbh, $first_name, $last_name, $email, $password){
	$query = $dbh->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)');
	$query->execute(array(':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':password' => $password));

	return $dbh->lastInsertId();
}

function add_dinner($dbh, $host_id, $name, $price, $menu, $street, $city, $state, $zip, $time, $extra){
	$query = $dbh->prepare('INSERT INTO dinners (host_id, name, price, menu, street, city, state, zip, time, additional_info)
		VALUES (:host_id, :name, :price, :menu, :street, :city, :state, :zip, :time, :additional_info)');
	$query->execute(array(':host_id' => $host_id, ':name' => $name, ':price' => $price,':menu' => $menu, ':street' => $street, ':city' => $city, ':state' => $state,
		':zip' => $zip, ':time' => $time, ':additional_info' => $extra));

	$dinner_id = $dbh->lastInsertId();
	$time = date('Y/m/d h:i:s');

	$query = $dbh->prepare('INSERT INTO is_attending (dinner_id, user_id, date_added) VALUES (:dinner_id, :user_id, :time)');
	$query->execute(array(':dinner_id' => $dinner_id, ':user_id' => $host_id, ':time' => $time));

	return $dinner_id;
}

function add_attendee($dbh, $dinner_id, $user_id, $time){
	$query = $dbh->prepare('INSERT INTO is_attending (dinner_id, user_id, date_added) VALUES (:dinner_id, :user_id, :time)');
	$query->execute(array(':dinner_id' => $dinner_id, ':user_id' => $user_id, ':time' => $time));
}

function verify_user($dbh, $email, $password){
	$query = $dbh->prepare('SELECT password FROM users WHERE email = :email');
	$query->execute(array(':email' => $email));

	$results = $query->fetchAll(PDO::FETCH_ASSOC);
	$actual_pw = $results[0]['password'];

	if ($actual_pw === $password){
		return true;
	} else {
		return false;
	}

}

