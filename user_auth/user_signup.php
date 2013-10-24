<?php
	require_once ("../db_config/opendb.php");
	
	$username = mysql_real_escape_string($_POST['uwin_id']);
	$firstname = mysql_real_escape_string($_POST['first_name']);
	$lastname = mysql_real_escape_string($_POST['last_name']);
	$password = mysql_real_escape_string($_POST['pass']);
	$confirm = mysql_real_escape_string($_POST['confirm']);
	
	if ($password !== $confirm) {
		header ("location: user_signup.php?conf=1");		
	}
	else {
		mysql_query("INSERT INTO users(fname, lname, id, password) VALUES ($firstname', '$lastname', '$username', '$password')");
	//header("location: index.php?auth=1");
	//mysql_close ($conn);
	}
?>

<html>
<head>
	<title>University of Windsor Used Book Store - Register</title>
</head>
<body>
	<form action="user_signup.php" method="post">
		First name<br /><input type="text" name="first_name" /><br />
		Last name<br /><input type="text" name="last_name" /><br />
		UWin ID<br /><input type="text" name="uwin_id" />@uwindsor.ca<br />
		Password<br /><input type="password" name="pass" /><br />
		Confirm password<br /><input type="password" name="confirm" />
			<?php if ($_GET['conf'] == 1) echo "Passwords do not match!"; ?><br />
		<input type="submit" value="Register"/>
	</form>
</body>
