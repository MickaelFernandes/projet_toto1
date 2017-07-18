<?php
//inclure le ficher config
require "../inc/config.php";

// PARTIE 3 ---
$sql_GET = "SELECT 	stu_id,
								stu_lastname,
								stu_firstname,
								stu_email,
								stu_birthdate
				FROM student
				LEFT OUTER JOIN city
														ON city.cit_id = student.city_cit_id
				LEFT OUTER JOIN country
														ON country.cou_id = city.country_cou_id
        WHERE stu_id = :idStudent
      ";


$studentID = isset($_GET['id']) ? trim($_GET['id']) : 0;

$pdoStatement = $pdo->prepare($sql_GET);
$pdoStatement->bindValue(':idStudent', $studentID, PDO::PARAM_INT);

if ($pdoStatement->execute() === false ) { // Si erreur
	print_r($pdoStatement->errorInfo());
}
else {
	$studentInfos = $pdoStatement->fetch(PDO::FETCH_ASSOC);

  $studentLastname = $studentInfos['stu_lastname'];
  $studentFirstname = $studentInfos['stu_firstname'];
  $studentEmail = $studentInfos['stu_email'];
  $studentBirthday = $studentInfos['stu_birthdate'];

	// print_r($studentInfos);
}


//
require "../view/header.php";
require "../view/student.php";
require "../view/footer.php";

 ?>
