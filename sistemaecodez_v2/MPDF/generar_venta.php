<?php

require_once __DIR__ . '/vendor/autoload.php';
require '../conexion_global/r_conexion.php';
$mpdf = new \Mpdf\Mpdf();
$query = "SELECT
venta.venta_id, 
venta.cliente_id, 
CONCAT_WS(' ',persona.persona_nombre,persona.persona_apepat,persona.persona_apemat) as cliente,
persona.persona_nrodocumento,
venta.venta_ticomprobante, 
venta.venta_seriecomprobante, 
venta.venta_numcomprobante, 
venta.venta_fecha, 
venta.venta_impuesto, 
venta.venta_total, 
venta.venta_porcentaje,
persona.persona_telefono
FROM
venta
INNER JOIN
persona
ON 
    venta.cliente_id = persona.persona_id
where venta.venta_id='".$_GET['codigo']."'";
$resultado = $mysqli -> query($query);
while($row1 = $resultado->fetch_assoc()){
  $html = '<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Reporte Venta</title>
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
              <th width="20%" style="border-top:0px;border-left:0px;border-bottom:0px;border-right:0px"><img src="img/logo.png" width="300px"></th>
              <th width="50%" style="border-top:0px;border-left:0px;border-bottom:0px;border-right:0px;text-align:center">
                <b>ASOCIACION DE RECOLECTORES </b> <br> <b> ECODEZ </b><br>
                <b style="color:black;font-size:12px">Direccion</b>: <span  style="color:black;font-size:12px">Bogota; - Cra 88g # 74c 33 sur</span><br>
                <b style="color:black;font-size:12px">Tel&eacute;fono</b>: <span  style="color:black;font-size:12px"> 3022576317</span><br>
                <b style="color:black;font-size:12px">Correo</b>: <span  style="color:black;font-size:12px"> ecodezasociacion@gmail.com</span><br>
              </th>
              <th width="30%" style="text-align:center">
                <h3 style="color:black">NIT: 901403999-0</h3>
                <h1 style="color:black">'.$row1['venta_ticomprobante'].' DE VENTA</h1><br>
                <h3 style="color:black">'.utf8_encode($row1['venta_seriecomprobante']).' - '.utf8_encode($row1['venta_numcomprobante']).'</h3>
              </th>
            </tr>
          </thead>
        </table>
        <div id="project">
          <div><span style="color:black;font-size:13px"><b>CEDULA:</b> '.$row1['persona_nrodocumento'].'</span></div>
          <div><span style="color:black;font-size:13px"><b>CLIENTE:</b> '.utf8_encode($row1['cliente']).'</span></div>
          <div><span style="color:black;font-size:13px"><b>NÚMERO CONTACTO:</b> '.$row1['persona_telefono'].'</span></div>
          <div><span style="color:black;font-size:13px"><b>FECHA:</b> '.$row1['venta_fecha'].'</span></div>
        </div>
      </header>
      <main>
        <table>
          <thead>
            <tr>
              <th class="service">ITEM</th>
              <th class="desc">DESCRIPCIÓN</th>
              <th>PRECIO</th>
              <th>CANTIDAD</th>
              <th>SUB TOTAL</th>
            </tr>
          </thead>
          <tbody>';
          $query2 = "SELECT
          producto.producto_nombre, 
          detalle_venta.detalleventa_cantidad, 
          detalle_venta.detalleventa_precio, 
          detalle_venta.detalleventa_cantidad * detalle_venta.detalleventa_precio as subtotal,
          detalle_venta.venta_id
      FROM
          detalle_venta
          INNER JOIN
          producto
          ON 
              detalle_venta.producto_id = producto.producto_id
            where detalle_venta.venta_id='".$row1['venta_id']."'";
            $contador=0;
            $resultado2 = $mysqli -> query($query2);
            while($row2 = $resultado2->fetch_assoc()){
              $contador++;
            $html.='<tr>
                <td class="service">'.$contador.'</td>
                <td class="desc">'.utf8_encode($row2['producto_nombre']).'</td>
                <td class="unit">'.$row2['detalleventa_precio'].'</td>
                <td class="qty">'.$row2['detalleventa_cantidad'].'</td>
                <td class="total">'.round($row2['subtotal'],2).'</td>
              </tr>';
            }
            if($row1['venta_ticomprobante']=="FACTURA"){
              $html.='          
              <tr>
                <td colspan="2" rowspan="4" style="background:#FFFFFF;">
                <b>
                
                </b></td>
              </tr>        
              <tr>
                <td colspan="2"  style="background:#FFFFFF;"><b>SUBTOTAL</b></td>
                <td class="total"  style="background:#FFFFFF;">'.($row1['venta_total']-$row1['ingreso_impuesto']).'</td>
              </tr>            
              <tr>
                <td colspan="2"  style="background:#FFFFFF;"><b>IVA '.($row1['venta_porcentaje']*100).'%</b></td>
                <td class="total" style="background:#FFFFFF;">'.$row1['venta_impuesto'].'</td>
              </tr>
              <tr>
                <td colspan="2" class="TOTAL"  style="background:#FFFFFF;"><b>TOTAL</b></td>
                <td class="grand total"  style="background:#FFFFFF;">'.$row1['venta_total'].'</td>
              </tr>'
              
              ;
            }else{
              $html.='              
            <tr>
              <td colspan="4" class="TOTAL"><b>TOTAL</b></td>
              <td class="grand total">'.$row1['venta_total'].'</td>
            </tr>';
            
            }
          $html.='
          </tbody>
        </table>
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
  </html>';
}
$css = file_get_contents('css/style.css');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf -> Output('reporte_salida.pdf', 'D');
