<?php 
	require_once("../db_config/opendb.php");
	/*
	<form action="process_book_upload.php" method="post">
	Book title: <input type="text" name="book_name"/> <br />
	ISBN number: <input type="text" name="isbn_number" /> <br />
	Asking price: <input type="text" name="book_price" /> <br /> 	
	<input type="submit" />
</form>
*/

echo $_POST["book_name"];
echo $_POST["isbn_number"];
echo $_POST["book_price"];


	//Database table values
	$table_name="";
	$db_book_title ="";
	$db_isbn_number="";
	$db_price="";
	
	$sql = sprintf("insert into %s (%s, %s, %s) values ('%s','%s','%s')",
	$table_name,
	
	$db_book_title ="a",
	$db_isbn_number="b",
	$db_price="c",
	
	mysql_real_escape_string($_POST["book_name"]),
	mysql_real_escape_string($_POST["isbn_number"]),
	mysql_real_escape_string($_POST["book_price"])
	);

echo $sql;


?>