<?php
//inclure le ficher config
require "../inc/config.php";
//
//
//
//PARTIE 4 --- ADD ! Nouveau student
if (!empty($_POST)) {

	$lastnameAdd = isset($_POST['lastname']) ? strip_tags(strtoupper(trim($_POST['lastname']))) : '';
	$firstnameAdd = isset($_POST['firstname']) ? strip_tags(strtoupper(trim($_POST['firstname']))) : '';
	// Je considère les données valides avant de les valider
	$formValid = true;

	// 2 - Validation des données
	if (empty($lastnameAdd)) {
		$formValid = false;
		// echo 'Veuillez renseigner le champ nom<br>';
	}
	else if (strlen($lastnameAdd) < 2) {
		$formValid = false;
		// echo 'Le champ nom doit contenir au moins 2 caractères<br>';
	}
	//
	if (empty($firstnameAdd)) {
		$formValid = false;
		// echo 'Veuillez renseigner le champ prénom<br>';
	}
	else if (strlen($firstnameAdd) < 2) {
		$formValid = false;
		// echo 'Le champ prénom doit contenir au moins 2 caractères<br>';
	}
	//
	//
	// EXO 1 for upload formulaire
	define( "__UPLOAD_DIR___", dirname( __FILE__ ).DIRECTORY_SEPARATOR."files".DIRECTORY_SEPARATOR );
	echo __UPLOAD_DIR___ , "<br />";

	print_r( $_REQUEST );
 	print_r( $_FILES );
	if(!empty( $_FILES )){
		foreach ( $_FILES as $inputName => $fileData ) {

			echo "copy from ".$fileData["tmp_name"]."<br />"; //parti non necessaire !!!!!!!!!!!!!
			echo "to ".__UPLOAD_DIR___.$fileData["name"]."<br />"; //parti non necessaire !!!!!!!!!!!!!

			$tmpExplode = explode( ".", $fileData["name"] );
			$extension = end( $tmpExplode );
			$uploadFilename = __UPLOAD_DIR___.$fileData["name"].".".$extension;
			$allowedExtensions = array( "jpg" , "jpeg" , "gif" , "svg" , "png" );

			//in_array(wat ech sichen , wou ech et siichen)
			if ( !in_array($extension, $allowedExtensions) ) {
				echo "<br />Ficher invalide ! File can't be uploaded ! <br />";
			}
			else{
				if(	move_uploaded_file( $fileData["tmp_name"], $uploadFilename ) ) {
					echo "UPLOAD IS DONE! OKAY. <br />";
				}
			}
		}
	}
	else{
		echo "<br />formValid ass net valide am upload!<br />";
		$formValid = false;
	}

	//
	//
	// Si aucune erreur
	if ($formValid) {
		$sql_ADD = "INSERT INTO student (
																			stu_id,
																			stu_lastname,
																			stu_firstname,
																			stu_birthdate,
																			stu_email,
																			stu_friendliness,
																			stu_inserted,
																			session_ses_id,
																			city_cit_id
																		)
								VALUES (
												NULL,
												:lastnameAdd,
												:firstnameAdd,
												NULL,
												NULL,
												NULL,
												CURRENT_TIMESTAMP,
												'',
												''
											);
							";

		$pdoStatement_ADD = $pdo->prepare($sql_ADD);
		$pdoStatement_ADD->bindValue(':lastnameAdd', $lastnameAdd, PDO::PARAM_STR);
		$pdoStatement_ADD->bindValue(':firstnameAdd', $firstnameAdd, PDO::PARAM_STR);

		if ($pdoStatement_ADD->execute() === false ) { // Si erreur
			print_r($pdoStatement_ADD->errorInfo());
		}
		else {
			// header to redirect to student.php
			$studentLastInsertedID = $pdo->lastInsertId();
			header('Location: student.php?id='.$studentLastInsertedID);
		}
	}
}


//
//
//
// PARTIE 4 - OPTION/SELECT City / seccion

// city
$sql_city = "	SELECT cit_name
							FROM city
							ORDER BY cit_name ASC
					";

$pdoStatement_city = $pdo->query($sql_city);

if ($pdoStatement_city === false) {
	print_r($pdo->errorInfo());
}
else {
	$cityList = $pdoStatement_city->fetchAll(PDO::FETCH_ASSOC);
}


// secction
$sql_ses = "	SELECT ses_number
							FROM session
							ORDER BY ses_number ASC
					";

$pdoStatement_ses = $pdo->query($sql_ses);

if ($pdoStatement_ses === false) {
	print_r($pdo->errorInfo());
}
else {
	$sesList = $pdoStatement_ses->fetchAll(PDO::FETCH_ASSOC);
}
//
//
//
require "../view/header.php";
require "../view/add.php";
require "../view/footer.php";
//
 ?>
