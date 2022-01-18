<?php

require_once __DIR__ . '/vendor/autoload.php';
require '../conexion_global/r_conexion.php';
$mpdf = new \Mpdf\Mpdf();
$query = "SELECT
proveedor.proveedor_id, 
proveedor.persona_id, 
proveedor.proveedor_razonsocial, 
persona.persona_nombre, 
persona.persona_apepat, 
persona.persona_apemat, 
persona.persona_nrodocumento,
persona.persona_telefono
FROM
proveedor
INNER JOIN
persona
ON 
    proveedor.persona_id = persona.persona_id
    where proveedor.persona_id='".$_GET['idper']."'";
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
        <table style="border-collapse;" border="1">
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
                <h3 style="color:black">VENTAS POR PROVEEDOR</h3>
              </th>
            </tr>
          </thead>
        </table>
        <div id="project">
          <div><span style="color:black;font-size:13px"><b>PROVEEDOR:</b> '.utf8_encode($row1['proveedor_razonsocial']).'</span></div>
          <div><span style="color:black;font-size:13px"><b>NÚMERO CONTACTO:</b> '.$row1['persona_telefono'].'</span></div>
          <div><span style="color:black;font-size:13px"><b>CEDULA:</b> '.$row1['persona_nrodocumento'].'</span></div>
          <div><span style="color:black;font-size:13px"><b>VENTRAS ENTRE EL :</b> '.$_GET['inicio'].' Y '.$_GET['inicio'].'</span></div>
        </div>
      </header>
      <main>
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
           $query2 = "SELECT
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
             WHERE proveedor.persona_id=".$_GET['idper']." AND ingreso.ingreso_fecha BETWEEN'$inicio' AND '$fin' GROUP BY detalle_ingreso.producto_id ";
            $contador=0;
            $totalgeneral=0;
            $totalcantidad=0;
            $resultado2 = $mysqli -> query($query2);
            while($row2 = $resultado2->fetch_assoc()){
              $contador++;
              $totalgeneral=$totalgeneral+$row2['total'];
              $totalcantidad=$totalcantidad+$row2['cantidad'];
            $html.='<tr>
                <td class="service">'.$contador.'</td>
                <td class="desc" style="text-align:left;">'.utf8_encode($row2['producto_nombre']).'</td>
                <td class="unit" style="text-align:left;">'.$row2['categoria_nombre'].'</td>
                <td class="qty" style="text-align:center;">'.$row2['cantidad'].'</td>
                <td class="total" style="text-align:center;">'.round($row2['total'],2).'</td>
              </tr>';
            }
              $html.='              
            <tr>
              <td colspan="4" class="TOTAL" ><b>TOTAL CANTIDAD</b></td>
              <td class="grand total">'.$totalcantidad.'</td>
            </tr>
            <tr>
            <td colspan="4" class="TOTAL" ><b>TOTAL GENERAL</b></td>
              <td>'.$totalgeneral.'</td>
            </tr>';
            
         $html.=' 
          </tbody>
        </table> 
        <div id="notices">
          <div>AVISO:</div>
          <div class="notice">
          En caso de reclamacion, dirijase a la oficina proncipal.</div>
        </div>
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
