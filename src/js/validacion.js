var tableroEnJuego;
const btnJugar=document.getElementById('btnJugar');
btnJugar.addEventListener('click',()=>{
  let selectDificultad=document.getElementById('dificultad');
  let dificultad=selectDificultad.value;
  console.log(dificultad);
  $.ajax({
    url: '../generarTablero.php', // Ruta al archivo PHP
    method: 'POST',
    data: {
      dificultad_elegida: dificultad
    }, // Envía los valores de los inputs a PHP
    success: function (response) {
      let inicio=document.getElementById('inicio');
      let tablero=document.getElementById('tablero');
      inicio.style.display='none';
      tablero.style.visibility='visible';
      tableroEnJuego=response;
      console.log(response);
      var inputs = document.querySelectorAll('input');
      let cont=0;
      for(let i=0;i<9;i++){
        for(let j=0;j<9;j++){
          if(response[i][j]!=0){
            inputs[cont].value=response[i][j];
            inputs[cont].readOnly=true;
          }else{
            inputs[cont].value="";
          }
          
          cont++;
        }

      }

      // Aquí puedes manejar la respuesta de PHP
     
    }
  });
});



var inputs = document.querySelectorAll('input');
var inputValues = [];
var inputFocus = [];
let fila = [];
let indexEvent;
let contador = 0;
var modifiedIndex = [];
var indiceFocus = [];
inputs.forEach((input, index) => input.addEventListener('focus', () => {
  indiceFocus = [];
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      fila[j] = inputs[contador];
      if (index == contador) {
        indiceFocus.push(i);
        indiceFocus.push(j);
        console.log(indiceFocus);
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

}))
inputs.forEach((input, index) => input.addEventListener('focusout', () => {
  indiceFocus = [];
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      fila[j] = inputs[contador];
      if (index == contador) {
        indiceFocus.push(i);
        indiceFocus.push(j);
        console.log(indiceFocus);
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

inputs.forEach((input, index) => input.addEventListener('keyup', () => {
  console.log(index);
  //indexEvent=index;
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      inputs[contador].value == "" ? fila[j] = 0 : fila[j] = parseInt(inputs[contador].value);
      if (index == contador) {
        modifiedIndex.push(i);
        modifiedIndex.push(j);
      }
      contador++;
    }
    inputValues[i] = fila;
    fila = [];
  }
  contador = 0;
  console.log(inputValues);
  console.log(modifiedIndex);
  $.ajax({
    url: '../validar.php', // Ruta al archivo PHP
    method: 'POST',
    data: {
      input_values: inputValues,
      modified_index: modifiedIndex
    }, // Envía los valores de los inputs a PHP
    success: function (response) {
      // Aquí puedes manejar la respuesta de PHP
      console.log(response);
      if (response == "") {
        console.log(modifiedIndex);
        inputs[modifiedIndex[0] * 9 + modifiedIndex[1]].style.color = "red";
        modifiedIndex = [];
      } else {
        inputs[modifiedIndex[0] * 9 + modifiedIndex[1]].style.color = "black";
        modifiedIndex = [];
        if (!Array.from(inputs).some(input => input.value == '')) {
          alert("has ganado");
        }
      }
    }
  });
  //modifiedIndex=[];
}

));
const btnResete = document.getElementById("reset");
btnResete.addEventListener("click",(e)=>{
  e.preventDefault();
  var inputs = document.querySelectorAll('input');
  let cont=0;
  for(let i=0;i<9;i++){
    for(let j=0;j<9;j++){
      if(tableroEnJuego[i][j]!=0){
        inputs[cont].value=tableroEnJuego[i][j];
        inputs[cont].readOnly=true;
      }else{
        inputs[cont].value="";
      }
      
      cont++;
    }

  }

});
const btnResolver = document.getElementById("resolver");
btnResolver.addEventListener("click", (e) => {
  e.preventDefault()
  for (let i = 0; i < 9; i++) {
    for (let j = 0; j < 9; j++) {
      inputs[contador].readOnly ? fila[j] = parseInt(inputs[contador].value):fila[j] = 0;
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
      // Aquí puedes manejar la respuesta de PHP
      console.log(response);
      let form = document.getElementById("tablero");

      let divBtn = document.createElement("div");
      let btnJugar=document.createElement("button");
      btnJugar.textContent="Volver a Jugar";
      btnJugar.classList.add("btn","btn-warning");
      btnJugar.setAttribute("id","volverAJugar");
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

modifiedIndex = [];


