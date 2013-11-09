<?php
	require_once("../db_config/opendb.php");
	
	$table_name="Textbooks";
	$book_id = $_GET['bookId'];
	$sql = sprintf("select * from %s where id = %s", $table_name, $book_id);
	
	$bookDetailsResults = mysql_query($sql) or die('couldn\'t retrieve from database');
	$bookDetails = mysql_fetch_assoc($bookDetailsResults);
	
	//Convert the db entry value to a formated version to display to the users
	$bookDetails['book_subject'] = convert_subject_text ($bookDetails['book_subject']);
	
	//Convert all db value for book subject into a formated version to display to the users
	function convert_subject_text ($subject) {
		$formatedSubject = "No subject selected";
		
		switch ($subject) {
			case "Biology": $formatedSubject = "Biology"; break;
			case "Business": $formatedSubject = "Business"; break;
			case "ChemistryBiochemistry": $formatedSubject = "Chemistry &amp; Biochemistry"; break;
			case "Classics": $formatedSubject = "Classics"; break;
			case "ComunicationsMediaFilm": $formatedSubject = "Communications, Media and Film"; break;
			case "ComputerScience": $formatedSubject = "Computer Science"; break;
			case "Drama": $formatedSubject = "Dramatic Art"; break;
			case "EnvironmentalScience": $formatedSubject = "Earth and Environmental Science"; break;
			case "Economics": $formatedSubject = "Economics"; break;
			case "Education": $formatedSubject = "Education"; break;
			case "Engineering": $formatedSubject = "Engineering"; break;
			case "English": $formatedSubject = "English"; break;
			case "HumanKinetics": $formatedSubject = "Human Kinetics"; break;
			case "LabourStudies": $formatedSubject = "Labour Studies"; break;
			case "Languages": $formatedSubject = "Languages, Literatures and Cultures"; break;
			case "Math": $formatedSubject = "Mathematics and Statistics"; break;
			case "Music": $formatedSubject = "Music"; break;
			case "Nursing": $formatedSubject = "Nursing"; break;
			case "Philosophy": $formatedSubject = "Philosophy"; break;
			case "Physics": $formatedSubject = "Physics"; break;
			case "PoliticalScience": $formatedSubject = "Political Science"; break;
			case "Psychology": $formatedSubject = "Psychology"; break;
			case "SocialWork": $formatedSubject = "Social Work"; break;
			case "SociologyAnthropologyCriminology": $formatedSubject = "Sociology, Anthropology and Criminology"; break;
			case "VisualArt": $formatedSubject = "Visual Arts"; break;
			case "WomensStudies": $formatedSubject = "Women's Studies"; break;
		}	
		return $formatedSubject;
	}
	
?>