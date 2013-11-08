<?php
	require_once("../db_config/opendb.php");
	
	$table_name="Textbooks";
	$book_id = $_GET['bookId'];
	$sql = sprintf("select * from %s where id = %s", $table_name, $book_id);
	
	$bookDetailsResults = mysql_query($sql) or die('couldn\'t retrieve from database');
	$bookDetails = mysql_fetch_assoc($bookDetailsResults)
	
?>