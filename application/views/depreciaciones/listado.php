
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
                                <h4 class="card-title">Listado de Activos</h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->                         
                        <div class="row" >
                            <div class="col-md-12">                                        
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_insertar"><i class="mdi mdi-plus"></i> Agregar</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Activos</h4>                                        
                                <div class="table-responsive m-t-40">
                                    <table id="auxiliar_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>nro</th>
                                                <th>codigo</th> 
                                                <th>fecha de compra</th> 
                                                <th>descripcion</th>
                                                <th>costo</th>
                                                <th>Dep. Anual</th>
                                                <th>Dep. Mensual</th>
                                                <th>Estado</th>
                                                                                                                              
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            <?php foreach ($data_table_activos as $row) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row->codigo; ?></td>
                                                    <td><?php echo $row->fecha_incorporacion; ?></td>                                                      
                                                    <td><?php echo $row->descripcion; ?></td> 
                                                    <td><?php echo $row->costo; ?></td> 
                                                    <td><?php echo $row->dep_anual; ?></td> 
                                                    <td><?php echo $row->dep_mensual; ?></td>                                                    
                                                    <td>                                           
                                                        <?php if (($row->activo)==1):?>
                                                            <button type="button" class="btn btn-success">En almacen</button>
                                                        <?php endif ?>
                                                        <?php if (($row->activo)==2):?>
                                                            <button type="button" class="btn btn-danger">Asignado</button>
                                                        <?php endif ?>
                                                    </td> 
                                                    <td>
                                                        <a href="<?php echo site_url('activos/edit'); ?>/<?php echo $row->activo_id; ?>"><button type="button" class="btn btn-warning"><span class="fas fa-edit" aria-hidden="true"></span></button></a>

                                                         <?php if (($row->activo)==1):?>                      
                                                            <a href="<?php echo site_url('activos/edit_baja'); ?>/<?php echo $row->activo_id; ?>"><button type="button" class="btn btn-danger"><span class="fas fa-arrow-alt-circle-down" aria-hidden="true"></span> Dar de Baja</button></a>
                                                            <?php endif ?> 
                                                        <a href="<?php echo site_url('activos/pdf_alta'); ?>/<?php echo $row->activo_id  ?>" target="_blank"><button type="button" class="btn btn-warning"><span class="fas fa-print" aria-hidden="true"></span></button></a>    
                                                        <a href="<?php echo site_url('activos/pdf_asign'); ?>/<?php echo $row->activo_id  ?>" target="_blank"><button type="button" class="btn btn-warning"><span class="fas fa-print" aria-hidden="true"></span></button></a>    
                                                        
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
                                    <h4 class="modal-title" id="exampleModalLabel1">Agregar Activos</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<form action="<?php echo base_url();?>zona_urbana/insertar" method="POST">-->
                                        <?php echo form_open('activos/create'); ?>
                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="location1">Categoria :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="grupo_id" name="grupo_id">
                                                        <option value="">Seleccione una categoria</option>
                                                        <?php foreach ($data_table_grupo as $tp) : ?>
                                                            <option value="<?php echo $tp->grupo_id; ?>"><?php echo $tp->nombre; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="location1">Auxiliar :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="auxiliar_id" name="auxiliar_id">
                                                        <option value="">Seleccione una categoria</option>
                                                        <?php foreach ($data_table_auxiliar as $tp) : ?>
                                                            <option value="<?php echo $tp->auxiliar_id; ?>"><?php echo $tp->nombre; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>                                                
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Descripcion A.F.:</label>
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" required="">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Fecha de Compra</label>
                                                    <input type="date" class="form-control" id="validationCustom01" placeholder="Fecha de Nacimiento" name="fecha" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Costo Bs.:</label>
                                                    <input type="text" class="form-control" id="costo" name="costo" required="">
                                                </div>                                                
                                            </div>
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="location1">Estado del bien :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="estado" name="estado" required>
                                                        <option value="">Seleccione estado</option>
                                                        <?php foreach ($data_table_estado as $d) : ?>
                                                            <option value="<?php echo $d->estado_id; ?>"><?php echo $d->descripcion; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        
                                        
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Observaciones:</label>
                                            <input type="text" class="form-control" id="observaciones" name="observaciones" required="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
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
<!-- ============================================================== --> 


