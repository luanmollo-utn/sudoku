<?php

class Celda {
    //put your code here
    private $num;
    private $mostrar;
    
    public function __construct() {
       
    }

    public function getNum() {
        return $this->num;
    }

    public function getMostrar() {
        return $this->mostrar;
    }

    public function setNum($num){
        $this->num = $num;
    }

    public function setMostrar($mostrar): void {
        $this->mostrar = $mostrar;
    }


}