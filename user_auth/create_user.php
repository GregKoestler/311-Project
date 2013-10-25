<?php
	require_once ("../db_config/opendb.php");
	session_start();

	$fields=array();
	if (!isset($_SESSION['reg_error']))
		$_SESSION['reg_error']=false;
	
	// only proceed if the submit button has been clicked
	if (isset($_POST['submit']))
	{	
			$_SESSION['reg_error']=false;
			$_SESSION['blank_reg_field']=false;
			$_SESSION['password_mismatch']=false;
			$_SESSION['preexisting_user']=false;
		
		// Remove leading/trailing whitespace and escape special characters from input fields
		$fields['username'] = trim(mysql_real_escape_string($_POST['uwin_id']));
		$fields['firstname'] = trim(mysql_real_escape_string($_POST['first_name']));
		$fields['lastname'] = trim(mysql_real_escape_string($_POST['last_name']));
		$fields['password'] = trim(mysql_real_escape_string($_POST['pass']));
		$fields['confirm'] = trim(mysql_real_escape_string($_POST['confirm']));
		
		// add an error to the list if any fields are empty
		foreach ($fields as $field=>$value) {
			if (empty($value)) {
				$_SESSION['blank_reg_field']=true;
				$_SESSION['reg_error']=true;
				break;
			}
		}
		
		if ($fields['password'] !== $fields['confirm']) {
			$_SESSION['password_mismatch']=true;
			$_SESSION['reg_error']=true;
		}
		
			$query = sprintf("select * from users where id='%s'", $fields['username']); //check if user already exists
			$sql = mysql_query ($query) or die('Error: Couldn\'t access database.');
			
			// insert user into database
			if (mysql_num_rows($sql) != 0) {
				$_SESSION['preexisting_user']=true;
				$_SESSION['reg_error']=true;				
			}
			if (!$_SESSION['reg_error']) {
				$insert = sprintf ("insert into users(fname, lname, id, password) values ('%s', '%s', '%s', '%s')",
					$fields['firstname'], $fields['lastname'], $fields['username'], $fields['password']);
				
				$result = mysql_query($insert) or die('couldn\'t add to database!');
				echo "Registration successful.";
			}

		if ($_SESSION['reg_error'])
			header ('location: /user_auth/user_signup.php');
	}
	
	function display_errors () {
		if ($_SESSION['reg_error']) {
				echo "<ul>";
				if ($_SESSION['preexisting_user']) {
					echo "<li>This user already exists.</li>";
				}
				else {
					if ($_SESSION['blank_reg_field']) {
						echo "<li>All fields are required.</li>";
					}
					if ($_SESSION['password_mismatch']) {
						echo "<li>Passwords do not match.</li>";
					}
				}
				echo "</ul>";
			}
	}
?>