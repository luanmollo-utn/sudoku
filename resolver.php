<?php
require_once './src/Celda.php';
require_once './src/Cuadricula.php';
require_once './src/Tablero.php';
//Recibimos la info del dom
$inputValues = $_POST['input_values'];
//Instanciamos objeto y cargamos el tablero
$tablero=new Tablero();
$tablero->llenarTablero($inputValues);
//Disparamos metodo para resolver tablero
$tablero->resolverSudoku(0,0,0,0);
//generamos tablero en arreglo de 9x9
$response=$tablero->imprimirSudokuOB();
//convertios a Json para poder enviar el arreglo resuelto
$responseJSON = json_encode($response);

// Establecer las cabeceras para indicar que la respuesta es JSON
header('Content-Type: application/json');

// Enviar la respuesta JSON al cliente
echo $responseJSON;

