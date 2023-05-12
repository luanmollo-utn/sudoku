<h1>hola mundo</h1>

<?php
require_once "./src/Celda.php";
require_once "./src/Cuadricula.php";
require_once "./src/Tablero.php";


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


$tablero = new Tablero();

$tablero->llenarTablero($sudoku);
echo "Sudoku sin resolver:"."<br>";


$tablero->imprimirSudokuOB();

echo "Sudoku resuelto:"."<br>";
$tablero->resolverSudoku(0, 0, 0, 0);


?>