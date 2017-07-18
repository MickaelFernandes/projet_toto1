<!-- <div class="container">
  <h2>Détails Etudiant</h2>
  <ul class="list-group">
    <li class="list-group-item">Last Name: <?=// $studentLastname ?></li>
    <li class="list-group-item">First Name: <?= //$studentFirstname ?></li>
    <li class="list-group-item">Email: <?=// $studentEmail ?></li>
    <li class="list-group-item">Birthday: <?=// $studentBirthday ?></li>
  </ul>
</div> -->

<div id="studentContent"></div>

<script type="text/javascript">
	$(document).ready(function(){
			$.ajax({
				url : "/ajax/student.php",
				method: "POST",
				data: {
					id : <?= 
				}
