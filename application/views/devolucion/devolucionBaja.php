
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
                                 <a href="<?php echo site_url('Devolucion/nuevo'); ?>" class="btn btn-info " title="Ir Atras" data-toggle="tooltip" align="left" ><i class="fa fas fa-reply" ></i> Atras</a>
                                  <br><br>
                                <h4 class="card-title">Devolucion de Activos</h4>
                            </div>                           
                        </div>                       
                                              
                      <?php echo form_open('Devolucion/bajaActivo'); ?>

                          
                        <div class="card">
                            <div class="card-body">
                                
                                                                        
                                <div class="table-responsive m-t-40">
                                    

                                        <div class="form-group">
                                            <label for="location1">Motivo :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="motivo" name="motivo" required>
                                                <option value="">Seleccione </option>
                                                <?php foreach ($motivos as $tp) : ?>
                                                    <option value="<?php echo $tp->motivo; ?>"><?php echo $tp->motivo; ?></option>
                                                <?php endforeach; ?>
                                                <option value="1">Otros </option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="otros">
                                            <label for="recipient-name" class="control-label">Otro:</label>
                                            <input type="text" class="form-control" id="otro" name="otro" >
                                        </div>
                                        <div class="form-group">
                                    <label>Observacion :<span class="text-danger"></span></label>
                                    <textarea class="form-control" rows="4"    id="obsv" name="obsv"      ></textarea>
                                </div>
                                <table id="auxiliar_tablesss" class="table table-bordered table-striped" style="font-size: 12px">
                                        <thead>
                                            <tr>
                                                
                                                <th>Codigo Asignacion</th>
                                                <th>Producto</th>
                                                <th>Ubicacion</th>
                                                <th>Imagen</th>
                                           
                                                                                                
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                          
                                            <?php foreach ($solicitud as $row) { 
                                                ?>
                                                <tr>
                                                    
                                                    <td>
                                                         <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo $row->detalle_id; ?>" name="codigoAsign[]" value="<?php echo $row->detalle_id;?>">
                                            <label class="custom-control-label" for="<?php echo $row->detalle_id; ?>"><?php echo $row->codigoAsign; ?></label>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row->auxiliar; ?></td>
                                                     <td><?php echo $row->oficina; ?></td>

                                                    <td>
                                                        <img src="<?php echo base_url(); ?><?php echo $row->url; ?>/<?php echo $row->imagen; ?>" alt="user" width="100px"/>
                                                                        
                                                    </td>
                                                   
                                                
                                                
                                                   
                                                </tr>
                                                <?php 
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" class="form-control" id="empleado" name="empleado" value="<?php echo $act->persona_id; ?>" >
                                        <input type="hidden" class="form-control" id="asignacion_id" name="asignacion_id" value="<?php echo $act->asignacion_id; ?>" >
                                <div class="modal-footer">                                            
                                           
                                            <a href="<?php echo site_url('Devolucion/nuevo'); ?>" class='btn btn-default" data-dismiss'>Cancelar </a>                                                        
                                            <button type="submit" class="btn btn-primary">Desvincular Seleccionados</button>
                                        </div>
                                        </form>                                        
                            </div>
                        </div>
                    </div>

               
            </div>
        </div>
    </div>
</div>
</div>


<!--modal detalles-->


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
        $('#otros').hide(); 
       
   });
</script>
<script>
    $(document).ready(function() {
        //$('#bt_add').click(function() {
            $('#bt_add').click(function() {
                agregar();
            //$('#responsive-modal').modal('hide');
        });     
        });
    var cont_n = 0;
    estado = 0;
    total = 0;
    
    subtotal = [];
    $("#guardar").hide();

    function agregar() {
        activo_id = $("#activo").val();
        persona_id = $("#empleado").val();
        activo = $("#activo option:selected").text();
        
        //cantidad = $("#cantidad").val();
        
        

        if (activo_id != "" && persona_id != ""  ) {
            total = total+1;
            var fila = '<tr class="selected" id="fila' + cont_n + '"><td><input type="hidden" name="activo_id[]" value="' + activo_id + '">' + activo + '</td><td><button type="button" cLass="btn btn-danger" onclick="eliminar(' + cont_n + ');"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></td></tr>';
            cont_n++;
            limpiar();
            evaluar();
            $('#detalles').append(fila);
        } else {
            alert("los campos estan vacios");
        }
    }

    function limpiar() {
        $("#activo").val(""); //id
        
        $("#cantidad").val("0.00");

    }

    function evaluar() {
        if (total > 0) {
            $("#guardar").show();
        } else {
            $("#guardar").hide();
        }
    }

    function eliminar(index) {
        total = total - 1;

        $("#fila" + index).remove();
        evaluar();
    }
</script>
<script>

    $('#motivo').change(function() {        
              var motivo = $('#motivo').val();
        
           

              if (motivo==1) {
                                  
                  $('#otros').show();

                  
              }else{
                $('#otros').hide();
              }

             

              
    // alert($(this).val());
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
</body>

</html>