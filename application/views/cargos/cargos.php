
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
                                <h4 class="card-title">Registro de cargos</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->                         
                        <div class="row" >
                            <div class="col-md-12">                                        
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_insertar"><i class="mdi mdi-plus"></i> Agregar</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Cargos Registrados</h4>                                         -->
                                <div class="table-responsive m-t-40">
                                    <table id="auxiliar_table" class="table table-bordered table-striped" style="font-size: 14px">
                                        <thead>
                                            <tr>
                                                <th>nro</th>
                                                <th>descripcion</th>                                                  
                                                   
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            <?php foreach ($data_table_cargo as $row) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row->descripcion; ?></td>                         
                                                                                                                                                             
                                                    <td>
                                                        

                                                        <button  class='userinfo btn waves-effect waves-light btn btn-warning btn-sm' data-id="<?php echo $row->cargo_id ?>" title="Editar" data-toggle="tooltip"><span class="fas fa-edit" aria-hidden="true" style="color:#ffffff"></span></button>                            
                                                        <a href="<?php echo site_url('Cargos/delete'); ?>/<?php echo $row->cargo_id; ?>" class="eliminarPersona btn btn-danger btn-sm" title="Eliminar" data-toggle="tooltip" ><i class="fa fa-trash"></i></a>
                                                        
                                                        
                                                       


                                                      
                                                        
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










                    
                    <div class="modal fade" id="modal_insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Registro de Cargos</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<form action="<?php echo base_url();?>zona_urbana/insertar" method="POST">-->
                                        <?php echo form_open('Cargos/create'); ?>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Cargo :</label>
                                            <input type="text" class="form-control" id="cargo" name="cargo" onkeypress="return check_keyLetras(event)" required="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>

                                            
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
</div>
<!-- ============================================================== --> 


<!--modal detalles-->

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
    url: 'editar',
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

    function check_keyLetras(e) {
        tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta letras espacios acentos y numeros   
    patron = /[A-Za-zá-ü\s]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
</script>
</body>

</html>