var t_persona;
function listar_persona(){
    t_persona = $("#tabla_persona").DataTable({
		"ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
    	"autoWidth": false,
      "ajax":{
        "method":"POST",
		"url":"../controlador/persona/controlador_persona_listar.php",
      },
      "columns":[
            {"defaultContent":""},
            {"data":"persona"},
            {"data":"persona_nrodocumento"},
            {"data":"persona_tipodocumento"},
            {"data":"persona_sexo",
                render: function(data,type,row){
                            if(data==="MASCULINO"){
                                return "<i class='fa fa-male'></i>";
                            }else{
                                return "<i class='fa fa-female'></i>";
                            }
                        
                }
            },
            {"data":"persona_telefono"},
            {"data":"persona_estatus",
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
        },
        "language":idioma_espanol,
        select: true
	});
	t_persona.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_persona').DataTable().page.info();
        t_persona.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}

$('#tabla_persona').on('click','.editar',function(){
    var data = t_persona.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_persona.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_persona.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    document.getElementById('txtidpersona').value=data.persona_id;
    document.getElementById('txtnombre_editar').value=data.persona_nombre;
    document.getElementById('txtapepat_editar').value=data.persona_apepat;
    document.getElementById('txtapemat_editar').value=data.persona_apemat;
    document.getElementById('txtnro_editar_actual').value=data.persona_nrodocumento;
    document.getElementById('txtnro_editar_nuevo').value=data.persona_nrodocumento;
    document.getElementById('txttelefono_editar').value=data.persona_telefono;
    $("#cbm_tdocumento_editar").val(data.persona_tipodocumento).trigger('change');
    $("#cbm_sexo_editar").val(data.persona_sexo).trigger('change');
    $("#cbm_estatus").val(data.persona_estatus).trigger('change');
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
})

function AbrirModal(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
    //document.getElementById('div_error').style.display="none";
    limpiarmodal();
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
}
function ValidacionInputRegistro(nombre,apepat,apemat,cedula,telefono){
	Boolean($("#"+nombre).val().length>0) ? $("#"+nombre).removeClass('is-invalid').addClass("is-valid") : $("#"+nombre).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+apepat).val().length>0) ? $("#"+apepat).removeClass('is-invalid').addClass("is-valid") : $("#"+apepat).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+apemat).val().length>0) ? $("#"+apemat).removeClass('is-invalid').addClass("is-valid") : $("#"+apemat).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+cedula).val().length>0) ? $("#"+cedula).removeClass('is-invalid').addClass("is-valid") : $("#"+cedula).removeClass('is-valid').addClass("is-invalid"); 
    Boolean($("#"+telefono).val().length>0) ? $("#"+telefono).removeClass('is-invalid').addClass("is-valid") : $("#"+telefono).removeClass('is-valid').addClass("is-invalid"); 
}

function Registrar_Persona(){
    var txtnombre = document.getElementById('txtnombre').value;
    var txtapepat = document.getElementById('txtapepat').value;
    var txtapemat = document.getElementById('txtapemat').value;
    var txtnro = document.getElementById('txtnro').value;
    var tdocumento = document.getElementById('cbm_tdocumento').value;
    var sexo = document.getElementById('cbm_sexo').value;
    var txttelefono = document.getElementById('txttelefono').value;
    ValidacionInputRegistro('txtnombre','txtapepat','txtapemat','txtnro','txttelefono');
    if(txtnombre.length==0 || txtapepat.length==0 || txtapemat.length==0 || txtnro.length==0 || txttelefono.length==0 ){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    $.ajax({
        url:'../controlador/persona/controlador_registro_persona.php',
        type:'POST',
        data:{
            nombre:txtnombre,
            apepat:txtapepat,
            apemat:txtapemat,
            ndocumento:txtnro,
            tdocumento:tdocumento,
            sexo:sexo,
            telefono:txttelefono
        }
    }).done(function(resp){
        if(isNaN(resp)){
        }else{
            if(resp>0){
                if(resp==1){
                    
                    Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente registrados, <b>Nuevo Cliente Registrado</b>","success")
                    .then ( ( value ) =>  {
                        t_persona.ajax.reload();
                        limpiarmodal();
                        $("#modal_registro").modal('hide');
                        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                    });
                    
                }else{
                    Swal.fire("Mensaje de advertencia","El <b>Nro de documento y/o cliente</b> ingresado ya se encuentra en la bd","warning");
                }
            }else{
                Swal.fire("Mensaje De Error","El registro no se pudo completar","error");
            }
        }
        
    })
}

function Editar_Persona(){
    var id        = document.getElementById('txtidpersona').value;
    var txtnombre = document.getElementById('txtnombre_editar').value;
    var txtapepat = document.getElementById('txtapepat_editar').value;
    var txtapemat = document.getElementById('txtapemat_editar').value;
    var ndocumentoactual = document.getElementById('txtnro_editar_actual').value;
    var txtnro = document.getElementById('txtnro_editar_nuevo').value;
    var tdocumento = document.getElementById('cbm_tdocumento_editar').value;
    var sexo = document.getElementById('cbm_sexo_editar').value;
    var txttelefono = document.getElementById('txttelefono_editar').value;
    var estatus = document.getElementById('cbm_estatus').value;
    ValidacionInputRegistro('txtnombre_editar','txtapepat_editar','txtapemat_editar','txtnro_editar_nuevo','txttelefono_editar');
    if(txtnombre.length==0 || txtapepat.length==0 || txtapemat.length==0 || txtnro.length==0 || txttelefono.length==0 ){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    $.ajax({
        url:'../controlador/persona/controlador_editar_persona.php',
        type:'POST',
        data:{
            id:id,
            nombre:txtnombre,
            apepat:txtapepat,
            apemat:txtapemat,
            ndocumentoactual:ndocumentoactual,
            ndocumentonuevo:txtnro,
            tdocumento:tdocumento,
            sexo:sexo,
            telefono:txttelefono,
            estatus:estatus
        }
    }).done(function(resp){
        if(isNaN(resp)){
        }else{
            if(resp>0){
                if(resp==1){
                    Swal.fire("Mensaje de confirmaci&oacute;n","Datos correctamente actualizados, <b>Datos del Cliente modificados</b>","success")
                    .then ( ( value ) =>  {
                        t_persona.ajax.reload();
                        limpiarmodal();
                        $("#modal_editar").modal('hide');
                        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                    });
                }else{
                    Swal.fire("Mensaje de advertencia","El <b>Nro de documento y/o cliente</b> ingresado ya se encuentra en la bd","warning");
                }
            }else{
                Swal.fire("Mensaje de Error","La actualizacion no se pudo completar","error");
            }
        }
        
    })
}

function  mensajeerror(nombre,apepat,apemat,ndocumento,tdocumento,sexo,telefono,id){
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
