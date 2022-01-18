<div class="row">
    <div class="col-md-12">
        <div class="ibox ibox-default">
            <div class="ibox-head">
                <div class="ibox-title">MODULO PRODUCTO</div>
                <div class="ibox-tools">
                        <button class="btn btn-danger" onclick="AbrirModal()" hidden>Nuevo Registro</button>
                </div>
            </div>
            <div class="ibox-body">
                <table id="tabla_producto" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Presentaci&oacute;n</th>
                            <th style="text-align:center">Categoria</th>
                            <th style="text-align:center">U Medida</th>
                            <th style="text-align:center">Stock</th>
                            <th style="text-align:center">Precio</th>
                            <th style="text-align:center">Foto</th>
                            <th style="text-align:center">Estatus</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Presentaci&oacute;n</th>
                            <th style="text-align:center">Categoria</th>
                            <th style="text-align:center">U Medida</th>
                            <th style="text-align:center">Stock</th>
                            <th style="text-align:center">Precio</th>
                            <th style="text-align:center">Foto</th>
                            <th style="text-align:center">Estatus</th>
                            
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
        <h5 class="modal-title" id="exampleModalLongTitle">Registro Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return false">
          <div class="row">
              <div class="col-lg-12 form-group">
                  <label for="">Producto (*):</label>
                  <input type="text" class="form-control" id="txt_producto_registro" maxlength="100" onkeypress="return sololetras(event)">
              </div>
              <div class="col-lg-12 form-group">
                  <label for="">Presentaci&oacute;n (*):</label>
                  <input type="text" class="form-control" id="txt_presentacion_registro" maxlength="150" onkeypress="return sololetras(event)">
              </div>
              <div class="col-lg-6 form-group">
                  <label for="">Categor&iacute;a (*):</label>
                  <select class="js-example-basic-single" id="cbm_categoria_registro" style="width:100%">
                  </select>
              </div>
              <div class="col-lg-6 form-group">
                  <label for="">Unidad Medida (*):</label>
                  <select class="js-example-basic-single" id="cbm_unidad_registro" style="width:100%">
                  </select>
              </div>
              <div class="col-lg-6 form-group">
                  <label for="">Precio Venta (*):</label>
                  <input type="text" class="form-control precio" id="txt_precio_registro" maxlength="10" >
              </div>
              <div class="col-lg-6 form-group">
                  <label for="">Foto del Producto :</label>
                  <input type="file" class="form-control" id="txt_foto_producto" accept="image/*">
              </div>
              <div class="col-lg-12" style="text-align: left;font-weight: bold;color: #9B0000">
                Campos Obligatorios (*)
              </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Producto()">Guardar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_editar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return false">
          <div class="row">
              <div class="col-lg-12 form-group">
                  <label for="">Producto</label>
                  <input type="text" id="txt_producto_id" hidden>
                  <input type="text" class="form-control" id="txt_producto_nuevo_editar" maxlength="150" onkeypress="return sololetras(event)">
              </div>
              <div class="col-lg-12 form-group">
                  <label for="">Presentaci&oacute;n</label>
                  <input type="text" class="form-control" id="txt_presentacion_editar" maxlength="150" onkeypress="return sololetras(event)">
              </div>
              <div class="col-lg-6 form-group">
                  <label for="">Categor&iacute;a</label>
                  <select class="js-example-basic-single" id="cbm_categoria_editar" style="width:100%">
                  </select>
              </div>
              <div class="col-lg-6 form-group">
                  <label for="">Unidad Medida</label>
                  <select class="js-example-basic-single" id="cbm_unidad_editar" style="width:100%">
                  </select>
              </div>
              <div class="col-lg-6 form-group">
                  <label for="">Precio Venta</label>
                  <input type="text" class="form-control precio" id="txt_precio_editar" maxlength="10">
              </div>
              <div class="col-lg-6 form-group">
                  <label for="">Estatus</label>
                  <select class="js-example-basic-single" id="cbm_estatus" style="width:100%">
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                  </select>
              </div>
              <div class="col-lg-12" style="text-align: left;font-weight: bold;color: #9B0000">
                Campos Obligatorios (*)
              </div>
              <div class="col-md-4 form-group"></div>
              <div class="col-md-4 form-group"><br>
                <button type="button" style="width:100%" class="btn btn-primary" onclick="Editar_Producto()">Guardar</button>
              </div>
              <div class="col-md-4 form-group"></div>
              <div class="col-md-12 form-group"><hr></div>
              <div class="col-lg-9">
                    <label for="">Subir</label>
                    <input type="file" class="form-control-file" id="txt_foto_producto_editar" accept="image/*">
              </div>
              <div class="col-lg-3" style="text-align:center">
                <label for="">&nbsp;</label>
                <button class="btn btn-success" onclick="Editar_Foto_Producto()">Actualizar</button>
              </div>
          </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>     
      </form>
    </div>
  </div>
</div>
<script src="../js/console_producto.js?rev=<?php echo time();?>"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    listar_producto_bodega();
    categoria_combo();
    unidad_combo();
});
$('#modal_registro').on('shown.bs.modal', function () {
  $('#txt_producto_registro').trigger('focus')
})
document.getElementById("txt_foto_producto").addEventListener("change", () => {
     var fileName = document.getElementById("txt_foto_producto").value; 
     var idxDot = fileName.lastIndexOf(".") + 1; 
     var extFile = fileName.substr(idxDot, fileName.length).toLowerCase(); 
     if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){ 
      //TO DO 
     }else{ 
      Swal.fire("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN IMAGENES - USTED SUBIO UN ARCHIVO CON EXTESION "+extFile,"warning");
      document.getElementById("txt_foto_producto").value="";
     } 
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