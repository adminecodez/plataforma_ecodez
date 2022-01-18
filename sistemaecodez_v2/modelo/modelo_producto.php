<?php
    class Modelo_Producto{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Listar_Producto(){
            $sql = "call SP_LISTAR_PRODUCTO()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }

        function listar_combo_categoria(){
            $sql = "call SP_LISTAR_COMBO_CATEGORIA()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_array($consulta)){
                           $arreglo[] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }

        function listar_combo_unidad(){
            $sql = "call SP_LISTAR_COMBO_UNIDAD()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_array($consulta)){
                           $arreglo[] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }

        function Registrar_Producto($producto,$presentacion,$categoria,$unidad,$precio,$ruta){
            $sql = "call SP_REGISTRAR_PRODUCTO('$producto','$presentacion','$categoria','$unidad','$precio','$ruta')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }
        
        function Editar_Producto($id,$producto,$presentacion,$categoria,$unidad,$precio,$estatus){
            $sql = "call SP_EDITAR_PRODUCTO('$id','$producto','$presentacion','$categoria','$unidad','$precio','$estatus')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

        function Editar_Foto_Producto($id,$ruta){
            $sql = "call SP_MODIFICAR_PRODUCTO_FOTO('$id','$ruta')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

    }


?>