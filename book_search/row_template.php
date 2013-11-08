<?php

	function createCell($cell) {
		return '<td>' . $cell . '</td>';
	}
	
	function createDate($date) {
		return date("F j, Y", strtotime($date));
	}


	function createRow($textbook) {
		echo '<tr><td>';
		//Link to page displaying all book details
		echo '<a href="/book_details/book_details.php?bookId=\'' . $textbook['id'] . '\'"> '. $textbook['book_title'] . '</a>' ;
		if ($textbook['book_author'] != "")
			echo ' By ' . $textbook['book_author'];
		echo '<br>';		
		echo $textbook['book_details'];
		
		echo '</td>';
		
		echo createCell('$' . $textbook['book_price']);
		
		echo createCell(createDate($textbook['date_added']));
		
		echo '</td></tr>';
	}
	
	
	
?>