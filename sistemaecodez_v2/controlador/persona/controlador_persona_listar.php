<?php
    require '../../modelo/modelo_persona.php';
    $MP = new Modelo_Persona();
    $consulta = $MP->Listar_Persona();
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