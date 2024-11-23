<?php ob_start(); ?>

<h2 class="text-center">Connexion</h2>
<form action="" method="POST">

    <div class="form-group">
        <label for="login">Identifiant</label>
        <input type="text" id="login" name="login" class="form-control" maxlength="25" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Se connecter</button>
</form>

<?php
$contenu = ob_get_clean();
include "template.php";