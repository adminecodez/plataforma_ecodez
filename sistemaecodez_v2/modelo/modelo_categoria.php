<?php
    class Modelo_Categoria{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Listar_Categoria(){
            $sql = "call SP_LISTAR_CATEGORIA()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }
        function Registrar_Categoria($categoria){
            $sql = "call SP_REGISTRAR_CATEGORIA('$categoria')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

        function Modificar_Categoria($id,$categoriaactual,$categorianuevo,$estatus){
            $sql = "call SP_EDITAR_CATEGORIA('$id','$categoriaactual','$categorianuevo','$estatus')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

    }


?>