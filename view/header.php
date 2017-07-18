<!DOCTYPE html>
<html lang="en">

<head>
	<title>Projet TO TO</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style media="screen">
		#lognav{
			margin-left: 600px;
		}
		#btnLogin{
			margin-top: 10px;
		}
		#navLogin{
			text-decoration: none;
			color: grey;
		}
		#navLogin:hover{
			background-color: black;
			color: white;
		}
	</style>
</head>

<body>

	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">PHP Project</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="index.php">Home</a></li>
	      <li><a href="index.php">Les sessions</a></li>
	      <li><a href="list.php">Les étudiants</a></li>
	      <li><a href="add.php">Ajouter un étudiant</a></li>
	    </ul>
	    <form class="navbar-form navbar-left">
	      <div class="input-group">
	        <input type="text" class="form-control" placeholder="Search" name="s">
	        <div class="input-group-btn">
	          <button class="btn btn-default" type="submit">
	            <i class="glyphicon glyphicon-search"></i>
	          </button>
	        </div>
	      </div>
				<ul class="nav navbar-right" id="lognav">
				 <li class="dropdown" id="menuLogin">
					 <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login</a>
					 <div class="dropdown-menu" style="padding:17px;">
						 <form class="form" id="formLogin">
							 <input name="username" id="username" type="text" placeholder="Username">
							 <input name="password" id="password" type="password" placeholder="Password"><br>
							 <button type="button" id="btnLogin" class="btn">Login</button>
							 <a href="forgot_password.php">Forgot pass?</a>
						 </form>
					 </div>
				 </li>
			 </ul>
	    </form>
	  </div>
	</nav>
