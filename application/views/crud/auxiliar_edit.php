
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
                                 <a href="<?php echo site_url('Auxiliar/nuevo'); ?>" class="btn btn-info " title="Ir Atras" data-toggle="tooltip" ><i class="fa fas fa-reply"></i> Atras</a>
                                  <br><br>
                                <h4 class="card-title">Editar</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       

                        <?php echo form_open('auxiliar/update'); ?>
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
                                            <label for="recipient-name" class="control-label">Nombre:</label>
                                            <input type="hidden" class="form-control" id="auxiliar_id" name="auxiliar_id" value="<?php echo $row->auxiliar_id; ?>">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row->auxiliar; ?>">
                                        </div>                                       
                                        <div class="modal-footer">                                            
                                            <a href="<?php echo site_url('auxiliar/nuevo'); ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>                                                          
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


