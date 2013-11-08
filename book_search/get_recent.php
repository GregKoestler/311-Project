<?php
	require_once("db_config/opendb.php");
	
	function getRecentTextbooks() {
			$selectStatement = "select id, book_title, book_author, isbn_number, book_price, date_added, book_details from Textbooks where book_deleted = '0' order by date_added desc limit 0, 20";
			return mysql_query($selectStatement);		
	}

?>