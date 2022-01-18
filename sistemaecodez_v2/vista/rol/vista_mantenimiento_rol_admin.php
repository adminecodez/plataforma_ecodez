<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-default">
            <div class="ibox-head">
                <div class="ibox-title">MODULO ROL</div>
                <div class="ibox-tools">
                      <!--  <button class="btn btn-danger" onclick="AbrirModal()">Nuevo Registro</button>-->
                </div>
            </div>
            <div class="ibox-body">
                <table id="tabla_rol" class="display" style="width:100%">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Rol</th>
                          <th style="text-align:center">Fecha Registro</th>
                          <th style="text-align:center">Estatus</th>
                         <!-- <th>Acci&oacute;n</th>-->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Rol</th>
                          <th style="text-align:center">Fecha Registro</th>
                          <th style="text-align:center">Estatus</th>
                          <!-- <th>Acci&oacute;n</th>-->
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
        <h5 class="modal-title" id="exampleModalLongTitle">Registro de rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Rol</label>
        <input type="text" class="form-control" id="txt_rol">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Rol()">Guardar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 form-group">
            <input type="text" id="txtidrol" hidden>
            <label for="">Rol (*):</label>
            <input type="text" id="txt_rol_actual_editar" hidden>
            <input type="text" disabled class="form-control" id="txt_rol_nuevo_editar">
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
        <button type="button" class="btn btn-primary" onclick="Editar_Rol()">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<script src="../js/console_rol.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    listar_rol_admin();
});
$('#modal_registro').on('shown.bs.modal', function () {
  $('#txt_rol').trigger('focus')
})
</script>