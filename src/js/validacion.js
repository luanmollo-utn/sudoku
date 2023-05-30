
    var inputs = document.querySelectorAll('input');
    var inputValues = [];
    var inputFocus= [];
    let fila=[];
    let indexEvent;
    let contador=0;
    var modifiedIndex = [];
    var indiceFocus=[];
    inputs.forEach((input,index)=>input.addEventListener('focus',()=>{
      indiceFocus=[];
      for(let i=0;i<9;i++){
        for(let j=0;j<9;j++){
          fila[j]=inputs[contador];    
    if(index==contador){
        indiceFocus.push(i);
        indiceFocus.push(j);
        console.log(indiceFocus);
    }
    
              contador++;
        }
        inputFocus[i]=fila;
        fila=[];
    }
    contador=0;
    for($i=0;$i<9;$i++){
      
     inputFocus[$i][indiceFocus[1]].classList.add('custom-input-focus');
    }
    for($j=0;$j<9;$j++){
      inputFocus[indiceFocus[0]][$j].classList.add('custom-input-focus');
     }

     for($i=Math.floor(indiceFocus[0]/3)*3;$i<Math.floor(indiceFocus[0]/3)*3+3;$i++){
      for($j=Math.floor(indiceFocus[1]/3)*3;$j<Math.floor(indiceFocus[1]/3)*3+3;$j++){
        inputFocus[$i][$j].classList.add('custom-input-focus');
      }

     }

    }))
    inputs.forEach((input,index)=>input.addEventListener('focusout',()=>{
      indiceFocus=[];
      for(let i=0;i<9;i++){
        for(let j=0;j<9;j++){
          fila[j]=inputs[contador];    
    if(index==contador){
        indiceFocus.push(i);
        indiceFocus.push(j);
        console.log(indiceFocus);
    }
    
              contador++;
        }
        inputFocus[i]=fila;
        fila=[];
    }
    contador=0;
    for($i=0;$i<9;$i++){
     inputFocus[$i][indiceFocus[1]].classList.remove('custom-input-focus');
    }
    for($j=0;$j<9;$j++){
      inputFocus[indiceFocus[0]][$j].classList.remove('custom-input-focus');
     }

     for($i=Math.floor(indiceFocus[0]/3)*3;$i<Math.floor(indiceFocus[0]/3)*3+3;$i++){
      for($j=Math.floor(indiceFocus[1]/3)*3;$j<Math.floor(indiceFocus[1]/3)*3+3;$j++){
        inputFocus[$i][$j].classList.remove('custom-input-focus');
      }

     }
    }));
    
    inputs.forEach((input,index)=>input.addEventListener('keyup',()=>{
        console.log(index);
        //indexEvent=index;
        for(let i=0;i<9;i++){
            for(let j=0;j<9;j++){
              inputs[contador].value==""?fila[j]=0:fila[j]=parseInt(inputs[contador].value);    
        if(index==contador){
            modifiedIndex.push(i);
            modifiedIndex.push(j);
        }
                  contador++;
            }
            inputValues[i]=fila;
            fila=[];
        }
        contador=0;
        console.log(inputValues);
        console.log(modifiedIndex);
        $.ajax({
            url: '../validar.php', // Ruta al archivo PHP
            method: 'POST',
            data: {  input_values: inputValues,
              modified_index: modifiedIndex}, // Envía los valores de los inputs a PHP
            success: function(response) {
              // Aquí puedes manejar la respuesta de PHP
              console.log(response);
              if(response==""){
                console.log(modifiedIndex);
                inputs[modifiedIndex[0]*9+modifiedIndex[1]].style.color="red";
                modifiedIndex=[];
              }else{
                inputs[modifiedIndex[0]*9+modifiedIndex[1]].style.color="black";
                modifiedIndex=[];
                if(!Array.from(inputs).some(input=>input.value=='')){
                  alert("has ganado");
                }
              }
            }
          });
          //modifiedIndex=[];
    }
    
    )); 
   // console.log(contador);
   
   /* for(let i=0;i<9;i++){
        for(let j=0;j<9;j++){
            fila[j]=inputs[contador].value;    
    if(indexEvent==contador){
        modifiedIndex.push(i);
        modifiedIndex.push(j);
    }
              contador++;
        }
        inputValues[i]=fila;
        fila=[];
    }*/
    
   /* inputs.forEach(function(input) {
      inputValues.push(input.value);
    });*/
    
    // Realiza la solicitud AJAX a tu archivo PHP
   /* $.ajax({
      url: '../validar.php', // Ruta al archivo PHP
      method: 'POST',
      data: {  input_values: inputValues,
        modified_index: modifiedIndex}, // Envía los valores de los inputs a PHP
      success: function(response) {
        // Aquí puedes manejar la respuesta de PHP
        console.log(response);
      }
    });*/
    modifiedIndex=[];
    
    
  
  