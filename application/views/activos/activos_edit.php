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
                                <h4 class="card-title">Edicion </h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->                         
                      <?php echo form_open_multipart('Activos/updateActivo', array('method'=>'POST',  'onsubmit' => 'return check_validacion()')); ?>                      <input type="hidden" class="form-control" id="idActivo" name="idActivo" value="<?php echo $idActivo; ?>">                    
                                <div class="row">
                                 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            Grupo : <?php echo $datosA->grupo; ?>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4" id="auxiliares">
                                        <div class="form-group">
                                           Producto : <?php echo $datosA->auxiliar; ?>
                                        </div>                                                
                                    </div>
                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <!-- onkeypress="return check_keyLetras(event)" -->

                                <div class="form-group">
                                    <label>Descripcion :<span class="text-danger"> *</span></label>
                                    <textarea class="form-control" rows="2"    id="descripcion" name="descripcion"      required><?php echo $datosA->descripcion; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Accesorios :<span class="text-danger"> *</span></label>
                                    <textarea class="form-control" rows="2" id="accesorios" name="accesorios" required><?php echo $datosA->accesorios; ?></textarea >
                                </div>

                                  

                                <div class="row">

                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="validationCustom01">Fecha de Compra</label>
                                            <input type="date" class="form-control"  placeholder="Fecha de Compra" name="fecha" value="<?php echo $datosA->fecha_incorporacion; ?>">
                                            <div class="valid-feedback" >
                                                Looks good!
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Costo Bs.:</label>
                                            <input type="text" class="form-control" onkeypress="return check_keyMedidas(event)" value="<?php echo $datosA->costo; ?>" id="costo" name="costo" >
                                        </div>                                                
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="location1">Estado del bien :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="estado" name="estado" required>
                                            
                                                <?php foreach ($data_table_estado as $d) : ?>
                                                    <?php if ($d->estado_id!=$datosA->estado_id): ?>
                                                        <option value="<?php echo $d->estado_id; ?>"><?php echo $d->descripcion; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo $d->estado_id; ?>" selected><?php echo $d->descripcion; ?></option>
                                                    <?php endif ?>
                                                    
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    

                                </div>
                                

                                

                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?php echo base_url().'public/assets/images/activos/'.$datosA->imagen; ?>" height="200px">
                                         </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                    <div class="card">
                                        <label for="recipient-name" class="control-label">Foto</label>
                                        <label for="input-file-now">

                                            <i class="fas fa-exclamation" style="color:red"> </i>                                            
                                            Solo se admite archivos jpg y maximo 1 megabyte
                                        </label>

                                        <input type="file" id="input-file-now" class="dropify" name="foto_org" data-allowed-file-extensions='["jpg"]' data-max-file-size="1M" />
                                    </div>
                                    </div>
                                     </div>

                                </div>
                                 <div class="row">
                                    <div class="col-md-8">
                                        <label for="recipient-name" class="control-label">Forma de pago:</label>
                                    <input type="text" class="form-control" id="formaPago" name="formaPago" value="<?php echo $datosA->forma_pago; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="recipient-name" class="control-label">Nro. Factura:</label>
                                    <input type="text" class="form-control" id="nrofactura" name="nrofactura"  value="<?php echo $datosA->nrofactura; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Observaciones :</label>
                                    <textarea class="form-control" rows="2"    id="observaciones" name="observaciones" ><?php echo $datosA->observaciones; ?></textarea>
                                </div>
                                <div class="row">

                                   <?php 
                                   switch ($datosA->grupo_id) {
                case 1:
                        $data['campoGrupo']=$this->load->view('camposgrupo/edicion/ed');
                    break;
                case 2:
                        $data['campoGrupo']=$this->load->view('camposgrupo/edicion/me');
                    break;
                case 8:
                       $data['campoGrupo']=$this->load->view('camposgrupo/edicion/ve');
                    break;
                case 15:
                        $data['campoGrupo']=$this->load->view('camposgrupo/edicion/eqc');
                    break;
                case 35:
                        $data['campoGrupo']=$this->load->view('camposgrupo/edicion/ot');
                    break;
                case 42:
                       $data['campoGrupo']=$this->load->view('camposgrupo/edicion/eqo');
                    break;
            } 
                                    ?>

                                    
                                </div>
                                

                                <div class="modal-footer">
                                    <a href="<?php echo site_url('Activos/nuevo'); ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>  
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

                    <div class="modal fade bs-example-modal-lg" id="modal_insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Agregar Activos</h4>
                                </div>
                                <div class="modal-body">




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



<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->

            <footer class="footer">
            <div style="text-align: center;">
            <footer class="footer">
            <div style="text-align: center;">
    &copy; Desarrollado por <b> Cristian Javier Quispe Callizaya</b> 2023
</div>

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

<script type="text/javascript">

    $(document).ready(function() {
        var table = $('#datos_tabla').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "oLanguage": {

          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('Activos/activosList')?>",
          "type": "POST"
      },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": "_all", //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],      
    });

    });

</script>

<!--fin de tabla con ajax-->
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




<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->




<script src="<?php echo base_url(); ?>public/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>


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

            var grupoId = $('#grupo_id').val();

            if (grupoId!=0) {

              $('#camposgrupos').empty();

              $.ajax({
                url: 'camposGrupo',
                type: 'post',
                data: {grupoId: grupoId},
                dataType: "html",
                success: function(response){ 

                  $('#camposgrupos').html(response);
              }
          });
                //fin ajax
            }else{
                $('#camposgrupos').empty();
            }
    // alert($(this).val());
});
</script>

<!-- caracteres especiales -->
<script>

    function check_key(e) {
        tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta letras espacios acentos y numeros   
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<script>

    function check_keyLetras(e) {
        tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta letras espacios acentos y numeros   
    patron = /[A-Za-zá-ü\s,.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<script>

    function check_keyModelos(e) {
        tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta letras espacios acentos y numeros   
    patron = /[A-Z0-9a-zá-ü\s]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<script>

    function check_keyMedidas(e) {
        tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta letras espacios acentos y numeros   
    patron = /[0-9.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<!--detalle de activos -->
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

            var grupoId = $('#grupo_id').val();

            if (grupoId!=0) {

              $('#camposgrupos').empty();

              $.ajax({
                url: 'camposGrupo',
                type: 'post',
                data: {grupoId: grupoId},
                dataType: "html",
                success: function(response){ 

                  $('#camposgrupos').html(response);
              }
          });
                //fin ajax
            }else{
                $('#camposgrupos').empty();
            }
    // alert($(this).val());
});
</script>

<script type="text/javascript">


        var enviando = false; //Obligaremos a entrar el if en el primer submit

        function check_validacion() {
            if (!enviando) {
                enviando= true;
                $('#guardar').hide();
                $('#guardando').show();
                return true;
            } else {

            // //Si llega hasta aca significa que pulsaron 2 veces el boton submit
            Swal.fire(
              'Correcto!',
              'El formulario ya se esta enviando!',
              'success'
              )
            return false;
        }
    }
</script>
<script>
   $(document).ready(function() {
    $('#guardando').hide();
})
</script>



</body>

</html>