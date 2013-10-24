<?php
//Connect to the database
require_once("db_config/opendb.php");


// Get all textbooks
$textbookRetrievalSql = "select id, book_title, book_author, isbn_number, book_price, date_added from Textbooks";
$textbookRetrievalResult = mysql_query($textbookRetrievalSql);

?>

<html>
<head>
	<title>University of Windsor Used Book Store</title>

	<link rel="stylesheet" href="main.css" type="text/css" /> 
</head>
<body>
<header id="banner">
	<h1>University of Windsor Used Book Store</h1>
	<nav><ul>
		<li><a href="#">Home</a></li>
		<li><a href="/upload_book/upload_book_form.php">Upload a textbook</a></li>
		<li><a href="/user_auth/user_signup.php">Sign Up</a></li>
		<li><a href="/user_auth/user_signin.php">Login</a></li>
	</ul></nav>

</header>

<table id="mainTable">
	<tbody>
	<?php while($textbook = mysql_fetch_assoc($textbookRetrievalResult)): ?>
		<tr>
			<td>
				<a><?php echo $textbook['book_title']?></a> <!-- Link to page displaying all book details -->
				<br>
				Description....
			</td>
			<td>
				$<?php echo $textbook['book_price']?>
			</td>
			<td>
				<?php echo $textbook['date_added']?>
			</td>
		</tr>
	<?php endwhile;?>
	</tbody>
</table>

</body>
</html>