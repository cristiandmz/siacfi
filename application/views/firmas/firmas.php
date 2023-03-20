<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/plugins/dropify/dist/css/dropify.min.css">
<link href="<?php echo base_url(); ?>public/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
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
     
                      <!---///////-->



                       <div class="row" >
                        <div class="col-lg-12" align="left">
                             <a href="<?php echo site_url('Activos/reportes'); ?>" class="btn btn-info " title="Ir Atras" data-toggle="tooltip" align="left" ><i class="fa fas fa-reply" ></i> Atras</a>
                                  <br><br>
                        </div>
                    <div class="col-lg-12" align="center">
                        <div class="card">
                            <div class="card-body">
                               
                                <h4 class="card-title" ><?php echo $encabezado->texto_uno; ?></h4>
                                
                                
                                

                                      <a href="<?php echo site_url('Firmas/editarEncabezado/'.$encabezado->encabezado_id); ?>"><button type="button" class="btn btn-success"><span class="fas fa-edit" aria-hidden="true" style="color:#ffffff"></span>editar</button></a>

                                    
                                    
                                
                            </div>
                        </div>
                    </div>
                    
                </div>


                        <div class="row" align="center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $firmas[0]['nombre']; ?></h4>
                                <h5 class="card-subtitle"><?php echo $firmas[0]['cargo_f']; ?></h5>
                          
                                
                                    <button  class='userinfo btn waves-effect waves-light btn btn-success' data-id="<?php echo $firmas[0]['firma_id']; ?>"><span class="fas fa-edit" aria-hidden="true" style="color:#ffffff"></span> editar </button>

                                    
                                    
                                
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="row" align="center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $firmas[2]['nombre']; ?></h4>
                                <h5 class="card-subtitle"><?php echo $firmas[2]['cargo_f']; ?></h5>
                              
                                <button  class='userinfo btn waves-effect waves-light btn btn-success' data-id="<?php echo $firmas[2]['firma_id']; ?>"><span class="fas fa-edit" aria-hidden="true" style="color:#ffffff"></span> editar </button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                        
                        

                        <!--modal detalles-->
                        <div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog" role="document">

       <!-- Modal content-->
       <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">...</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


        </div>

</div>
</div>
</div>

                        <!--/modal detalles-->

                       
           


 
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

<!--detalle firmas-->
<script>
    $(document).ready(function(){

       $('.userinfo').click(function(){

         var userid = $(this).data('id');
         console.log(userid);
   // AJAX request
   $.ajax({
    url: 'detalles',
    type: 'post',
    data: {userid: userid},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('.modal-body').html(response);

      // Display Modal
      $('#empModal').modal('show'); 
  }

});
});
   });
</script>

<!--detalle encabezado-->

<script>
    $(document).ready(function(){

       $('.encabezado').click(function(){

         var userid = $(this).data('id');
         console.log(userid);
   // AJAX request
   $.ajax({
    url: 'detalle_encabezado',
    type: 'post',
    data: {userid: userid},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('.modal-body').html(response);

      // Display Modal
      $('#empModal').modal('show'); 
  }

});
});
   });
</script>