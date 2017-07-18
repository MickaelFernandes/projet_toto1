<?php

// For nav
$currentPage = 'reset';

// J'inclus le fichier de config
require '../inc/config.php';

// VOTRE CODE
// Initialisations
$token = isset($_GET['token']) ? trim(strip_tags($_GET['token'])) : '';

// Vérification du token (GET et POST)
$userData = getUserByToken($token);
if ($userData === false) {
	// TODO tester la date d'expiration du token
	$errorList[] = 'Token non reconnu';
}
else {
	if (!empty($_POST)) {
		// Récupération & Traitement des données
		$password1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
		$password2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';

		// Validation des données
		$formValid = true;

		if (empty($password1) || empty($password2)) {
			$formValid = false;
			$errorList[] = 'Le password est vide';
		}
		if ($password1 !== $password2) {
			$formValid = false;
			$errorList[] = 'Les password sont différents';
		}
		if (strlen($password1) < 6 || strlen($password2) < 6) {
			$formValid = false;
			$errorList[] = 'Le password doit faire au moins 6 caractères';
		}

		// Si tout est ok => on ajoute en DB
		if ($formValid) {
			$sql = "
				UPDATE user
				SET usr_token = '',
				usr_password = :password
				WHERE usr_id = :id
			";
			// Prepare la requete
			$pdoStatement = $pdo->prepare($sql);
			// bindValues
			$pdoStatement->bindValue(':id', $userData['usr_id']);
			$pdoStatement->bindValue(':password', password_hash($password1, PASSWORD_BCRYPT));

			// Execution
			if ($pdoStatement->execute() === false) {
				print_r($pdoStatement->errorInfo());
			}
			// Si aucun erreur SQL
			else {
				$successList[] = 'Votre mot de passe a été mis à jour';
			}
		}
	}
}

// FIN CODE

// J'inclus les vues
require dirname(dirname(__FILE__)).'/view/header.php';
require dirname(dirname(__FILE__)).'/view/reset_password.php';
require dirname(dirname(__FILE__)).'/view/footer.php';