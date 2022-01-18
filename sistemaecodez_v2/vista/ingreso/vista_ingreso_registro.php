<script src="../js/console_ingreso.js?rev=<?php echo time();?>"></script>
<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-default">
            <div class="ibox-head">
                <div class="ibox-title">MODULO REGISTRO DE INGRESO</div>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-8 form-group">
                        <label for="">Proveedor (*):</label>
                        <select class="js-example-basic-single" id="cbm_proveedor" style="width:100%">
                        </select>
                    </div>
                    <div class="col-4 form-group" hidden>
                        <label for="">Impuesto (19% = 0.19) (*):</label>
                        <input type="text" class="form-control precio" id="txt_impuesto" value="0" style="font-weight:bold;text-align:center;color:#9B0000" disabled>
                    </div>
                    <div class="col-4 form-group">
                        <label for="">Tipo Comprobante (*):</label>
                        <select class="js-example-basic-single" id="cbm_tipo" style="width:100%">
                            <option value="RECIBO">RECIBO</option>
                           <!-- <option value="FACTURA">FACTURA</option>-->
                            <!--<option value="TICKET">TICKET</option>-->
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label for="">Serie Comprobante (*):</label>
                        <input type="text" value="REC" class="form-control" id="txt_serie"  maxlength="10" onkeypress="return soloNroDocumento(event)">
                    </div>
                    <div class="col-4 form-group">
                        <label for="">N&uacute;mero Comprobante (*):</label>
                        <input type="number" value="1" class="form-control" id="txt_ncomprobante" maxlength="10"  onkeypress="return soloNroDocumento(event)" onkeypress="return incremental(event)">
                    </div>
                    <div class="col-lg-12 form-group" style="text-align: left;font-weight: bold;color: #9B0000">
                        Campos Obligatorios (*)
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Producto:</label>
                        <select class="js-example-basic-single" id="cbm_producto" style="width:100%">
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="">Precio:</label>
                        <input type="number"   min="1" class="form-control precio" id="txt_precio" disabled>
                    </div>
                    <div class="col-2 form-group">
                        <label for="">Cantidad:</label>
                        <input type="number"  onkeypress="return soloNumeros(event)" min="1" class="form-control" id="txt_cantidad">
                    </div>
                    <div class="col-2 form-group">
                        <label for="">&nbsp;</label><br>
                        <button class="btn btn-success" style="width:100%" onclick="Agregar_Producto_Detalle_Ingreso()"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
                    </div>
                    <div class="col-12 form-group" style="text-align:center"><br>
                        <button class="btn btn-primary btn-lg" onclick="Registrar_Ingreso()">Registrar Ingreso</button>
                    </div>
                    <div class="col-12 form-group" style="text-align:left"><br>
                        <h5 for=""><b>Detalle de Ingreso (*):</b></h5>
                    </div>
                    <div class="col-12 table-responsive">
                        <table id="detalle_ingreso" class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" hidden>ID</th>
                                    <th style="text-align:left">PRODUCTO</th>
                                    <th style="text-align:center">PRECIO</th>
                                    <th style="text-align:center">CANTIDAD</th>
                                    <th style="text-align:center">SUB TOTAL</th>
                                    <th style="text-align:center">ACCI&Oacute;N</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_detalle_ingreso">
                            </tbody>
                        </table>
                    </div>
                        <div class="col-12" style="text-align:right">
                            <h5 for="" id="lbl_subtotal"></h5>
                        </div>
                        <div class="col-12" style="text-align:right">
                            <h5 for="" id="lbl_impuesto"></h5>
                        </div>
                        <div class="col-12" style="text-align:right">
                            <h5 for="" id="lbl_totalneto"></h5>
                        </div>
                </div><br>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    combo_proveedor();
    combo_producto();

});
$('#cbm_producto').on('select2:select', function (e) {
    let id = document.getElementById('cbm_producto').value;
    document.getElementById('txt_precio').value=arreglo_precio[id];

});
$('#cbm_tipo').on('select2:select', function (e) {
    let tipo = document.getElementById('cbm_tipo').value;
    if(tipo=="FACTURA"){
        document.getElementById('txt_impuesto').disabled=false;
        document.getElementById('txt_impuesto').value = "0.18";
    }else{
        document.getElementById('txt_impuesto').disabled=true;
        document.getElementById('txt_impuesto').value = '0';
    }
    SumarTotalneto();
});
$("#txt_impuesto").keyup(function(){
    SumarTotalneto();
});
$('.precio').keypress(function(event) {
    var $this = $(this);
    if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
       ((event.which < 48 || event.which > 57) &&
       (event.which != 0 && event.which != 8))) {
           event.preventDefault();
    }

    var text = $(this).val();
    if ((event.which == 46) && (text.indexOf('.') == -1)) {
        setTimeout(function() {
            if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
            }
        }, 1);
    }

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
    }      
});
</script>