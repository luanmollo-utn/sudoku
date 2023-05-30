<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./src/styles/style.css">
        <title>Sudoku</title>
    </head>

    <body class="bg-primary">
        <main class="d-flex align-items-center flex-column ">
            <h1 class="text-center text-white my-3">Sudoku</h1>
            
            <?php
            require_once './src/Celda.php';
            require_once './src/Cuadricula.php';
            require_once './src/Tablero.php';
            // $numeros = range(1, 9);
            //shuffle($numeros);
          
           
            
            
         /*   
            $arreglo[4] = [6, 7, 8, 9, 1, 2, 3, 4, 5];

            $arreglo[5] = [9, 1, 2, 3, 4, 5, 6, 7, 8];
            $arreglo[6] = [5, 6, 7, 8, 9, 1, 2, 3, 4];
            $arreglo[7] = [2, 3, 4, 5, 6, 7, 8, 9, 1];

            $arreglo[8] = [8, 9, 1, 2, 3, 4, 5, 6, 7];
            $mostrar=[true,false,true,false,true,false,true,false,false];
            shuffle($mostrar);*/
           
            

           
           $arreglo = array(array(), array(), array(),
                array(),
                array(),
                array(),
                array(),
                array(),
                array());
            // random_int(1, 9);
            $arreglo[0] = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            $arreglo[1] = [4, 5, 6, 7, 8, 9, 1, 2, 3];
            $arreglo[2] = [7, 8, 9, 1, 2, 3, 4, 5, 6];
            $arreglo[3] = [3, 4, 5, 6, 7, 8, 9, 1, 2];
            $arreglo[4] = [6, 7, 8, 9, 1, 2, 3, 4, 5];

            $arreglo[5] = [9, 1, 2, 3, 4, 5, 6, 7, 8];
            $arreglo[6] = [5, 6, 7, 8, 9, 1, 2, 3, 4];
            $arreglo[7] = [2, 3, 4, 5, 6, 7, 8, 9, 1];

            $arreglo[8] = [8, 9, 1, 2, 3, 4, 5, 6, 7];

           $sudoku = array(
                array(0, 0, 3, 0, 2, 0, 6, 0, 0),
                array(9, 0, 0, 3, 0, 5, 0, 0, 1),
                array(0, 0, 1, 8, 0, 6, 4, 0, 0),
                array(0, 0, 8, 1, 0, 2, 9, 0, 0),
                array(7, 0, 0, 0, 0, 0, 0, 0, 8),
                array(0, 0, 6, 7, 0, 8, 2, 0, 0),
                array(0, 0, 2, 6, 0, 9, 5, 0, 0),
                array(8, 0, 0, 2, 0, 3, 0, 0, 9),
                array(0, 0, 5, 0, 1, 0, 3, 0, 0)
            );
           /* $tablero=new Tablero();
$tablero->llenarTablero($sudoku);
$tablero->resolverSudoku(0,0,0,0);
$response=$tablero->imprimirSudokuOB();
echo json_encode($response);*/

            /*$sudoku = array(
                array(0, 2, 3, 4, 5, 6, 7, 8, 9),
                array(4, 5, 6, 7, 8, 9, 1, 2, 3),
                array(7, 8, 9, 1, 2, 3, 4, 5, 6),
                array(3, 4, 5, 6, 7, 8, 9, 1, 2),
                array(6, 7, 8, 9, 1, 2, 3, 4, 5),
                array(9, 1, 2, 3, 4, 5, 6, 7, 8),
                array(5, 6, 7, 8, 9, 1, 2, 3, 4),
                array(2, 3, 4, 5, 6, 7, 8, 9, 1),
                array(8, 9, 1, 2, 3, 4, 5, 6, 7)
            );*/
            ?>
            <form id="tablero" class=" col-9 d-flex flex-column align-items-center gap-2 mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <?php
                for ($i = 0; $i < 9; $i++) {
                    ?>
                    <div class="col-6 d-flex flex-row justify-content-center gap-2">
                        <?php
                        for ($j = 0; $j < 9; $j++) {
                            // echo $arreglo[$i][$j]." ";
                            ?>
                            <input  name="miArreglo[<?php $i ?>][<?php $j ?>]" class="custom-input col-1 text-center prueba" type="text" 
                           
                    onKeypress="if (event.keyCode < 49 || event.keyCode > 57) event.returnValue = false;" maxlength="1" value="<?php if($sudoku[$i][$j]!=0){
                    echo $sudoku[$i][$j];
                    }
                    ?>" 
                    <?php if($sudoku[$i][$j]!=0){
                        ?> readonly<?php
                    }?>
                   >
                        <?php }
                        ?>
                    </div>
                    <?php
                }
                ?>
               <div> <button id="reset" type="reset"class="btn btn-danger my-3">Reset</button>
                <button id="resolver" class="btn btn-success my-3">Resolver sudoku</button> </div>
            </form>
           
            
            
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="./src/js/validacion.js"></script>
    
    
    </body>
</html>