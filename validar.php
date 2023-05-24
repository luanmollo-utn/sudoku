<?php
require_once './src/Celda.php';
require_once './src/Cuadricula.php';
require_once './src/Tablero.php';
$inputValues = $_POST['input_values'];
$modifiedIndex=$_POST['modified_index'];
//echo "Valor modificado: ".$inputValues[$modifiedIndex[0]][$modifiedIndex[1]]."<br>";
$filaTab=floor($modifiedIndex[0]/3);
//echo "Fila Tab: ".$filaTab."<br>";
$colTab=floor($modifiedIndex[1]/3);
//echo "Columna Tab: ".$colTab."<br>";
if($modifiedIndex[0]<3){
  $filaCuad=$modifiedIndex[0];
  //echo "Fila cuad: ".$filaCuad."<br>";
}else if($modifiedIndex[0]<6){
  $filaCuad=$modifiedIndex[0]-3;
  //echo "Fila cuad: ".$filaCuad."<br>";
}else{
  $filaCuad=$modifiedIndex[0]-6;
  //echo "Fila cuad: ".$filaCuad."<br>";
}
if($modifiedIndex[1]<3){
  $colCuad=$modifiedIndex[1];
  //echo "Col cuad: ".$colCuad."<br>";
}else if($modifiedIndex[1]<6){
  $colCuad=$modifiedIndex[1]-3;
 // echo "Col cuad: ".$colCuad."<br>";
}else{
  $colCuad=$modifiedIndex[1]-6;
  //echo "Col cuad: ".$colCuad."<br>";
}


$tablero=new Tablero();
$tablero->llenarTablero($inputValues);

  $response =$tablero->esValido($filaTab,$colTab,$filaCuad,$colCuad,$inputValues[$modifiedIndex[0]][$modifiedIndex[1]]);

//$tablero->imprimirSudokuOB();
// Realiza la validación con los valores de los inputs
// ...

// Ejemplo de validación básica: si todos los valores son "validos"
/*if (array_search('invalido', $inputValues) === false) {
  $response = 'Los valores son válidos'; // Puedes personalizar el mensaje de respuesta
} else {
  $response = 'Al menos uno de los valores no es válido'; // Puedes personalizar el mensaje de respuesta
}*/

// Envía la respuesta al JavaScript
echo $response;
?>
