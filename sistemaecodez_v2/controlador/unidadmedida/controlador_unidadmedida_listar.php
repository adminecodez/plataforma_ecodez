<?php
    require '../../modelo/modelo_unidadmedida.php';
    $MU = new Modelo_UnidadMedida();//instanciamos
    $consulta = $MU->Listar_UnidadMedida();
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