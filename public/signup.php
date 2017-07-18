<html>

<?php
// connextion a la base de donnees
require "inc/config.php";
// initialisation
$errorList = array();
$email = "";


if ( !empty($_POST) ) {
	//traitement des données
	$email = isset( $_POST["emailToto"] ) ? strip_tags( trim( $_POST["emailToto"] ) ) : "" ;
	$password1 = isset( $_POST["passwordToto1"] ) ? trim( $_POST["passwordToto1"] ) : "" ;
	$password2 = isset( $_POST["passwordToto2"] ) ? trim( $_POST["passwordToto2"] ) : "" ;

	// validation des données
	$formValid = true;

	// verification email
	if ( empty( $email ) ) {
		$formValid = false;
		$errorList["emailToto"][] = "l'e-mail est vide";
	}
	else if ( filter_var ( $email , FILTER_VALIDATE_EMAIL ) === false ) {
		$formValid = false;
		$errorList["emailToto"][] = "l'e-mail est invalide";
	}
	// verification passwords
	if ( empty( $password1 ) || empty( $password2 ) ) {
		$formValid = false;
		$errorList["passwordToto"][] = "l'password est vide";
	}
	else if ( $password1 !== $password2 ) { //!!!!! -> !== den 2x == zeechen ass dofir do dat hien dat genee op d'lettre huelt , sooss wann ee 000 typt and 00000 ... geif hien just 0 = 0 huelen an net genee 000 = 00000
		$formValid = false;
		$errorList["passwordToto"][] = "Le password sont differents";
	}
	else if ( strlen( $password1 ) < 6 || strlen( $password2 ) < 6 ){
		$formValid = false;
		$errorList["passwordToto"][] = "Le password doit faire au moins 6 caracteres";
	}

	// si tout est valide :
	if ( $formValid ) {
		$sql = "INSERT INTO user (
															usr_email,
															usr_password,
															usr_date_creation
														)
						VALUES (
										:email,
										:password,
										NOW()
									)
		";
	}
	// prepare la requete
	$pdoStatement = $pdo -> prepare( $sql );
	// bindvalue
	$pdoStatement -> bindValue( ":email" , $email );
	//
	// clear password
	// $hashedpassword = $password
	// md5 :
	// $hashedPassword = md5( $password1 );
	// md5 + Salt :
	// $hashedPassword = md5( "salt à_moi:)".$password1 );
	// password_hash :
	$hashedPassword = password_hash( $password1, PASSWORD_BCRYPT);
	//
	//
	//bind the password
	$pdoStatement -> bindValue( ":password" , $hashedPassword );
	//
	// execution
	if ( $pdoStatement -> execute() === false ){
		print_r( $pdoStatement -> errorInfo() );
	}
	else{
		// si aucune erreur sql
		$successList[] = "Votre inscription a bien été prise en compte";
	}
	print_r( $errorList );
}
?>


	<head>
		<title>User sign up</title>
		<meta charset="utf-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	</head>

	<body>
			<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-2 col-xs-0"></div>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="page-header">
			  			<h1>Sign up</h1>
					</div>

					<form
						method="POST"
						action=""
					>
						<fieldset>
							<input
								type="email"
								class="form-control"
								name="emailToto"
								value="<?php $email ?>"
								placeholder="Email address"
							/>
								<br />
							<input
								type="password"
								class="form-control"
								name="passwordToto1"
								value=""
								placeholder="Your password"
							/>
								<br />
							<input
								type="password"
								class="form-control"
								name="passwordToto2"
								value=""
								placeholder="Confirm your password"
							/>
								<br />
							<input
								type="submit"
								class="btn btn-success btn-block"
								value="Sign up"
							/>
						</fieldset>
					</form>

				</div>
				<div class="col-md-2 col-sm-2 col-xs-0"></div>
			</div>
		</div>
	</body>

</html>

<?php

require "../view/header.php";
require "../view/home.php";
require "../view/footer.php";
 ?>
