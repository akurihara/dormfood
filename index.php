<!DOCTYPE html>
<html>
	<head>
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script>
		  $(document).ready(function() {
		    $("#datepicker").datepicker();
		  });
		</script>

	</head>

	<body>

		<form name="register" action="./post.php" method="post">
			<input type="hidden" name="type" value="new_user" />
			First Name: <input type="text" name="first_name" /><br/>
			Last Name: <input type="text" name="last_name" /><br/>
			Email: <input type="text" name="email" /><br/>
			Password: <input type="password" name="password" /><br/>
			<input type="submit" value="Submit" />
		</form>
		<br>
		<form name="new_dinner" action="./post.php" method="post">
			<input type="hidden" name="type" value="new_dinner" />
			Host ID: <input type="text" name="host_id" /><br/>
			Name: <input type="text" name="name" /><br/>
			Contribution: <input type="text" name="price" /><br/>
			Menu: <input type="text" name="menu" /><br/>
			Street: <input type="text" name="street" /><br/>
			City: <input type="text" name="city" /><br/>
			State: <input type="text" name="state" /><br/>
			Zip: <input type="text" name="zip" /><br/>
			Time: <input id="datepicker" name="time" /><br>
			<input type="submit" value="Submit" />
		</form>
		<br>
		<form name="login" action="./post.php" method="post">
			<input type="hidden" name="type" value="login" />
			Email: <input type="text" name="email" /><br/>
			Password: <input type="password" name="password" /><br/>
			<input type="submit" value="Submit" />
		</form>

		<form name="is_attending" action="./post.php" method="post">
			<input type="hidden" name="type" value="is_attending" />
			User ID: <input type="text" name="user_id" /><br/>
			Dinner ID: <input type="text" name="dinner_id" /><br/>
			<input type="submit" value="Submit" />
		</form>

	</body>
<html>