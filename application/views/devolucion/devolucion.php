
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
            <div class="col-12">
                <div class="card wizard-content">
                    <div class="card-body">
                        <div class="row page-titles">
                            <div class="col-md-6 col-8 align-self-center">
                                
                                <h4 class="card-title">Devolucion de Activos</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->                         
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Activos</h4>                                        
                                <div class="table-responsive m-t-40">
                                    <table id="auxiliar_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Fecha asignacion</th>                                                 
                                                <th>Empleado</th>                                                
                                                <th>Detalle</th>                                  
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            <?php foreach ($data_table_asign as $row) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row->fecha_asign; ?></td> 
                                                    <td><?php echo $row->nombre; ?></td>  
                                                    <td>
                                                        <button  class='userinfo btn waves-effect waves-light btn btn-info' data-id="<?php echo $row->asignacion_id ?>">Detalle</button>
                                                    </td>   
                                                    <td>    
                                                               <a href="<?php echo site_url('Devolucion/detalleAsignacion'); ?>/<?php echo $row->asignacion_id; ?>" class=' btn waves-effect waves-light btn btn-danger'>Devolucion <span class="fas fa-arrow-alt-circle-down" aria-hidden="true"></span></a>                     
                                                    </td>
                                                </tr>
                                                <?php 
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>                                        
                            </div>
                        </div>
                    </div>

                    <div class="modal fade " id="modal_insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Desvinculacion de Activo</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="insertar">
                                        

                                    </div>                                        
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== --> 

<!--modal detalles-->

<div class="modal fade bs-example-modal-lg" id="empModal" role="dialog">
    <div class="modal-dialog modal-xl" role="document">

       <!-- Modal content-->
       <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Material solicitado</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="modal-tabla">
            </div>

        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal" data-backdrop="false">Cerrar</button>
     </div>
 </div>
</div>
</div>
<!---->
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


<script>
    $(document).ready(function(){

       $('.userinfo').click(function(){

         var asign_id = $(this).data('id');
         console.log(asign_id);
   // AJAX request
   $.ajax({
    url: 'vista_detalles',
    type: 'post',
    data: {asign_id: asign_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('.modal-tabla').html(response);

      // Display Modal
      $('#empModal').modal('show'); 
  }

});
});
   });
</script>


<script>
    $(document).ready(function(){

       $('.insert').click(function(){

         var asign_id = $(this).data('id');
         console.log(asign_id);
   // AJAX request
   $.ajax({
    url: 'vista_insertar',
    type: 'post',
    data: {asign_id: asign_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('.insertar').html(response);

      // Display Modal
      $('#modal_insertar').modal('show'); 
  }

});
});
   });
</script>


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
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>

<!-- This is data table -->
<script src="<?php echo base_url(); ?>public/assets/plugins/datatables/datatables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<script src="<?php echo base_url(); ?>public/assets/plugins/dropify/dist/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Arrastre un archivo o haga click',
                replace: 'Arrastre un archivo para reemplazar',
                remove: 'eliminar',
                error: 'Lo sentimos, el archivo es demasiado grande.'
            }
        });
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>



<script>
    $(function() {
        $('#auxiliar_table').DataTable(
        {     
            "oLanguage": {
                "sUrl": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });

        $('#grupo_table').DataTable(
        {     
            "oLanguage": {
                "sUrl": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });



        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
</script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->


<script src="<?php echo base_url(); ?>public/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

</body>

</html>
