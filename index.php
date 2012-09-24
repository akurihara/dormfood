<!DOCTYPE html>
<html>
	<body>

		<form name="register" action="./post.php" method="post">
			<input type="hidden" name="type" value="new_user" />
			Name: <input type="text" name="name" /><br/>
			Email: <input type="text" name="email" /><br/>
			Password: <input type="password" name="password" /><br/>
			<input type="submit" value="Submit" />
		</form>
		<br>
		<form name="register" action="./post.php" method="post">
			<input type="hidden" name="type" value="new_dinner" />
			Host ID: <input type="text" name="host_id" /><br/>
			Name: <input type="text" name="name" /><br/>
			Contribution: <input type="text" name="price" /><br/>
			Menu: <input type="text" name="menu" /><br/>
			Street: <input type="text" name="street" /><br/>
			City: <input type="text" name="city" /><br/>
			State: <input type="text" name="state" /><br/>
			Zip: <input type="text" name="zip" /><br/>
			<input type="submit" value="Submit" />
		</form>

	</body>
<html>