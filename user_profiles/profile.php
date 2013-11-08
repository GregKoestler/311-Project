<?php
	include("find_user_info.php");
	require_once("../libs/libs.php");
?>

<html>
	<head>
		<title>University of Windsor Used Book Store - Register</title>
	</head>
	<body>
		<?php generateHeader(); ?>
		Name: <?php echo $user_info['fname'] ?> <?php echo $user_info['lname'] ?> <br />
		Email: <a href="mailto:<?php echo $user ?>@uwindsor.ca"><?php echo $user ?>@uwindsor.ca</a> <br /><br />
		
		<?php list_user_books();?>
	</body>
</html>