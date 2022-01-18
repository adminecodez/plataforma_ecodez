<?php
// solo letras con espacio
if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $tuvariable)){ 

}
// solo letras sin espacio
if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú]*$/", $tuvariable)){ 
    return $alerta;  
    }

    //////////////////////////////////////////////////////////////////
//solo numeros con espacio
if (!preg_match("/^[[:digit:]]*$/", $tuvariable)){ 
  
}

// solo numeros sin espacio

if (!preg_match("/^[[:digit:]\s]*$/", $tuvariable)){ 
    
    }
?>