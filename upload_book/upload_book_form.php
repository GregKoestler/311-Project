<?php 
session_start();	
if (is_null($_SESSION['user'])) {
	//echo "need to sign in first";
	header("Location: http://koestleg.myweb.cs.uwindsor.ca/user_auth/user_signin.php");
	exit();
}

?>


<form action="process_book_upload.php" method="post" enctype="multipart/form-data">
	Book title: <input type="text" name="book_title"/> <br />
	ISBN number: <input type="text" name="isbn_number" /> <br />
	Author: <input type="text" name="book_author"/> <br />
	Edition: <input type="text" name="book_edition"/> <br />
	
	University of Windsor course code that uses this book (Eg. 03-60-311): <input type="text" size="9" name="course_code" /> <br />
	
	Condition:
	<select name="book_condition">
	 <option value="Excellent">Excellent (No writing / highlighting inside)</option>
	 <option value="Good">Good (Minimal wrtiting / hightlighting inside)</option>
	 <option value="Usable">Usable (Writing / highlighting inside)</option>
	 <option value="Bad">Bad</option>
	</select> <br />
	Asking price: <input type="text" name="book_price" /> <br />
	Details: <br /><textarea name="book_details" cols="50"></textarea> <br />
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file"><br />

	<input type="submit" value="Upload book to store" />
</form>

