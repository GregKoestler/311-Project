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
	
	Subject of the book:
	<select name="book_subject">
	  <option value="">Choose a field of study</option>
	  <option value="Biology">Biology</option>
	  <option value="Business">Business</option>
	  <option value="ChemistryBiochemistry">Chemistry &amp; Biochemistry</option>
	  <option value="Classics">Classics</option>
	  <option value="ComunicationsMediaFilm">Communications, Media and Film</option>
	  <option value="ComputerScience">Computer Science</option>
	  <option value="Drama">Dramatic Art</option>
	  <option value="EnvironmentalScience">Earth and Environmental Science</option>
	  <option value="Economics">Economics</option>
	  <option value="Education">Education</option>
	  <option value="Engineering">Engineering</option>
	  <option value="English">English</option>
	  <option value="History">History</option>
	  <option value="HumanKinetics">Human Kinetics</option>
	  <option value="LabourStudies">Labour Studies</option>
	  <option value="Languages">Languages, Literatures and Cultures</option>
	  <option value="Math">Mathematics and Statistics</option>
	  <option value="Music">Music</option>
	  <option value="Nursing">Nursing</option>
	  <option value="Philosophy">Philosophy</option>
	  <option value="Physics">Physics</option>
	  <option value="PoliticalScience">Political Science</option>
	  <option value="Psychology">Psychology</option>
	  <option value="SocialWork">Social Work</option>
	  <option value="SociologyAnthropologyCriminology">Sociology, Anthropology and Criminology</option>
	  <option value="VisualArt">Visual Arts</option>
	  <option value="WomensStudies">Women's Studies</option>
	</select>
	<br />
		
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

