<?php
  $mysqli = new mysqli('localhost','asoecod1_brayan','ecodezbrayan','asoecod1_sistemaecodez_v2');
    if(mysqli_connect_errno()){
        echo 'La conexion fallida: ',mysqli_connect_error();
        exit();
    }

?>