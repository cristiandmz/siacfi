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
                                <h4 class="card-title">Inventario de Activos</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->     
                        <?php echo form_open('activos/reporte_anio'); ?> 
                        <div class="row" >
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="location1">Gestion<span class="text-danger"> *</span></label>
                                <select class="custom-select form-control" id="gestion" name="gestion" required>
                                    <option value="">Seleccione gestion</option>
                                    <?php foreach ($gestion as $tp) : ?>
                                        <option value="<?php echo $tp->anio; ?>"><?php echo $tp->anio; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <p>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                            <button type="submit" class="btn btn-success">Generar Reporte</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal fade bs-example-modal-lg" id="modal_insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- ============================================================== --> 

