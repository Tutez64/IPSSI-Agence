<?php

abstract class GenericMdl {
	protected PDO $pdo;

	public function __construct(){
		$this->pdo = new PDO("mysql:host=127.0.0.1;dbname=Agency", "Tutez", "tutez", [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
	}

	public function user(){
		return unserialize($_SESSION['user']);
	}

	public function executeReq(string $query, $data = []): false|PDOStatement
	{
		$stmt = $this->pdo->prepare($query);

		foreach($data as $cle => $valeur){
			$data[$cle] = htmlentities($valeur);
		}
		$stmt->execute($data);

		return $stmt;
	}
}