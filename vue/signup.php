<?php ob_start(); ?>

<h2 class="text-center">Inscription</h2>
<form action="" method="POST">
	<div class="form-group">
		<label for="civility">Civilité</label>
		<select id="civility" name="civility" class="form-control" required>
			<option value="M.">M.</option>
			<option value="Mme">Mme</option>
		</select>
	</div>

	<div class="form-group">
		<label for="first_name">Prénom</label>
		<input type="text" id="first_name" name="first_name" class="form-control" maxlength="25" required>
	</div>

	<div class="form-group">
		<label for="last_name">Nom</label>
		<input type="text" id="last_name" name="last_name" class="form-control" maxlength="25" required>
	</div>

	<div class="form-group">
		<label for="login">Identifiant</label>
		<input type="text" id="login" name="login" class="form-control" maxlength="25" required>
	</div>

	<div class="form-group">
		<label for="email">Courriel</label>
		<input type="email" id="email" name="email" class="form-control" maxlength="50" required>
	</div>

	<div class="form-group">
		<label for="phone_number">Téléphone</label>
		<input type="text" id="phone_number" name="phone_number" class="form-control" maxlength="20"
		       required>
	</div>

	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" id="password" name="password" class="form-control" required>
	</div>

	<button type="submit" class="btn btn-primary mt-2">Créer un compte</button>
</form>

<?php
$contenu = ob_get_clean();
include "template.php";