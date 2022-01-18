<?php
    require '../../modelo/modelo_ingreso.php';
    $MI = new Modelo_Ingreso();//instanciamos
    $consulta = $MI->listar_combo_producto();
    echo json_encode($consulta)
?>