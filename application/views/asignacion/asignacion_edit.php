<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/barcode/jquery-barcode.js"></script>

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
                                <h4 class="card-title">Editar</h4>                                
                            </div>                                                      
                        </div>      


                        <?php echo form_open('Asignacion/update'); ?>    

                                        <input type="hidden" class="form-control" id="empleado_id" name="empleado_id" value="<?php echo $asignacion->persona_id; ?>" >
                                        
                                        <div class="form-group">

                                            <label for="location1">Empleado :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="empleado" name="empleado" disabled>
                                                <option value="<?php echo $asignacion->persona_id; ?>" selected=""><?php echo $asignacion->nombre; ?></option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="location1">Activo :<span class="text-danger"> *</span></label>
                                            <select class="mi-selector custom-select form-control" id="activo" name="activo">
                                                <option value="" selected="">Seleccione un activo</option>
                                                <?php foreach ($data_table_activo as $tp) : ?>
                                                    
                                                    <option value="<?php echo $tp->activo_id; ?>"><?php echo $tp->codigo.' -- '.$tp->descripcion; ?></option>
                                                    
                                                <?php endforeach; ?>
                                            </select>
                                        </div>                                         

                                        <div class="row">
                                        <div class="col-md-12" align="right">     
                                            <button type="button" class="btn waves-effect waves-light btn-sm btn-info" id="bt_add" >Agregar</button>
                                        </div>
                                    </div>

                                    <p> </p>


                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="detalles" class="table " style="font-size: 12px;">
                                                    <thead class="bg-success text-white">
                                                        <tr>
                                                            <th>Activos</th>   
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody >
                                                        <?php $c=0; foreach ($detalle as $row ) { ?>
                                                            <tr class="selected" id="fila<?php echo $c;  ?>">
                                                                <td>
                                                                    <input type="hidden" name="activo_id[]" value="<?php echo $row->activo_id;?>">
                                                                    <?php echo $row->codigo.' -- '.$row->descripcion ?>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $c; ?>);"><span class="fas fa-trash-alt" aria-hidden="true"></span></button>
                                                                </td>
                                                            </tr>
                                                            <?php $c=$c+1; ?>

                                                        <?php  } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                        
                                        <input type="hidden" class="form-control" id="asignacion_id" name="asignacion_id" value="<?php echo $asignacion->asignacion_id; ?>" >
                                        <div class="modal-footer">                                            
                                            <a href="<?php echo site_url('asignacion/nuevo'); ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>                                                          
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>                    
                    </div>
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
    $(document).ready(function() {
        //$('#bt_add').click(function() {
            $('#bt_add').click(function() {
                agregar();
            //$('#responsive-modal').modal('hide');
        });     
        });
    var cont_n = <?php echo $c; ?>;
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
