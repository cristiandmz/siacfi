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
                                <h4 class="card-title">Reporte de Activos</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->                         
                        <div class="row button-group" >





                            <div class="col-md-4">
                                <a href="<?php echo site_url('Reportes/grupo'); ?>" >
                                 <button type="button" class="btn btn-success " ><i class="fas fa-file-pdf"></i> Listado de activos</button></a> 

                             </div>
                           
                            
                             <!--  <div class="col-md-4">
                                <a href="?php echo site_url('Reportes/asignados'); ?>" target="_blank">
                                 <button type="button" class="btn btn-danger " ><i class="fas fa-file-pdf"></i> Reporte de asignaciones</button></a> 

                             </div> -->
                             <div class="col-md-4">
                                <a href="<?php echo site_url('Activos/ubicacion'); ?>" >
                                 <button type="button" class="btn btn-info" ><i class=" fas fa-qrcode"></i> Generar Etiquetas QR</button></a> 

                             </div>
                               <div class="col-md-4">
                                <a href="<?php echo site_url('Firmas/firmas'); ?>" target="_blank">
                                 <button type="button" class="btn btn-warning" ><i class="fas fa-edit"></i> Editar Encabezado y pie de firmas</button></a> 

                             </div>
                         </div>

                         <div class="row button-group" >

                           
                            <div class="col-md-4">
                                <a href="<?php echo site_url('Regen/actualizar'); ?>" id="guardandoqr" onclick="generar()">
                                 <button type="button" class="btn btn-success " ><i class="fas fa-circle-notch"></i> Actualizar codigos QR</button></a>

                                 <div id="guardando">
                                        <button class="btn btn-warning" type="button" disabled="">
                                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                          Generando...
                                        </button>
                                    </div> 

                             </div>



                         
                             
                             

                         </div>

                  

                        









                     <div class="card">
                        <div class="card-body">

                            <div class="table-responsive m-t-40">

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

