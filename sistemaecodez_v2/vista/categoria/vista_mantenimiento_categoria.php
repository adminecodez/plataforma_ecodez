<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-default">
            <div class="ibox-head">
                <div class="ibox-title">MODULO CATEGOR&Iacute;A</div>
                <div class="ibox-tools" >
                        <button class="btn btn-danger" onclick="AbrirModal()">Nuevo Registro</button>
                </div>
            </div>
            <div class="ibox-body">
                <table id="tabla_categoria" class="display" style="width:100%">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Categor&iacute;a</th>
                          <th style="text-align:center">Fecha Registro</th>
                          <th style="text-align:center">Estatus</th>
                          <th style="text-align:center">Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Categor&iacute;a</th>
                          <th style="text-align:center">Fecha Registro</th>
                          <th style="text-align:center">Estatus</th>
                          <th style="text-align:center">Acci&oacute;n</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_registro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registro de Categor&iacute;a</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 form-group">
          <label for="">Categor&iacute;a (*):</label>
          <input type="text" class="form-control" id="txt_categoria" maxlength="100" onkeypress="return sololetras(event)">
        </div>
        
        <div class="col-lg-12" style="text-align: left;font-weight: bold;color: #9B0000">
          Campos Obligatorios (*)
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Categoria()">Guardar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Categor&iacute;a</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 form-group">
            <input type="text" id="txtidcategoria" hidden>
            <label for="">Categor&iacute;a (*):</label>
            <input type="text" id="txt_categoria_actual_editar" hidden>
            <input type="text" class="form-control" id="txt_categoria_nuevo_editar" maxlength="100" onkeypress="return sololetras(event)">
        </div>
        <div class="col-lg-12 form-group">
            <label for="">Estatus</label>
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
        <button type="button" class="btn btn-primary" onclick="Editar_Categoria()">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<script src="../js/console_categoria.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    listar_categoria();
});
$('#modal_registro').on('shown.bs.modal', function () {
  $('#txt_categoria').trigger('focus')
})
</script>