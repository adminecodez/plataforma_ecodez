<?php
    require '../../modelo/modelo_ingreso.php';
    $MI = new Modelo_Ingreso();//instanciamos
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $producto = htmlspecialchars($_POST['producto'],ENT_QUOTES,'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'],ENT_QUOTES,'UTF-8');
    $precio = htmlspecialchars($_POST['precio'],ENT_QUOTES,'UTF-8');
    //Convertimos los datos a arreglo explode()
    $array_producto = explode(",",$producto);
    $array_cantidad = explode(",",$cantidad);
    $array_precio = explode(",",$precio);
    for ($i=0; $i < count($array_producto); $i++) { 
        $consulta = $MI->Registrar_Ingreso_Detalle($id,$array_producto[$i],$array_cantidad[$i],$array_precio[$i]);
    }


    echo $consulta;

?>