
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
                        <p></p>                       

                        <?php echo form_open('unidad/update'); ?>
                                         <div class="form-group">
                                            <label for="location1">Unidad :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="grupo_id" name="grupo_id">
                                                <option value="<?php echo $unidad->unidad_id; ?>" selected=""><?php echo $unidad->nombre_unidad; ?></option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Oficina:</label>
                                            <input type="hidden" class="form-control" id="auxiliar_id" name="auxiliar_id" value="<?php echo $row->unidad_id; ?>">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row->nombre_unidad; ?>">
                                        </div>                                       
                                        <div class="modal-footer">                                            
                                            <a href="<?php echo site_url('Unidad/nuevo'); ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>                                                          
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


