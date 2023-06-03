var tableroEnJuego;
const btnJugar = document.getElementById('btnJugar');
//Generamos escucha para boton jugar y generar el tablero
btnJugar.addEventListener('click', () => {
  let selectDificultad = document.getElementById('dificultad');
  let dificultad = selectDificultad.value;
  console.log(dificultad);
  //Enviamos peticion ajax a generarTablero con el nivel de dificultad elegido
  $.ajax({
    url: '../generarTablero.php', // Ruta al archivo PHP
    method: 'POST',
    data: {
      dificultad_elegida: dificultad
    }, // Envía los valores de los inputs a PHP
    success: function (response) {
      //ocultamos el menu de seleccion de dificultad y cargamos el tablero
      let inicio = document.getElementById('inicio');
      let tablero = document.getElementById('tablero');
      inicio.style.display = 'none';
      tablero.style.visibility = 'visible';
      tableroEnJuego = response;
      console.log(response);
      var inputs = document.querySelectorAll('input');
      let cont = 0;
      for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
          if (response[i][j] != 0) {
            inputs[cont].value = response[i][j];
            inputs[cont].readOnly = true;
          } else {
            inputs[cont].value = "";
          }

          cont++;
        }

      }
    }
  });
});


//definimos variables para manejar eventos del tablero
var inputs = document.querySelectorAll('input');
var inputValues = [];
var inputFocus = [];
let fila = [];
let indexEvent;
let contador = 0;
var modifiedIndex = [];
var indiceFocus = [];
//evento para cambiar el borde de las celda seleccionada y su grupo
inputs.forEach((input, index) => input.addEventListener('focus', () => {
  indiceFocus = [];
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      fila[j] = inputs[contador];
      if (index == contador) {
        indiceFocus.push(i);
        indiceFocus.push(j);
        console.log("Indice focus " + indiceFocus);
      }

      contador++;
    }
    inputFocus[i] = fila;
    fila = [];
  }
  contador = 0;
  for ($i = 0; $i < 9; $i++) {

    inputFocus[$i][indiceFocus[1]].classList.add('custom-input-focus');
  }
  for ($j = 0; $j < 9; $j++) {
    inputFocus[indiceFocus[0]][$j].classList.add('custom-input-focus');
  }

  for ($i = Math.floor(indiceFocus[0] / 3) * 3; $i < Math.floor(indiceFocus[0] / 3) * 3 + 3; $i++) {
    for ($j = Math.floor(indiceFocus[1] / 3) * 3; $j < Math.floor(indiceFocus[1] / 3) * 3 + 3; $j++) {
      inputFocus[$i][$j].classList.add('custom-input-focus');
    }

  }

}));
//Evento de escucha para quitar el borde cuando nos corremos a otra celda
inputs.forEach((input, index) => input.addEventListener('focusout', () => {
  indiceFocus = [];
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      fila[j] = inputs[contador];
      if (index == contador) {
        indiceFocus.push(i);
        indiceFocus.push(j);
        console.log("indice focusout " + indiceFocus);
      }

      contador++;
    }
    inputFocus[i] = fila;
    fila = [];
  }
  contador = 0;
  for ($i = 0; $i < 9; $i++) {
    inputFocus[$i][indiceFocus[1]].classList.remove('custom-input-focus');
  }
  for ($j = 0; $j < 9; $j++) {
    inputFocus[indiceFocus[0]][$j].classList.remove('custom-input-focus');
  }

  for ($i = Math.floor(indiceFocus[0] / 3) * 3; $i < Math.floor(indiceFocus[0] / 3) * 3 + 3; $i++) {
    for ($j = Math.floor(indiceFocus[1] / 3) * 3; $j < Math.floor(indiceFocus[1] / 3) * 3 + 3; $j++) {
      inputFocus[$i][$j].classList.remove('custom-input-focus');
    }

  }
}));

//Evnto de escucha ante cambio de contnido en las celdas
inputs.forEach((input, index) => input.addEventListener('keyup', () => {
  console.log(index);
  let focus = []
  //armamos la info en arreglo de 9x9 y almacnamos la info de la celda modificada
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      inputs[contador].value == "" ? fila[j] = 0 : fila[j] = parseInt(inputs[contador].value);
      if (index == contador) {
        focus.push(i);
        focus.push(j);
        modifiedIndex.push(focus);
      }
      contador++;
    }
    inputValues[i] = fila;
    fila = [];
  }
  contador = 0;
  //console.log(inputValues);
  //console.log(modifiedIndex);
  //Enviamos la info a validar.php para que nos diga si esta bien el numero o no
  $.ajax({
    url: '../validar.php', // Ruta al archivo PHP
    method: 'POST',
    data: {
      input_values: inputValues,
      modified_index: modifiedIndex
    }, // Envía los valores de los inputs a PHP
    success: function (response) {
      //manejamos respuesta
      console.log(response);
      if (response == 1 || response == "") {
        if (response == "") {
          console.log(modifiedIndex);
          inputs[modifiedIndex[modifiedIndex.length - 1][0] * 9 + modifiedIndex[modifiedIndex.length - 1][1]].style.color = "red";

        } else {
          inputs[modifiedIndex[modifiedIndex.length - 1][0] * 9 + modifiedIndex[modifiedIndex.length - 1][1]].style.color = "black";
        }

      } else {
        console.log(response);
        Array.from(response).forEach(par => {
          if (par[2] == 1) {

            inputs[parseInt(par[0]) * 9 + parseInt(par[1])].style.color = "black";
          } else {
            inputs[parseInt(par[0]) * 9 + parseInt(par[1])].style.color = "red"
          }
        });
        if (!Array.from(inputs).some(input => input.value == '' && input.style.color != "red")) {
          alert("HAS GANADO");
        }
      }
    }
  });

}

));
//Manejamos evento de boton reset
const btnResete = document.getElementById("reset");
btnResete.addEventListener("click", (e) => {
  e.preventDefault();
  var inputs = document.querySelectorAll('input');
  let cont = 0;
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      if (tableroEnJuego[i][j] != 0) {
        inputs[cont].value = tableroEnJuego[i][j];
        inputs[cont].readOnly = true;
      } else {
        inputs[cont].value = "";
      }

      cont++;
    }

  }

});
//Manejamos evento de boton resolver
const btnResolver = document.getElementById("resolver");
btnResolver.addEventListener("click", (e) => {
  e.preventDefault()
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      inputs[contador].readOnly ? fila[j] = parseInt(inputs[contador].value) : fila[j] = 0;
      contador++;
    }
    inputValues[i] = fila;
    fila = [];
  }
  contador = 0;
  console.log(inputValues);
  $.ajax({
    url: '../resolver.php', // Ruta al archivo PHP
    method: 'POST',
    data: { input_values: inputValues }, // Envía los valores de los inputs a PHP
    success: function (response) {
      // Manejamos la respuesta del tablero
      console.log(response);
      let form = document.getElementById("tablero");

      let divBtn = document.createElement("div");
      divBtn.classList.add("my-2");
      let btnJugar = document.createElement("button");
      btnJugar.textContent = "Volver a Jugar";
      btnJugar.classList.add("btn", "btn-warning");
      btnJugar.setAttribute("id", "volverAJugar");
      divBtn.appendChild(btnJugar);
      form.innerHTML = "";
      for (let i = 0; i < 9; i++) {
        let div = document.createElement('div');
        div.className = 'col-6 d-flex flex-row justify-content-center gap-2';

        for (let j = 0; j < 9; j++) {
          let input = document.createElement('input');

          input.className = 'custom-input col-1 text-center prueba';
          input.type = 'text';
          input.maxLength = 1;

          input.value = response[i][j];
          input.readOnly = true;


          div.appendChild(input);
        }

        form.appendChild(div);
      }
      form.appendChild(divBtn);
    }
  });

});




