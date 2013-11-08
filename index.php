<?php
session_start();
require_once("libs/libs.php");
//Connect to the database
require_once("db_config/opendb.php");
require_once("book_search/get_recent.php");
require_once("book_search/row_template.php");
?>

<html>
<head>
	<title>University of Windsor Used Book Store</title>

	<link rel="stylesheet" href="main.css" type="text/css" /> 
</head>
<body>
<?php generateHeader(); ?>
Recently Added Textbooks
<table id="mainTable">
	<tbody>
	
	<?php $recent = getRecentTextbooks();
	 while($textbook = mysql_fetch_assoc($recent)) {
		createRow($textbook);
	}
	?>
	</tbody>
</table>

</body>
</html>