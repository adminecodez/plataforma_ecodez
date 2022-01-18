<?php
    require '../../modelo/modelo_categoria.php';
    $MC = new Modelo_Categoria();//instanciamos
    $consulta = $MC->Listar_Categoria();
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