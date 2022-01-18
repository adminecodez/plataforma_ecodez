<?php
    class Modelo_Venta{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Listar_Venta($finicio,$ffin){
            $sql = "call SP_LISTAR_VENTA('$finicio','$ffin')";
            $arreglo = array();
            if($consulta = $this->conexion->conexion->query($sql)){
                while($consulta_vu = mysqli_fetch_assoc($consulta)){
                           $arreglo["data"][] = $consulta_vu;
                }

                return $arreglo;
                $this->conexion->cerrar();
            }  
        }

        function Anular_Venta($idventa){
            $sql = "call SP_ANULAR_VENTA('$idventa')";
            if($consulta = $this->conexion->conexion->query($sql)){
                return 1;
               
            }else{
                return 0;
            }
            $this->conexion->cerrar();
        }


        
        function listar_combo_cliente(){
            $sql = "call SP_LISTAR_COMBO_CLIENTE()";
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

        function Registrar_Venta($idcliente,$idusuario,$tipo,$serie,$ncomprobante,$total,$impuesto,$porcentaje){
            $sql = "call SP_REGISTRAR_VENTA('$idcliente','$idusuario','$tipo','$serie','$ncomprobante','$total','$impuesto','$porcentaje')";
            if($consulta = $this->conexion->conexion->query($sql)){
                if($row= mysqli_fetch_array($consulta)){
                    return $respuesta = trim($row[0]);
                }
                
                $this->conexion->cerrar();
            }  
        }

        function Registrar_Venta_Detalle($id,$array_producto,$array_cantidad,$array_precio){
            $sql = "call SP_REGISTRAR_VENTA_DETALLE('$id','$array_producto','$array_cantidad','$array_precio')";
            if($consulta = $this->conexion->conexion->query($sql)){
                return 1;
               
            }else{
                return 0;
            }
            $this->conexion->cerrar();
        }

    }


?>