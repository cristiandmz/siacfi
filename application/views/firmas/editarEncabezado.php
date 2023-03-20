<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/plugins/dropify/dist/css/dropify.min.css">
<link href="<?php echo base_url(); ?>public/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                <div class="card wizard-content">
                    <div class="card-body">

                     

     <?php echo form_open('Firmas/update_encabezado', array('method'=>'POST', 'id'=>'insertar')); ?>

        <input type="hidden" class="form-control" id="encabezado_id" name="encabezado_id" value="<?php echo $encabezado_id; ?>">   
 
                             <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Editar Encabezado</h4>
                          
                                    <div class="form-group">
                                        <textarea class="textarea_editor form-control" name="texto_uno" rows="6" >
                                            <?php echo $datos->texto_uno ?>
                                        </textarea>
                                    </div>
                             
                        
                    </div>
                    
                </div>  
                 <div class="row">
                    <div class="col-8">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            
               <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>           
                    </div>  
    
    
</div>  
</form>         
                    </div> 
                    </div>           
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