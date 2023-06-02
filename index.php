<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./src/styles/style.css">
        <title>Sudoku</title>
    </head>

    <body class="bg-dark">
    <main id="main" class="d-flex align-items-center flex-column ">
        <h1 class="text-center text-white my-3">SUDOKU</h1>

        <?php
        require_once './src/Celda.php';
        require_once './src/Cuadricula.php';
        require_once './src/Tablero.php';

        ?>
       <div id="inicio" >
            <label class="display-5 text-white" for="dificultad">Elija el nivel de dificultad:</label>

            <select id='dificultad' name="dificultad" class="form-select w-50" aria-label="Default select example">
                <option selected value="facil">Facil</option>
                <option value="medio">Medio</option>
                <option value="dificil">Dificil</option>
            </select>
            <div>
                <button id="btnJugar" class="btn btn-success my-3">Jugar</button>
            </div>
</div>
<form id="tablero" class=" col-9 d-flex flex-column align-items-center gap-2 mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php
            for ($i = 0; $i < 9; $i++) {
            ?>
                <div class="col-6 d-flex flex-row justify-content-center gap-2">
                    <?php
                    for ($j = 0; $j < 9; $j++) {
                        // echo $arreglo[$i][$j]." ";
                    ?>
                        <input name="miArreglo[<?php $i ?>][<?php $j ?>]" class="custom-input col-1 text-center prueba" type="text" onKeypress="if (event.keyCode < 49 || event.keyCode > 57) event.returnValue = false;" maxlength="1" value="<?php if ($sudoku[$i][$j] != 0) {
                                                                                                                                                                                                                                                    echo $sudoku[$i][$j];
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                ?>" <?php if ($sudoku[$i][$j] != 0) {
                                                                                                                                                                                                                                                    ?> readonly<?php
                                                                                                                                                                                                                                                            } ?>>
                    <?php }
                    ?>
                </div>
            <?php
            }
            ?>
            <div> <button id="reset" type="reset" class="btn btn-danger m-3">Reset</button>
                <button id="resolver" class="btn btn-success m-3">Resolver sudoku</button>
            </div>
        </form>



    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/validacion.js"></script>


</body>

</html>