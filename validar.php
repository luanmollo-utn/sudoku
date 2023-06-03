<?php
require_once './src/Celda.php';
require_once './src/Cuadricula.php';
require_once './src/Tablero.php';

//Recibimos la info del dom para procesarla
$inputValues = $_POST['input_values'];
$modifiedIndex = $_POST['modified_index'];

//Convertimos los indices para trabajar con nuestro modelo de objeto
if ($inputValues[$modifiedIndex[count($modifiedIndex) - 1][0]][$modifiedIndex[count($modifiedIndex) - 1][1]] != 0) {
  $filaTab = floor($modifiedIndex[count($modifiedIndex) - 1][0] / 3);
  $colTab = floor($modifiedIndex[count($modifiedIndex) - 1][1] / 3);
  if ($modifiedIndex[count($modifiedIndex) - 1][0] < 3) {
    $filaCuad = $modifiedIndex[count($modifiedIndex) - 1][0];
  } else if ($modifiedIndex[count($modifiedIndex) - 1][0] < 6) {
    $filaCuad = $modifiedIndex[count($modifiedIndex) - 1][0] - 3;
  } else {
    $filaCuad = $modifiedIndex[count($modifiedIndex) - 1][0] - 6;
  }
  if ($modifiedIndex[count($modifiedIndex) - 1][1] < 3) {
    $colCuad = $modifiedIndex[count($modifiedIndex) - 1][1];
  } else if ($modifiedIndex[count($modifiedIndex) - 1][1] < 6) {
    $colCuad = $modifiedIndex[count($modifiedIndex) - 1][1] - 3;
  } else {
    $colCuad = $modifiedIndex[count($modifiedIndex) - 1][1] - 6;
  }

  //Instanciamos el objeto y lo cargamos
  $tablero = new Tablero();
  $tablero->llenarTablero($inputValues);
  //usamos metodo de validacion del objeto
  $response = $tablero->esValido($filaTab, $colTab, $filaCuad, $colCuad, $inputValues[$modifiedIndex[count($modifiedIndex) - 1][0]][$modifiedIndex[count($modifiedIndex) - 1][1]]);

  // Envía la respuesta al JavaScript
  echo $response;
} else {
  //si se borro un valor validamos que los que quedaron sean correctos
  $tablero = new Tablero();
  $tablero->llenarTablero($inputValues);
  for ($i = 0; $i < count($modifiedIndex) - 1; $i++) {
    $filaTab = floor($modifiedIndex[$i][0] / 3);

    $colTab = floor($modifiedIndex[$i][1] / 3);
    if ($modifiedIndex[$i][0] < 3) {
      $filaCuad = $modifiedIndex[$i][0];
    } else if ($modifiedIndex[$i][0] < 6) {
      $filaCuad = $modifiedIndex[$i][0] - 3;
    } else {
      $filaCuad = $modifiedIndex[$i][0] - 6;
    }
    if ($modifiedIndex[$i][1] < 3) {
      $colCuad = $modifiedIndex[$i][1];
    } else if ($modifiedIndex[$i][1] < 6) {
      $colCuad = $modifiedIndex[$i][1] - 3;
    } else {
      $colCuad = $modifiedIndex[$i][1] - 6;
    }

    if (!$tablero->esValido($filaTab, $colTab, $filaCuad, $colCuad, $inputValues[$modifiedIndex[$i][0]][$modifiedIndex[$i][1]])) {
      array_push($modifiedIndex[$i], 0);
    } else {
      array_push($modifiedIndex[$i], 1);
    }
  }
  $responseJSON = json_encode($modifiedIndex);

  // Establecer las cabeceras para indicar que la respuesta es JSON
  header('Content-Type: application/json');

  // Enviar la respuesta JSON al cliente
  echo $responseJSON;
}
