<?php
    require '../../modelo/modelo_producto.php';
    $MP = new Modelo_Producto();
    $consulta = $MP->listar_combo_unidad();
    echo json_encode($consulta)
?>