<?php
    require '../../modelo/modelo_categoria.php';
    $MC = new Modelo_Categoria();//instanciamos
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $categoriaactual = htmlspecialchars($_POST['categoriaactual'],ENT_QUOTES,'UTF-8');
    $categorianuevo = htmlspecialchars($_POST['categorianuevo'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MC->Modificar_Categoria($id,$categoriaactual,$categorianuevo,$estatus);
    echo $consulta;
?>

