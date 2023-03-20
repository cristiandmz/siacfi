
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
                                <h4 class="card-title">Asignacion de Activos</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 --> 
                        <?php echo form_open('Asignacion/create', array('method'=>'POST',  'onsubmit' => 'return check_validacion()')); ?>
                        <div class="row">
                            <div class="col-md-6">                                        
                                 <div class="form-group">
                                            <label for="location1">Empleado :<span class="text-danger"> *</span></label>
                                            <select class="mi-selector-insertar" style="width: 100%;" id="empleado" name="empleado" required>
                                                <option value="">Seleccione Persona</option>
                                                <?php foreach ($data_table_persona as $tp) : ?>
                                                    <option value="<?php echo $tp->persona_id; ?>"><?php echo $tp->nombres." ".$tp->paterno." ".$tp->materno; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-4">                                        
                              <div class="form-group">
                                            <label for="location1">Categoria :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="grupo_id" name="grupo_id">
                                                <option value="0">Seleccione una categoria</option>
                                                <?php foreach ($data_table_grupo as $tp) : ?>
                                                    <option value="<?php echo $tp->grupo_id; ?>"><?php echo $tp->nombre; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                            </div>
                                
                                    <div class="col-md-4" id="auxiliares">
                                        <div class="form-group">
                                            <label for="location1">Bien :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="auxiliar_id" name="auxiliar_id">
                                                <option value="">Seleccione un bien</option>
                                             
                                            </select>
                                        </div>                                                
                                    </div>
                             
                        </div>
                        <div class="row" id="listactivos">
                            
                        </div>

                         <div class="row">
                                        
                                        <div class="col-md-9">
                                            <div class="table-responsive">
                                                <table id="detalles" class="table " style="font-size: 12px;">
                                                    <thead class="bg-success text-white">
                                                        <tr>
                                                            <th>Activos</th>   
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody >

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="modal-footer">
                                        <a href="<?php echo site_url('Asignacion/nuevo'); ?>"><button type="button" class="btn btn-danger">Cancelar</button></a> 
                                        <div id="guardando">
                                        <button class="btn btn-primary" type="button" disabled="">
                                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                          Guardando...
                                        </button>
                                    </div>
                                        <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                                    </div>

                                </form>

                       
                    </div>

                  
            </div>
        </div>
    </div>
</div>
</div>


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
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>-->
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
    // $(document).ready(function() {
        
    //         $('#bt_add').click(function() {
    //             agregar();
            
    //     });     
    //     });



    var cont_n = 0;
    estado = 0;
    total = 0;
    
    subtotal = [];
    

    function agregar() {
        activo_id = $("#activo").val();
        persona_id = $("#empleado").val();
        activo = $("#activo option:selected").text();
        
        //cantidad = $("#cantidad").val();
        console.log('id activo'+activo_id);


        

        if (activo_id != "" && persona_id != ""  ) {
            total = total+1;
            var fila = '<tr class="selected" id="fila' + cont_n + '"><td><input type="hidden" name="activo_id[]" value="' + activo_id + '">' + activo + '</td><td><button type="button" cLass="btn btn-danger" onclick="eliminar(' + cont_n + ');"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></td></tr>';
            cont_n++;
            limpiar();
            evaluar();
            $('#detalles').append(fila);
        } else {

            Swal.fire(
              'Error!',
              'Los campos estan vacios!',
              'error'
            )
            // alert("los campos estan vacios");
        }
    }

    function limpiar() {
        $("#activo").val(""); //id
        
        $("#cantidad").val("0.00");

    }

    function evaluar() {
        if (total > 0) {
            // $("#guardar").show();
        } else {
            // $("#guardar").hide();
        }
    }

    function eliminar(index) {
        total = total - 1;

        $("#fila" + index).remove();
        evaluar();
    }
</script>

<script type="text/javascript">
    var enviando = false; //Obligaremos a entrar el if en el primer submit
    
    function check_validacion() {
        if ( total > 0) {
            $('#guardar').hide();
            $('#guardando').show();
            return true;
        } else {
          
            return false;
        }
        }
    </script>

     <script>
         $(document).ready(function() {
            $('#guardando').hide();
         })
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
 <script src="<?php echo base_url(); ?>public/assets/plugins/sweetalert/sweetalert.min.js"></script>
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
 <!-- <script src="<?php echo base_url(); ?>public/assets/plugins/switchery/dist/switchery.min.js"></script> -->
 <script src="<?php echo base_url(); ?>public/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
 
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>-->
 <script>
$(document).ready(function() {
    $('.mi-selector').select2();
});
     </script>
     <script>
      $(document).ready(function() {
        $('.mi-selector-insertar').select2();
    });  
         </script>


<!-- script ajax -->
<script>

    $('#grupo_id').change(function() {



    
        
              var grupoId = $('#grupo_id').val();
        
           

              if (grupoId!=0) {
                                  
                  $('#auxiliares').empty();

                  $.ajax({
                    url: 'apiAuxiliares',
                    type: 'post',
                    data: {grupoId: grupoId},
                    dataType: "html",
                    success: function(response){ 
                     
                      $('#auxiliares').html(response);
                  }
                });
                //fin ajax
              }else{
                $('#auxiliares').empty();
              }

            
    // alert($(this).val());
});
</script>
</body>

</html>