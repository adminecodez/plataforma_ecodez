<?php
    require '../../modelo/modelo_persona.php';
    $MP = new Modelo_Persona();
    $error="";
    $contador=0;
    $nombre = htmlspecialchars(strtoupper($_POST['nombre']),ENT_QUOTES,'UTF-8');
    $apepat = htmlspecialchars(strtoupper($_POST['apepat']),ENT_QUOTES,'UTF-8');
    $apemat = htmlspecialchars(strtoupper($_POST['apemat']),ENT_QUOTES,'UTF-8');
    $ndocumento = htmlspecialchars(strtoupper($_POST['ndocumento']),ENT_QUOTES,'UTF-8');
    $tdocumento = htmlspecialchars(strtoupper($_POST['tdocumento']),ENT_QUOTES,'UTF-8');
    $sexo = htmlspecialchars(strtoupper($_POST['sexo']),ENT_QUOTES,'UTF-8');
    $telefono = htmlspecialchars(strtoupper($_POST['telefono']),ENT_QUOTES,'UTF-8');

    if($contador>0){
        echo $error;
    }else{
        $consulta = $MP->Registrar_Persona($nombre,$apepat,$apemat,$ndocumento,$tdocumento,$sexo,$telefono);
        echo $consulta;
    }

 

?>