<?php
    require '../../modelo/modelo_venta.php';
    $MV = new Modelo_Venta();//instanciamos
    $idcliente = htmlspecialchars($_POST['idcliente'],ENT_QUOTES,'UTF-8');
    $idusuario = htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
    $tipo = htmlspecialchars($_POST['tipo'],ENT_QUOTES,'UTF-8');
    $serie = htmlspecialchars($_POST['serie'],ENT_QUOTES,'UTF-8');
    $ncomprobante = htmlspecialchars($_POST['ncomprobante'],ENT_QUOTES,'UTF-8');
    $total = htmlspecialchars($_POST['total'],ENT_QUOTES,'UTF-8');
    $impuesto = htmlspecialchars($_POST['impuesto'],ENT_QUOTES,'UTF-8');
    $porcentaje = htmlspecialchars($_POST['porcentaje'],ENT_QUOTES,'UTF-8');
    $consulta = $MV->Registrar_Venta($idcliente,$idusuario,$tipo,$serie,$ncomprobante,$total,$impuesto,$porcentaje);
    echo $consulta;

?>