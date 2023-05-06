<?php class tableroClases {
 private $arregloCuadricula;
 
 public function __construct($arregloCuadricula) {
    $this->arregloCuadricula = $arregloCuadricula;
}

    public function getArregloCuadricula() {
        return $this->arregloCuadricula;
    }
}


