<?php
    require '../../modelo/modelo_proveedor.php';
    $MP = new Modelo_Proveedor();
    $idproveedor = htmlspecialchars(strtoupper($_POST['idproveedor']),ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars(strtoupper($_POST['estatus']),ENT_QUOTES,'UTF-8');
    $consulta = $MP->Modificar_Estatus_Proveedor($idproveedor,$estatus);
    echo $consulta;
?>