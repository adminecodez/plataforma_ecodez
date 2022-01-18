<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-default">
            <div class="ibox-head">
                <div class="ibox-title">MODULO CLIENTE</div>
                <div class="ibox-tools">
                        <button class="btn btn-danger" onclick="AbrirModal()">Nuevo Registro</button>
                </div>
            </div>
            <div class="ibox-body">
                <table id="tabla_persona" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>N&deg; documento</th>
                            <th style="text-align:center">Tipo documento</th>
                            <th style="text-align:center">Sexo</th>
                            <th>Tel&eacute;fono</th>
                            <th>Estatus</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>N&deg; documento</th>
                            <th style="text-align:center">Tipo documento</th>
                            <th style="text-align:center"s>Sexo</th>
                            <th>Tel&eacute;fono</th>
                            <th>Estatus</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registro de Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 form-group">
            <label for="">Nombre (*):</label>
            <input type="text" class="form-control" maxlength="100" id="txtnombre" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6  form-group">
            <label for="">Apellido Paterno (*):</label>
            <input type="text" class="form-control" maxlength="50" id="txtapepat" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6  form-group">
            <label for="">Apellido Materno (*):</label>
            <input type="text" class="form-control" maxlength="50" id="txtapemat" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6  form-group">
            <label for="">Nro Documento (*):</label>
            <input type="text" class="form-control" maxlength="8" id="txtnro" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-lg-6  form-group">
            <label for="">Tipo Documento (*):</label>
            <select class="js-example-basic-single" id="cbm_tdocumento" style="width:100%">
                <option value="CEDULA">CEDULA</option>
            </select>
          </div>
          <div class="col-lg-6  form-group">
            <label for="">Sexo (*):</label>
            <select class="js-example-basic-single" id="cbm_sexo" style="width:100%">
                <option value="MASCULINO">MASCULINO</option>
                <option value="FEMENINO">FEMENINO</option>
            </select>
          </div>
          <div class="col-lg-6  form-group">
            <label for="">Nro Tel&eacute;fono (*):</label>
            <input type="text" class="form-control" maxlength="12" id="txttelefono" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-lg-12" style="text-align: left;font-weight: bold;color: #9B0000">
            Campos Obligatorios (*)
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Persona()">Guardar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_editar" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12  form-group">
          <input type="text" id="txtidpersona" hidden>
            <label for="">Nombre (*):</label>
            <input type="text" class="form-control" maxlength="100" id="txtnombre_editar" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Apellido Paterno (*):</label>
            <input type="text" class="form-control" id="txtapepat_editar" maxlength="100" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Apellido Materno (*):</label>
            <input type="text" class="form-control" id="txtapemat_editar" maxlength="100" onkeypress="return sololetras(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Nro Documento (*):</label>
            <input type="text" id="txtnro_editar_actual" onkeypress="return soloNumeros(event)" hidden>
            <input type="text" class="form-control" maxlength="11" id="txtnro_editar_nuevo" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-lg-6 form-group">
            <label for="">Tipo Documento (*):</label>
            <select disabled class="js-example-basic-single" id="cbm_tdocumento_editar" style="width:100%">
                <option value="CEDULA">CEDULA</option>
                <option value="PASAPORTE">PASAPORTE</option>
                <option value="RUT">RUT</option>
            </select>
          </div>
          <div class="col-lg-4 form-group">
            <label for="">Sexo (*):</label>
            <select class="js-example-basic-single" id="cbm_sexo_editar" style="width:100%">
                <option value="MASCULINO">MASCULINO</option>
                <option value="FEMENINO">FEMENINO</option>
            </select>
          </div>
          <div class="col-lg-4 form-group">
            <label for="">Nro Tel&eacute;fono (*):</label>
            <input type="text" class="form-control" maxlength="12" id="txttelefono_editar" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-lg-4 form-group">
            <label for="">Estatus (*):</label>
            <select class="js-example-basic-single" id="cbm_estatus" style="width:100%">
                <option value="ACTIVO">ACTIVO</option>
                <option value="INACTIVO">INACTIVO</option>
            </select>
          </div>
          <div class="col-lg-12" style="text-align: left;font-weight: bold;color: #9B0000">
          Campos Obligatorios (*)
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Editar_Persona()">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<script src="../js/console_persona.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    listar_persona();
});
$('#modal_registro').on('shown.bs.modal', function () {
  $('#txtnombre').trigger('focus')
})
</script>