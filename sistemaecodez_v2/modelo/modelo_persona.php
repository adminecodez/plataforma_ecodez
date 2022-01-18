<?php
    class Modelo_Persona{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Listar_Persona(){
            $sql = "call SP_LISTAR_PERSONA()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }
        function Registrar_Persona($nombre,$apepat,$apemat,$ndocumento,$tdocumento,$sexo,$telefono){
            $sql = "call SP_REGISTRAR_PERSONA('$nombre','$apepat','$apemat','$ndocumento','$tdocumento','$sexo','$telefono')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }
        
        function Editar_Persona($id,$nombre,$apepat,$apemat,$ndocumentoactual,$ndocumentonuevo,$tdocumento,$sexo,$telefono,$estatus){
            $sql = "call SP_EDITAR_PERSONA('$id','$nombre','$apepat','$apemat','$ndocumentoactual','$ndocumentonuevo','$tdocumento','$sexo','$telefono','$estatus')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

    }


?>