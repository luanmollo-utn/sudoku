<?php
require_once './src/Celda.php';
require_once './src/Cuadricula.php';
require_once './src/Tablero.php';
$inputValues = $_POST['input_values'];

$tablero=new Tablero();
$tablero->llenarTablero($inputValues);
$tablero->resolverSudoku(0,0,0,0);
$response=$tablero->imprimirSudokuOB();
$responseJSON = json_encode($response);

// Establecer las cabeceras para indicar que la respuesta es JSON
header('Content-Type: application/json');

// Enviar la respuesta JSON al cliente
echo $responseJSON;

