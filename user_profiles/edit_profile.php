<?php
	session_start();
	require_once ("../libs/libs.php");
	require_once ("modify_settings.php");
?>

<html>
<head>
	<title>University of Windsor Used Book Store - User Settings</title>
	<link rel="stylesheet" href="../main.css" type="text/css" />
</head>
<body>
	<?php generateHeader(); ?>
	<p>Modify your profile information below. You must enter your current password to make any changes.<br />If you wish to change your password, you must enter your current and new passwords and confirm the new password.</p>
	<form action="modify_settings.php" method="post">
		<?php display_errors(); ?>
		<label>UWin ID</label>  <input type="text" value="<?php echo $user_info['id']?>" disabled /><br />
		<label>First name</label>  <input type="text" name="first_name" value="<?php echo $user_info['fname']?>" /><br />
		<label>Last name</label>  <input type="text" name="last_name" value="<?php echo $user_info['lname']?>" /><br /><br />
		
		<label>Current password</label>  <input type="password" name="curr_pass" /><br />
		<label>New password</label>  <input type="password" name="new_pass" /><br />
		<label>Confirm new password</label>  <input type="password" name="conf_pass" /><br />
		
		<input type="submit" name="submit" value="Save" />		
	</form>
</body>
</html>