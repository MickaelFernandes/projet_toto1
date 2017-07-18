<?php

// Fichier de config
require dirname(dirname(dirname(__FILE__))).'/inc/config.php';

if (!empty($_POST)) {
	// Je récupère la donnée
	$studentId = isset($_POST['id']) ? intval($_POST['id']) : 0;

	// Récupération du code de public/student.php
	$studentLastname = '';
	$studentFirstname = '';
	$studentEmail = '';
	$studentBirthdate = '';
	$studentAge = '';
	$studentFriendliness = '';
	$studentCity = '';
	$studentCountry = '';

	$sql = '
		SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness, stu_email, stu_birthdate
		FROM student
		LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
		LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id
		WHERE stu_id = :idStudent
	';
	$pdoStatement = $pdo->prepare($sql); //=>prepare car donnée "externe"
	$pdoStatement->bindValue(':idStudent', $studentId, PDO::PARAM_INT);

	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else {
		$studentInfos = $pdoStatement->fetch(PDO::FETCH_ASSOC);
		//print_r($studentListe);
		$studentLastname = $studentInfos['stu_lastname'];
		$studentFirstname = $studentInfos['stu_firstname'];
		$studentEmail = $studentInfos['stu_email'];
		$studentBirthdate = $studentInfos['stu_birthdate'];
		$studentFriendliness = getSympathieLabelFromId($studentInfos['stu_friendliness']);
		$studentAge = calculAge($studentBirthdate);
		$studentCity = $studentInfos['cit_name'];
		$studentCountry = $studentInfos['cou_name'];

		?>
		<ul>
			<li>Nom : <?= $studentLastname ?></li>
			<li>Prénom : <?= $studentFirstname ?></li>
			<li>Email : <?= $studentEmail ?></li>
			<li>Date de naissance : <?= $studentBirthdate ?></li>
			<li>Age : <?= $studentAge ?></li>
			<li>Sympathie : <?= $studentFriendliness ?></li>
			<li>Ville : <?= $studentCity ?></li>
			<li>Pays : <?= $studentCountry ?></li>
  		</ul>
  		<?php
	}
}