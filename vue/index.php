<?php
session_start();

include "../classes/Person.php";

include "../controllers/UserCtrl.php";

include "../models/GenericMdl.php";
include "../models/UserMdl.php";

$userCtrl = new UserCtrl();
$userCtrl->userActions();

include "template.php";