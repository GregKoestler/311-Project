<?php
	require_once ("../db_config/opendb.php");
	
	$username = mysql_real_escape_string($_POST['uwin_id']);
	$full_name = mysql_real_escape_string($_POST['name']);
	$password = mysql_real_escape_string($_POST['pass']);
	$confirm = mysql_real_escape_string($_POST['confirm']);
	
	if ($password !== $confirm) {
		header ("location: user_signup.php?conf=0");		
	}
	else {
		mysql_query("INSERT INTO users(id, name, password) VALUES ('$username', '$full_name', '$password')");
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
		Name<br /><input type="text" name="name" /><br />
		UWin ID<br /><input type="text" name="uwin_id" />@uwindsor.ca<br />
		Password<br /><input type="password" name="pass" /><br />
		Confirm password<br /><input type="password" name="confirm" />
			<?php if ($_GET['conf'] == 0) echo "Passwords do not match!"; ?><br />
		<input type="submit" value="Register"/>
	</form>
</body>
