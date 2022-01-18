<?php
require '../../modelo/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $consulta = $MU->Traer_Precio_Tonelada();
    echo json_encode($consulta)
?>