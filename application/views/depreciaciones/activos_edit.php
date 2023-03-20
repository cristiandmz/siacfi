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
                            <div class="col-md-6 col-8 align-self-center" align="right">
                                <div id="barcode" align="right"></div>
                                <button type="button" class="btn btn-success"><?php echo $row->codigo; ?></button>                             
                            </div>                          
                        </div>                       

                        <?php echo form_open('activos/update'); ?>                                       
                                        <div class="form-group">
                                            <label for="location1">Categoria :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="grupo_id" name="grupo_id">
                                               <option value="<?php echo $row->grupo_id; ?>" selected=""><?php echo $row->grupo; ?></option>
                                                <?php foreach ($data_table_grupo as $tp) : ?>
                                                     <?php if (($row->grupo_id) != $tp->grupo_id): ?>
                                                    <option value="<?php echo $tp->grupo_id; ?>"><?php echo $tp->nombre; ?></option>
                                                    <?php endif; ?>                                                    
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="location1">Auxiliar :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="auxiliar_id" name="auxiliar_id">
                                                <option value="<?php echo $row->auxiliar_id; ?>" selected=""><?php echo $row->auxiliar; ?></option>
                                                <?php foreach ($data_table_auxiliar as $tp) : ?>
                                                    <?php if (($row->auxiliar_id) != $tp->auxiliar_id): ?>
                                                    <option value="<?php echo $tp->auxiliar_id; ?>"><?php echo $tp->nombre; ?></option>
                                                    <?php endif; ?>                                                    
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" class="form-control" id="activo_id" name="activo_id" value="<?php echo $row->activo_id; ?>" >

                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Descripcion:</label>
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $row->descripcion; ?>" required="">
                                        </div>
                                       <div class="form-group">
                                            <label for="validationCustom01">Fecha de Incio</label>
                                            <input type="date" class="form-control" id="validationCustom01" placeholder="Fecha de Nacimiento" value="<?php echo $row->fecha_incorporacion; ?>" name="fecha" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Costo:</label>
                                            <input type="text" class="form-control" id="costo" value="<?php echo $row->costo; ?>" name="costo" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Observaciones:</label>
                                            <input type="text" class="form-control" id="observaciones" value="<?php echo $row->observaciones; ?>" name="observaciones" required="">
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
