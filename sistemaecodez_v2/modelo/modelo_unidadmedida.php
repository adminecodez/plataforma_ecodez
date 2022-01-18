<?php
    class Modelo_UnidadMedida{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Listar_UnidadMedida(){
            $sql = "call SP_LISTAR_UNIDADMEDIDA()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }
        function Registrar_UnidadMedida($unidad,$abreviatura){
            $sql = "call SP_REGISTRAR_UNIDADMEDIDA('$unidad','$abreviatura')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

        function Modificar_UnidadMedida($id,$unidadactual,$unidadnueva,$abreviatura,$estatus){
            $sql = "call SP_EDITAR_UNIDAD('$id','$unidadactual','$unidadnueva','$abreviatura','$estatus')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

    }


?>