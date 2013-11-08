<?php
	session_start();
	require_once ('create_user.php');
	require_once ("../libs/libs.php");
?>

<html>
<head>
	<title>University of Windsor Used Book Store - Register</title>
</head>
<body>
	<?php
	generateHeader();
	?>
	<form action="create_user.php" method="post">
		<?php display_errors(); ?>
		First name<br /><input type="text" name="first_name" /><br />
		Last name<br /><input type="text" name="last_name" /><br />
		UWin ID<br /><input type="text" name="uwin_id" />@uwindsor.ca<br />
		Password<br /><input type="password" name="pass" /><br />
		Confirm password<br /><input type="password" name="confirm" /><br />
		<input type="submit" name="submit" value="Register"/>
	</form>
</body>
</html>
