<?php
	class conexion{
		private $servidor;
		private $usuario;
		private $contrasena;
		private $basedatos;
		public $conexion;
		public function __construct(){
		    $this->servidor = "localhost";
        	$this->usuario = "asoecod1_brayan";
        	$this->contrasena = "ecodezbrayan";
			$this->basedatos = "asoecod1_sistemaecodez_v2";
		}
        
		function conectar(){
			$this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
			$this->conexion->set_charset("utf8");
        }
        
		function cerrar(){
			$this->conexion->close();	
		}
	}
?> 