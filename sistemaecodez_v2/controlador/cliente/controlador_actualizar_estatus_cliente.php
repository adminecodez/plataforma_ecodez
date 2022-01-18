<?php
    require '../../modelo/modelo_cliente.php';
    $MC = new Modelo_Cliente();
    $idcliente = htmlspecialchars(strtoupper($_POST['idcliente']),ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars(strtoupper($_POST['estatus']),ENT_QUOTES,'UTF-8');
    $consulta = $MC->Modificar_Estatus_Cliente($idcliente,$estatus);
    echo $consulta;


 

?>