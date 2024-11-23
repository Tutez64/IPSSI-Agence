<?php

class Person {
	private int $id;
	private string $civility;
	private string $first_name;
	private string $last_name;
	private string $login;
	private string $email;
	private string $role;
	private datetime $signup_date;
	private string $phone_number;
	private string $password;

	public function __construct(int $id, string $civility, string $first_name, string $last_name, string $login,
	                            string $email, string $role, datetime $signup_date, string $phone_number, string $password) {
		$this->id = $id;
		$this->civility = $civility;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->login = $login;
		$this->email = $email;
		$this->role = $role;
		$this->signup_date = $signup_date;
		$this->phone_number = $phone_number;
		$this->password = $password;
	}

	public function getId() : int { return $this->id; }
	public function getCivility() : string { return $this->civility; }
	public function getFirstName() : string { return $this->first_name; }
	public function getLastName() : string { return $this->last_name; }
	public function getLogin() : string { return $this->login; }
	public function getEmail() : string { return $this->email; }
	public function getRole() : string { return $this->role; }
	public function getSignupDate() : datetime { return $this->signup_date; }
	public function getPhoneNumber() : string { return $this->phone_number; }
	public function getPassword() : string { return $this->password; }
}