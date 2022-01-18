<?php
    require '../../modelo/modelo_cliente.php';
    $MC = new Modelo_Cliente();
    $consulta = $MC->Listar_Cliente();
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