
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
                                 <a href="<?php echo site_url('Personas/nuevo'); ?>" class="btn btn-info " title="Ir Atras" data-toggle="tooltip" align="left" ><i class="fa fas fa-reply" ></i> Atras</a>
                                  <br><br>
                                <h4 class="card-title">Edicion</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       

                        <?php echo form_open_multipart('Personas/update', array('method'=>'POST', 'id'=>'insertar')); ?>
                    <input type="hidden" class="form-control" id="persona_id" name="persona_id" value="<?php echo $datosP->persona_id; ?>">
                                      

                                   <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Nombres:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="nombres" name="nombres" onkeypress="return check_keyLetras(event)" value="<?php echo $datosP->nombres; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Apellido Paterno:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="paterno" name="paterno" onkeypress="return check_keyLetras(event)" value="<?php echo $datosP->paterno; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Apellido Materno:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="materno" name="materno" onkeypress="return check_keyLetras(event)" value="<?php echo $datosP->materno; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Carnet de identidad:<span class="text-danger"> *</span> </label>
                                                    <input type="text" class="form-control" id="ci" name="ci" minlength="5" value="<?php echo $datosP->ci; ?>"  maxlength="13" onkeypress="return check_keyNumeros(event)"required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3" align="center">
                                                <img src="<?php echo base_url(); ?>usuarios/<?php echo $datosP->img.'.png'; ?>" height="100px">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Cambiar Imagen: <code>solo se admite archivos png</code> </label>
                                                    <input type="file" class="form-control" id="imagen" name="imagen"  accept=",.png">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Direccion:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $datosP->direccion; ?>" onkeypress="return check_keyLetrasDos(event)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Celular:<span class="text-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="telefono" name="telefono" minlength="8"  maxlength="8"  value="<?php echo $datosP->telefono; ?>"onkeypress="return check_keyNumeros(event)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Fecha de Nacimiento</label>
                                                    <input type="date" class="form-control" id="fecha_nacimiento" placeholder="" name="fecha_nacimiento" value="<?php echo $datosP->fec_nacimiento; ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Fecha de incorporacion<span class="text-danger"> *</span></label>
                                                    <input type="date" class="form-control" id="fecha_incorporacion" placeholder="" name="fecha_incorporacion" value="<?php echo $datosP->fec_incorporacion; ?>" required>                                            
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="location1">Sucursal :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="sucursal_id" name="sucursal_id" required>
                                                        
                                                        <?php foreach ($getSucursal as $tp) : ?>
                                                            
                                                        <?php if ($tp->sucursal_id!=$datosP->sucursal_id): ?>
                                                                <option value="<?php echo $tp->sucursal_id; ?>"><?php echo $tp->sucursal; ?></option>
                                                                <?php else: ?>
                                                                    <option value="<?php echo $tp->sucursal_id; ?>" selected><?php echo $tp->sucursal; ?></option>
                                                            <?php endif ?>  
                                                            
                                                            
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
                                                            <?php if ($tp->gerencia_id!=$datosP->gerencia_id): ?>
                                                                <option value="<?php echo $tp->gerencia_id; ?>"><?php echo $tp->gerencia; ?></option>
                                                                <?php else: ?>
                                                                    <option value="<?php echo $tp->gerencia_id; ?>" selected><?php echo $tp->gerencia; ?></option>
                                                            <?php endif ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="location1">Cargo :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="cargo_id" name="cargo_id" required>                               
                                                        <?php foreach ($data_table_cargo as $tp) : ?>
                                                            <?php if ($tp->cargo_id!=$datosP->cargo_id): ?>
                                                                <option value="<?php echo $tp->cargo_id; ?>"><?php echo $tp->descripcion; ?></option>
                                                                <?php else: ?>
                                                                    <option value="<?php echo $tp->cargo_id; ?>" selected><?php echo $tp->descripcion; ?></option>
                                                            <?php endif ?>         
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="location1">Perfil :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="rol" name="rol" required>
                                                        
                                                        <?php foreach ($perfil as $tp) : ?>
                                                             <?php if ($tp->rol_id!=$datosP->rol_id): ?>
                                                                <option value="<?php echo $tp->rol_id; ?>"><?php echo $tp->rol; ?></option>
                                                                <?php else: ?>
                                                                    <option value="<?php echo $tp->rol_id; ?>" selected><?php echo $tp->rol; ?></option>
                                                            <?php endif ?> 
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">                                            
                                            <a href="<?php echo site_url('Personas/nuevo'); ?>"><button type="button" class="btn btn-danger">Cancelar</button></a>                                                          
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


