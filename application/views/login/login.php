<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Cristian Javier Quispe Callizaya">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>public/assets/images/favicon.png">
    <title>SIAF</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>public/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>public/css/colors/blue.css" id="theme" rel="stylesheet">

    <!--alerts CSS -->
    <link href="<?php echo base_url(); ?>public/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<?php
$date = new DateTime();
$time=$date->getTimestamp();
?>
<body>
    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image: url(public/assets/images/background/loginalt.jpg);">        
            <div class="login-box card">
                <div class="col-xs-8" align="center">
                    <br>
                            <img src="<?php echo base_url().'public/assets/images/logos/activos_fijos.png?';?><?php echo $time; ?>" height="90px"  >
                        </div>
            <div class="card-body">                
                
                
                <?php echo form_open('login/login', array('class'=>'floating-labels ', 'method'=>'POST')); ?>
                    <h5 class="box-title mb-3" align="center" >Iniciar Sesi&oacute;n</h5>
                    <br>
                   

                    <div class="form-group mb-5">                        
                        <input class="form-control" type="text"  required=""  name="usuario" id="input4">
                        <span class="bar"></span>
                        <label for="input4">Usuario</label>
                    </div>
                   

                    <div class="form-group mb-5">                        
                        <input class="form-control" type="password" required=""  name="contrasenia" id="input3">
                        <span class="bar"></span>
                        <label for="input3">Contrase&ntilde;a</label> 
                    </div>
                    
                    <div class="form-group text-center mt-3">
                        <div class="col-xs-10">
                            <button class="btn btn-success " type="submit">Ingresar</button>
                        </div>
                    </div>

                    <div class="col-xs-10" align="center">
                        
                        </div>
                    
                </form>
               
            </div>
          </div>
        </div>
        
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url(); ?>public/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>public/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url(); ?>public/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url(); ?>public/js/custom.min.js"></script>
    <!-- ============================================================== -->
  <!-- Sweet-Alert  -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

</body>

</html>