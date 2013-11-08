<?php 
	require_once("../db_config/opendb.php");
	$table_name = "Textbooks";
	//Set the deleted flag for the specified book
	$sql = sprintf("update %s set book_deleted = '1' where id = '%s'", $table_name, mysql_real_escape_string($_GET['bookId']));
	
	//echo $sql;
	$bookDetailsResult = mysql_query($sql) or die('couldn\'t update database');
	//print receipt
?>
<h3>Your book was deleted</h3>
<a href="http://koestleg.myweb.cs.uwindsor.ca">Return home</a>