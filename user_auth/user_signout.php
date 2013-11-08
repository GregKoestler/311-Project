<?php
require_once("../libs/libs.php");

unset($_SESSION['loggedinas']);
unset($_SESSION['user']);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>University of Windsor Used Book Store - Sign Out</title>
	</head>
	<body>
		
		<?php generateHeader();	?>	
		<p>You have successfully logged out.</p>
	</body>
</html>