<?php
    require '../../modelo/modelo_venta.php';
    $MV = new Modelo_Venta();//instanciamos
    $finicio = htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
    $ffin = htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');
    $consulta = $MV->Listar_Venta($finicio,$ffin);
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