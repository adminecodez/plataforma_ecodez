<?php
    class Modelo_Proveedor{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Listar_Proveedor(){
            $sql = "call SP_LISTAR_PROVEEDOR()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }
        function Registrar_Proveedor($nombre,$apepat,$apemat,$ndocumento,$tdocumento,$sexo,$telefono,$razonsocial){
            $sql = "call SP_REGISTRAR_PROVEEDOR('$nombre','$apepat','$apemat','$ndocumento','$tdocumento','$sexo','$telefono','$razonsocial')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }
        
        function Modificar_Estatus_Proveedor($idproveedor,$estatus){
            $sql = "call SP_MODIFICAR_ESTATUS_PROVEEDOR('$idproveedor','$estatus')";
            if($consulta = $this->conexion->conexion->query($sql)){
                return 1;
               
            }else{
                return 0;
            }
            $this->conexion->cerrar();
        }

        function Modificar_Proveedor($idproveedor,$razonsocial,$nombre,$apepat,$apemat,$ndocumento,$tdocumento,$sexo,$telefono){
            $sql = "call SP_MODIFICAR_PROVEEDOR('$idproveedor','$razonsocial','$nombre','$apepat','$apemat','$ndocumento','$tdocumento','$sexo','$telefono')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            } 
        }

    }


?>