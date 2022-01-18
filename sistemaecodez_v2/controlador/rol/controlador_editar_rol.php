<?php
    require '../../modelo/modelo_rol.php';
    $MR = new Modelo_Rol();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $rolactual = htmlspecialchars($_POST['rolactual'],ENT_QUOTES,'UTF-8');
    $rolnuevo = htmlspecialchars($_POST['rolnuevo'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MR->Modificar_Rol($id,$rolactual,$rolnuevo,$estatus);
    echo $consulta;
?>

