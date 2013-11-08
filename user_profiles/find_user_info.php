<?php
	session_start();
	require_once("../db_config/opendb.php");
	require_once("../book_search/row_template.php");

	if (isset($_GET['user'])) {	 // ?user=xyz is set; use this value (if valid) as $user
		$user = $_GET['user'];
		$sql_user = sprintf ("select * from users where id = '%s'", $user);
		$user_confirm = mysql_query($sql_user) or die('couldn\'t retrieve from the database.');
		if (mysql_num_rows($user_confirm) == 0) {	// specified user not found
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php">';
			exit;
		}
	}
	else if (isset($_SESSION['user']))	// if ?user=xyz is not set, use current login
		$user = $_SESSION['user'];
	else {						// otherwise redirect to homepage
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php">';
		exit;
	}
		
	$sql_books = sprintf ("select * from Textbooks where owner_username = '%s' and book_deleted = '0'", $user);
	$book_list = mysql_query($sql_books) or die ('couldn\'t retrieve from the database.');
	
	$sql_user = sprintf ("select fname, lname, id from users where id = '%s'", $user);
	$user_query = mysql_query($sql_user);
	$user_info = mysql_fetch_assoc ($user_query);

	function list_user_books () {
		global $book_list, $user_info;
		if (mysql_num_rows($book_list) == 0)
			echo $user_info['fname'] . " does not have any textbooks for sale right now.";
		else {
			echo "<table id=\"userBooks\" width=\"75%\"><tbody>";
			while ($book = mysql_fetch_assoc($book_list)) {
				createRow($book); // use constant format for displaying book information
				/*echo <<<END
					<tr><td><a href="../book_details/book_details.php?bookId={$book['id']}">{$book['book_title']}</a><br />
					Description...</td>
					<td>${$book['book_price']}</td>
					<td>{$book['date_added']}</td></tr>	
END;
*/
			}
			echo "</tbody></table>";
		}
	}
?>