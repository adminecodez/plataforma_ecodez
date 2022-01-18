<?php
require '../../modelo/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $usuario = htmlspecialchars($_POST['u'],ENT_QUOTES,'UTF-8');
    $password = htmlspecialchars($_POST['p'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->VerificarUsuario($usuario,$password);
    $data = json_encode($consulta);
    if(count($consulta)>0){
        echo $data;
    }else{
        echo 0;
    }
?>