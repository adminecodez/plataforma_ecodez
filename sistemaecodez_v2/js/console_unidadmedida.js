var t_unidadmedida;
function listar_unidadmedida(){
    t_unidadmedida = $("#tabla_unidadmedida").DataTable({
		"ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
    	"autoWidth": false,
        "ajax":{
            "method":"POST",
            "url":"../controlador/unidadmedida/controlador_unidadmedida_listar.php",
        },
        "columns":[
            {"defaultContent":""},
            {"data":"unidad_nombre"},
            {"data":"unidad_abreviatura"},
            {"data":"unidad_fregistro"},
            {"data":"unidad_estatus",
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
            $($(nRow).find("td")[2]).css('text-align', 'center' );
            $($(nRow).find("td")[3]).css('text-align', 'center' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );
            $($(nRow).find("td")[5]).css('text-align', 'center' );
        },
        "language":idioma_espanol,
        select: true
	});
	t_unidadmedida.on( 'draw.dt', function () {
    var PageInfo = $('#tabla_unidadmedida').DataTable().page.info();
    t_unidadmedida.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    } );
}

$('#tabla_unidadmedida').on('click','.editar',function(){
    var data = t_unidadmedida.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_unidadmedida.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_unidadmedida.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    document.getElementById('txtidunidad').value=data.unidad_id;
    document.getElementById('txt_unidad_actual_editar').value=data.unidad_nombre;
    document.getElementById('txt_unidad_nuevo_editar').value=data.unidad_nombre;
    document.getElementById('txt_abreviatura_editar').value=data.unidad_abreviatura;
    $("#cbm_estatus").val(data.unidad_estatus).trigger("change");
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
})

function AbrirModal(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    limpiarmodal();
}
function ValidacionInputRegistro(nombre,abreviatura){
	Boolean($("#"+nombre).val().length>0) ? $("#"+nombre).removeClass('is-invalid').addClass("is-valid") : $("#"+nombre).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+abreviatura).val().length>0) ? $("#"+abreviatura).removeClass('is-invalid').addClass("is-valid") : $("#"+abreviatura).removeClass('is-valid').addClass("is-invalid"); 
}
function Registrar_Unidad(){
    var unidad = document.getElementById('txt_unidad').value;
    var abreviatura = document.getElementById('txt_abreviatura').value;
    ValidacionInputRegistro('txt_unidad','txt_abreviatura');
    if(unidad.length==0 || abreviatura.length==0){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }

    $.ajax({
        url:'../controlador/unidadmedida/controlador_registro_unidadmedida.php',
        type:'POST',
        data:{
            unidad:unidad,
            abreviatura:abreviatura
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente registrados, <b>Nueva Categor&iacute;a Registrada</b>","success")
                .then ( ( value ) =>  {
                    t_unidadmedida.ajax.reload();
                    limpiarmodal();
                    $("#modal_registro").modal('hide');
                    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                });
                
            }else{
                Swal.fire("Mensaje de advertencia","La Unidad de Medida ingresada ya se encuentra en la bd","warning");
            }
        }else{
            Swal.fire("Mensaje De Error","El registro no se pudo completar","error");
        }
    })
}
function limpiarmodal() {
    document.getElementById('txt_abreviatura').value="";
    document.getElementById('txt_unidad').value="";
}

function Editar_Unidad(){
    var id = document.getElementById('txtidunidad').value;
    var unidadactual = document.getElementById('txt_unidad_actual_editar').value;
    var unidadnueva = document.getElementById('txt_unidad_nuevo_editar').value;
    var abreviatura = document.getElementById('txt_abreviatura_editar').value;
    var estatus = document.getElementById('cbm_estatus').value;
    ValidacionInputRegistro('txt_unidad_nuevo_editar','txt_abreviatura_editar');
    if(unidadnueva.length==0 || abreviatura.length==0){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }

    $.ajax({
        url:'../controlador/unidadmedida/controlador_editar_unidadmedida.php',
        type:'POST',
        data:{
            id:id,
            unidadactual:unidadactual,
            unidadnueva:unidadnueva,
            abreviatura:abreviatura,
            estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente actualizados, <b>Datos de la Unidad de medida modificados</b>","success")
                .then ( ( value ) =>  {
                    t_unidadmedida.ajax.reload();
                    $("#modal_editar").modal('hide');
                    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                });
            }else{
                Swal.fire("Mensaje de advertencia","La Unidad de Medida ingresada ya se encuentra en la bd","warning");
            }
        }else{
            Swal.fire("Mensaje De Error","El registro no se pudo completar","error");
        }
    })
}

function listar_unidadmedida_bodega(){
    t_unidadmedida = $("#tabla_unidadmedida").DataTable({
        "ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
        "autoWidth": false,
        "ajax":{
            "method":"POST",
            "url":"../controlador/unidadmedida/controlador_unidadmedida_listar.php",
        },
        "columns":[
            {"defaultContent":""},
            {"data":"unidad_nombre"},
            {"data":"unidad_abreviatura"},
            {"data":"unidad_fregistro"},
            {"data":"unidad_estatus",
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
            $($(nRow).find("td")[2]).css('text-align', 'center' );
            $($(nRow).find("td")[3]).css('text-align', 'center' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );

        },
        "language":idioma_espanol,
        select: true
    });
    t_unidadmedida.on( 'draw.dt', function () {
    var PageInfo = $('#tabla_unidadmedida').DataTable().page.info();
    t_unidadmedida.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    } );
}
