<?php class Tablero {
 private $arregloCuadricula;

    public function __construct(){
        $this->arregloCuadricula = array(array(new Cuadricula(), new Cuadricula(), new Cuadricula()), array(new Cuadricula(), new Cuadricula(), new Cuadricula()), array(new Cuadricula(), new Cuadricula(), new Cuadricula()));
    }

    public function getArregloCuadricula()
    {
        return $this->arregloCuadricula;
    }

    function imprimirSudokuOB() 
    {
       /* for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $this->arregloCuadricula[$i][$j]->imprimirCuadricula();
            }
            echo '|||';
            if($i<3){
                echo "============================================" . '<br>';
           }
        }*/

        for ($filaTab = 0; $filaTab < 3; $filaTab++) {
            for ($filaOb = 0; $filaOb < 3; $filaOb++) {
            
                for ($colTab = 0; $colTab < 3; $colTab++) {
                    echo "||";
                    for ($colOb = 0; $colOb < 3; $colOb++) {
                        echo $this->arregloCuadricula[$filaTab][$colTab]->getArregloCeldas()[$filaOb][$colOb]->getNum()."||";
                        
                    }
                    echo "  ";
                }
                if($filaOb<3){
                    echo "<br>";
                }
            }
            if($filaTab<3){
                echo "<br>"."======================"."<br>";
            }
        }
      
}

public function llenarTablero($arreglo)
{
    $contadorFila = -1;
    for ($filaTab = 0; $filaTab < 3; $filaTab++) {
        for ($filaOb = 0; $filaOb < 3; $filaOb++) {
            $contadorCol = 0;
            $contadorFila++;
            for ($colTab = 0; $colTab < 3; $colTab++) {
                for ($colOb = 0; $colOb < 3; $colOb++) {
                    $this->arregloCuadricula[$filaTab][$colTab]->getArregloCeldas()[$filaOb][$colOb]->setNum($arreglo[$contadorFila][$contadorCol]);
                    $contadorCol++;
                }
            }
        }
    }
}

public function esValido($filTab, $colTab, $filCuad, $colCuad, $numero){
    // Verificar si el número ya está en la fila
    for ($columnaTab = 0; $columnaTab < 3; $columnaTab++) {
        
        for ($columnaCuad = 0; $columnaCuad < 3; $columnaCuad++) {
              if ($this->arregloCuadricula[$filTab][$columnaTab]->getArregloCeldas()[$filCuad][$columnaCuad]->getNum() == $numero) {
                return false;
            }
        }
    }

    // Verificar si el número ya está en la columna

    for ($filaTab = 0; $filaTab < 3; $filaTab++) {
      
        for ($filaCuad = 0; $filaCuad < 3; $filaCuad++) {
           
            if ($this->arregloCuadricula[$filaTab][$colTab]->getArregloCeldas()[$filaCuad][$colCuad]->getNum() == $numero) {
                return false;
            }
        }
    }

    // Verificar si el número ya está en la submatriz

    for ($filaCuad = 0; $filaCuad < 3; $filaCuad++) {
       
        for ($columnaCuad = 0; $columnaCuad < 3; $columnaCuad++) {
            
            if ($this->arregloCuadricula[$filTab][$colTab]->getArregloCeldas()[$filaCuad][$columnaCuad]->getNum() == $numero) {
                return false;
            }
        }
    }

    // Si no se ha encontrado ninguna coincidencia, entonces el número es válido
    return true;
}

}


