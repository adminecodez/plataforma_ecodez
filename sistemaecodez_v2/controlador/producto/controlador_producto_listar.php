<?php
    require '../../modelo/modelo_producto.php';
    $MP = new Modelo_Producto();
    $consulta = $MP->Listar_Producto();
    if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
		    "sEcho": 1,
		    "iTotalRecords": "0",
		    "iTotalDisplayRecords": "0",
		    "aaData": []
		}';       
    }

?>