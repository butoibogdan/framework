<?php

namespace framework;

use framework\Framework;
use framework\Session;
use framework\Request;
use PDO;

class Auth extends Model {

    private $pdo;
    private $table;
    private $user;
    private $pass;
    private $id;
    private $key;
    private $username;
    private $password;

    public function __construct() {
        parent::__construct();
        $this->pdo = parent::$_pdo;
    }

    public function __get($name) {

        if (isset($this->username) && isset($this->password)) {
            return;
        }
    }

    public function isauth() {
        $request = new Request();
        
        $this->table = Framework::$params['users']['user_table'];
        $this->user = Framework::$params['users']['user_column'];
        $this->pass = Framework::$params['users']['password_column'];
        
        $this->username = $request->method()->{$this->user};
        $this->password = $request->method()->{$this->pass};
        
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE ({$this->user} = :user AND {$this->pass} = :pass)");
        $query->execute([':user' => $this->username, ':pass' => $this->password]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function check() {
        $val = $this->isauth();
        if ($val) {
            $sesiune = new Session(KEY);
            if ($val) {
                $sesiune->write('data', json_encode($val));
                $sesiune->write(md5(KEY), '');
                return true;
            } else {
                return false;
            }
        } else
            return FALSE;
    }

}
