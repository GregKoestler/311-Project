<?php
	include('get_book_details.php');
	session_start();
?>

Title: <?php echo $bookDetails['book_title']?> <br />
ISBN Number: <?php echo $bookDetails['isbn_number']?> <br />
Book author: <?php echo $bookDetails['book_author']?> <br />
Edition: <?php echo $bookDetails['book_edition']?> <br />
University of Windsor course code that uses this book: <?php echo $bookDetails['book_course_code']?> <br />
Subject of the book: <?php echo $bookDetails['book_subject']?> <br />
Condition: <?php echo $bookDetails['book_condition']?> <br />


Price: <?php echo $bookDetails['book_price']?> <br />
Details: <?php echo $bookDetails['book_details']?> <br />
Date added: <?php echo $bookDetails['date_added']?> <br />

<!-- Book owners Email: <a href="mailto:<?php echo $bookDetails['owner_username']?>@uwindsor.ca"><?php echo $bookDetails['owner_username']?>@uwindsor.ca</a> -->
Book owner: <a href="../user_profiles/profile.php?user=<?php echo $bookDetails['owner_username']?>"><?php echo $bookDetails['owner_username']?></a>
 (<a href="mailto:<?php echo $bookDetails['owner_username']?>@uwindsor.ca">email</a>)
<br />

<?php if(!is_null($bookDetails['book_image_location']) || !empty($bookDetails['book_image_location'])): ?>
Book image: <br />
	<img src="/upload_book/images/<?php echo $bookDetails['book_image_location'] ?>" alt="textbook" />
<?php endif; ?>

<?php if($_SESSION['user'] == $bookDetails['owner_username']): ?>
	<br /><a href="../delete_book/process_delete.php?bookId=<?php echo $bookDetails['id'];?>">Delete this book from store</a>
<?php endif; ?>