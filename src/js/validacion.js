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
     inputFocus[$i][indiceFocus[1]].style.border = "2px solid yellow";
    }
    for($j=0;$j<9;$j++){
      inputFocus[indiceFocus[0]][$j].style.border = "2px solid yellow";
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
     inputFocus[$i][indiceFocus[1]].style.border = "0";
    }
    for($j=0;$j<9;$j++){
      inputFocus[indiceFocus[0]][$j].style.border = "0";
     }

    }));