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
                                <h4 class="card-title">Baja de activo</h4>                                
                            </div> 
                            <div class="col-md-6 col-8 align-self-center" align="right">
                                <div id="barcode" align="right"></div>
                                                            
                            </div>                          
                        </div>                       

                        <?php echo form_open('activos/delete'); ?>                                                                               
                                        <input type="hidden" class="form-control" id="activo_id" name="activo_id" value="<?php echo $row->activo_id; ?>" >

                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Descripcion:</label>
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $row->descripcion; ?>" required="" onlyread>
                                        </div>                                       
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Motivo:</label>
                                            <input type="text" class="form-control" id="motivo" value="" name="motivo" required="">
                                        </div>   

                                        <div class="modal-footer">                                            
                                            <a href="<?php echo site_url('activos/nuevo'); ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>                                                          
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

<script>
    $("#barcode").barcode(
"<?php echo $row->codigo; ?>",
//"ASDAD1234567890128", // Value barcode (dependent on the type of barcode)
"code39" // type (string)
);
</script>
