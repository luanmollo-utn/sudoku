<?php
class Cuadricula {
    private $arregloCeldas;
      
    public function __construct() {
        $this->arregloCeldas = array(array(new Celda(), new Celda(),new Celda()),array(new Celda(), new Celda(),new Celda()),array(new Celda(), new Celda(),new Celda()));
    }
    
    public function getArregloCeldas() {
        return $this->arregloCeldas;
    }

    public function imprimirCuadricula(){
        for($i=0;$i<3;$i++){
            for($j=0;$j<3;$j++){
                echo $this->arregloCeldas[$i][$j]->getNum()."||";
            }
            if($i<3){
            echo '<br>';
            }
        }
    }
            
}
