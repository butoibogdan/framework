<?php

namespace app\models;

use framework\Model;

class UserModel extends Model {

    // PDO connection - aceasta linie trebuie sa fie in fiecare model
    private $pdo;

    // suprascrierea constructorului din parinte - linia asta trebuie sa fie in fiecare model
    public function __construct() {
        parent::__construct();
        $this->pdo = parent::$_pdo;
    }

    // Get a list of users
    public static function listUser() {
        return Model::all('users');
    }

    public function update($id, $post) {

        $set = 'firstname = :firstname, lastname = :lastname, email = :email';
        $sql = $this->pdo->prepare("UPDATE users SET $set  WHERE id = :id");

        return $sql->execute(array(
                    ':id' => $id,
                    ':firstname' => $post['firstName'],
                    ':lastname' => $post['lastName'],
                    ':email' => $post['email']));
    }

    public static function register($data) {
        $validare = Model:: validate($post, ['unique'], 'users', 'users');
        if (!$validare) {
            return false;
        }
        return Model::record('users', $data);
    }

    public static function validare($data, $rules, $column) {
        return Model::validate($data, $rules, 'users', $column);
    }

    public static function deleteUser($id) {
        return Model::delete('users', $id);
    }

    public static function userUpdate($array, $id) {
        return Model::editID('users', $array, $id);
    }

    public static function findByID($id) {
        return Model::findByPk('users', $id);
    }

}
