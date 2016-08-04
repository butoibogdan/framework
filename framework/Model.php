<?php
namespace framework;
use framework\Framework as Framework;

class Model {	
	// database connection instance	- singleton
	static protected $_pdo;	

	public function __construct(){
		$this->connectDB();
	}

	/**
	* Singleton pattern
	* Daca, de exemplu, intr-o pagina avem mai multe apelari ale Model-ului, doar o instanta de PDO este creata
	* e.g listare un articol si sub el comentarii - se apeleaza modelul de la articole si cel de la comentarii 
	*/ 
	protected function connectDB(){
		if(is_null(self::$_pdo)){
			$database = Framework::$params['database']['name'];
			$username = Framework::$params['database']['username'];	
			$password = Framework::$params['database']['password'];		
			$options = Framework::$params['database']['options'];

			self::$_pdo = new \PDO("mysql:dbname={$database};host=localhost;port=3306;charset=utf8", $username, $password, $options);
		}else{
			return self::$_pdo;
		}				
	}
       
}