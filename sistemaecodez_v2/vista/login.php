<?php
session_start();

if(isset($_SESSION['S_IDUSUARIO'])){
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
      <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">

                <div class="container">
                     
                </div>

                <div>
                      <ul class="navbar-nav cfnavbar">

                        <li class="nav-item ">
                          <a class="nav-link " href="../../index.html">INICIO</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link" href="../../nosotros.html">NOSOTROS</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link" href="../../documentos.html">DOCUMENTOS</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link" href="../../contacto.html">CONTACTANOS</a>
                        </li>     

                      </ul>
                </div>
        </nav>

      </header>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Inicio de Sesi&oacute;n | PLATAFORMA ECODEZ</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="plantilla/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="plantilla/assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link rel="stylesheet" href="plantilla/Select2/select2.min.css">

    <link href="plantilla/assets/css/pages/auth-light.css" rel="stylesheet" />
    <link rel="stylesheet" href="plantilla/css/estilo_propio.css?rev=<?php echo time();?>">

</head>

<body class="bg-silver-300">
<br><br><br><br>
    <div class="content ancho">
        <div class="brand">
            <a style="font-weight:bold" class="link" href="index.php">PLATAFORMA ECODEZ</a>
        </div>
        <form id="login-form" onsubmit="return false">
            <h2 class="login-title" style="font-weight:bold">Iniciar sesi&oacute;n</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="text" name="usuario" placeholder="Ingrese su usuario" autocomplete="new-password" id="txt_usu">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" onkeyup = "if(event.keyCode == 13) Verificar_Usuario()" name="password" autocomplete="new-password" placeholder="Ingrese su contrase&ntilde;a" id="password">
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info" style="font-weight:bold">
                    <input type="checkbox">
                    <span class="input-span" ></span>
                    Recordar</label>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" onclick="Verificar_Usuario()">Ingresar</button>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="plantilla/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="plantilla/assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="plantilla/Select2/select2.min.js" type="text/javascript"></script>

    <script src="plantilla/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>

    <script src="plantilla/assets/js/app.js" type="text/javascript"></script>
    <script src="../js/console_usuario.js" type="text/javascript"></script>
    <script src="plantilla/Sweetalert2/sweetalert2.js" type="text/javascript"></script>

    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

        <div >
            <footer class="py-3 my-4">
              <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="../../index.html" class="nav-link px-2 text-muted">Inicio</a></li>
                <li class="nav-item"><a href="../../nosotros.html" class="nav-link px-2 text-muted">Nosotros</a></li>
                <li class="nav-item"><a href="../../documentos.html" class="nav-link px-2 text-muted">Documentos</a></li>
                <li class="nav-item"><a href="../../contacto.html" class="nav-link px-2 text-muted">Contactanos</a></li>
              </ul>
              <p class="text-center text-muted">© 2022 Asociaci&oacute;n de Recolectores ECODEZ</p>
            </footer>
        </div>

</html>
<style type="text/css">
    @media (min-width:102px){
        .ancho{
          width: 350px;
          max-width: 700px !important;
        }
    }
    @media (min-width:580px){
        .ancho{
          width: 500px;
          max-width: 700px !important;
        }
    }
    @media (min-width:1600px){
        .ancho{
            width: 500px;
            max-width: 700px !important;
        }
    }
    .btn{
        font-weight: bold;
        cursor:pointer;
    }
</style>