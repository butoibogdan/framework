<?php

namespace framework;

use framework\Framework;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author bogdan.butoi
 */
class Session {

    private $key;

    public function __construct($key) {
        $this->key = $key;
    }

    public function read($id) {
        $data = $_SESSION[$id];
        if (!$data) {
            return "";
        } else {
            return $this->decrypt($data, $this->key);
        }
    }

    public function write($id, $data) {
        $data = $this->encrypt($data, $this->key);
        $_SESSION[$id]=$data;
        return $_SESSION[$id];
    }

    private function decrypt($edata, $password) {
        $data = base64_decode($edata);
        $salt = substr($data, 0, 16);
        $ct = substr($data, 16);

        $rounds = 3; // depends on key length
        $data00 = $password . $salt;
        $hash = array();
        $hash[0] = hash('sha256', $data00, true);
        $result = $hash[0];
        for ($i = 1; $i < $rounds; $i++) {
            $hash[$i] = hash('sha256', $hash[$i - 1] . $data00, true);
            $result .= $hash[$i];
        }
        $key = substr($result, 0, 32);
        $iv = substr($result, 32, 16);

        return openssl_decrypt($ct, 'AES-256-CBC', $key, true, $iv);
    }

    /**
     * crypt AES 256
     *
     * @param data $data
     * @param string $password
     * @return base64 encrypted data
     */
    private function encrypt($data, $password) {

        // Set a random salt
        $salt = openssl_random_pseudo_bytes(16);

        $salted = '';
        $dx = '';
        // Salt the key(32) and iv(16) = 48
        while (strlen($salted) < 48) {
            $dx = hash('sha256', $dx . $password . $salt, true);
            $salted .= $dx;
        }

        $key = substr($salted, 0, 32);
        $iv = substr($salted, 32, 16);

        $encrypted_data = openssl_encrypt($data, 'AES-256-CBC', $key, true, $iv);
        return base64_encode($salt . $encrypted_data);
    }
    
    public static function destroy(){
        return session_destroy();
    }

}
