<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-default">
            <div class="ibox-head">
                <div class="ibox-title">MODULO PROVEEDOR</div>
                <div class="ibox-tools">
                        <button class="btn btn-danger" onclick="AbrirModal()" hidden>Nuevo Registro</button>
                </div>
            </div>
            <div class="ibox-body">
                <table id="tabla_proveedor" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Razon Social</th>
                            <th>Contacto</th>
                            <th style="text-align:center">N&deg; Contacto </th>
                            <th style="text-align:center">N&deg; documento</th>
                            <th style="text-align:center">Tipo documento</th>
                            <th style="text-align:center">Estatus</th>
                           <!--<th style="text-align:center">Acci&oacute;n</th>-->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Persona</th>
                            <th>Contacto</th>
                            <th style="text-align:center">N&deg; Contacto </th>
                            <th style="text-align:center">N&deg; documento</th>
                            <th style="text-align:center">Tipo documento</th>
                            <th style="text-align:center">Estatus</th>
                            <!--<th style="text-align:center">Acci&oacute;n</th>-->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_registro" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registro de Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 form-group">
            <label for="">Raz&oacute;n Social (*)</label>
            <input type="text" class="form-control" maxlength="200" id="txt_razonsocial" >
          </div>
          <div class="col-lg-12 form-group">
            <label for="">Nombre Contacto (*):</label>
            <input type="text" class="form-control" maxlength="100" id="txtnombre" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Apellido Paterno Contacto (*):</label>
            <input type="text" class="form-control" maxlength="50" id="txtapepat" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Apellido Materno Contacto (*):</label>
            <input type="text" maxlength="50" class="form-control" id="txtapemat" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Nro Documento (*):</label>
            <input type="text" class="form-control"  maxlength="11" id="txtnro" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Tipo Documento (*):</label>
            <select class="js-example-basic-single" id="cbm_tdocumento" style="width:100%">
                <option value="CEDULA">CEDULA</option>
                <option value="RUT">RUT</option>
            </select>
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Sexo (*):</label>
            <select class="js-example-basic-single" id="cbm_sexo" style="width:100%">
                <option value="MASCULINO">MASCULINO</option>
                <option value="FEMENINO">FEMENINO</option>
            </select>
          </div>
          <div class="col-lg-6 form-group">
            <label for="">N&uacute;mero Contacto</label>
            <input type="text" class="form-control" maxlength="12" id="txttelefono" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-lg-12" style="text-align: left;font-weight: bold;color: #9B0000">
          Campos Obligatorios (*)
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Proveedor()">Guardar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_editar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 form-group">
            <input type="text" id="txt_idproveedor" hidden>
            <label for="">Razon Social (*):</label>
            <input type="text" class="form-control" maxlength="200" id="txt_razonsocial_editar" >
          </div>
          <div class="col-lg-12 form-group">
            <label for="">Nombre Contacto (*):</label>
            <input type="text" class="form-control" maxlength="100" id="txtnombre_editar" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Apellido Paterno Contacto (*):</label>
            <input type="text" class="form-control" maxlength="50" id="txtapepat_editar" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Apellido Materno Contacto (*):</label>
            <input type="text" maxlength="50" class="form-control" id="txtapemat_editar" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Nro Documento (*):</label>
            <input type="text" class="form-control"  maxlength="11" id="txtnro_editar" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Tipo Documento (*):</label>
            <select class="js-example-basic-single" id="cbm_tdocumento_editar" style="width:100%">
                <option value="CEDULA">CEDULA</option>
                <option value="RUT">RUT</option>
            </select>
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Sexo (*):</label>
            <select class="js-example-basic-single" id="cbm_sexo_editar" style="width:100%">
                <option value="MASCULINO">MASCULINO</option>
                <option value="FEMENINO">FEMENINO</option>
            </select>
          </div>
          <div class="col-lg-6 form-group">
            <label for="">N&uacute;mero Contacto</label>
            <input type="text" class="form-control" maxlength="12" id="txttelefono_editar" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-lg-12" style="text-align: left;font-weight: bold;color: #9B0000">
          Campos Obligatorios (*)
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Modificar_Proveedor()">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<script src="../js/console_proveedor.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    listar_proveedor_bodega();
});
$('#modal_registro').on('shown.bs.modal', function () {
  $('#txt_razonsocial').trigger('focus')
})
</script>