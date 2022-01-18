<?php
    require '../../modelo/modelo_unidadmedida.php';
    $MU = new Modelo_UnidadMedida();//instanciamos
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $unidadactual = htmlspecialchars($_POST['unidadactual'],ENT_QUOTES,'UTF-8');
    $unidadnueva = htmlspecialchars($_POST['unidadnueva'],ENT_QUOTES,'UTF-8');
    $abreviatura = htmlspecialchars($_POST['abreviatura'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Modificar_UnidadMedida($id,$unidadactual,$unidadnueva,$abreviatura,$estatus);
    echo $consulta;

?>