<?php 
session_start();	


	require_once("../db_config/opendb.php");

//Flag used to see if an image was uploaded or not
$imageFileLocation = null;

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 800000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    //echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    /*
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    */
    if (file_exists("images/" . $_FILES["file"]["name"]))
      {
      //echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "images/" . $_FILES["file"]["name"]);
      //echo "Stored in: " . "images/" . $_FILES["file"]["name"];
      $imageFileLocation = $_FILES["file"]["name"];
      }
    }
  }
else
  {
  //echo "Invalid file or no file";
  }


	//Database table values
	$table_name="Textbooks";
	$db_book_title ="book_title";
	$db_book_author ="book_author";
	$db_isbn_number="isbn_number";
	$db_price="book_price";
	$db_edition="book_edition";
	$db_book_courseCode="book_course_code";
	$db_book_condition="book_condition";
	$db_book_details="book_details";
	$db_book_image="book_image_location";
	$db_book_owner="owner_username";
	
	//Insert with a picture location file 
	//Else insert book to DB without the file location specified
	if (!is_null($imageFileLocation)) {
		$sql = sprintf("insert into %s (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s) values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
		$table_name,
		
		$db_book_title,
		$db_book_author,
		$db_isbn_number,
		$db_price,
		$db_edition,
		$db_book_courseCode,
		$db_book_condition,
		$db_book_details,
		$db_book_image,
		$db_book_owner,
		
		mysql_real_escape_string($_POST["book_title"]),
		mysql_real_escape_string($_POST["book_author"]),
		mysql_real_escape_string($_POST["isbn_number"]),
		mysql_real_escape_string($_POST["book_price"]),
		mysql_real_escape_string($_POST["book_edition"]),
		mysql_real_escape_string($_POST["course_code"]),
		mysql_real_escape_string($_POST["book_condition"]),
		mysql_real_escape_string($_POST["book_details"]),
		$imageFileLocation,
		$_SESSION['user']
		);
	} else {
		$sql = sprintf("insert into %s (%s, %s, %s, %s, %s, %s, %s, %s, %s) values ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
		$table_name,
		
		$db_book_title,
		$db_book_author,
		$db_isbn_number,
		$db_price,
		$db_edition,
		$db_book_courseCode,
		$db_book_condition,
		$db_book_details,
		$db_book_owner,
		
		mysql_real_escape_string($_POST["book_title"]),
		mysql_real_escape_string($_POST["book_author"]),
		mysql_real_escape_string($_POST["isbn_number"]),
		mysql_real_escape_string($_POST["book_price"]),
		mysql_real_escape_string($_POST["book_edition"]),
		mysql_real_escape_string($_POST["course_code"]),
		mysql_real_escape_string($_POST["book_condition"]),
		mysql_real_escape_string($_POST["book_details"]),
		$_SESSION['user']
		);

	}
//echo $sql;
$bookDetailsResult = mysql_query($sql) or die('couldn\'t add to database');

//Upload was successful so print a receipt!
?>
<h3>The following textbook information was uploaded successfully!</h3>
Book title:  <?php echo $_POST["book_title"]?><br />
ISBN number: <?php echo $_POST["isbn_number"]?> <br />
Author: <?php echo $_POST["book_author"]?><br />
Edition: <?php echo $_POST["book_edition"]?> <br />
	
University of Windsor course code that uses this book: <?php echo $_POST["course_code"]?><br />
	
Condition:<?php echo $_POST["book_condition"]?>
Asking price: <?php echo $_POST["book_price"]?> <br />
Details: <?php echo $_POST["book_details"]?> <br />

<?php if(!is_null($imageFileLocation)): ?>
Book image: <br />
	<img src="/upload_book/images/<?php echo $imageFileLocation ?>" alt="textbook" />
<?php endif; ?>
<br />
<a href="http://koestleg.myweb.cs.uwindsor.ca">Return to home</a>