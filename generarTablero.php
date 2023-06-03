<?php
//resibimos nivel de dificultad elegido en el dom
$dificultad=$_POST['dificultad_elegida'];
// Función para generar un tablero de sudoku aleatorio válido con diferentes niveles de dificultad
function generarTableroAleatorio($dificultad) {
    $tablero = array();

    // Inicializar el tablero con celdas vacías
    for ($i = 0; $i < 9; $i++) {
        $tablero[$i] = array();
        for ($j = 0; $j < 9; $j++) {
            $tablero[$i][$j] = 0;
        }
    }

    // Resolver el sudoku inicialmente para obtener un tablero válido
    resolverSudoku($tablero);

    // Determinar la cantidad mínima de celdas con números según la dificultad
    $cantidadMinima = 0;
    if ($dificultad === 'dificil') {
        $cantidadMinima = 64;
    } elseif ($dificultad === 'medio') {
        $cantidadMinima = 35;
    } elseif ($dificultad === 'facil') {
        $cantidadMinima = 25;
    }

    // Copiar el tablero para realizar modificaciones sin afectar el tablero original
    $tableroModificado = $tablero;

    // Eliminar números del tablero hasta alcanzar la cantidad mínima
    $celdasEliminadas = 0;
    while ($celdasEliminadas < $cantidadMinima) {
        $fila = rand(0, 8);
        $columna = rand(0, 8);

        // Verificar si la celda ya está vacía
        if ($tableroModificado[$fila][$columna] == 0) {
            continue;
        }

        // Guardar el número actual antes de eliminarlo
        $numeroGuardado = $tableroModificado[$fila][$columna];

        // Eliminar el número en la celda actual
        $tableroModificado[$fila][$columna] = 0;

        // Verificar si el tablero aún tiene una única solución
        if (!tieneMasDeUnaSolucion($tableroModificado)) {
            $celdasEliminadas++;
        } else {
            // Restaurar el número guardado en la celda actual si el tablero tiene más de una solución
            $tableroModificado[$fila][$columna] = $numeroGuardado;
        }
    }

    return $tableroModificado;
}
// Función para resolver un sudoku utilizando un algoritmo de retroceso recursivo
function resolverSudoku(&$tablero) {
    $vacio = encontrarCeldaVacia($tablero);

    // Si no hay celdas vacías, el sudoku está resuelto
    if (!$vacio) {
        return true;
    }

    $fila = $vacio[0];
    $columna = $vacio[1];

    // Generar un arreglo de números aleatorios del 1 al 9
    $numeros = range(1, 9);
    shuffle($numeros);

    // Probar números aleatorios del 1 al 9 en la celda vacía
    foreach ($numeros as $num) {
        if (esNumeroValido($tablero, $fila, $columna, $num)) {
            $tablero[$fila][$columna] = $num;

            if (resolverSudoku($tablero)) {
                return true;
            }

            // Si la solución no es válida, retroceder y probar otro número
            $tablero[$fila][$columna] = 0;
        }
    }

    // Si no se encuentra ninguna solución válida, se retrocede
    return false;
}

// Función para verificar si un número es válido en una celda específica
function esNumeroValido($tablero, $fila, $columna, $num) {
    // Verificar si el número se repite en la misma fila
    for ($i = 0; $i < 9; $i++) {
        if ($tablero[$fila][$i] == $num) {
            return false;
        }
    }

    // Verificar si el número se repite en la misma columna
    for ($i = 0; $i < 9; $i++) {
        if ($tablero[$i][$columna] == $num) {
            return false;
        }
    }

    // Verificar si el número se repite en el mismo bloque de 3x3
    $bloqueFila = floor($fila / 3) * 3;
    $bloqueColumna = floor($columna / 3) * 3;

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($tablero[$bloqueFila + $i][$bloqueColumna + $j] == $num) {
                return false;
            }
        }
    }

    return true;
}
// Función para encontrar la próxima celda vacía en el tablero
function encontrarCeldaVacia($tablero) {
    for ($fila = 0; $fila < 9; $fila++) {
        for ($columna = 0; $columna < 9; $columna++) {
            if ($tablero[$fila][$columna] == 0) {
                return array($fila, $columna);
            }
        }
    }
    return null;
}
// Resto del código de las funciones encontrarCeldaVacia, esNumeroValido, tieneMasDeUnaSolucion, etc.
// Función para verificar si un tablero tiene más de una solución
function tieneMasDeUnaSolucion($tablero) {
    $copiaTablero = $tablero;

    // Intentar resolver el sudoku
    if (resolverSudoku($copiaTablero)) {
        // Si se puede resolver y hay al menos una celda vacía, hay más de una solución
        if (encontrarCeldaVacia($copiaTablero)) {
            return true;
        }
    }

    return false;
}
function contarCeldasVacias($tablero) {
    $contador = 0;

    for ($fila = 0; $fila < 9; $fila++) {
        for ($columna = 0; $columna < 9; $columna++) {
            if ($tablero[$fila][$columna] == 0) {
                $contador++;
            }
        }
    }

    return $contador;
}
// Generar un tablero de sudoku aleatorio válido
$response= generarTableroAleatorio($dificultad);

$responseJSON = json_encode($response);

// Establecer las cabeceras para indicar que la respuesta es JSON
header('Content-Type: application/json');

// Enviar la respuesta JSON al cliente
echo $responseJSON;
