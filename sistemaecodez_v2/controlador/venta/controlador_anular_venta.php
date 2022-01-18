<?php
    require '../../modelo/modelo_venta.php';
    $MV = new Modelo_Venta();//instanciamos
    $idventa = htmlspecialchars($_POST['idventa'],ENT_QUOTES,'UTF-8');
    $consulta = $MV->Anular_Venta($idventa);
    echo $consulta;

?>