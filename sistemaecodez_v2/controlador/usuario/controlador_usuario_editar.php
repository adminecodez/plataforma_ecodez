<?php
require '../../modelo/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8'); 
    $idpersona = htmlspecialchars($_POST['idpersona'],ENT_QUOTES,'UTF-8');
    $emailnuevo = htmlspecialchars($_POST['emailnuevo'],ENT_QUOTES,'UTF-8');
    $idrol = htmlspecialchars($_POST['idrol'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Editar_Usuario($id,$idpersona,$emailnuevo,$idrol,$estatus);
    echo $consulta;
    
?>