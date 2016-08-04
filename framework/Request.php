<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace framework;
use framework\Framework;

/**
 * Description of Request
 *
 * @author butoibogdan
 */
class Request {

    private $methoda;

    public function method() {

        $this->methoda = [
            'GET',
            'POST',
            'FILES'
        ];

        $array = [];
        foreach ($this->methoda as $metoda) {
            if ($_SERVER['REQUEST_METHOD'] == $metoda) {
                global ${'_'. $metoda};
                foreach (${'_'. $metoda} as $key => $var) {
                    $array+=[$key => $var];
                }
            }
        }
        return (object) $array;
    }

}
