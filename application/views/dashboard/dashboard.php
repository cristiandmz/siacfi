
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-info">
                            <div class="box bg-info text-center">
                                <a href="<?php echo base_url(); ?>personas/nuevo" target="blank">
                                <h1 class="font-light text-white"><?php echo $conteo_pers->total ?></h1>
                                <h1 class="text-white"><i class="ti-user"></i></h1>
                                <h6 class="text-white">Empleados</h6>
                            </a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-primary card-inverse">
                            <div class="box text-center">
                                <a href="<?php echo base_url(); ?>activos/nuevo" target="blank">
                                <h1 class="font-light text-white"><?php echo $conteo_act->total ?></h1>
                                <h1 class="text-white"><i class="ti-home"></i></h1>
                                <h6 class="text-white">Total Activos</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-success">
                            <div class="box text-center">
                                <a href="<?php echo base_url(); ?>Asignacion/nuevo" target="blank">
                                <h1 class="font-light text-white"><?php echo $conteo_asign->total ?></h1>
                                <h1 class="text-white"><i class="ti-share"></i></h1>
                                <h6 class="text-white">Asignaciones</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>

        <div class="row">

            <!-- column -->
            <!-- column -->


            <!-- column -->
            <!-- column -->

            <!-- column -->
            <!-- column -->

            <!-- column -->
            <!-- column -->

            <!-- column -->
        </div>


    </div>
</div>
<!-- ============================================================== --> 
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->

            <footer class="footer">
            <footer class="footer">
            <div style="text-align: center;">
    &copy; Desarrollado por <b> Cristian Javier Quispe Callizaya</b> 2023
</div>


 
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<!-- Bootstrap tether Core JavaScript -->

<script src="<?php echo base_url(); ?>public/assets/plugins/jquery/jquery.min.js"></script>
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
<!-- Chart JS -->

<script>
    $(function() {

        /*<!-- ============================================================== -->*/
        /*<!-- Line Chart -->*/
        /*<!-- ============================================================== -->*/








        new Chart(document.getElementById("chart1"),
        {
            "type":"line",
                //"data":{"labels":["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                "data":{"labels":["Enero","Febrero","Marzo","Abril","Mayo"],
                "datasets":[{
                    "label":"Compras por mes",
                    //"data":[65,59,80,81,0,0,0,0,0,0,0,0],
                    "data":[5,6,4,7,0],
                    "fill":false,
                    "borderColor":"rgb(86, 192, 216)",
                    "lineTension":0.1
                }]
            },"options":{}});

        /*<!-- ============================================================== -->*/
        /*<!-- Bar Chart -->*/
        /*<!-- ============================================================== -->*/


        /*<!-- ============================================================== -->*/
        /*<!-- Pie Chart -->*/
        /*<!-- ============================================================== -->*/
        new Chart(document.getElementById("chart3"),
        {
            "type":"pie",
            "data":{"labels":["Asignados","Sin Asignar"],
            "datasets":[{
                "label":"My First Dataset",
                "data":[70,30],
                "backgroundColor":["rgb(57, 139, 247)","rgb(255, 178, 43)"]}
                ]}
            });

        /*<!-- ============================================================== -->*/
        /*<!-- Doughnut Chart -->*/
        /*<!-- ============================================================== -->*/


        /*<!-- ============================================================== -->*/
        /*<!-- PolarArea Chart -->*/
        /*<!-- ============================================================== -->*/

        /*<!-- ============================================================== -->*/
        /*<!-- Radar Chart -->*/
        /*<!-- ============================================================== -->*/


    });
</script>
<script src="<?php echo base_url(); ?>public/assets/plugins/Chart.js/Chart.min.js"></script>
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->

<script src="<?php echo base_url(); ?>public/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>