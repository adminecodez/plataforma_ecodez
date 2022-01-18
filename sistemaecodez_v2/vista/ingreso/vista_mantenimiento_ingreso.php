<script src="../js/console_ingreso.js?rev=<?php echo time();?>"></script>
<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-default">
            <div class="ibox-head">
                <div class="ibox-title">MODULO INGRESO</div>
                <div class="ibox-tools">
                        <button class="btn btn-danger" onclick="cargar_contenido('contenido_principal','ingreso/vista_ingreso_registro.php')">Nuevo Registro</button>
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Seleccionar Rango Fechas:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;padding: 0px 12px;" id="txt_rangofecha">
                            </div>
                        </div>
                    </div> 
                    <div class="col-2">
                        <label for="">&nbsp;</label><br>
                        <button class="btn btn-success" style="width:100%" onclick="listar_ingreso()"><i class="fa fa-search"></i>&nbsp;Buscar</button>
                    </div>  
                    <div class="col-md-2">
                        <label for="">&nbsp;</label><br>
                        <button class="btn btn-warning" style="width:100%" onclick="Generar_Reporte_Admin()"><i class="fa fa-print"></i>&nbsp;Generar Reporte</button>
                    </div>      
                </div><br>
                    <table id="tabla_ingreso" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align:center">#</th>
                                <th>Usuario</th>
                                <th>Proveedor</th>
                                <th>Tipo Comprobante</th>
                                <th style="text-align:center">Serie Comprobante</th>
                                <th style="text-align:center">Nro Comprobante</th>
                                <th style="text-align:center">Fecha</th>
                                <th style="text-align:center">Total</th>
                                <th style="text-align:center">Impuesto</th>
                                <th style="text-align:center">Estado</th>
                                <th style="text-align:center">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                                <th style="text-align:center">#</th>
                                <th>Usuario</th>
                                <th>Proveedor</th>
                                <th>Tipo Comprobante</th>
                                <th style="text-align:center">Serie Comprobante</th>
                                <th style="text-align:center">Nro Comprobante</th>
                                <th style="text-align:center">Fecha</th>
                                <th style="text-align:center">Total</th>
                                <th style="text-align:center">Impuesto</th>
                                <th style="text-align:center">Estado</th>
                                <th style="text-align:center">Acci&oacute;n</th>
                            </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
            <input type="text" id="txtidcategoria" hidden>
            <label for="">Categoria</label>
            <input type="text" id="txt_categoria_actual_editar" hidden>
            <input type="text" class="form-control" id="txt_categoria_nuevo_editar">
        </div>
        <div class="col-lg-12">
            <label for="">Estatus</label>
            <select class="js-example-basic-single" id="cbm_estatus" style="width:100%">
                <option value="ACTIVO">ACTIVO</option>
                <option value="INACTIVO">INACTIVO</option>
            </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Editar_Categoria()">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    var f = new Date();
    var anio = f.getFullYear();
    var mes = f.getMonth()+1;
    var d = f.getDate();
    // 01 02 03 04 05 06 07 08 09
    if(d<10){
        d='0'+d;
    }
    if(mes<10){
        mes='0'+mes;
    }
    //document.getElementById('txt_finicio').value=anio+"-"+mes+"-"+d;
    //document.getElementById('txt_ffin').value=anio+"-"+mes+"-"+d;
    listar_ingreso();
});
$('#modal_registro').on('shown.bs.modal', function () {
  $('#txt_categoria').trigger('focus')
})
$('#txt_rangofecha').daterangepicker({
    locale: {
    format: 'DD-MM-YYYY',
    "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "separator": " / ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Rango Personalizado",
    },
    ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Los Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
        'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
        'El Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
});
</script>