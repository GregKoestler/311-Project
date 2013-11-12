<?php 
	session_start();
	require_once ("../db_config/opendb.php");
	
	if (isset ($_SESSION['user']))
		$user = $_SESSION['user'];
	else {	// if not logged in, immediately redirect to index (this page should never be navigated to when logged out
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php">';
		exit;
	}

	$sql_user = sprintf ("select * from users where id = '%s'", $user);
	$query = mysql_query($sql_user);
	$user_info = mysql_fetch_assoc ($query);
	
	if (isset($_POST['submit'])) {
		// If user entered new first name, save it
		if (isset($_POST['first_name']))
			$first = trim(mysql_real_escape_string($_POST['first_name']));
		else	// if field was emptied, keep old first name
			$first = $user_info['fname'];
			
		// If user entered new last name, save it
		if (isset($_POST['last_name']))
			$last = trim(mysql_real_escape_string($_POST['last_name']));
		else	 // if field was emptied, keep old last name
			$last = $user_info['lname'];
			
		$curr_pass = trim(mysql_real_escape_string($_POST['curr_pass']));
		// If user entered current password, save it
		if (isset($curr_pass) && strlen($curr_pass) > 0)
			$current = $curr_pass;
		else {	// if field remained empty, set error to true and refresh
			$_SESSION['no_password'] = true;
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./edit_profile.php">';
			exit;
		}
		
		// Check entered current password for validity
		if ($current !== $user_info['password']) {
			$_SESSION['invalid_password'] = true;
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./edit_profile.php">';
			exit;
		}
		
		$new_pass = trim(mysql_real_escape_string($_POST['new_pass']));
		$conf_pass = trim(mysql_real_escape_string($_POST['conf_pass']));
		
		// if user entered new password AND confirmed it, save both
		if (isset($new_pass) && strlen($new_pass) > 0
			&& isset($conf_pass) && strlen($conf_pass) > 0)
		{
			$new_password = $new_pass;
			$confirm = $conf_pass;
			
			if ($new_password !== $confirm) {
				$_SESSION['bad_confirmation'] = true;
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./edit_profile.php">';
				exit;
			}
		}
		// if user entered NEITHER new password nor a confirmation, new_password = password
		else if (!strlen($new_pass) && !strlen($conf_pass)) {
			$new_password = $current;
		}
		// if user entered new password OR confirmed it, set error to true and refresh
		else {
			$_SESSION['need_both_new_pass'] = true;
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./edit_profile.php">';
			exit;
		}
		
		/* To reach this point, the user has entered the proper current password
			and either not changed their password or entered two identical new passwords. */
		
		$modify_query = sprintf ("update users set fname='%s', lname='%s', password='%s' where id='%s' and password='%s'",
			$first, $last, $new_password, $user_info['id'], $current);
		$update = mysql_query($modify_query) or die('couldn\'t update the database.');
		header('location: /user_profiles/profile.php');
	}
	
	function display_errors() {
		if ($_SESSION['no_password'] === true)
			echo "You must enter your current password in order to save your changes.<br />";
		if ($_SESSION['need_both_new_pass'] === true)
			echo "In order to change your password, you must fill in all three password fields.<br />";
		if ($_SESSION['bad_confirmation'] === true)
			echo "Your new password does not match its confirmation.<br />";
		if ($_SESSION['invalid_password'] === true)
			echo "Invalid password. Try again.<br />";
		echo "";
		
		$_SESSION['no_password'] = false;
		$_SESSION['need_both_new_pass'] = false;
		$_SESSION['bad_confirmation'] = false;
		$_SESSION['invalid_password'] = false;
	}
?>