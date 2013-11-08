<?php
	require_once("../db_config/opendb.php");
	
	class SearchResults {
		public $count = 0;
		public $searchText;
		public $page;
		private $textbookRetrievalResult;
		// const NUMPERPAGE = 1;
		
		function __construct($searchFor, $page) {
			$this->searchText = $searchFor;
			$this->page = $page;
			$selectStatement = $this->buildSqlStatement() or die('buildSqlStatement failed');
			$this->textbookRetrievalResult = mysql_query($selectStatement) or die('here');

		}
		
		function buildSqlStatement() {
			$selectStatement = "select id, book_title, book_author, isbn_number, book_price, date_added, book_details from Textbooks where book_deleted = 0 && (";
			$keywords = explode(" ", $this->searchText);
			$flag = false;
			
			foreach ($keywords as $keyword) {
				if ($flag)
					$selectStatement .= "OR ";
				$selectStatement .= 'book_title LIKE "%' . $keyword . '%" OR ';
				$selectStatement .= 'book_author LIKE "%' . $keyword . '%" OR ';
				$selectStatement .= 'isbn_number LIKE "' . $keyword . '" ';

				$flag = true;
			}
			
			
			// echo '<br>' . self::NUMPERPAGE;
			// $selectStatement .= 'limit ' . ($this->page - 1) * self::NUMPERPAGE . ', ' . $this->page * self::NUMPERPAGE;
			$selectStatement .= ") order by date_added desc";
			//echo $selectStatement;
			return $selectStatement;
		}
		
		public function getNextTextbook() {
			return mysql_fetch_assoc($this->textbookRetrievalResult);
		}
		
		public function numResults() {
			return mysql_num_rows($this->textbookRetrievalResult);
		}
	}
	
	function searchTextbooks($searchFor, $page) {
		$searchFor = strip_tags($searchFor);
		$searchFor = mysql_real_escape_string($searchFor);
		$searchFor = trim($searchFor);
		
		$ss = new SearchResults($searchFor, $page);
		
		return $ss;
	}
	
	

?>