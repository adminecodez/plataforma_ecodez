<?php
    require '../../modelo/modelo_venta.php';
    $MV = new Modelo_Venta();//instanciamos
    $consulta = $MV->listar_combo_cliente();
    echo json_encode($consulta)
?>