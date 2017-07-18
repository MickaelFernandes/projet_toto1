	<style media="screen">
		#city{
			margin-bottom: 20px;
		}
	</style>

	<body>
		<div class="container">
			<br>
			<div class="panel panel-success" style="max-width:400px;margin:auto;">
				<div class="panel-heading">
					<h3 class="panel-title">Form</h3>
				</div>
				<div class="panel-body">
					<form action="add.php" method="post" enctype="multipart/form-data">
						<fieldset>
							<strong>Nom</strong><br />
							<input type="text" class="form-control" value="" name="lastname" /><br />
							<strong>Prénom</strong><br />
							<input type="text" class="form-control" value="" name="firstname" /><br />

							<strong>City</strong><br / />
							<select class="form-control" id="city">
								<option>Select a City</option>

								<?php foreach ($cityList as $cityKey => $cityValue) : ?>
								<option value=<?=$cityKey?>> <?= $cityValue["cit_name"] ?> </option>
								<?php endforeach; ?>
							</select>


							<strong>Session</strong><br />
							<select class="form-control">
								<option>Select a Session</option>

								<?php foreach ($sesList as $sesKey => $sesValue) : ?>
								<option value=<?=$sesKey?>> <?= $sesValue["ses_number"] ?> </option>
								<?php endforeach; ?>
							</select>


							<!-- EXO 1 - Upload images -->
							<label for="fileForm"><strong>Image</strong></label>
							<input type="file" name="fileForm" id="fileForm" />
							<!-- EXO 1 - Upload images -->


							<br>
							<input type="submit" class="btn btn-success" value="Valider" />
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</body>
