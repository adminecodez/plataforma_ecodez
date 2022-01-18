<?php

require_once __DIR__ . '/vendor/autoload.php';
require '../conexion_global/r_conexion.php';
$mpdf = new \Mpdf\Mpdf(['setAutoBottomMargin' => 'stretch']);
$query = "SELECT * FROM tonelada";
    $inicio=$_GET['inicio'];
    $fin=$_GET['fin'];
$resultado = $mysqli -> query($query);
while($row1 = $resultado->fetch_assoc()){
  $html = '<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Reporte Ingreso</title>
      <link rel="stylesheet" href="style.css" media="all" />
      <style>
        @page {
            size: auto;
            odd-footer-name: html_myFooter1;
        }
      </style>
    </head>
    <body>
      <header class="clearfix">
        <table style="border-collapse;width:760px" border="1">
          <thead>
            <tr>
              <th width="200px" style="border-top:0px;border-left:0px;border-bottom:0px;border-right:0px"><img src="img/logo.png" width="300px"></th>
              <th style="border-top:0px;border-left:0px;border-bottom:0px;border-right:0px;text-align:left;text-align:center;width:400px">
                <b>ASOCIACIÓN DE RECOLECTORES ECODEZ</b><br>
                <b style="color:black;font-size:15px">Dirección</b>:<span  style="color:black;font-size:15px"> Cra 88G # 74C SUR 33</span><br>
                <b style="color:black;font-size:15px">Tel&eacute;fono</b>: <span  style="color:black;font-size:15px"> 3022576317</span><br>
                <b style="color:black;font-size:15px">Correo</b>: <span  style="color:black;font-size:15px"> ecodezasociacion@gmail.com</span><br>
              </th>
              <th width="100px" style="text-align:center">
                <h4 style="color:black">INFORME DE COMPRAS GENERAL DE BODEGAS</h4>
              </th>
            </tr>
          </thead>
        </table>
        <div id="project">
          <div><span style="color:black;font-size:13px"><b>VENTRAS ENTRE EL :</b> '.$_GET['inicio'].' Y '.$_GET['inicio'].'</span></div>
        </div>
      </header>
      <main>';
        $query2="SELECT
        ingreso.proveedor_id, 
        proveedor.proveedor_razonsocial
    FROM
        ingreso
        INNER JOIN
        proveedor
        ON 
            ingreso.proveedor_id = proveedor.proveedor_id
             WHERE  ingreso.ingreso_fecha BETWEEN '$inicio' AND '$fin'
            GROUP BY ingreso.proveedor_id";
        $resultado2 = $mysqli -> query($query2);
        $cantotal=0;
        $montotal=0;
        $tontotal=0;
        while($row2 = $resultado2->fetch_assoc()){
        $idproveedor=$row2['proveedor_id'];
        $html.='
        <div id="project">
          <div><span style="color:black;font-size:13px"><b>PROVEEDOR: </b> '.$row2['proveedor_razonsocial'].' '.$idproveedor.'</span></div>
        </div>
        <table>
          <thead>
            <tr style="color:black !important">
              <th style="color:black !important;font-weight:bold" class="service">ITEM</th>
              <th style="color:black !important;font-weight:bold" class="desc">CATEGORIA</th>
              <th style="color:black !important;font-weight:bold" class="desc">MATERIAL</th>
              <th style="color:black !important;font-weight:bold">CANTIDAD</th>
              <th style="color:black !important;font-weight:bold">TOTAL</th>
            </tr>
          </thead>
          <tbody>';
           $query3 = "SELECT
           detalle_ingreso.producto_id, 
           sum(detalle_ingreso.detalleingreso_cantidad) as cantidad, 
           sum(detalle_ingreso.detalleingreso_total) as total, 
           producto.producto_nombre, 
           producto.producto_presentacion,
           categoria.categoria_nombre
            FROM
              ingreso
              INNER JOIN
              proveedor
              ON 
                ingreso.proveedor_id = proveedor.proveedor_id
              INNER JOIN
              detalle_ingreso
              ON 
                ingreso.ingreso_id = detalle_ingreso.ingreso_id
              INNER JOIN
              producto
              ON 
                detalle_ingreso.producto_id = producto.producto_id
              INNER JOIN
              categoria
              ON 
                producto.categoria_id = categoria.categoria_id
             WHERE ingreso.proveedor_id='.$idproveedor.' GROUP BY detalle_ingreso.producto_id";
            $contador=0;
            $totalgeneral=0;
            $totalcantidad=0;
            $resultado3 = $mysqli -> query($query3);
            while($row3 = $resultado3->fetch_assoc()){
              $contador++;
              $totalgeneral=$totalgeneral+$row3['total'];
              $totalcantidad=$totalcantidad+$row3['cantidad'];
            $html.='<tr>
                <td class="service">'.$contador.'</td>
                <td class="desc" style="text-align:left;">'.utf8_encode($row3['producto_nombre']).'</td>
                <td class="unit" style="text-align:left;">'.$row3['categoria_nombre'].'</td>
                <td class="qty" style="text-align:center;">'.$row3['cantidad'].'</td>
                <td class="total" style="text-align:center;">'.round($row3['total'],2).'</td>
              </tr>';
            }
              $html.='              
            <tr>
              <td colspan="4" class="TOTAL" style="font-size:10px"><b>TOTAL CANTIDAD</b></td>
              <td class="grand total" style="text-align:center;font-size:10px"> '.round($totalcantidad,2).'</td>
            </tr>
            <tr>
            <td colspan="4" class="TOTAL" style="font-size:10px"><b>TOTAL COMPRAS</b></td>
              <td style="text-align:center;font-size:10px">$ '.round($totalgeneral,2).'</td>
            </tr>'; 
            $cantotal=$cantotal+$totalcantidad;
            $montotal=$montotal+$totalgeneral;
     //       $tontotal=$tontotal+($totalcantidad*$row1['precio_tonelada']);
         $html.=' 
          </tbody>
          </table>';
        }
        
        $html.='
        <table width="100%" style="text-align:center;">
            <tr>
                <td>
                    <b>TOTAL CANTIDAD:</b> '.$cantotal.'
                </td>
                <td>
                    <b>TOTAL COMPRAS:</b> $'.$montotal.'
                </td>

            </tr>
        </table>
      </main>
      <htmlpagefooter name="myFooter1" style="display:none">
        <table width="100%" style="text-align:center;">
            <tr>
                <td width="100%" style="text-align:right;background-color:white;">
                    <hr><br>
                    Page: {PAGENO}/{nbpg}
                </td>
            </tr>
        </table>
      </htmlpagefooter>
    </body>
    </script>
  </html>';
  
}
$css = file_get_contents('css/style.css');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf -> Output();
