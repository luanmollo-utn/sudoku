<?php
class Celda{
//atributos
    private $num;
    private $mostrar;

//metodos

    public function __contruct(){

    }
    public function getNum(){
        return $this->Num;
    }
    public function getMostrar(){
        return $this->mostrar;
    }
    public function setNum($num){
        $this->num= $num;
    }
    public function setMostrar($mostrar){
        $this->mostrar=mostrar;
    }
}

?>