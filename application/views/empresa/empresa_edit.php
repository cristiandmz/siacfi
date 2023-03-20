
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
                                <h4 class="card-title">Datos Empresa</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       

                        <?php echo form_open('empresa/update', array('method'=>'POST', 'id'=>'insertar')); ?>

                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Nombre:</label>
                                            <input type="hidden" class="form-control" id="empresa_id" name="empresa_id" value="<?php echo $row->empresa_id; ?>">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row->nombre; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Direccion:</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row->direccion; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">NIT:</label>
                                            <input type="number" class="form-control" id="nit" name="nit" value="<?php echo $row->nit; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Ciudad:</label>
                                            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $row->ciudad; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Telefono:</label>
                                            <input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo $row->telefono; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom01">Incio de Actividades</label>
                                            <input type="date" class="form-control" id="validationCustom01" placeholder="Fecha de Nacimiento" value="<?php echo $row->fecha_creacion_emp; ?>" name="fecha_creacion_emp" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>

                                        
                                        <div class="modal-footer">                                            
                                            <a href="<?php echo site_url('empresa/nuevo'); ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>                                                          
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


