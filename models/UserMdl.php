<?php


class UserMdl extends GenericMdl {

	public function getUsersByRole(string $role): array {
		$res = $this->executeReq("SELECT * FROM Person WHERE role = :role", [
			"role" => $role
		]);

		$tab = [];

		while($u = $res->fetch()) {
			extract($u);
			$tab[] = new Person($id, $civility, $first_name, $last_name, $login, $email, $role, date_create_from_format('Y-m-d H:i:s', $signup_date),
				$phone_number, $password);
		}

		return $tab;
	}

	public function userById(int $id): Person {
		$stmt = $this->executeReq("SELECT * FROM Person WHERE id = :id", ["id" => $id]);

		extract($stmt->fetch());

		return new Person($id, $civility, $first_name, $last_name, $login, $email, $role, date_create_from_format('Y-m-d H:i:s', $signup_date),
			$phone_number, $password);
	}

	public function inserer(Person $p) {
		$query = "INSERT INTO Person VALUES(NULL, :civility, :first_name, :last_name, :login, :email, 'Customer',
                            now(), :phone_number, :password)";

		$this->executeReq($query, [
			"civility"     => $p->getCivility(),
			"first_name"   => $p->getFirstName(),
			"last_name"    => $p->getLastName(),
			"login"        => $p->getLogin(),
			"email"        => $p->getEmail(),
			"phone_number" => $p->getPhoneNumber(),
			"password"     => $p->getPassword()
		]);

		//RECUP DERNIER ID INSERE
		$lastId = $this->pdo->lastInsertId();

		$_SESSION['user'] = serialize( $this->userById($lastId) );

		header("location: ?action=dashboard");
		exit;
	}

	public function login(string $login, string $password): ?string {
		$query = "SELECT * FROM Person WHERE login = ?";

		$stmt = $this->pdo->prepare($query);

		$stmt->execute([$login]);

		//SI LOGIN EST TROUVE DANS BD
		if($stmt->rowCount() != 0) {
			$res = $stmt->fetch();
			//TEST SUR MDP
			if( password_verify($password, $res['password']) ){
				extract($res);

				$p = new Person($id, $civility, $first_name, $last_name, $login, $email, $role, date_create_from_format('Y-m-d H:i:s', $signup_date),
					$phone_number, $password);

				//SESSION
				$_SESSION['user'] = serialize($p);

				return $_SESSION['user'];
			}
		}
		return null;
	}

	public function addEntry(string $table, array $data): void {
		array_pop($data);
		array_pop($data);

		if (isset($data['password'])) {
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		}

		$keys = implode(', ', array_keys($data));
		$values = "'" . implode("', '", array_values($data)) ."'";
		$query = "INSERT INTO $table ($keys) VALUES ($values)";
		$query = str_replace("''", 'DEFAULT', $query);
		$this->executeReq($query);
	}

	public function delEntry(string $table, string $id): void {
		$query = "DELETE FROM $table WHERE id = :id";
		$this->executeReq($query, ["id" => $id]);
	}
}