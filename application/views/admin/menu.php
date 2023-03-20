<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" style="font-size: 12px">
        <!-- User profile -->
        <div class="user-profile" style="font-size: 12px">
            <!-- User profile image -->
            <div class="profile-img"> <img src="<?php echo base_url(); ?>usuarios/<?php echo $this->session->userdata("imgUser").'.png' ?>" alt="user" /> </div>
            <!-- User profile text-->

            

            <div class="profile-text" style="font-size: 12px"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $this->session->userdata("usuario");?><span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY" style="font-size: 12px">

                    <div class="dropdown-divider"></div> <a href="<?php echo base_url(); ?>login/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Cerrar Sesi&oacute;n</a>
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="font-size: 12px">
            <ul id="sidebarnav" style="font-size: 12px">

                <?php 
                
                $rol=$this->session->userdata("rol");
                if($rol==1 || $rol==2): // rol de administrador?>
                       <li style="font-size: 12px; background-color: #AFFFFF;"><a href="<?php echo base_url(); ?>dashboard" style="font-size: 12px"><i class="mdi mdi-home"></i>Página de Inicio</a></li>

               

                <li style="font-size: 12px">
                <a class="has-arrow" href="#" aria-expanded="false" style="background-color: #AFFFFF;"><i class="mdi mdi-car"></i>




                
                <span class="hide-menu">Activos</span></a>

                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>Activos/nuevo"><i class="mdi mdi-plus"></i></i> Altas</a></li>
                        <li><a href="<?php echo base_url(); ?>Grupos/nuevo"><i class="mdi mdi-tag"></i></i> Categorias</a></li>
                        <li><a href="<?php echo base_url(); ?>Auxiliar/nuevo"><i class="mdi mdi-package"></i></i> Bienes</a></li>
                         
                         

                    </ul> 
                </li>



                <li style="border: 1px solid #AFFFFF; border-radius: 4px; padding: 10px; background-color: #AFFFFF;"><a href="<?php echo base_url(); ?>Asignacion/nuevo"><i class="fas fa-arrow-right"></i>
</i> Asignación Activos</a></li>

                <li>
                <a class="has-arrow" href="#" aria-expanded="false" style="background-color: #AFFFFF; padding: 10px; display: block;"><i class="fas fa-arrow-left"></i>
</i></i><span class="hide-menu">Devolución de activos</span></a>

                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>Devolucion/nuevo"><i class=" fas fa-book"></i>Devolución</a></li>
                        <li><a href="<?php echo base_url(); ?>Devolucion/lista"><i class="fas fa-clipboard-list"></i> Historial</a></li>
                     <!--   <li><a href="<?php echo base_url(); ?>Devolucion/lista"><i class="fas fa-clipboard-list"></i> Desvinculacion</a></li> -->
                    </ul> 
                </li>
                <li style="background-color: #AFFFFF; padding: 10px;"><a href="<?php echo base_url(); ?>Activos/reportes"><i class="mdi mdi-printer"></i></i> Reportes</a></li>

</li>
                <?php 
                $rol=$this->session->userdata("rol");
                        ?>

                <!-- se valida que el rol 1 es decir el Administrador pueda acceder a este modulo-->
                     
                        <?php if($rol==1):?>
                <li>
                <a class="has-arrow" href="#" aria-expanded="false" style="background-color: #AFFFFF; padding: 10px; display: block;"><i class="fas fa-cog"></i><span class="hide-menu">Administración</span></a>

                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url(); ?>Personas/nuevo"><i class=" fas fa-user"></i> Registro de Empleados</a></li>
                         <li><a href="<?php echo base_url(); ?>Gerencias/nuevo"><i class="mdi mdi-file-tree"></i>
</i></i> Nivel de Jerarquía</a></li>
                       <li><a href="<?php echo base_url(); ?>Oficina/nuevo"><i class="mdi mdi-map"></i>

</i> Localizaciones</a></li>
                                                                                
                        <li><a href="<?php echo base_url(); ?>Cargos/nuevo"><i class="fas fa-briefcase"></i>



</i> Cargos</a></li>                 
                        
                        
                    </ul> 
                </li>
                        <?php endif ?>
                <?php endif ?>
                
                <?php if ($rol==3): ?>
                     <!-- <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="fas fa-angle-double-right"></i><span class="hide-menu">Mis asignaciones</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="?php echo base_url(); ?>Asignacion/lista_user"><i class=" fas fa-book"></i> Listado</a></li>
                     
                    </ul> 
                </li> -->
                <li><a href="<?php echo base_url(); ?>Activos/reportes"><i class="fas fa-clipboard-list"></i> Reportes</a></li>
                    
                <?php endif ?>
                
                



            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <!-- <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a> -->
        <!-- item-->
        <!-- <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a> -->
        <!-- item-->
        <!-- <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> -->
    </div>
    <!-- End Bottom points-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->