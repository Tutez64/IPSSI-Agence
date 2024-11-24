<?php ob_start(); ?>
<h1>Bienvenue sur votre tableau de bord</h1>
<?php
$contenu = ob_get_clean();
include "template.php";
