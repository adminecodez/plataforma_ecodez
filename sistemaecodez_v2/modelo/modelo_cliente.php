<?php
    class Modelo_Cliente{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Listar_Cliente(){
            $sql = "call SP_LISTAR_CLIENTE()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }
        function Registrar_Cliente($nombre,$apepat,$apemat,$ndocumento,$tdocumento,$sexo,$telefono){
            $sql = "call SP_REGISTRAR_CLIENTE('$nombre','$apepat','$apemat','$ndocumento','$tdocumento','$sexo','$telefono')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }
        
        function Modificar_Estatus_Cliente($idcliente,$estatus){
            $sql = "call SP_MODIFICAR_ESTATUS_CLIENTE('$idcliente','$estatus')";
            if($consulta = $this->conexion->conexion->query($sql)){
                return 1;
               
            }else{
                return 0;
            }
            $this->conexion->cerrar();
        }

    }


?>