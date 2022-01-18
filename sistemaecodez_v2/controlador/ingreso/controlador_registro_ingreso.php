<?php
    require '../../modelo/modelo_ingreso.php';
    $MI = new Modelo_Ingreso();//instanciamos
    $idproveedor = htmlspecialchars($_POST['idproveedor'],ENT_QUOTES,'UTF-8');
    $idusuario = htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
    $tipo = htmlspecialchars($_POST['tipo'],ENT_QUOTES,'UTF-8');
    $serie = htmlspecialchars($_POST['serie'],ENT_QUOTES,'UTF-8');
    $ncomprobante = htmlspecialchars($_POST['ncomprobante'],ENT_QUOTES,'UTF-8');
    $total = htmlspecialchars($_POST['total'],ENT_QUOTES,'UTF-8');
    $impuesto = htmlspecialchars($_POST['impuesto'],ENT_QUOTES,'UTF-8');
    $porcentaje = htmlspecialchars($_POST['porcentaje'],ENT_QUOTES,'UTF-8');
    $consulta = $MI->Registrar_Ingreso($idproveedor,$idusuario,$tipo,$serie,$ncomprobante,$total,$impuesto,$porcentaje);
    echo $consulta;

?>