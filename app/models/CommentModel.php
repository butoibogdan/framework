<?php

namespace app\models;

use framework\Model;

class CommentModel extends Model {

    private $pdo;

    public function __construct() {
        parent::__construct();
        $this->pdo = parent::$_pdo;
    }

    public static function addComents($data) {
        return Model::record('cooments', $data);
    }

    public static function commentsByUser($id) {
        return @Model::select('cooments', 'user_id', $id);
    }

    public static function allComments() {
        return Model::all('cooments');
    }

}
