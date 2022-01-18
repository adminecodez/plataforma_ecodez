<?php

require_once __DIR__ . '/vendor/autoload.php';
require '../conexion_global/r_conexion.php';
$mpdf = new \Mpdf\Mpdf();
$query = "SELECT
ingreso.ingreso_id, 
ingreso.ingreso_tipcomprobante, 
ingreso.ingreso_seriecomprobante, 
ingreso.ingreso_numcomprobante, 
ingreso.ingreso_fecha, 
proveedor.proveedor_razonsocial, 
persona.persona_telefono AS proveedor_numcontacto, 
persona.persona_nrodocumento,	
ingreso.ingreso_total, 
ingreso.ingreso_impuesto, 
ingreso.ingreso_porcentaje
FROM
ingreso
INNER JOIN
proveedor
ON 
  ingreso.proveedor_id = proveedor.proveedor_id
INNER JOIN
persona
ON 
  proveedor.persona_id = persona.persona_id
where ingreso.ingreso_id='".$_GET['codigo']."'";
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
              <th width="20%" style="border-top:0px;border-left:0px;border-bottom:0px;border-right:0px"><img src="img/logo.png" width="300px"></th>
              <th width="50%" style="border-top:0px;border-left:0px;border-bottom:0px;border-right:0px;text-align:center">
                <b>ASOCIACION DE RECOLECTORES </b> <br> <b> ECODEZ </b><br>
                <b style="color:black;font-size:12px">Direccion</b>: <span  style="color:black;font-size:12px">Bogota; - Cra 88g # 74c 33 sur</span><br>
                <b style="color:black;font-size:12px">Tel&eacute;fono</b>: <span  style="color:black;font-size:12px"> 3022576317</span><br>
                <b style="color:black;font-size:12px">Correo</b>: <span  style="color:black;font-size:12px"> ecodezasociacion@gmail.com</span><br>
              </th>
              <th width="30%" style="text-align:center">
                <h3 style="color:black">RUT: 901403999-0</h3>
                <h1 style="color:black">'.$row1['ingreso_tipcomprobante'].' DE INGRESO</h1><br>
                <h3 style="color:black">'.utf8_encode($row1['ingreso_seriecomprobante']).' - '.utf8_encode($row1['ingreso_numcomprobante']).'</h3>
              </th>
            </tr>
          </thead>
        </table>
        <div id="project">
          <div><span style="color:black;font-size:13px"><b>CEDULA:</b> '.$row1['persona_nrodocumento'].'</span></div>
          <div><span style="color:black;font-size:13px"><b>PROVEEDOR:</b> '.utf8_encode($row1['proveedor_razonsocial']).'</span></div>
          <div><span style="color:black;font-size:13px"><b>NÚMERO CONTACTO:</b> '.$row1['proveedor_numcontacto'].'</span></div>
          <div><span style="color:black;font-size:13px"><b>FECHA:</b> '.$row1['ingreso_fecha'].'</span></div>
        </div>
      </header>
      <main>
        <table>
          <thead>
            <tr style="color:black !important">
              <th style="color:black !important;font-weight:bold" class="service">ITEM</th>
              <th style="color:black !important;font-weight:bold" class="desc">DESCRIPCIÓN</th>
              <th style="color:black !important;font-weight:bold">PRECIO</th>
              <th style="color:black !important;font-weight:bold">CANTIDAD</th>
              <th style="color:black !important;font-weight:bold">SUB TOTAL</th>
            </tr>
          </thead>
          <tbody>';
          $query2 = "SELECT
          producto.producto_nombre, 
          detalle_ingreso.detalleingreso_cantidad, 
          detalle_ingreso.detalleingreso_precio,
          detalle_ingreso.detalleingreso_cantidad * detalle_ingreso.detalleingreso_precio AS subtotal
        FROM
          detalle_ingreso
          INNER JOIN
          producto
          ON 
            detalle_ingreso.producto_id = producto.producto_id
            where detalle_ingreso.ingreso_id='".$row1['ingreso_id']."'";
            $contador=0;
            $resultado2 = $mysqli -> query($query2);
            while($row2 = $resultado2->fetch_assoc()){
              $contador++;
            $html.='<tr>
                <td class="service">'.$contador.'</td>
                <td class="desc">'.utf8_encode($row2['producto_nombre']).'</td>
                <td class="unit">'.$row2['detalleingreso_precio'].'</td>
                <td class="qty">'.$row2['detalleingreso_cantidad'].'</td>
                <td class="total">'.round($row2['subtotal'],2).'</td>
              </tr>';
            }
            if($row1['ingreso_tipcomprobante']=="FACTURA"){
              $html.='          
              <tr>
                <td colspan="2" rowspan="4" style="background:#FFFFFF;">
                <b>
                <barcode code="54321068" type="QR" class="barcode" size="1.2" disableborder="1"/>
                </b></td>
              </tr>        
              <tr>
                <td colspan="2"  style="background:#FFFFFF;"><b>SUBTOTAL</b></td>
                <td class="total"  style="background:#FFFFFF;">'.($row1['ingreso_total']-$row1['ingreso_impuesto']).'</td>
              </tr>            
              <tr>
                <td colspan="2"  style="background:#FFFFFF;"><b>IGV '.($row1['ingreso_porcentaje']*100).'%</b></td>
                <td class="total" style="background:#FFFFFF;">'.$row1['ingreso_impuesto'].'</td>
              </tr>
              <tr>
                <td colspan="2" class="TOTAL"  style="background:#FFFFFF;"><b>TOTAL</b></td>
                <td class="grand total"  style="background:#FFFFFF;">'.$row1['ingreso_total'].'</td>
              </tr>'
              
              ;
            }else{
              $html.='              
            <tr>
              <td colspan="4" class="TOTAL"><b>TOTAL</b></td>
              <td class="grand total">'.$row1['ingreso_total'].'</td>
            </tr>';
            
            }
          $html.='
          </tbody>
        </table>
        <div id="notices">
          <div>AVISO:</div>
          <div class="notice">
          Antes de retirarse,verifique bien su material,kilos y su respectivo valor.</div>
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
$mpdf -> Output('reporte_ingreso.pdf', 'D');
