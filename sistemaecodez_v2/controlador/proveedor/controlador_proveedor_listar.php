<?php
    require '../../modelo/modelo_proveedor.php';
    $MP = new Modelo_Proveedor();
    $consulta = $MP->Listar_Proveedor();
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