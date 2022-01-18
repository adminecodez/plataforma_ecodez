var t_proveedor;
function listar_proveedor(){
    t_proveedor = $("#tabla_proveedor").DataTable({
		"ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
    	"autoWidth": false,
        "ajax":{
            "method":"POST",
            "url":"../controlador/proveedor/controlador_proveedor_listar.php",
        },
        "columns":[
            {"defaultContent":""},
            {"data":"proveedor_razonsocial"},
            {"data":"proveedor_contacto"},
            {"data":"proveedor_numcontacto"},
            {"data":"persona_nrodocumento"},
            {"data":"persona_tipodocumento"},
            {"data":"proveedor_estatus",
                render: function(data,type,row){
                    if(data==="ACTIVO"){
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }else{
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }
                
                }
            },
            {"data":"proveedor_estatus",
                render: function(data,type,row){
                    if(data==="ACTIVO"){
                        return "<button class='editar btn btn-primary' ><i class='fa fa-edit'></i></button>&nbsp;<button class='btn btn-warning' disabled><i class='fa fa-check'></i></button>&nbsp;<button class='desactivar btn btn-danger'><i class='fa fa-times-circle'></i></button>";
                    }else{
                        return "<button class='editar btn btn-primary' ><i class='fa fa-edit'></i></button>&nbsp;<button class='activar btn btn-warning'><i class='fa fa-check'></i></button>&nbsp;<button class=' btn btn-danger' disabled><i class='fa fa-times-circle'></i></button>";
                    }
                
                }
            }
        ],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $($(nRow).find("td")[0]).css('text-align', 'left' );
            $($(nRow).find("td")[1]).css('text-align', 'left' );
            $($(nRow).find("td")[2]).css('text-align', 'left' );
            $($(nRow).find("td")[3]).css('text-align', 'center' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );
            $($(nRow).find("td")[5]).css('text-align', 'center' );
            $($(nRow).find("td")[6]).css('text-align', 'center' );
            $($(nRow).find("td")[7]).css('text-align', 'center' );
        },
        "language":idioma_espanol,
        select: true
	});
	t_proveedor.on( 'draw.dt', function () {
    var PageInfo = $('#tabla_proveedor').DataTable().page.info();
    t_proveedor.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    } );
}

$('#tabla_proveedor').on('click','.activar',function(){
    var data = t_proveedor.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_proveedor.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_proveedor.row(this).data();
    }
    Swal.fire({
        title: 'Desea activar al proveedor?',
        text: "Esta seguro de activar al proveedor!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.value) {
            Modificar_Estatus_Proveedor(data.proveedor_id,'ACTIVO');
        }else{
           
        }
    })
})

$('#tabla_proveedor').on('click','.desactivar',function(){
    var data = t_proveedor.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_proveedor.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_proveedor.row(this).data();
    }
    Swal.fire({
        title: 'Desea desactivar al proveedor?',
        text: "Esta seguro de desactivar al proveedor!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText: 'NO'
    })
    .then((result) => {
        if (result.value) {
            Modificar_Estatus_Proveedor(data.proveedor_id,'INACTIVO');
        }else{
            
        }
    })
})

$('#tabla_proveedor').on('click','.editar',function(){
    var data = t_proveedor.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_proveedor.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_proveedor.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    document.getElementById('txt_idproveedor').value=data.proveedor_id;
    document.getElementById('txt_razonsocial_editar').value=data.proveedor_razonsocial;
    document.getElementById('txtnombre_editar').value=data.persona_nombre;
    document.getElementById('txtapepat_editar').value=data.persona_apepat;
    document.getElementById('txtapemat_editar').value=data.persona_apemat;
    document.getElementById('txtnro_editar').value=data.persona_nrodocumento;
    document.getElementById('txttelefono_editar').value=data.proveedor_numcontacto;

    $("#cbm_tdocumento_editar").val(data.persona_tipodocumento).trigger('change');
    $("#cbm_sexo_editar").val(data.persona_sexo).trigger('change');
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
})

function Modificar_Estatus_Proveedor(idproveedor,estatus){
    $.ajax({
        url:'../controlador/proveedor/controlador_actualizar_estatus_proveedor.php',
        type:'POST',
        data:{
            idproveedor:idproveedor,
            estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            if(estatus=="ACTIVO"){
                Swal.fire("Mensaje de confirmacion","Proveedor Activado Correctamente","success");
            }else{
                Swal.fire("Mensaje de confirmacion","Proveedor Desactivado Correctamente","success");
            }
            t_proveedor.ajax.reload();
        }else{
            Swal.fire("Mensaje de Error","No se pudo actualizar los datos","error");
        }
        
    })
}

function AbrirModal(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    limpiarmodal();
}
function ValidacionInputRegistro(razonsocial,nombre,apepat,apemat,cedula,telefono){
	Boolean($("#"+razonsocial).val().length>0) ? $("#"+razonsocial).removeClass('is-invalid').addClass("is-valid") : $("#"+razonsocial).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+nombre).val().length>0) ? $("#"+nombre).removeClass('is-invalid').addClass("is-valid") : $("#"+nombre).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+apepat).val().length>0) ? $("#"+apepat).removeClass('is-invalid').addClass("is-valid") : $("#"+apepat).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+apemat).val().length>0) ? $("#"+apemat).removeClass('is-invalid').addClass("is-valid") : $("#"+apemat).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+cedula).val().length>0) ? $("#"+cedula).removeClass('is-invalid').addClass("is-valid") : $("#"+cedula).removeClass('is-valid').addClass("is-invalid"); 
    Boolean($("#"+telefono).val().length>0) ? $("#"+telefono).removeClass('is-invalid').addClass("is-valid") : $("#"+telefono).removeClass('is-valid').addClass("is-invalid"); 
}
function Registrar_Proveedor(){
    var txt_razonsocial = document.getElementById('txt_razonsocial').value;
    var txtnombre       = document.getElementById('txtnombre').value;
    var txtapepat       = document.getElementById('txtapepat').value;
    var txtapemat       = document.getElementById('txtapemat').value;
    var txtnro          = document.getElementById('txtnro').value;
    var tdocumento      = document.getElementById('cbm_tdocumento').value;
    var sexo            = document.getElementById('cbm_sexo').value;
    var txttelefono     = document.getElementById('txttelefono').value;
    ValidacionInputRegistro('txt_razonsocial','txtnombre','txtapepat','txtapemat','txtnro','txttelefono');
    if(txtnombre.length==0 || txtapepat.length==0 || txtapemat.length==0 || txtnro.length==0 || txttelefono.length==0 || txt_razonsocial.length==0){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    $.ajax({
        url:'../controlador/proveedor/controlador_registro_proveedor.php',
        type:'POST',
        data:{
            nombre:txtnombre,
            apepat:txtapepat,
            apemat:txtapemat,
            ndocumento:txtnro,
            tdocumento:tdocumento,
            sexo:sexo,
            telefono:txttelefono,
            razonsocial:txt_razonsocial
        }
    }).done(function(resp){
        if(isNaN(resp)){
       }else{
            if(resp>0){
               if(resp==1){
                Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente registrados, <b>Nuevo Proveedor Registrado</b>","success")
                .then ( ( value ) =>  {
                    t_proveedor.ajax.reload();
                    limpiarmodal();
                    $("#modal_registro").modal('hide');
                    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                });
                }else{
                    Swal.fire("Mensaje de advertencia","El <b>Nro de RUC</b> ingresado ya se encuentra en la bd","warning");
                }
            }else{
                Swal.fire("Mensaje De Error","El registro no se pudo completar","error");
            }
        }
        
    })
}

function  mensajeerror(nombre,apepat,apemat,ndocumento,tdocumento,sexo,telefono,razonsocial,nomcontacto,numcontacto,id){
    var cadena="";
    if(nombre.length==0){
        cadena+="El campo nombre no debe estar vacio.<br>"
    }

    if(apepat.length==0){
        cadena+="El campo apellido paterno no debe estar vacio.<br>"
    }

    if(apemat.length==0){
        cadena+="El campo apellido materno no debe estar vacio.<br>"
    }

    if(ndocumento.length==0){
        cadena+="El campo n&uacute;mero de documento no debe estar vacio.<br>"
    }

    if(tdocumento.length==0){
        cadena+="El campo tipo de documento no debe estar vacio.<br>"
    }

    if(sexo.length==0){
        cadena+="El campo sexo no debe estar vacio.<br>"
    }

    if(telefono.length==0){
        cadena+="El campo n&uacute;mero de telefono no debe estar vacio.<br>"
    }

    if(razonsocial.length==0){
        cadena+="El campo razon social no debe estar vacio.<br>"
    }

    if(nomcontacto.length==0){
        cadena+="El campo nombre de contacto no debe estar vacio.<br>"
    }

    if(numcontacto.length==0){
        cadena+="El campo n&uacute;mero de contacto no debe estar vacio.<br>"
    }

    document.getElementById(id).style.display="block";
    document.getElementById(id).innerHTML="<strong>Revise los siguientes campos:</strong><br>"+cadena;
}

function limpiarmodal(){
    document.getElementById('txtnombre').value="";
    document.getElementById('txtapepat').value="";
    document.getElementById('txtapemat').value="";
    document.getElementById('txtnro').value="";
    document.getElementById('txttelefono').value="";
}


function Modificar_Proveedor(){
    var idproveedor = document.getElementById('txt_idproveedor').value;
    var razonsocial = document.getElementById('txt_razonsocial_editar').value;
    var txtnombre   = document.getElementById('txtnombre_editar').value;
    var txtapepat   = document.getElementById('txtapepat_editar').value;
    var txtapemat   = document.getElementById('txtapemat_editar').value;
    var txtnro      = document.getElementById('txtnro_editar').value;
    var tdocumento  = document.getElementById('cbm_tdocumento_editar').value;
    var sexo        = document.getElementById('cbm_sexo_editar').value;
    var txttelefono = document.getElementById('txttelefono_editar').value;
    ValidacionInputRegistro('txt_razonsocial_editar','txtnombre_editar','txtapepat_editar','txtapemat_editar','txtnro_editar','txttelefono_editar');
    if(idproveedor.length==0 || txtnombre.length==0 || txtapepat.length==0 || txtapemat.length==0 || txtnro.length==0 || txttelefono.length==0 || txt_razonsocial.length==0){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    $.ajax({
        url:'../controlador/proveedor/controlador_editar_proveedor.php',
        type:'POST',
        data:{
            idproveedor:idproveedor,
            razonsocial:razonsocial,
            nombre:txtnombre,
            apepat:txtapepat,
            apemat:txtapemat,
            ndocumento:txtnro,
            tdocumento:tdocumento,
            sexo:sexo,
            telefono:txttelefono
        }
    }).done(function(resp){
        if(resp>0){
            Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente actualizados, <b>Datos del Cliente modificados</b>","success")
            .then ( ( value ) =>  {
                t_proveedor.ajax.reload();
                $("#modal_editar").modal('hide');
                $('.form-control').removeClass("is-invalid").removeClass("is-valid");
            });
        }else{
            Swal.fire("Mensaje de Error","No se pudo actualizar los datos","error");
        }
        
    })
}


function listar_proveedor_bodega(){
    t_proveedor = $("#tabla_proveedor").DataTable({
        "ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
        "autoWidth": false,
        "ajax":{
            "method":"POST",
            "url":"../controlador/proveedor/controlador_proveedor_listar.php",
        },
        "columns":[
            {"defaultContent":""},
            {"data":"proveedor_razonsocial"},
            {"data":"proveedor_contacto"},
            {"data":"proveedor_numcontacto"},
            {"data":"persona_nrodocumento"},
            {"data":"persona_tipodocumento"},
            {"data":"proveedor_estatus",
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
            $($(nRow).find("td")[0]).css('text-align', 'left' );
            $($(nRow).find("td")[1]).css('text-align', 'left' );
            $($(nRow).find("td")[2]).css('text-align', 'left' );
            $($(nRow).find("td")[3]).css('text-align', 'center' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );
            $($(nRow).find("td")[5]).css('text-align', 'center' );
            $($(nRow).find("td")[6]).css('text-align', 'center' );

        },
        "language":idioma_espanol,
        select: true
    });
    t_proveedor.on( 'draw.dt', function () {
    var PageInfo = $('#tabla_proveedor').DataTable().page.info();
    t_proveedor.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    } );
}
