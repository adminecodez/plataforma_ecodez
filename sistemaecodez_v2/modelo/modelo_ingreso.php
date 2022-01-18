<?php
    class Modelo_Ingreso{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Listar_Ingreso($finicio,$ffin){
            $sql = "call SP_LISTAR_INGRESO('$finicio','$ffin')";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }

        function Listar_Ingreso_Proveedor($finicio,$ffin,$id){
            $sql = "call SP_LISTAR_INGRESO_PROVEEDOR('$finicio','$ffin','$id')";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }
        function Anular_Ingreso($idingreso){
            $sql = "call SP_ANULAR_INGRESO('$idingreso')";
            if($consulta = $this->conexion->conexion->query($sql)){
                return 1;
               
            }else{
                return 0;
            }
            $this->conexion->cerrar();
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

        
        function listar_combo_proveedor(){
            $sql = "call SP_lISTAR_COMBO_PROVEEDOR()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_array($consulta)){
                           $arreglo[] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }

        
        function listar_combo_producto(){
            $sql = "call SP_LISTAR_COMBO_PRODUCTO()";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_array($consulta)){
                           $arreglo[] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }

        function Registrar_Ingreso($idproveedor,$idusuario,$tipo,$serie,$ncomprobante,$total,$impuesto,$porcentaje){
            $sql = "call SP_REGISTRAR_INGRESO('$idproveedor','$idusuario','$tipo','$serie','$ncomprobante','$total','$impuesto','$porcentaje')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

        function Registrar_Ingreso_Detalle($id,$array_producto,$array_cantidad,$array_precio){
            $sql = "call SP_REGISTRAR_INGRESO_DETALLE('$id','$array_producto','$array_cantidad','$array_precio')";
            if($consulta = $this->conexion->conexion->query($sql)){
                return 1;
               
            }else{
                return 0;
            }
            $this->conexion->cerrar();
        }

    }


?>