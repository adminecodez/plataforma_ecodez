<?php
require '../../modelo/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8'); 
    $pre = htmlspecialchars($_POST['pre'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Editar_Precio_Tonelada($id,$pre);
    echo $consulta;
    
?>