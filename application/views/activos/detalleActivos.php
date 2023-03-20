<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/plugins/dropify/dist/css/dropify.min.css">
<link href="<?php echo base_url(); ?>public/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
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
                                <a href="<?php echo site_url('Activos/nuevo'); ?>" class="btn btn-info " title="Ir Atras" data-toggle="tooltip" ><i class="fa fas fa-reply"></i> Atras</a>
                                  <br><br>
                                <h4 class="card-title">Detalle del Activo</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->                         
                        <div class="row justify-content-center" >
                            <div class="col-md-6">
                                <?php if (isset($getDatosActivos->auxiliar)): ?>
                                      <b>Producto :</b> <?php echo $getDatosActivos->auxiliar; ?><p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->grupo)): ?>
                                      <b>Clasificacion :</b> <?php echo $getDatosActivos->grupo; ?><p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->forma_pago)): ?>
                                      <b>Forma y medio de Pago: </b> <?php echo $getDatosActivos->forma_pago; ?><p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->nrofactura)): ?>
                                      <b>Nro de Recibo/Factura o Invoice: </b> <?php echo $getDatosActivos->nrofactura; ?><p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->fecha_incorporacion)): ?>
                                      <b>Fecha de compra: </b> <?php echo $getDatosActivos->fecha_incorporacion; ?><p></p>
                                <?php endif ?>

                            <!--     ?php if (isset($getDatosActivos->cantidad)): ?>
                                      Cantidad: ?php echo $getDatosActivos->cantidad; ?> <p></p>
                                ?php endif ?> -->

                                <?php if (isset($getDatosActivos->descripcion)): ?>
                                       <b>Descripcion:</b> <?php echo $getDatosActivos->descripcion; ?> <p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->accesorios)): ?>
                                       <b>Accesorios:</b> <?php echo $getDatosActivos->accesorios; ?> <p></p>
                                <?php endif ?>
                                
                                
                                
                            </div>
                                   <div class="col-md-6">
                             <?php if (isset($getDatosActivos->sucursal)): ?>
                                      <b>Sucursal :</b> <?php echo $getDatosActivos->sucursal; ?><p></p>
                                <?php endif ?>
                                 <b>Observaciones:</b>
                                 <?php if (isset($getDatosActivos->observaciones)): ?>
                                       <?php echo $getDatosActivos->observaciones; ?> <p></p>
                                <?php endif ?>
                                 <?php if (isset($getDatosActivos->costo)): ?>
                                      <b>Costo:</b> <?php echo $getDatosActivos->costo; ?> <p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->marca)): ?>
                                      <b>Marca :</b> <?php echo $getDatosActivos->marca; ?><p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->modelo)): ?>
                                      <b>Modelo:</b> <?php echo $getDatosActivos->modelo; ?> <p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->serie)): ?>
                                      <b>N° de Serie :</b> <?php echo $getDatosActivos->serie; ?> <p></p>
                                <?php endif ?>
                              

                                <?php if (isset($getDatosActivos->color)): ?>
                                      <b>Color:</b> <?php echo $getDatosActivos->color; ?> <p></p>
                                <?php endif ?>

                                <?php if (isset($getDatosActivos->ancho)): ?>
                                      <b>Ancho:</b> <?php echo $getDatosActivos->ancho; ?> <p></p>
                                <?php endif ?>
                                 <?php if (isset($getDatosActivos->largo)): ?>
                                      <b>Largo:</b> <?php echo $getDatosActivos->largo; ?> <p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->anio)): ?>
                                      <b>Año:</b> <?php echo $getDatosActivos->anio; ?> <p></p>
                                <?php endif ?>
                                <?php if (isset($getDatosActivos->nromotor)): ?>
                                      <b>Nro motor:</b> <?php echo $getDatosActivos->nromotor; ?> <p></p>
                                <?php endif ?>
                                 <?php if (isset($getDatosActivos->nrooficina)): ?>
                                      <b>Nro oficina:</b> <?php echo $getDatosActivos->nrooficina; ?> <p></p>
                                <?php endif ?>

                                <?php if (isset($getDatosActivos->dimension)): ?>
                                      <b>Dimension:</b> <?php echo $getDatosActivos->dimension; ?> <p></p>
                                <?php endif ?>
                                 <?php if (isset($getDatosActivos->nrocontrato)): ?>
                                      <b>Nro de contrato:</b> <?php echo $getDatosActivos->nrocontrato; ?> <p></p>
                                <?php endif ?>
                               
                            </div>
                            
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Activos</h4>                                        
                                <div class="table-responsive m-t-40">
                                    <table id="" class="table table-bordered table-striped" style="font-size: 13px">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>                                                
                                                <th>Codigo Asginacion</th>
                                                <th>Ubicacion</th>
                                                <th>Estado de Asignacion</th> 
                                                <th>Observacion</th> 
                                                <th>Cambiar ubicacion</th>
                                                                                                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            <?php foreach ($getActivos as $row) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>                        
                                                    <td ><?php echo $row->codigoAsign; ?></td> 

                                                    <td ><?php echo $row->oficina; ?></td> 
                                                         <td >
                                                            <?php if ($row->asignado==1): ?>
                                                                no asignado     
                                                            <?php else: ?> 
                                                                asignado

                                                            <?php endif ?>
                                                            
                                                                
                                                            </td>
                                                            <td ><?php echo $row->observaciones; ?></td>            
                                                            <td>
                                                                 

                                                           <button  class=' btn waves-effect waves-light btn-normal btn-warning btn-sm'  id="infor"  onclick="editar(<?php echo $row->codigoAsign_id ?>,<?php echo $activoId ?>);"><span class="fas fa-edit" aria-hidden="true" style="color:#ffffff"></span>
                                                                
                                                       </button>        

                                                        
                                                 
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

          <!--modal edicion-->

<div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog" role="document">

       <!-- Modal content-->
       <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edicion</h4>
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


    <script type="text/javascript">
    $('.eliminarPersona').on("click", function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal({
        title: 'Está seguro?',
        text: "No podrá recuperar la información una vez sea eliminado!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor:'#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: "Cancelar!",
        confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(url);
                swal("Eliminado!", "Su información ha sido eliminada!", "success");
            }else{
                swal("Cancelado", "Su información está a salvo!", "error");
            }
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
    <script src="<?php echo base_url(); ?>public/assets/plugins/sweetalert/sweetalert.min.js"></script>
     <script src="<?php echo base_url(); ?>public/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>


<script>
   
function editar(idsubactivo,id_activo) {

   
         console.log(id_activo);
   // AJAX request
   $.ajax({
    url: '<?php echo base_url(); ?>Activos/editarSubactivo',
    type: 'post',
    data: {idsubactivo: idsubactivo,id_activo:id_activo},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('.modal-tabla').html(response);

      // Display Modal
      $('#empModal').modal('show'); 
  }

});
  
}

   
</script>

</body>

</html>