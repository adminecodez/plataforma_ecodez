<?php
    require '../../modelo/modelo_persona.php';
    $MP = new Modelo_Persona();
    $error="";
    $contador=0;
    $id = htmlspecialchars(strtoupper($_POST['id']),ENT_QUOTES,'UTF-8');
    $nombre = htmlspecialchars(strtoupper($_POST['nombre']),ENT_QUOTES,'UTF-8');
    $apepat = htmlspecialchars(strtoupper($_POST['apepat']),ENT_QUOTES,'UTF-8');
    $apemat = htmlspecialchars(strtoupper($_POST['apemat']),ENT_QUOTES,'UTF-8');
    $ndocumentoactual = htmlspecialchars(strtoupper($_POST['ndocumentoactual']),ENT_QUOTES,'UTF-8');
    $ndocumentonuevo = htmlspecialchars(strtoupper($_POST['ndocumentonuevo']),ENT_QUOTES,'UTF-8');
    $tdocumento = htmlspecialchars(strtoupper($_POST['tdocumento']),ENT_QUOTES,'UTF-8');
    $sexo = htmlspecialchars(strtoupper($_POST['sexo']),ENT_QUOTES,'UTF-8');
    $telefono = htmlspecialchars(strtoupper($_POST['telefono']),ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars(strtoupper($_POST['estatus']),ENT_QUOTES,'UTF-8');

    if($contador>0){
        echo $error;
    }else{
        $consulta = $MP->Editar_Persona($id,$nombre,$apepat,$apemat,$ndocumentoactual,$ndocumentonuevo,$tdocumento,$sexo,$telefono,$estatus);
        echo $consulta;
    }

 

?>