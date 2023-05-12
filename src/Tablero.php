<?php class tableroClases {
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

}


