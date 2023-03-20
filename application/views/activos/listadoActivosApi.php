<table id="auxiliar_table" class="table table-bordered table-striped" style="font-size: 13px">
                                        <thead>
                                            <tr>
                                               <th>Codigo</th> 
                                                <th>Fecha</th> 
                                                <th>Producto</th>
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>Estado</th>                                               
                                                
                                                <th style="width: 150px;">Imagen</th>
                                               
                                                <th>Detalle</th>
                                                <th>Acciones</th>                                                                              
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php foreach ($data_table_activos as $row) { ?>
                                                <tr>
                                                                   
                                                    <td ><?php echo $row->codigo; ?></td>
                                                    <td><?php echo $row->fecha_incorporacion; ?></td>  
                                                    <td><?php echo $row->auxiliar; ?></td>                                                     
                                                    <td><?php echo $row->descripcion; ?></td> 
                                                    <td><?php echo $row->cantidad; ?></td> 
                                                     
                                                    <td><?php echo $row->est; ?></td>
                                                    <td>
                                                       <div class="row el-element-overlay" >                                                             
                                                            <div class="col-lg-12 col-md-12" >
                                                                <div class="el-card-item">
                                                                    <div class="el-card-avatar el-overlay-1"> 
                                                                        <img src="<?php echo base_url(); ?><?php echo $row->url; ?>/<?php echo $row->imagen; ?>" alt="user" />
                                                                        <div class="el-overlay">
                                                                            <ul class="el-info">
                                                                                <li><a class="btn default btn-outline image-popup-vertical-fit" href="<?php echo base_url(); ?><?php echo $row->url; ?>/<?php echo $row->imagen; ?>"><i class="icon-magnifier"></i></a></li>              
                                                                            </ul>
                                                                        </div>
                                                                    </div>                                                                          
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </td> 
                                                                                                     
                                                    <td>  
                                                   

                                                          <a href="<?php echo site_url('Activos/detalleActivos'); ?>/<?php echo $row->activo_id; ?>" class="btn btn-info btn-sm" title="Activos" data-toggle="tooltip" > <i class="fas fa-info-circle"></i></a>

                                                   </td> 
                                                   <td>

                                                    <a href="<?php echo site_url('Activos/editar'); ?>/<?php echo $row->activo_id; ?>" class="btn btn-warning btn-sm" title="Editar" data-toggle="tooltip" > <i class="far fa-edit"></i></a>

                                                   <a href="<?php echo site_url('Reportes/alta'); ?>/<?php echo $row->activo_id  ?>" class="btn btn-success btn-sm" title="Reporte" data-toggle="tooltip"  target="_blank"><i class="fas fa-file-pdf"></i></a>

                                            

                                                     </td> 
                                                   <td>

                                                    <?php if (($row->estado_act)==1):?> 

                
                                                        <a href="<?php echo site_url('Activos/delete'); ?>/<?php echo $row->activo_id; ?>" class="eliminarPersona btn btn-danger btn-sm" title="Eliminar" data-toggle="tooltip" ><i class="fa fa-trash"></i></a>
                                                    <?php endif ?> 


                                                </td>
                                            </tr>
                                            <?php 
                                        } ?>
                                    </tbody>
                                </table>
                                <script type="text/javascript">
    $(".eliminarPersona").on("click", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        Swal({
        title: "Está seguro?",
        text: "No podrá recuperar la información una vez sea eliminado!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor:"#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "Cancelar!",
        confirmButtonText: "Si, Eliminar!"
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