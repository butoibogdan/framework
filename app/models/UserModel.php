<?php
namespace app\models;
use framework\Model as Model;

class UserModel extends Model{
	// PDO connection - aceasta linie trebuie sa fie in fiecare model
	private $pdo;

	// suprascrierea constructorului din parinte - linia asta trebuie sa fie in fiecare model
	public function __construct(){
		parent::__construct();
		$this->pdo = parent::$_pdo;
	}	

	// Get a list of users
	public function listUser(){
		return $this->pdo->query('SELECT * FROM users');
	}
}