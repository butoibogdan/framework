<?php

namespace framework;

use framework\Framework;

class Auth extends Model {

    private $pdo;
    private $table;
    private $column;
    private $value;

    public function __construct() {
        parent::__construct();
        $this->pdo = parent::$_pdo;
    }

    public function isauth($tabel, $coloana, $value) {
        $this->table = $tabel;
        $this->column = $coloana;
        $this->value = $value;
        $query = $this->pdo->prepare("SELECT * FROM $tabel WHERE $coloana= :val");
        $query->execute(['val' => $value]);
        return $query->fetchAll();
    }

}
