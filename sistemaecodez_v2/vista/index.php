<?php
session_start();

if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>P&aacute;gina Principal | Plataforma Ecodez</title>
    <link href="plantilla/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <link href="plantilla/assets/css/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="plantilla/DataTables/datatables.min.css">
    <link rel="stylesheet" href="plantilla/Select2/select2.min.css">
    <link rel="stylesheet" href="plantilla/css/estilo_propio.css?rev=<?php echo time();?>">
    <link rel="stylesheet" href="plantilla/boostrap/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plantilla/boostrap/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="plantilla/calendario/css/bootstrap-material-datetimepicker.css"/>
    <script type="text/javascript" src="plantilla/calendario/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="plantilla/calendario/js/bootstrap-material-datetimepicker.js"></script>
</head>
<style>
    .btn:hover{
        background-color: black !important;
        color: white;
    }
</style>

<body class="fixed-navbar has-animation fixed-layout">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand probando" style="font-weight:bold">
                <a class="link" href="index.php">
                    <span class="brand">Plataforma Ecodez &nbsp;<i class="ti-shopping-cart"></i>
                        <span class="brand-tip"></span>
                    </span>
                    <span class="brand-mini" title="Compra y Venta"><i class="ti-shopping-cart"></i></span>
                </a>
            </div>
            <div class="flexbox flex-1 ">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar bg-black-gradient" style="height: 55px;color:white !important;">
                    <li class="dropdown dropdown-user ">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown" style="color:white !important;font-weight:bold">
                            <img id="img_navbar" />
                            <span></span><label style="cursor:pointer" id="lb_usuario"></label> <i class="fa fa-angle-down m-l-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right  bg-black-gradient">
                            <a class="dropdown-item menu" onclick="cargar_contenido('contenido_principal','usuario/vista_profile.php')"><i class="fa fa-user"></i>Perfil</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item menu" href="../controlador/usuario/controlador_cerrar_session.php"><i class="fa fa-power-off"></i>Salir</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <!--<img class="img-circle"  id="imagen_sidebar"  width="45px" src="plantilla/assets/img/admin-avatar.png">-->
                        <img id="img_siderbar" width="45px" class="img-circle" alt="User Image">
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><label for="" id="usu_sidebar"></label></div><small id="rol_sidebar"></small>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="index.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Inicio</span>
                        </a>
                    </li>
                    <?php if($_SESSION['S_ROL']=='1'){ ?>
                    <li class="heading">MENU SUPERADMINISTRADOR</li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','persona/vista_mantenimiento_persona.php');"><i class="sidebar-item-icon ti-id-badge"></i>
                            <span class="nav-label">Cliente</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','proveedor/vista_mantenimiento_proveedor.php');"><i class="sidebar-item-icon ti-id-badge"></i>
                            <span class="nav-label">Proveedor</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','categoria/vista_mantenimiento_categoria.php');"><i class="sidebar-item-icon fa fa-cubes"></i>
                            <span class="nav-label">Categor&iacute;a</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','unidadmedida/vista_mantenimiento_unidadmedida.php');"><i class="sidebar-item-icon fa fa-list-ol"></i>
                            <span class="nav-label">Unidad Medida</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','producto/vista_mantenimiento_producto.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Productos</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','ingreso/vista_mantenimiento_ingreso.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Ingreso</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','venta/vista_mantenimiento_venta.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Ventas</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:AbrirModalTonelada()"><i class="sidebar-item-icon fa fa-money"></i>
                            <span class="nav-label">Precio Tonelada</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                    </li>
                    <li class="heading"> CONTROL DE ACCESO</li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','usuario/vista_mantenimiento_usuario.php');"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Usuario</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','rol/vista_mantenimiento_rol.php');"><i class="sidebar-item-icon ti-comment-alt"></i>
                            <span class="nav-label">Rol</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    
                    <?php 
                    } 

                    ?>
                     <?php if($_SESSION['S_ROL']=='2'){ ?>
                    <li class="heading">MENU ADMINISTRADOR</li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','persona/vista_mantenimiento_persona.php');"><i class="sidebar-item-icon ti-id-badge"></i>
                            <span class="nav-label">Cliente</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','proveedor/vista_mantenimiento_proveedor.php');"><i class="sidebar-item-icon ti-id-badge"></i>
                            <span class="nav-label">Proveedor</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','categoria/vista_mantenimiento_categoria_admin.php');"><i class="sidebar-item-icon fa fa-cubes"></i>
                            <span class="nav-label">Categor&iacute;a</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','unidadmedida/vista_mantenimiento_unidadmedida_admin.php');"><i class="sidebar-item-icon fa fa-list-ol"></i>
                            <span class="nav-label">Unidad Medida</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','producto/vista_mantenimiento_producto.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Productos</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','ingreso/vista_mantenimiento_ingreso_admin.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Ingreso</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>

                    <li>
                        <a href="javascript:AbrirModalTonelada()"><i class="sidebar-item-icon fa fa-money"></i>
                            <span class="nav-label">Precio Tonelada</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                    </li>
                    <li class="heading"> CONTROL DE ACCESO</li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','usuario/vista_mantenimiento_usuario.php');"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Usuario</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','rol/vista_mantenimiento_rol_admin.php');"><i class="sidebar-item-icon ti-comment-alt"></i>
                            <span class="nav-label">Rol</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    
                    <?php 
                    } 
                    ?>


                    <?php if($_SESSION['S_ROL']=='5')
                    { 
                    ?>
                    <li class="heading">MENU BODEGA</li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','proveedor/vista_mantenimiento_proveedor_bodega.php');"><i class="sidebar-item-icon ti-id-badge"></i>
                            <span class="nav-label">Proveedor</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                   <!-- <li>
                        <a href="javascript:cargar_contenido('contenido_principal','categoria/vista_mantenimiento_categoria_bodega.php');"><i class="sidebar-item-icon fa fa-cubes"></i>
                            <span class="nav-label">Categor&iacute;a</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','unidadmedida/vista_mantenimiento_unidadmedida_bodega.php');"><i class="sidebar-item-icon fa fa-list-ol"></i>
                            <span class="nav-label">Unidad Medida</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>-->
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','producto/vista_mantenimiento_producto_bodega.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Productos</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','ingreso/vista_ingreso_bodega.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Ingreso</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <?php 
                    } 
                    ?>


                    <?php if($_SESSION['S_ROL']=='4'){ ?>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','ingreso/vista_ingreso_proveedor.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Ingreso</span><i class="fa fa-angle-left arrow"></i></a>

                    </li>
                    <?php 
                    } 
                    ?>

                    <?php if($_SESSION['S_ROL']=='3'){ ?>
                    <li class="heading">MENU VENDEDOR</li>
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','persona/vista_mantenimiento_persona.php');"><i class="sidebar-item-icon ti-id-badge"></i>
                            <span class="nav-label">Cliente</span><i class="fa fa-angle-left arrow"></i></a>
                    </li>
                    
                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','producto/vista_mantenimiento_producto.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Productos</span><i class="fa fa-angle-left arrow"></i></a>
                    </li>

                    <li>
                        <a href="javascript:cargar_contenido('contenido_principal','venta/vista_mantenimiento_venta.php');"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Ventas</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                    </li>
                    
                    <?php 
                    } 
?>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <input type="text" value="<?php echo $_SESSION['S_IDUSUARIO'];?>" id="txt_codigo_principal" hidden>
            <input type="text" value="<?php echo $_SESSION['S_IDPER'];?>" id="txt_codigo_per" hidden>
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div id="contenido_principal">
                <?php if($_SESSION['S_ROL'] !='4'){ ?>    
                    <div class="row">
                        <div class="col-md-2"></div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Seleccionar Rango Fechas:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;padding: 0px 12px;" id="txt_rangofecha">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-2">
                                <label for="">&nbsp;</label><br>
                                <button class="btn btn-success" style="width:100%" onclick="TraerWidgets()"><i class="fa fa-search"></i>&nbsp;Buscar</button>
                            </div>   
                            <div class="col-md-2"></div> 
                        

                    </div>
                    <div class="row" id="div_widget">
                    
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ibox">
                                <canvas id="myChartVentaTop5"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ibox">
                                <canvas id="myChartIngresoTop5"></canvas>
                            </div>
                        </div>
                    </div>
                <?php 
                    } 
                ?>    
                </div>
            </div>


            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13"><b>PLATAFORMA ECODEZ</b> DISEÑADO POR BRAYAN ANDRES HERNANDEZ GAMBOA Y JEIMMY TATIANA CEPEDA ©<?php echo date('Y') ?></div>
            </footer>
        </div>
    </div>
    <div class="theme-config opened" hidden>
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
        <div class="theme-config-box">
            <div class="text-center font-18 m-b-20">SETTINGS</div>
            <div class="font-strong">LAYOUT OPTIONS</div>
            <div class="check-list m-b-20 m-t-10">
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedNavbar" type="checkbox" checked="">
                    <span class="input-span"></span>Fixed navbar</label>
                <label class="ui-checkbox- ui-checkbox-gray-">
                    <input id="_fixedlayout" type="checkbox">
                    <span class="input-span"></span>Fixed layout</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input class="js-sidebar-toggler" type="checkbox">
                    <span class="input-span"></span>Collapse sidebar</label>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_tonelada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">INGRESAR PRECIO POR TONELADA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">PRECIO POR TONELADA</label>
        <input type="number" class="form-control" id="txt_tonelada">
        <input type="text" id="txt_idtonelada" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="Editar_Tonelada()">Guardar</button>
      </div>
    </div>
  </div>
</div>

    <!-- BEGIN THEME CONFIG PANEL-->
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">CARGANDO PLATAFORMA ECODEZ</div>
    </div>

    <script src="plantilla/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
    <script src="plantilla/assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->

    <script src="plantilla/DataTables/datatables.min.js"></script>
    <script src="plantilla/Sweetalert2/sweetalert2.js" type="text/javascript"></script>
    <script src="plantilla/Select2/select2.min.js" type="text/javascript"></script>
    <script src="../js/console_usuario.js" type="text/javascript"></script>
    <script src="plantilla/boostrap/moment/min/moment.min.js"></script>
    <script src="plantilla/boostrap/bootstrap-daterangepicker/daterangepicker.js"></script>
    

    <!--funcion para que nos cargue la vista del contenedor -->
    <script>
         $("#_fixedlayout").prop("checked",true);
         $('body').addClass('fixed-layout');
            $('#sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: '0.9',
            });
            
        TraerDatosUsuario();
        function cargar_contenido(contenedor, contenido) {
            $("#" + contenedor).load(contenido);
        }

        var idioma_espanol = {
            select: {
                rows: "%d fila seleccionada"
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
            "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b>No se encontraron datos</b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

        
        function sololetras(e) {
            key = e.keyCode || e.which;

            teclado = String.fromCharCode(key).toLowerCase();

            letras = "qwertyuiopasdfghjklñzxcvbnm ";

            especiales = "8-37-38-46-164";

            teclado_especial = false;

            for (var i in especiales) {
                if (key == especiales[i]) {
                    teclado_especial = true;
                    break;
                }
            }

            if (letras.indexOf(teclado) == -1 && !teclado_especial) {
                return false;
            }
        }


        function soloNumeros(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == 8) {
                return true;
            }
            // Patron de entrada, en este caso solo acepta numeros
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
        function filterFloat(evt,input){
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempValue = input.value+chark;
            if(key >= 48 && key <= 57){
                if(filter(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
            }else{
                if(key == 8 || key == 13 || key == 0) {
                    return true;
                }else if(key == 46){
                        if(filter(tempValue)=== false){
                            return false;
                        }else{
                            return true;
                        }
                }else{
                    return false;
                }
            }
        }
        function filter(__val__){
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            if(preg.test(__val__) === true){
                return true;
            }else{
                return false;
            }
        }
        function soloNroDocumento(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = "abcdefghijklmnñopqrstuvwxyz0123456456789\@-_+*/";
            especiales = "8-37-39-46-58";

            tecla_especial = false
            for(var i in especiales){
                if(key == especiales[i]){
                    tecla_especial = true;
                    break;
                }
            }

            if(letras.indexOf(tecla)==-1 && !tecla_especial){
                return false;
            }
        }
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            var f = new Date();
            var anio = f.getFullYear();
            var mes = f.getMonth()+1;
            var d = f.getDate();
            // 01 02 03 04 05 06 07 08 09
            if(d<10){
                d='0'+d;
            }
            if(mes<10){
                mes='0'+mes;
            }
            //document.getElementById('txt_finicio_d').value=anio+"-"+mes+"-"+d;
            //document.getElementById('txt_ffin_d').value=anio+"-"+mes+"-"+d;
            TraerWidgets();
        });
$('#txt_rangofecha').daterangepicker({
    locale: {
    format: 'DD-MM-YYYY',
    "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "separator": " / ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Rango Personalizado",
    },
    ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Los Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
        'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
        'El Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
});

$('#modal_tonelada').on('shown.bs.modal', function () {
  $('#txt_tonelada').trigger('focus')
})

function AbrirModalTonelada(){
    $("#modal_tonelada").modal({backdrop:'static',keyboard:false})
    $("#modal_tonelada").modal('show');
    Traer_Precio_Tonelada();
}
    </script>
    <style type="text/css">
        
    </style>
</body>

</html>