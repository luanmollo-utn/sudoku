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
            ?>
            <form class=" col-9 d-flex flex-column align-items-center gap-2 mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <?php
                for ($i = 0; $i < 9; $i++) {
                    ?>
                    <div class="col-6 d-flex flex-row justify-content-center gap-2">
                        <?php
                        for ($j = 0; $j < 9; $j++) {
                            // echo $arreglo[$i][$j]." ";
                            ?>
                            <input  name="miArreglo[<?php $i ?>][<?php $j ?>]" class=" col-1 text-center prueba" type="text" 
                           
                    onKeypress="if (event.keyCode < 49 || event.keyCode > 57) event.returnValue = false;" maxlength="1" value="<?php if($sudoku[$i][$j]!=0){
                    echo $sudoku[$i][$j];
                    }
                    ?>" required pattern="[1-9]{1}"
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
                <button class="btn btn-danger my-3">Validar</button>
            </form>
            </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="./src/js/validacion.js"></script>
    
    
    </body>
</html>