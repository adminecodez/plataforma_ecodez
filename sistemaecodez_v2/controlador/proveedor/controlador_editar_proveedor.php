<?php
    require '../../modelo/modelo_proveedor.php';
    $MP = new Modelo_Proveedor();
    $idproveedor = htmlspecialchars(strtoupper($_POST['idproveedor']),ENT_QUOTES,'UTF-8');
    $razonsocial = htmlspecialchars(strtoupper($_POST['razonsocial']),ENT_QUOTES,'UTF-8');

    $nombre = htmlspecialchars(strtoupper($_POST['nombre']),ENT_QUOTES,'UTF-8');
    $apepat = htmlspecialchars(strtoupper($_POST['apepat']),ENT_QUOTES,'UTF-8');
    $apemat = htmlspecialchars(strtoupper($_POST['apemat']),ENT_QUOTES,'UTF-8');
    $ndocumento = htmlspecialchars(strtoupper($_POST['ndocumento']),ENT_QUOTES,'UTF-8');
    $tdocumento = htmlspecialchars(strtoupper($_POST['tdocumento']),ENT_QUOTES,'UTF-8');
    $sexo = htmlspecialchars(strtoupper($_POST['sexo']),ENT_QUOTES,'UTF-8');
    $telefono = htmlspecialchars(strtoupper($_POST['telefono']),ENT_QUOTES,'UTF-8');
    $consulta = $MP->Modificar_Proveedor($idproveedor,$razonsocial,$nombre,$apepat,$apemat,$ndocumento,$tdocumento,$sexo,$telefono);

    echo $consulta;
?>