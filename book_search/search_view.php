<?php
require_once("../libs/libs.php");
require_once("search_back.php");
require("row_template.php");
?>

<html>
<head>
	<link rel="stylesheet" href="../main.css" type="text/css" /> 
</head>
<body>
<?php 

// Generate main header
generateHeader();

// retrieve search criteria
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$input = $_POST['searchFor'];
$count = 0;

if (trim($input) == "") {
	echo $count;
}
else {
	$searchResults = searchTextbooks($input, 1);
	echo 'Your search for "' . $searchResults->searchText . '" returned ' . $searchResults->numResults() . ' results';
	
	echo '<table id="mainTable">';
	echo '<tbody>';
	while ($textbook = $searchResults->getNextTextbook()) {
		createRow($textbook);
	}
	echo '</tbody>';
	echo '</table>';
}

?>
</body>
</html>