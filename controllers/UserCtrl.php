<?php

class UserCtrl {
	public function userActions(): void {
		$userMdl = new UserMdl();

		if(isset($_GET['action'])){
			$action = $_GET['action'];

			switch($action){
				case "logout":
					session_destroy();
					header("location: .");
					exit;

				case "customer":
					$customers = $userMdl->getUsersByRole("Customer");
					var_dump($customers); // Mettre une vue pour l'affichage
					exit;
			}


		} else if( isset($_POST['signup']) ){
			extract($_POST);

			$p = new Person($id, $civility, $first_name, $last_name, $login, $email, "Customer", $signup_date,
				$phone_number, password_hash($password, PASSWORD_DEFAULT));;

			$userMdl->inserer($p);

			header("location: ?action=customer_dashboard");
			exit;

		} else if( isset($_POST['signin']) ){
			extract($_POST);

			$userMdl->login($login, $mdp);

			header("location: ?action=customer_dashboard");
			exit;
		}
	}
}