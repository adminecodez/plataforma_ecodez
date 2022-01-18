<?php
    require '../../modelo/modelo_unidadmedida.php';
    $MU = new Modelo_UnidadMedida();//instanciamos
    $unidad = htmlspecialchars($_POST['unidad'],ENT_QUOTES,'UTF-8');
    $abreviatura = htmlspecialchars($_POST['abreviatura'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Registrar_UnidadMedida($unidad,$abreviatura);
    echo $consulta;

?>