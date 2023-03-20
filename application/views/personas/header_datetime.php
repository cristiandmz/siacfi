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
    <title>ACTIVOS FIJOS</title>
   
    


      <link href="<?php echo base_url(); ?>public/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>public/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    
    <!-- Page plugins css -->
    <link href="<?php echo base_url(); ?>public/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="<?php echo base_url(); ?>public/assets/plugins/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="<?php echo base_url(); ?>public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="<?php echo base_url(); ?>public/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>public/css/colors/blue.css" id="theme" rel="stylesheet">
    <!--datatable-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/plugins/datatables/media/css/dataTables.bootstrap4.css">
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">

                     <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- Light Logo icon -->
                            <!--<img src="<?php echo base_url(); ?>public/assets/images/icono.png" alt="homepage" class="light-logo" />-->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <?php
                            $date = new DateTime();
                            $time=$date->getTimestamp();
                            ?>
                           <img src="<?php echo base_url(); ?>public/assets/images/logos/icono_emp.png?<?php echo $time; ?>" alt="homepage" class="dark-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text 
                         <img src="<?php echo base_url(); ?>public/assets/images/logo-text.png" alt="homepage" class="dark-logo" />-->
                         <!-- Light Logo text -->    
                         <img src="<?php echo base_url(); ?>public/assets/images/logos/activostext.png?<?php echo $time; ?>" class="dark-logo" alt="homepage" /></span>
                            </a>


                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                      
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>usuarios/<?php echo $this->session->userdata("imgUser").'.png' ?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo base_url(); ?>usuarios/<?php echo $this->session->userdata("imgUser").'.png' ?>" alt="user"></div>
                                            <div class="u-text">
                                                 
                                                <h4></h4>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                   <!--  <li><a href="#" data-toggle="modal" data-target="#m_modal_1"><i class="ti-user"></i> Ver Perfil</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#m_modal_5"><i class="ti-wallet"></i> Editar Perfil</a></li> -->
                                    <li><a href="<?php echo base_url(); ?>login/logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                            Cerrar Sesión
                                    </a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-bo"></i></a>
                           
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
<!--header-->
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Ver Rol</h4>
                    </div>

                    <span class="m-list-search__result-item-text">
                        <b>
                           
                    </span>

                   <div class="card">
                       <img class="card-img-top img-responsive" src="<?php echo base_url(); ?>public/assets/images/users/perfil.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Datos Personales</h4>
                                <p class="card-text">Nombre:
                                                        </p>
                                <p class="card-text">Carnet de Identidad:</p>
                                <p class="card-text">Fecha de Nacimiento: </p>
                                
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
</div>




       

