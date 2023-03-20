<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/plugins/dropify/dist/css/dropify.min.css">
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
                                <h4 class="card-title">Registro de empleados</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->                         
                        <div class="row" >
                            <div class="col-md-12">                                        
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_insertar"><i class="mdi mdi-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Empresas</h4>                                        
                                <div class="table-responsive m-t-40">
                                    <table id="empresa_table" class="table table-bordered table-striped" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>nro</th>
                                                <th>Nombre</th>
                                        
                                                <th>Usuario</th>
                                                <th>CI</th>                                                
                                                <th>Gerencia</th>
                                                <th>Asignacion</th>                       
                                                <th>Cargo</th>                                              
                                             
                                                <th>Rol</th>                                       
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            <?php foreach ($data_table_personas as $row) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row->nombres." ".$row->paterno." ".$row->materno; ?></td>   
                                                    
                                                    <td><?php echo $row->usuario; ?></td>   
                                                    <td><?php echo $row->ci; ?></td>                                    
                                                    <td><?php echo $row->gerencia; ?></td>
                                                      <td><?php echo $row->codAsignGer; ?></td>
                                                    <td><?php echo $row->cargo; ?></td>   
                                                    
                                                    <td><?php echo $row->rol; ?></td> 
                                                                                          
                                                    <td>

                                                        <?php if (($row->validar)==1):?>

                                                        <a href="<?php echo site_url('Personas/edit'); ?>/<?php echo $row->persona_id; ?>"><button type="button" class="btn waves-effect waves-light  btn-sm btn-warning" title="Editar" data-toggle="tooltip"><span class="fas fa-edit" aria-hidden="true"></span></button></a>                                                          
                                                        <button  class=" btn btn-info waves-effect waves-light btn-sm"  data-toggle="tooltip" title="Cambiar Contraseña"  onclick="editar_password('<?php echo $row->persona_id; ?>');" > 
                                                        <span class="fas fa-key" aria-hidden="true" ></span>
                                                        </button>
                                                        
                                                        <a href="<?php echo site_url('Personas/delete'); ?>/<?php echo $row->persona_id; ?>" class="eliminarPersona btn btn-danger btn-sm" title="Eliminar" data-toggle="tooltip" ><i class="fa fa-trash"></i></a>


                                                        <?php endif ?>
                                                        
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

                    <div class="modal fade bs-example-modal-lg" id="modal_insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Agregar Empleado</h4>
                                </div>
                                <div class="modal-body">
                                    
                                        <?php echo form_open_multipart('personas/create', array('method'=>'POST',  'onsubmit' => 'return check_validacion()')); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Nombres:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="nombres" name="nombres" onkeypress="return check_keyLetras(event)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Apellido Paterno:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="paterno" name="paterno" onkeypress="return check_keyLetras(event)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Apellido Materno:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="materno" name="materno" onkeypress="return check_keyLetras(event)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Carnet de identidad:<span class="text-danger"> *</span> </label>
                                                    <input type="text" class="form-control" id="ci" name="ci" minlength="5"  maxlength="13" onkeypress="return check_keyNumeros(event)"required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Imagen: <code>solo se admite archivos png</code> </label>
                                                    <input type="file" class="form-control" id="imagen" name="imagen"  accept=",.png">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Direccion:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="direccion" name="direccion" onkeypress="return check_keyLetrasDos(event)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Celular:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="telefono" name="telefono" minlength="8"  maxlength="8" onkeypress="return check_keyNumeros(event)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Fecha de Nacimiento</label>
                                                    <input type="date" class="form-control" id="fecha_nacimiento" placeholder="" name="fecha_nacimiento" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Fecha de incorporacion<span class="text-danger"> *</span></label>
                                                    <input type="date" class="form-control" id="fecha_incorporacion" placeholder="" name="fecha_incorporacion" required>                                            
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="location1">Sucursal :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="sucursal_id" name="sucursal_id" required>
                                                        <option value="">Seleccione Sucursal</option>
                                                        <?php foreach ($getSucursal as $tp) : ?>
                                                            <option value="<?php echo $tp->sucursal_id; ?>"><?php echo $tp->sucursal; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>
                                           
                                        </div>


                                     
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="location1">Nivel de Jerarquía:<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="gerencia_id" name="gerencia_id" required>
                                                        <option value="">Seleccione una opcion</option>
                                                        <?php foreach ($getGerencias as $tp) : ?>
                                                            <option value="<?php echo $tp->gerencia_id; ?>"><?php echo $tp->gerencia; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="location1">Cargo :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="cargo_id" name="cargo_id" required>
                                                        <option value="">Seleccione Cargo</option>
                                                        <?php foreach ($data_table_cargo as $tp) : ?>
                                                            <option value="<?php echo $tp->cargo_id; ?>"><?php echo $tp->descripcion; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="location1">Perfil :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="rol" name="rol" required>
                                                        <option value="">Seleccione Perfil</option>
                                                        <?php foreach ($perfil as $tp) : ?>
                                                            <option value="<?php echo $tp->rol_id; ?>"><?php echo $tp->rol; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>


                                        </div>

                                      
                                        <div class="row">
                                             
                                               <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Contraseña:<span class="text-danger"> minimo 8 caracteres *</span></label>
                                                    <input type="password" class="form-control" id="password" minlength="8"  maxlength="32" onkeypress="return check_keyPassword(event)" name="password" autocomplete="off" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Repita la Contraseña:<span class="text-danger"> *</span></label>
                                                    <input type="password" class="form-control" id="password_dos"  minlength="8"  maxlength="32" onkeypress="return check_keyPassword(event)" name="password_dos" autocomplete="off" required="">
                                                </div>
                                                <span><code id="msj_val_password_usuario"></code></span>
                                            </div>
                                        </div>      
                                        <div class="modal-footer">

                                            <div id="guardando">
                                        <button class="btn btn-primary" type="button" disabled="">
                                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                          Guardando...
                                        </button>
                                    </div>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
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


<!-- modal cambio password -->
<div class="modal fade" id="modal_cambio_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Cambio de contrase&ntilde;a</h4>
            </div>

            <span class="m-list-search__result-item-text">


            </span>

            <div class="modal-body">

                <!-- ?php echo form_open('Facturacion/update_password_usuario', array('method'=>'POST', 'id'=>'insertar')); ?> -->

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="usuario_id_cambio_password" name="usuario_id_cambio_password" autocomplete="off" required="" >
                            <label for="recipient-name" class="control-label">Contrase&ntilde;a nueva:</label>
                            <input type="password" class="form-control" id="password_nuevo_usuarios" minlength="8"  maxlength="32" onkeypress="return check_keyPassword(event)"  name="password_nuevo_usuarios" autocomplete="off" required="">
                            <span><code id="msj_validacion_password"></code></span>
                        </div>
                    </div>

                  <div class="col-md-12">
                        <div class="form-group">
                           
                            <label for="recipient-name" class="control-label">Repita la Contrase&ntilde;a:</label>
                            <input type="password" class="form-control" id="password_nuevo_usuarios_dos" minlength="8"  maxlength="32" onkeypress="return check_keyPassword(event)"  name="password_nuevo_usuarios_dos" autocomplete="off" required="">
                            <span><code id="msj_validacion_password_dos"></code></span>
                        </div>
                        <span><code id="msj_val_password_usuario_cambio"></code></span>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="actualizar_password_usuario('');" >Guardar</button>
               
            </form>
        </div>

    </div>
</div>
</div>
<!-- fin de modal cambio de password -->
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

    



    <!-- Bootstrap tether Core JavaScript -->
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
    <script src="<?php echo base_url(); ?>public/assets/plugins/datatables/datatables.min.js"></script>
    <!-- ============================================================== -->
    <!-- Plugins for this page -->
    <!-- ============================================================== -->
    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/moment/moment.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/plugins/moment/moment.js"></script>
     
    <!-- Datatable -->
    
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
   
    <!-- end - This is for export functionality only -->

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
    $(function() {
        

          $('#empresa_table').DataTable(
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

        <script>
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({       
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->

    <script src="<?php echo base_url(); ?>public/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>



<!-- check password -->
<script>

    function check_keyPassword(e) {
        tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta letras espacios acentos    
    patron = /[A-Za-z0-9-_@.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
</script>

<script>

    function validar_password_usuario(){

        var pas_user = $('#password').val();
        var pas_user_dos = $('#password_dos').val();
        
    //alert(pasct);
    console.log(pas_user,pas_user_dos);

    if (pas_user!="" && pas_user_dos!="") {

        if (pas_user==pas_user_dos) {

            console.log('iguales');

            document.getElementById("msj_val_password_usuario").innerHTML = '';
            return true;
        }else{

            console.log('distintos');
            document.getElementById("msj_val_password_usuario").innerHTML = 'las contraseñas no coinciden';
            return false;
        }

    }else{

        document.getElementById("msj_val_password_usuario").innerHTML = 'debe introducir una contraseña';
        return false;
    } 
}
</script>
<script type="text/javascript">
    var enviando = false; //Obligaremos a entrar el if en el primer submit
    
    function check_validacion() {
        if ( validar_password_usuario() && !enviando ) {
            enviando= true;
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

<!-- caracteres especiales -->
<script>

    function check_keyNumeros(e) {
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
    patron = /[A-Za-zá-ü\s]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
</script>
<script>

    function check_keyLetrasDos(e) {
        tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta letras espacios acentos y numeros   
    patron = /[A-Z0-9a-zá-ü\s-#,]/;
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
    patron = /[0-9,]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
</script>
<!-- cambio de password -->
 <script>

        function editar_password(usuario_id){
          console.log(usuario_id);
          $('#usuario_id_cambio_password').val(usuario_id); 
          $('#modal_cambio_password').modal('show');             
      }
  </script>

  <script>
    function actualizar_password_usuario(){
        // alert('hola');
              //var asign_id = $(this).data('id');
              var password_nuevo_usuarios = $('#password_nuevo_usuarios').val();
              var usuario_id_cambio_password = $('#usuario_id_cambio_password').val();
              // var usuario_id_cambio_password_dos = $('#usuario_id_cambio_password_dos').val();

              
              //var asign_id = document.getElementById('infor');
              if (validar_campo_password()) {
                $.ajax({
                    url: '<?php echo base_url(); ?>Personas/update_password_usuario',
                    type: 'post',
                    data: {password_nuevo_usuarios: password_nuevo_usuarios,usuario_id_cambio_password:usuario_id_cambio_password},
                    dataType: "json",
                    success: function(data){ 

                       Swal.fire({
                          type: 'success',
                          title: 'Buen trabajo!',
                          text: 'Se registro correctamente'
                      });
                       $('#password_nuevo_usuarios').val('');
                       $('#password_nuevo_usuarios_dos').val('');
                       
                       $("#modal_cambio_password").modal("hide");

                   }
               });
               //fin ajax
               // console.log('entro por si');
           }else{
            // console.log('entro por no');
        }

        // console.log(password_act,fecha_fin);


    }
</script>

<script>

    function check_keyPassword(e) {
        tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta letras espacios acentos    
    patron = /[A-Za-z0-9-_@.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
</script>


<script>
  function validar_campo_password(){

   var password = $('#password_nuevo_usuarios').val(); 
   var password_dos = $('#password_nuevo_usuarios_dos').val(); 
   var msj_form='Debe introducir este campo';
   var msj_form_exito='';

   if (password=="" || password_dos=="") {

    if (password=="") {
         document.getElementById("msj_validacion_password").innerHTML = msj_form;    
    }else{    
    document.getElementById("msj_validacion_password").innerHTML = msj_form_exito;    
    }

    if (password_dos=="") {
         document.getElementById("msj_validacion_password_dos").innerHTML = msj_form;    
    }
    else{    
    document.getElementById("msj_validacion_password_dos").innerHTML = msj_form_exito;    
    }
    return false;

   
}
else{  


    document.getElementById("msj_validacion_password").innerHTML = msj_form_exito;
    document.getElementById("msj_validacion_password_dos").innerHTML = msj_form_exito;
      if (password==password_dos) {

            console.log('iguales');

            document.getElementById("msj_val_password_usuario_cambio").innerHTML = '';
            return true;
        }else{

            console.log('distintos');
            document.getElementById("msj_val_password_usuario_cambio").innerHTML = 'las contraseñas no coinciden';
            return false;
        }
    // return true;
}

}

</script>
</body>

</html>

