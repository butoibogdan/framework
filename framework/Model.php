<?php

namespace framework;

use framework\Framework as Framework;
use framework\FlashMessages as Mess;
use PDO;

class Model {

    // database connection instance	- singleton
    static protected $_pdo;

    public function __construct() {
        $this->connectDB();
    }

    /**
     * Singleton pattern
     * Daca, de exemplu, intr-o pagina avem mai multe apelari ale Model-ului, doar o instanta de PDO este creata
     * e.g listare un articol si sub el comentarii - se apeleaza modelul de la articole si cel de la comentarii 
     */
    protected function connectDB() {
        if (is_null(self::$_pdo)) {
            $host= Framework::$params['database']['host'];
            $database = Framework::$params['database']['name'];
            $username = Framework::$params['database']['username'];
            $password = Framework::$params['database']['password'];
            $options = Framework::$params['database']['options'];
            self::$_pdo = new PDO("mysql:dbname={$database};host=$host;port=3306;charset=utf8", $username, $password, $options);
        } else {
            return self::$_pdo;
        }
    }

    public function findByPk($table, $id) {
        $sql = self::$_pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $sql->execute([':id' => $id]);
        $result = $sql->fetch();
        if (empty($result)) {
            throw new \Exception('ID inexistent');
        }
        return $result;
    }

    public static function all($table) {
        return self::$_pdo->query("SELECT * FROM $table");
    }

    public function delete($table, $id) {
        $sql = self::$_pdo->prepare(" DELETE FROM $table WHERE id = :id ");
        $sql->execute([':id' => $id]);
    }

    public static function record($table, $array) {
        $column = [];
        $array_val = [];
        $select = self::$_pdo->query("SELECT * FROM $table");
        foreach ($array as $key => $val) {
            for ($i = 0; $i <= $select->columnCount(); $i++) {
                $meta = $select->getColumnMeta($i);
                if ($meta['name'] == $key) {
                    array_push($column, $key);
                    array_push($array_val, '"' . $val . '"');
                }
            }
        }
        $c = implode(',', $column);
        $data = implode(',', $array_val);
        $sql = "INSERT INTO $table ($c) VALUES ($data)";
        $sql = self::$_pdo->exec($sql);
    }

    // Validate
    public static function validate($post, $rules = [], $table = null, $column = null) {
        // regulile se vor separa prin | iar subregulile prin :
        $validate = true;
        foreach ($rules as $rule) {
            if (strpos($rule, ':')) {
                $array = explode(':', $rule);
                switch ($array[0]) {
                    case 'len':
                        if (strlen($post) < $array[1]) {
                            $validate = FALSE;
                            Mess::setMess('flashmessage', 'String to short');
                        }
                }
            } else {
                switch ($rule) {
                    case 'unique':
                        $sql = self::$_pdo->prepare("SELECT * FROM $table WHERE $column=:column");
                        $sql->execute([':column' => $post]);
                        $result = $sql->fetch(PDO::FETCH_OBJ);
                        if ($result) {
                            Mess::setMess('flashmessage', 'Record must be unique');
                            $validate = false;
                        }
                        break;
                }
            }
        }

        return $validate;
    }

    public static function editID($table, $array, $id) {
        $column = [];
        $vector = [];
        $select = self::$_pdo->query("SELECT * FROM $table");
        foreach ($array as $key => $val) {
            for ($i = 0; $i <= $select->columnCount(); $i++) {
                $meta = $select->getColumnMeta($i);
                if ($meta['name'] == $key) {
                    array_push($column, $key . '=:' . 'val' . $i);
                    $vector['val' . $i] = $val;
                }
            }
        }
        $c = implode(', ', $column);
        $sql = "UPDATE $table SET $c WHERE id=:id";
        //print_r($vector);
        $sql = self::$_pdo->prepare($sql);
        $sql->execute($vector + [':id' => $id]);
    }

    public function select($table, $column, $id) {
        $sql = self::$_pdo->prepare("SELECT * FROM $table WHERE $column = :id");
        $sql->execute([':id' => $id]);
        $result = $sql->fetchAll();
        if (empty($result)) {
            return null;
        }
        return $result;
    }

}
