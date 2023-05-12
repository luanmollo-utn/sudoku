<?php class Tablero
{
    private $arregloCuadricula;

    public function __construct()
    {
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
                        echo $this->arregloCuadricula[$filaTab][$colTab]->getArregloCeldas()[$filaOb][$colOb]->getNum() . "||";

                    }
                    echo "  ";
                }
                if ($filaOb < 3) {
                    echo "<br>";
                }
            }
            if ($filaTab < 3) {
                echo "<br>" . "======================" . "<br>";
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

    public function esValido($filTab, $colTab, $filCuad, $colCuad, $numero)
    {
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

    public function resolverSudoku($filaTab, $colTab, $filaCuad, $colCuad)
    {

        // Si se ha llegado al final del sudoku, se ha resuelto
        /* echo "FilaTab: ".$filaTab." ColTab: ".$colTab." FilaCuad: ".$filaCuad." ColCuad: ".$colCuad."<br>";*/
        if ($colCuad == 3) {
            $colTab++;
            $colCuad = 0;
        }
        if ($colTab == 3) {
            $filaCuad++;
            $colTab = 0;
        }

        if ($filaCuad == 3) {
            $filaTab++;
            $filaCuad = 0;
        }

        if ($filaTab == 3) {
            $this->imprimirSudokuOB();
            return true;
        }
        // Si se ha llegado al final de la fila, pasar a la siguiente fila





        // Si la celda ya tiene un número, pasar a la siguiente celda
        if ($filaTab < 3) {
            if ($this->arregloCuadricula[$filaTab][$colTab]->getArregloCeldas()[$filaCuad][$colCuad]->getNum() != 0) {

                return $this->resolverSudoku($filaTab, $colTab, $filaCuad, $colCuad + 1);

            }
        } else {
            return $this->resolverSudoku($filaTab, $colTab, $filaCuad, $colCuad);
        }
        // Probar los números del 1 al 9 en la celda
        for ($numero = 1; $numero <= 9; $numero++) {
            if ($this->esValido($filaTab, $colTab, $filaCuad, $colCuad, $numero)) {
                //  echo "valido si ".$numero." es valido en posicion "."FilaTab".$filaTab.
                // " ColTab ".$colTab." FilaCuad ".$filaCuad." ColCuad ".$colCuad."<br>";
                $this->arregloCuadricula[$filaTab][$colTab]->getArregloCeldas()[$filaCuad][$colCuad]->setNum($numero);
                // $this->imprimirSudokuOB();
                // Si se ha encontrado una solución, retornar verdadero
                if ($this->resolverSudoku($filaTab, $colTab, $filaCuad, $colCuad + 1)) {
                    return true;
                }
                // Si no se ha encontrado una solución, retroceder y probar con otro número
                $this->arregloCuadricula[$filaTab][$colTab]->getArregloCeldas()[$filaCuad][$colCuad]->setNum(0);
            }
        }
        // Si se han probado todos los números y ninguno es válido, retroceder
        return false;
    }


}