function Verificar_Usuario(){
    var usu = document.getElementById('txt_usu').value;
    var password = document.getElementById('password').value;
    if(usu.length==0 || password.length==0){
        return Swal.fire("Mensaje de advertencia","LLene las cajas vacias","warning");
    }

    $.ajax({
        url: '../controlador/usuario/controlador_verificar_usuario.php',
        type:'POST',
        data:{
            u:usu,
            p:password
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        if(resp==0){
            Swal.fire("Mensaje de advertencia","Usuario y/o contrase\u00f1a incorrecta","warning");
        }else{
            if(data[0][5]==='ACTIVO'){

                $.ajax({
                    url:'../controlador/usuario/controlador_crear_session.php',
                    type:'POST',
                    data:{
                        idusuario:data[0][0],
                        user:data[0][1],
                        rol:data[0][6],
                        idper:data[0][8]
                    }
                }).done(function(resp){
                    let timerInterval
                    Swal.fire({
                      title: 'Bienvenido a la plataforma!',
                      html: 'Ingresando en',
                      timer: 2000,
                      timerProgressBar: true,
                      allowOutsideClick: false,
				      allowEscapeKey:false,
				      allowEnterKey:false,
				      focusConfirm:false,
                      onBeforeOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {
                          const content = Swal.getContent()
                          if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                              b.textContent = Swal.getTimerLeft()
                            }
                          }
                        }, 100)
                      },
                      onClose: () => {
                        clearInterval(timerInterval)
                      }
                    }).then((result) => {
                      /* Read more about handling dismissals below */
                      if (result.dismiss === Swal.DismissReason.timer) {
                         location.reload();
                      }
                    }) 
                })
  
            }else{
                Swal.fire("Mensaje de advertencia","El usuario se encuentra inactivo, comuniquese con el administrador","warning");               
            }
 
        }
    })
}

var t_usuario;
function listar_usuarios(){
  t_usuario = $("#tabla_usuario").DataTable({
		"ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
    	"autoWidth": false,
      "ajax":{
        "method":"POST",
		"url":"../controlador/usuario/controlador_usuario_listar.php",
      },
      "columns":[
            {"defaultContent":""},
            {"data":"usuario_nombre"},
            {"data":"persona"},
            {"data":"rol_nombre"},
            {"data":"usuario_email"},
            {"data":"usuario_imagen",
                render: function(data,type,row){
                    return  '<img src="../'+data+'" class="img-circle  m-r-10" style="width:28px;">';
                }
            },
            {"data":"usuario_estatus",
                render: function(data,type,row){
                    if(data==="ACTIVO"){
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }else{
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }
                 
                }
            },
            {"data":"rol_nombre",
                render: function(data,type,row){
                    if(data==="ADMINISTRADOR"){
                        return "<button disabled class=' btn btn-primary'><i class='fa fa-edit'></i></button>";
                    }else{
                        return "<button class='editar btn btn-primary'><i class='fa fa-edit'></i></button>";
                    }
                 
                }
            },
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
	t_usuario.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_usuario').DataTable().page.info();
        t_usuario.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}

function AbrirModal(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    limpiarmodal();
}

function listar_persona_combo(){
    $.ajax({
        url:"../controlador/usuario/controlador_persona_combo_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena = "";
        if(data.length>0){
            for (var i=0; i < data.length; i++) {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            document.getElementById('cbm_persona').innerHTML=cadena;
            document.getElementById('cbm_persona_editar').innerHTML=cadena;
        }else{
            document.getElementById('cbm_persona').innerHTML="<option value='0'>No se encontraron datos</option>";
            document.getElementById('cbm_persona_editar').innerHTML="<option value='0'>No se encontraron datos</option>";
        }
    })
}

function listar_rol_combo(){
    $.ajax({
        url:"../controlador/usuario/controlador_rol_combo_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena = "";
        if(data.length>0){
            for (var i=0; i < data.length; i++) {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            document.getElementById('cbm_rol').innerHTML=cadena;
            document.getElementById('cbm_rol_editar').innerHTML=cadena;
        }else{
            document.getElementById('cbm_rol').innerHTML="<option value='0'>No se encontraron datos</option>";
            document.getElementById('cbm_rol_editar').innerHTML="<option value='0'>No se encontraron datos</option>";
        }
    })
}

function Traer_Precio_Tonelada(){
    $.ajax({
        url:"../controlador/usuario/controlador_traer_precio_tonelada.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena = "";
        if(data.length>0){
            document.getElementById('txt_idtonelada').value=data[0][0];
            document.getElementById('txt_tonelada').value=data[0][1];
        }
    })
}


function limpiarmodal(){
    document.getElementById('txt_usu').value = "";
    document.getElementById('txt_password').value = "";
    document.getElementById('txt_email').value="";
    document.getElementById('imagen').value="";
}
function ValidacionInputRegistro(usuario,clave,email,imagen){
	Boolean($("#"+usuario).val().length>0) ? $("#"+usuario).removeClass('is-invalid').addClass("is-valid") : $("#"+usuario).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+clave).val().length>0) ? $("#"+clave).removeClass('is-invalid').addClass("is-valid") : $("#"+clave).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+email).val().length>0) ? $("#"+email).removeClass('is-invalid').addClass("is-valid") : $("#"+email).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+imagen).val().length>0) ? $("#"+imagen).removeClass('is-invalid').addClass("is-valid") : $("#"+imagen).removeClass('is-valid').addClass("is-invalid"); 
}
function Registrar_Usuario(){
    var txt_usu = document.getElementById('txt_usu').value;
    var txt_password    = document.getElementById('txt_password').value;
    var idpersona = document.getElementById('cbm_persona').value;
    var txt_email = document.getElementById('txt_email').value;
    var idrol = document.getElementById('cbm_rol').value;
    var imagen = document.getElementById('imagen').value;
    var f = new Date();
    var extension = imagen.split('.').pop();
    var nombrearchivo = "IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var foto = $("#imagen")[0].files[0];
    ValidacionInputRegistro('txt_usu','txt_password','txt_email','imagen',);
    if(idpersona.length==0 || txt_usu.length==0 || txt_password.length==0 || txt_email.length==0 || imagen.length==0 ){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    if(validar_email(txt_email)){

    }else{
        $("#txt_email").addClass("is-invalid")
        return Swal.fire("Mensaje de advertencia","El formato de email es incorrecto","warning");
    }
    formData.append('usuario',txt_usu);
    formData.append('pass',txt_password);
    formData.append('idpersona',idpersona);
    formData.append('email',txt_email);
    formData.append('idrol',idrol);
    formData.append('foto',foto);
    formData.append('nombrearchivo',nombrearchivo);
    $.ajax({
        url:'../controlador/usuario/controlador_usuario_registro.php',
        type:'post',
        data:formData,
        contentType:false,
        processData:false,
        success: function(respuesta){
            if(respuesta !=0){
                if(respuesta==1){
                    LimpiarCampos();
                    t_usuario.ajax.reload();
                    $("#modal_registro").modal('hide');
                    Swal.fire("Mensaje de confirmaci&oacute;n","Datos guardados","success");
                }else{
                    Swal.fire("Mensaje de Advertencia","El usuario o email ingresado ya se encuentra en la bd","warning");
                }
            }
        }
    });
    return false;
}
function LimpiarCampos(){
    document.getElementById('txt_usu').value="";
    document.getElementById('txt_email').value="";
    document.getElementById('txt_password').value="";
    document.getElementById('imagen').value="";
}

function validar_email(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

$('#tabla_usuario').on('click','.editar',function(){
    var data = t_usuario.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_usuario.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_usuario.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    document.getElementById('txt_usu_id').value=data.usuario_id;
    document.getElementById('txt_usu_editar_actual').value=data.usuario_nombre;
    document.getElementById('txt_email_editar_nuevo').value=data.usuario_email;
    $("#cbm_persona_editar").val(data.persona_id).trigger("change");
    $("#cbm_rol_editar").val(data.rol_id).trigger("change");
    $("#cbm_estatus").val(data.usuario_estatus).trigger("change");
    
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
})

function Editar_Usuario(){
    var id = document.getElementById('txt_usu_id').value;
    var idpersona = document.getElementById('cbm_persona_editar').value;
    var emailnuevo = document.getElementById('txt_email_editar_nuevo').value;
    var idrol = document.getElementById('cbm_rol_editar').value;
    var estatus = document.getElementById('cbm_estatus').value;
    ValidacionInputRegistro('txt_usu','txt_password','txt_email_editar_nuevo','imagen',);
    if( emailnuevo.length==0  ){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    if(validar_email(emailnuevo)){

    }else{
        $("#txt_email_editar_nuevo").addClass("is-invalid")
        return Swal.fire("Mensaje de advertencia","El formato de email es incorrecto","warning");
    }
    $.ajax({
        url:'../controlador/usuario/controlador_usuario_editar.php',
        type:'POST',
        data:{
            id:id,
            idpersona:idpersona,
            emailnuevo:emailnuevo,
            idrol:idrol,
            estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                t_usuario.ajax.reload();
                $("#modal_editar").modal('hide');
                TraerDatosUsuario();
                Swal.fire("Mensaje de confirmaci&oacute;n","Datos actualizados","success");
            }else{
                Swal.fire("Mensaje de advertencia","El email ingresado ya se encuentra en la bd","warning");
            }
        }else{
            Swal.fire("Mensaje De Error","La actualizacion no se pudo completar","error");
        }
    })
}

function Editar_Tonelada(){
    var id  = document.getElementById('txt_idtonelada').value;
    var pre = document.getElementById('txt_tonelada').value;
    $.ajax({
        url:'../controlador/usuario/controlador_precio_tonelada_editar.php',
        type:'POST',
        data:{
            id:id,
            pre:pre
        }
    }).done(function(resp){
        if(resp>0){
            Swal.fire("Mensaje De Confirmación","Precio por tonelada actualizada","success");
        }else{
            Swal.fire("Mensaje De Error","La actualizacion no se pudo completar","error");
        }
    })
}

function Editar_Foto(){
    var id = document.getElementById('txt_usu_id').value;
    var archivo = document.getElementById('imagen_editar').value;
    var f = new Date();
    var extension = archivo.split('.').pop();
    var nombrearchivo = "IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var foto = $("#imagen_editar")[0].files[0];
    if (archivo.length==0){
        return Swal.fire("Mensaje de advertencia","Debe seleccionar un archivo","warning");
    }
    formData.append('id',id);
    formData.append('foto',foto);
    formData.append('nombrearchivo',nombrearchivo);
    $.ajax({
        url:'../controlador/usuario/controlador_usuario_editar_imagen.php',
        type:'post',
        data:formData,
        contentType:false,
        processData:false,
        success: function(respuesta){
            if(respuesta !=0){
                if(respuesta==1){
                    t_usuario.ajax.reload();
                    $("#modal_editar").modal('hide');
                    Swal.fire("Mensaje de confirmaci&oacute;n","Foto Actualizada","success");
                    TraerDatosUsuario();
                }
            }
        }
    });
    return false;
}

function TraerDatosUsuario(){
    var id = document.getElementById('txt_codigo_principal').value;
    $.ajax({
        url:'../controlador/usuario/controlador_traerdatos_usuario.php',
        type:'POST',
        data:{
            id:id
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        if(data.length>0){
            document.getElementById('usu_sidebar').innerHTML=data[0][1];
            document.getElementById('rol_sidebar').innerHTML=data[0][7];
            document.getElementById('lb_usuario').innerHTML=data[0][17];
            document.getElementById('img_siderbar').src='../'+data[0][16];
            document.getElementById('img_navbar').src='../'+data[0][16];

        }
    })
}

function TraerWidgets(){

    //let inicio= document.getElementById('txt_finicio_d').value;
    //let fin = document.getElementById('txt_ffin_d').value;
    var txt_rangofecha = ($("#txt_rangofecha").val().replace(/ /g, "")).split('/');
    var info           = txt_rangofecha[0].split('-');
    var inicio = info[2] + '-' + info[1] + '-' + info[0];
    var info2          = txt_rangofecha[1].split('-');
    var fin = info2[2] + '-' + info2[1] + '-' + info2[0];
    if(inicio>fin){
        return Swal.fire("Mensaje de Advertencia","La fecha inicio debe ser menor a la fecha fin","warning");
    }
    TraerGraficoVentas();
    TraerGraficoIngreso();
    $.ajax({
        url:'../controlador/usuario/controlador_traerdatos_widget.php',
        type:'POST',
        data:{
            inicio:inicio,
            fin:fin
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        let cadena='';
        if(data.length>0){
            cadena+='<div class="col-lg-3 col-md-6">'+
            '<div class="ibox bg-success color-white widget-stat">'+
                '<div class="ibox-body">'+
                    '<h2 class="m-b-5 font-strong">'+data[0][0]+'</h2>'+
                    '<div class="m-b-5">TOTAL DE VENTAS</div><i class="ti-shopping-cart widget-stat-icon"></i>'+
                    '<div></div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="col-lg-3 col-md-6">'+
            '<div class="ibox bg-info color-white widget-stat">'+
                '<div class="ibox-body">'+
                    '<h2 class="m-b-5 font-strong">'+data[0][1]+'</h2>'+
                    '<div class="m-b-5">TOTAL INGRESO</div><i class="ti-bar-chart widget-stat-icon"></i>'+
                    '<div></div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="col-lg-3 col-md-6">'+
            '<div class="ibox bg-warning color-white widget-stat">'+
                '<div class="ibox-body">'+
                    '<h2 class="m-b-5 font-strong">'+data[0][2]+'</h2>'+
                    '<div class="m-b-5">VENTAS REALIZADAS</div><i class="ti-bar-chart widget-stat-icon"></i>'+
                    '<div></div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="col-lg-3 col-md-6">'+
            '<div class="ibox bg-danger color-white widget-stat">'+
                '<div class="ibox-body">'+
                    '<h2 class="m-b-5 font-strong">'+data[0][3]+'</h2>'+
                    '<div class="m-b-5">INGRESOS REALIZADOS</div><i class="ti-bar-chart widget-stat-icon"></i>'+
                    '<div></div>'+
                '</div>'+
            '</div>'+
        '</div>';
            document.getElementById('div_widget').innerHTML=cadena;
        }else{
            cadena+='<div class="col-lg-3 col-md-6">'+
            '<div class="ibox bg-success color-white widget-stat">'+
                '<div class="ibox-body">'+
                    '<h2 class="m-b-5 font-strong">0</h2>'+
                    '<div class="m-b-5">TOTAL DE VENTAS</div><i class="ti-shopping-cart widget-stat-icon"></i>'+
                    '<div></div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="col-lg-3 col-md-6">'+
            '<div class="ibox bg-info color-white widget-stat">'+
                '<div class="ibox-body">'+
                    '<h2 class="m-b-5 font-strong">0</h2>'+
                    '<div class="m-b-5">TOTAL INGRESO</div><i class="ti-bar-chart widget-stat-icon"></i>'+
                    '<div></div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="col-lg-3 col-md-6">'+
            '<div class="ibox bg-warning color-white widget-stat">'+
                '<div class="ibox-body">'+
                    '<h2 class="m-b-5 font-strong">0</h2>'+
                    '<div class="m-b-5">VENTAS REALIZADAS</div><i class="ti-bar-chart widget-stat-icon"></i>'+
                    '<div></div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="col-lg-3 col-md-6">'+
            '<div class="ibox bg-danger color-white widget-stat">'+
                '<div class="ibox-body">'+
                    '<h2 class="m-b-5 font-strong">0</h2>'+
                    '<div class="m-b-5">INGRESOS REALIZADOS</div><i class="ti-bar-chart widget-stat-icon"></i>'+
                    '<div></div>'+
                '</div>'+
            '</div>'+
        '</div>';
            document.getElementById('div_widget').innerHTML=cadena;
        }
    })
}

var chartventa;
function TraerGraficoVentas(){
    //let inicio= document.getElementById('txt_finicio_d').value;
    //let fin = document.getElementById('txt_ffin_d').value;
    var txt_rangofecha = ($("#txt_rangofecha").val().replace(/ /g, "")).split('/');
    var info           = txt_rangofecha[0].split('-');
    var inicio = info[2] + '-' + info[1] + '-' + info[0];
    var info2          = txt_rangofecha[1].split('-');
    var fin = info2[2] + '-' + info2[1] + '-' + info2[0];
    $.ajax({
        url:'../controlador/usuario/controlador_traergraficoventa_widget.php',
        type:'POST',
        data:{
            inicio:inicio,
            fin:fin
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        if(data.length>0){
            let producto = new Array();
            let cantidad = new Array();
            let color = new Array();
            for (let index = 0; index < data.length; index++) {
               producto.push(data[index][0]);
               cantidad.push(data[index][1]);
               color.push(colorRGB());
            }
            var ctx = document.getElementById('myChartVentaTop5').getContext('2d');
            if(chartventa){
                chartventa.reset();
                chartventa.destroy();
            }
            chartventa = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
        
                // The data for our dataset
                data: {
                    labels: producto,
                    datasets: [{
                        label: 'TOP 5 PRODUCTOS VENDIDOS',
                        backgroundColor: color,
                        borderColor: color,
                        data: cantidad
                    }]
                },
        
                // Configuration options go here
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
        }else{
            var ctx = document.getElementById('myChartVentaTop5').getContext('2d');
            if(chartventa){
                chartventa.reset();
                chartventa.destroy();
            }
            chartventa = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
        
                // The data for our dataset
                data: {
                    labels: ['NO HAY PRODUCTOS'],
                    datasets: [{
                        label: 'TOP 5 PRODUCTOS VENDIDOS',
                        data: [0]
                    }]
                },
        
                // Configuration options go here
                options: {
                }
            });
    
        }
    })
}

var chartingreso;
function TraerGraficoIngreso(){
    //let inicio= document.getElementById('txt_finicio_d').value;
    //let fin = document.getElementById('txt_ffin_d').value;
    var txt_rangofecha = ($("#txt_rangofecha").val().replace(/ /g, "")).split('/');
    var info           = txt_rangofecha[0].split('-');
    var inicio = info[2] + '-' + info[1] + '-' + info[0];
    var info2          = txt_rangofecha[1].split('-');
    var fin = info2[2] + '-' + info2[1] + '-' + info2[0];
    $.ajax({
        url:'../controlador/usuario/controlador_traergraficoingreso_widget.php',
        type:'POST',
        data:{
            inicio:inicio,
            fin:fin
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        if(data.length>0){
            let producto = new Array();
            let cantidad = new Array();
            let color = new Array();
            for (let index = 0; index < data.length; index++) {
               producto.push(data[index][0]);
               cantidad.push(data[index][1]);
               color.push(colorRGB());
            }
            var ctx = document.getElementById('myChartIngresoTop5').getContext('2d');
            if(chartingreso){
                chartingreso.reset();
                chartingreso.destroy();
            }
            chartingreso = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
        
                // The data for our dataset
                data: {
                    labels: producto,
                    datasets: [{
                        label: 'TOP 5 PRODUCTOS INGRESADOS',
                        backgroundColor: color,
                        borderColor: color,
                        data: cantidad
                    }]
                },
        
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
        }else{
            var ctx = document.getElementById('myChartIngresoTop5').getContext('2d');
            if(chartingreso){
                chartingreso.reset();
                chartingreso.destroy();
            }
            chartingreso = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
        
                // The data for our dataset
                data: {
                    labels: ['NO HAY PRODUCTOS'],
                    datasets: [{
                        label: 'TOP 5 PRODUCTOS INGRESADOS',
                        data: [0]
                    }]
                },
        
                // Configuration options go here
                options: {}
            });
    
        }
    })
}

function generarNumero(numero){
	return (Math.random()*numero).toFixed(0);
}

function colorRGB(){
        var coolor = "("+generarNumero(255)+"," + generarNumero(255) + "," + generarNumero(255) +")";
        return "rgb" + coolor;
}
function TraerDatosPerfil(){
    var id = document.getElementById('txt_codigo_principal').value;
    $.ajax({
        url:'../controlador/usuario/controlador_traerdatos_usuario.php',
        type:'POST',
        data:{
            id:id
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        if(data.length>0){
            document.getElementById('txt_imagen_profile').src='../'+data[0][16];
            document.getElementById('txt_persona_profile').innerHTML=data[0][8]+' '+data[0][9]+' '+data[0][10];
            document.getElementById('txt_rol_profile').innerHTML=data[0][7];
            document.getElementById('txt_nombres_profile').value=data[0][8];
            document.getElementById('txt_apepat_profile').value=data[0][9];
            document.getElementById('txt_apemat_profile').value=data[0][10];
            document.getElementById('txt_ndocumento_profile').value=data[0][11];
            $("#cbm_tdocumento_profile").val(data[0][12]).trigger('change');
            $("#cbm_sexo_profile").val(data[0][13]).trigger('change');
            document.getElementById('txttelefono_profile').value=data[0][14];
            document.getElementById('txt_conactual_profile').value=data[0][2];
            TraerDatosUsuario();
        }
    })
}


function Editar_Foto_Profile(){
    var id = document.getElementById('txt_codigo_principal').value;
    var archivo = document.getElementById('imagen_profile').value;
    if (archivo.length==0){
        return Swal.fire("Mensaje de advertencia","Debe seleccionar un archivo","warning");
    }
    var f = new Date();
    var extension = archivo.split('.').pop();
    var nombrearchivo = "IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var foto = $("#imagen_profile")[0].files[0];
    formData.append('id',id);
    formData.append('foto',foto);
    formData.append('nombrearchivo',nombrearchivo);
    $.ajax({
        url:'../controlador/usuario/controlador_usuario_editar_imagen.php',
        type:'post',
        data:formData,
        contentType:false,
        processData:false,
        success: function(respuesta){
            if(respuesta !=0){
                if(respuesta==1){
                    
                    Swal.fire("Mensaje de confirmaci&oacute;n","Foto Actualizada","success")
                    .then ( ( value ) =>  {
                        TraerDatosPerfil();
                        document.getElementById('imagen_profile').value= "";
                    });
                }
            }
        }
    });
    return false;
}
function ValidacionInputRegistro_perfil(nombre,apepat,apemat,cedula,telefono){
	Boolean($("#"+nombre).val().length>0) ? $("#"+nombre).removeClass('is-invalid').addClass("is-valid") : $("#"+nombre).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+apepat).val().length>0) ? $("#"+apepat).removeClass('is-invalid').addClass("is-valid") : $("#"+apepat).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+apemat).val().length>0) ? $("#"+apemat).removeClass('is-invalid').addClass("is-valid") : $("#"+apemat).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+cedula).val().length>0) ? $("#"+cedula).removeClass('is-invalid').addClass("is-valid") : $("#"+cedula).removeClass('is-valid').addClass("is-invalid"); 
    Boolean($("#"+telefono).val().length>0) ? $("#"+telefono).removeClass('is-invalid').addClass("is-valid") : $("#"+telefono).removeClass('is-valid').addClass("is-invalid"); 
}
function Datos_Actualizar(){
    var id = document.getElementById('txt_codigo_principal').value;
    var nombre = document.getElementById('txt_nombres_profile').value;
    var apepat = document.getElementById('txt_apepat_profile').value;
    var apemat = document.getElementById('txt_apemat_profile').value;
    var ndocumento = document.getElementById('txt_ndocumento_profile').value;
    var tdocumento = document.getElementById('cbm_tdocumento_profile').value;
    var sexo = document.getElementById('cbm_sexo_profile').value;
    var telefono = document.getElementById('txttelefono_profile').value;

    ValidacionInputRegistro_perfil('txt_nombres_profile','txt_apepat_profile','txt_apemat_profile','txt_ndocumento_profile','txttelefono_profile');
    if(nombre.length==0 || apepat.length==0 || apemat.length==0 || ndocumento.length==0 ||  telefono.length==0 ){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }
    $.ajax({
        url:'../controlador/usuario/controlador_actualizar_datos_persona_profile.php',
        type:'POST',
        data:{
            id:id,
            nombre:nombre,
            apepat:apepat,
            apemat:apemat,
            ndocumento:ndocumento,
            tdocumento:tdocumento,
            sexo:sexo,
            telefono:telefono
        }
    }).done(function(resp){

        if(isNaN(resp)){
       }else{
            if(resp>0){
                if(resp==1){
                    Swal.fire("Mensaje de confirmaci&oacute;n","Datos guardados","success");
                    TraerDatosPerfil();
                    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
                }else{
                    Swal.fire("Mensaje de advertencia","El Nro de documento ingresado ya se encuentra en la bd","warning");
                }
            }else{
                Swal.fire("Mensaje De Error","El registro no se pudo completar","error");
            }
        }
        
    })

}

function  mensajeerror(nombre,apepat,apemat,ndocumento,tdocumento,sexo,telefono){
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

    document.getElementById('div_error_profile').style.display="block";
    document.getElementById('div_error_profile').innerHTML="<strong>Revise los siguientes campos:</strong><br>"+cadena;
}
function ValidacionInputRegistro_clave(actual,nueva,repetir){
	Boolean($("#"+actual).val().length>0) ? $("#"+actual).removeClass('is-invalid').addClass("is-valid") : $("#"+actual).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+nueva).val().length>0) ? $("#"+nueva).removeClass('is-invalid').addClass("is-valid") : $("#"+nueva).removeClass('is-valid').addClass("is-invalid"); 
	Boolean($("#"+repetir).val().length>0) ? $("#"+repetir).removeClass('is-invalid').addClass("is-valid") : $("#"+repetir).removeClass('is-valid').addClass("is-invalid"); 
}
function Actualizar_Contra(){
    var id = document.getElementById('txt_codigo_principal').value;
    var contraactual = document.getElementById('txt_conactual_profile').value;
    var contraactualescrita = document.getElementById('txt_conactualescrita_profile').value;
    var contranueva = document.getElementById('txt_connueva_profile').value;
    var contrarepetir = document.getElementById('txt_conrepetir_profile').value;
   
    ValidacionInputRegistro_clave('txt_conactualescrita_profile','txt_connueva_profile','txt_conrepetir_profile');
    if(contraactualescrita.length==0 || contranueva.length==0 || contrarepetir.length==0 ){
        return Swal.fire("Mensaje de Advertencia","Porfavor <b>llene los campos vac&iacute;os (*)</b>","warning");
    }

    if(contranueva != contrarepetir){
        $("#txt_connueva_profile").removeClass('is-valid').addClass("is-invalid"); 
        $("#txt_conrepetir_profile").removeClass('is-valid').addClass("is-invalid"); 
        return Swal.fire("Mensaje de Advertencia","Debes ingresar la misma clave dos veces para confirmarla","warning");
    }
    $.ajax({
        url:'../controlador/usuario/controlador_actualizar_contra_usuario.php',
        type:'POST',
        data:{
            id:id,
            contraactual:contraactual,
            contraactualescrita:contraactualescrita,
            contranueva:contranueva
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                Swal.fire("Mensaje de confirmaci&oacute;n","Datos actualizados","success");
                LimpiarContra();
                TraerDatosPerfil();
            }else{
                Swal.fire("Mensaje de advertencia","La contra\u00f1a actual ingresada no coincide con la de la base de datos","warning");
            }
        }else{
            Swal.fire("Mensaje De Error","La modificacion no se pudo completar","error");
        }
    })  
}

function LimpiarContra(){
    document.getElementById('txt_conactualescrita_profile').value="";
    document.getElementById('txt_connueva_profile').value="";
    document.getElementById('txt_conrepetir_profile').value="";
}
