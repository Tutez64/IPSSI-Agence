<?php

class UserCtrl {
	public function userActions(): void {

		$userMdl = new UserMdl();

		if(isset($_GET['action'])) {
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


		} else if(isset($_POST['signup'])) {
			extract($_POST);

			$p = new Person(0, $civility, $first_name, $last_name, $login, $email, "Customer", new DateTime(),
				$phone_number, password_hash($password, PASSWORD_DEFAULT));;

			$userMdl->inserer($p);

			header("location: ?action=customer_dashboard");
			exit;

		} else if( isset($_POST['signin']) ){
			extract($_POST);

			$userMdl->login($login, $password);

			header("location: ?action=customer_dashboard");
			exit;
		}
	}

	function isConnected(): bool {
		return isset($_SESSION['user']);
	}

	function isAdmin(): bool {
		return $this->isConnected() && unserialize($_SESSION['user'])->getRole() == "Admin";
	}
}