<?php
require_once("../libs/libs.php");
require_once("../db_config/opendb.php");

$user_login = $_POST['login'];
$user_password = $_POST['pass'];
$sql = "SELECT fname FROM users WHERE id = '$user_login' AND password = '$user_password'"; 

$result = mysql_query($sql) or die('couldn\'t add to database');

$row = mysql_fetch_assoc($result);
$_SESSION['loggedinas'] = $row['fname'];
$_SESSION['user'] = $user_login;
//echo "You are signed in as ".$row['fname'];


?>

<!DOCTYPE html>
<html>
	<head>
		<title>University of Windsor Used Book Store - Sign In</title>
	</head>
	<body>
		
		<?php
		generateHeader();
		if ($_SESSION['loggedinas'] === null)
		{
		?>
			Not yet a member? <a href="/user_auth/user_signup.php">Sign up</a> for an account.<br />
			<form action="user_signin.php" method="POST">
			<label for="username">UWin ID: </label>
			<br/>
			<input type="text" name="login"/>
			<br/>
			<label for="password">Password: </label>
			<br/>
			<input type="password" name="pass"/>
			<br/>
			<input type="submit" name="submit" value="Login" />
			</form>
		<?php
		}
		else
		{
		?>
			<p>You are currently signed in as <?php echo $_SESSION['loggedinas']; ?>.</p>
		<?php
		}
		?>
	</body>
</html>