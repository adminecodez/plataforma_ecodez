<?php
    require '../../modelo/modelo_ingreso.php';
    $MI = new Modelo_Ingreso();//instanciamos
    $finicio = htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
    $ffin = htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');
    $consulta = $MI->Listar_Ingreso($finicio,$ffin);
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