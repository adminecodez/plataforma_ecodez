var t_producto;
function listar_producto(){
    t_producto = $("#tabla_producto").DataTable({
		"ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
    	"autoWidth": false,
      "ajax":{
        "method":"POST",
		"url":"../controlador/producto/controlador_producto_listar.php",
      },
      "columns":[
            {"defaultContent":""},
            {"data":"producto_nombre"},
            {"data":"producto_presentacion"},
            {"data":"categoria_nombre"},
            {"data":"unidad_nombre"},
            {"data":"producto_stock"},
            {"data":"producto_precioventa"},
            {"data":"producto_foto",
                render: function(data,type,row){
                    return  '<img src="../'+data+'" class="img-circle  m-r-10" style="width:28px;">';
                }
            },
            {"data":"producto_estatus",
                render: function(data,type,row){
                    if(data==="ACTIVO"){
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }else{
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }
                 
                }
            },
            {"defaultContent":"<button class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
		  
      ],
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $($(nRow).find("td")[3]).css('text-align', 'center' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );
            $($(nRow).find("td")[5]).css('text-align', 'center' );
            $($(nRow).find("td")[6]).css('text-align', 'center' );
            $($(nRow).find("td")[7]).css('text-align', 'center' );
            $($(nRow).find("td")[8]).css('text-align', 'center' );
            $($(nRow).find("td")[9]).css('text-align', 'center' );
        },
        "language":idioma_espanol,
        select: true
	});
	t_producto.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_producto').DataTable().page.info();
        t_producto.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}

$('#tabla_producto').on('click','.editar',function(){
    var data = t_producto.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_producto.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_producto.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    document.getElementById('txt_producto_id').value=data.producto_id;
    document.getElementById('txt_producto_nuevo_editar').value=data.producto_nombre;
    document.getElementById('txt_presentacion_editar').value=data.producto_presentacion;
    document.getElementById('txt_precio_editar').value=data.producto_precioventa;
    $("#cbm_categoria_editar").val(data.categoria_id).trigger("change");
    $("#cbm_unidad_editar").val(data.unidad_id).trigger("change");
    $("#cbm_estatus").val(data.producto_estatus).trigger("change"); 
    document.getElementById('div_error_editar').style.display="none";
    document.getElementById('div_error_editar').innerHTML="";
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
})

function categoria_combo(){
    $.ajax({
        url:"../controlador/producto/controlador_categoria_combo_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena = "";
        if(data.length>0){
            for (var i=0; i < data.length; i++) {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            document.getElementById('cbm_categoria_registro').innerHTML=cadena;
            document.getElementById('cbm_categoria_editar').innerHTML=cadena;
        }else{
            document.getElementById('cbm_categoria_registro').innerHTML="<option value='0'>No se encontraron datos</option>";
            document.getElementById('cbm_categoria_editar').innerHTML="<option value='0'>No se encontraron datos</option>";
        }
    })
}


function unidad_combo(){
    $.ajax({
        url:"../controlador/producto/controlador_unidad_combo_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena = "";
        if(data.length>0){
            for (var i=0; i < data.length; i++) {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            document.getElementById('cbm_unidad_registro').innerHTML=cadena;
            document.getElementById('cbm_unidad_editar').innerHTML=cadena;
        }else{
            document.getElementById('cbm_unidad_registro').innerHTML="<option value='0'>No se encontraron datos</option>";
            document.getElementById('cbm_unidad_editar').innerHTML="<option value='0'>No se encontraron datos</option>";
        }
    })
}

function limpiarmodal() {
    document.getElementById('txt_producto_registro').value = "";
    document.getElementById('txt_presentacion_registro').value = "";
    document.getElementById('txt_precio_registro').value = "";
    document.getElementById('txt_foto_producto').value = "";
}
function ValidacionInputRegistro(producto,presentacion,precio){
	Boolean($("#"+producto).val().length>0) ? $("#"+producto).removeClass('is-invalid').addClass("is-valid") : $("#"+producto).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+presentacion).val().length>0) ? $("#"+presentacion).removeClass('is-invalid').addClass("is-valid") : $("#"+presentacion).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+precio).val().length>0) ? $("#"+precio).removeClass('is-invalid').addClass("is-valid") : $("#"+precio).removeClass('is-valid').addClass("is-invalid"); 
}
function Registrar_Producto(){
    var producto = document.getElementById('txt_producto_registro').value;
    var presentacion = document.getElementById('txt_presentacion_registro').value;
    var categoria = document.getElementById('cbm_categoria_registro').value;
    var unidad = document.getElementById('cbm_unidad_registro').value;
    var precio = document.getElementById('txt_precio_registro').value;
    var archivo = document.getElementById('txt_foto_producto').value;
    ValidacionInputRegistro('txt_producto_registro','txt_presentacion_registro','txt_precio_registro');
    if(producto.length==0 || presentacion.length==0 || categoria.length==0 || unidad.length==0 || precio.length==0){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    var f = new Date();
    var extension = archivo.split('.').pop();
    var nombrearchivo = "PRO"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var foto = $("#txt_foto_producto")[0].files[0];
    formData.append('producto',producto);
    formData.append('presentacion',presentacion);
    formData.append('categoria',categoria);
    formData.append('unidad',unidad);
    formData.append('precio',precio);
    formData.append('foto',foto);
    formData.append('nombrearchivo',nombrearchivo);
    $.ajax({
        url:'../controlador/producto/controlador_producto_registro.php',
        type:'post',
        data:formData,
        contentType:false,
        processData:false,
        success: function(respuesta){
            if(isNaN(respuesta)){
              }else{
                if(respuesta==1){
                    Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente registrados, <b>Nuevo Producto Registrado</b>","success")
                    .then ( ( value ) =>  {
                        t_producto.ajax.reload();
                        limpiarmodal();
                        $("#modal_registro").modal('hide');
                        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                    });
                }else{
                    if(respuesta==2){
                        Swal.fire("Mensaje de advertencia","El <b>producto ingresado</b> ya se encuentra en la bd","warning"); 
                    }
                    else{
                        Swal.fire("Mensaje de Error","El registro no se pudo completar","error");
                    }
                    
                }
            }
        }
    });
    return false;
}


function Editar_Producto(){
    var id = document.getElementById('txt_producto_id').value;
    var producto = document.getElementById('txt_producto_nuevo_editar').value;
    var presentacion = document.getElementById('txt_presentacion_editar').value;
    var categoria = document.getElementById('cbm_categoria_editar').value;
    var unidad = document.getElementById('cbm_unidad_editar').value;
    var precio = document.getElementById('txt_precio_editar').value;
    var estatus = document.getElementById('cbm_estatus').value;
    ValidacionInputRegistro('txt_producto_nuevo_editar','txt_presentacion_editar','txt_precio_editar');
    if(id.length==0 || producto.length==0 || presentacion.length==0 || categoria.length==0 || unidad.length==0 || precio.length==0 || estatus.length==0){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    $.ajax({
        url:'../controlador/producto/controlador_editar_producto.php',
        type:'POST',
        data:{
            id:id,
            producto:producto,
            presentacion:presentacion,
            categoria:categoria,
            unidad:unidad,
            precio:precio,
            estatus:estatus
        }
    }).done(function(resp){
        if(isNaN(resp)){
       }else{
            if(resp>0){
                if(resp==1){
                    Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente actualizados, <b>Datos del producto modificados</b>","success")
                    .then ( ( value ) =>  {
                        t_producto.ajax.reload();
                        $("#modal_editar").modal('hide');
                        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                    });
                }else{
                    Swal.fire("Mensaje de advertencia","El <b>producto ingresado</b> ya se encuentra en la bd","warning");
                }
            }else{
                Swal.fire("Mensaje de Error","El registro no se pudo completar","error");
            }
        }
        
    })
}

function Editar_Foto_Producto(){
    var id = document.getElementById('txt_producto_id').value;
    var archivo = document.getElementById('txt_foto_producto_editar').value;
    var f = new Date();
    var extension = archivo.split('.').pop();
    var nombrearchivo = "PRO"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var foto = $("#txt_foto_producto_editar")[0].files[0];
    if (archivo.length==0){
        return Swal.fire("Mensaje de advertencia","Debe seleccionar un archivo","warning");
    }
    formData.append('id',id);
    formData.append('foto',foto);
    formData.append('nombrearchivo',nombrearchivo);
    $.ajax({
        url:'../controlador/producto/controlador_producto_editar_imagen.php',
        type:'post',
        data:formData,
        contentType:false,
        processData:false,
        success: function(respuesta){
            if(respuesta !=0){
                if(respuesta==1){
                    Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente actualizados, <b>Foto del producto modificado</b>","success")
                    .then ( ( value ) =>  {
                        t_producto.ajax.reload();
                        //$("#modal_editar").modal('hide');
                        document.getElementById('txt_foto_producto_editar').value="";
                        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                    });
                }
                else{
                    Swal.fire("Mensaje de Error","La actualizaci&oacute; no se pudo completar","error");
                }
            }
        }
    });
    return false;
}


//MENSAJE DE ERROR CUANDO LOS CAMPOS ESTEN VACIOS O NO COINCIDAN EL TIPO DE DATO
function  mensajeerror(producto,presentacion,categoria,unidad,precio,id){
    var cadena="";
    if(producto.length==0){
        cadena+="El campo producto no debe estar vacio.<br>"
    }

    if(presentacion.length==0){
        cadena+="El campo presentacion no debe estar vacio.<br>"
    }

    if(categoria.length==0){
        cadena+="El campo categoria  no debe estar vacio.<br>"
    }

    if(unidad.length==0){
        cadena+="El campo unidad no debe estar vacio.<br>"
    }

    if(precio.length==0){
        cadena+="El campo precio no debe estar vacio.<br>"
    }

    document.getElementById(id).style.display="block";
    document.getElementById(id).innerHTML="<strong>Revise los siguientes campos:</strong><br>"+cadena;
}

function AbrirModal(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    limpiarmodal();
}

function listar_producto_bodega(){
    t_producto = $("#tabla_producto").DataTable({
        "ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
        "autoWidth": false,
      "ajax":{
        "method":"POST",
        "url":"../controlador/producto/controlador_producto_listar.php",
      },
      "columns":[
            {"defaultContent":""},
            {"data":"producto_nombre"},
            {"data":"producto_presentacion"},
            {"data":"categoria_nombre"},
            {"data":"unidad_nombre"},
            {"data":"producto_stock"},
            {"data":"producto_precioventa"},
            {"data":"producto_foto",
                render: function(data,type,row){
                    return  '<img src="../'+data+'" class="img-circle  m-r-10" style="width:28px;">';
                }
            },
            {"data":"producto_estatus",
                render: function(data,type,row){
                    if(data==="ACTIVO"){
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }else{
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }
                 
                }
            }
          
      ],
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $($(nRow).find("td")[3]).css('text-align', 'center' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );
            $($(nRow).find("td")[5]).css('text-align', 'center' );
            $($(nRow).find("td")[6]).css('text-align', 'center' );
            $($(nRow).find("td")[7]).css('text-align', 'center' );
            $($(nRow).find("td")[8]).css('text-align', 'center' );

        },
        "language":idioma_espanol,
        select: true
    });
    t_producto.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_producto').DataTable().page.info();
        t_producto.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}