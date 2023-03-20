
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
                        <!-- Step 1 -->                         
                        <div class="row" >
                            <div class="col-md-12">                                        
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_insertar"><i class="mdi mdi-plus"></i> Nueva Empresa</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Empresas</h4>                                        
                                <div class="table-responsive m-t-40">
                                    <table id="empresa_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>nro</th>
                                                <th>Nombre</th>
                                                <th>Direccion</th>
                                                <th>Nit</th>
                                                <th>Ciudad</th>
                                                <th>Telefono</th>  
                                                <th>Estado</th>          
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            <?php foreach ($data_table_empresa as $row) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row->nombre; ?></td>   
                                                    <td><?php echo $row->direccion; ?></td> 
                                                    <td><?php echo $row->nit; ?></td>                                                        
                                                    <td><?php echo $row->ciudad; ?></td>   
                                                    <td><?php echo $row->telefono; ?></td>  
                                                    <td>                                           
                                                        <?php if (($row->activo)==1):?>
                                                            <button type="button" class="btn btn-success">Activo</button>
                                                        <?php endif ?>
                                                        <?php if (($row->activo)==0):?>
                                                            <button type="button" class="btn btn-danger">Inactivo</button>
                                                        <?php endif ?>
                                                    </td>                                                                                                          
                                                    <td>
                                                        

                                                        <a href="<?php echo site_url('empresa/edit'); ?>/<?php echo $row->empresa_id; ?>"><button type="button" class="btn btn-warning"><span class="fas fa-edit" aria-hidden="true"></span></button></a>                                                          

                                                        <?php if (($row->activo)==1):?>
                                                            <a href="<?php echo site_url('empresa/delete'); ?>/<?php echo $row->empresa_id; ?>"><button type="button" class="btn btn-danger"><span class="fas fa-arrow-alt-circle-down" aria-hidden="true"></span> Dar de Baja</button></a>                                                          
                                                        <?php endif ?>
                                                        <?php if (($row->activo)==0):?>
                                                            <a href="<?php echo site_url('empresa/delete'); ?>/<?php echo $row->empresa_id; ?>"><button type="button" class="btn btn-success"><span class="fas fa-arrow-alt-circle-up" aria-hidden="true"></span> Dar de Alta</button></a>                                                          
                                                        <?php endif ?>
                                                        
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

                    <div class="modal fade" id="modal_insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Agregar Empresa</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<form action="<?php echo base_url();?>zona_urbana/insertar" method="POST">-->
                                        <?php echo form_open('empresa/create', array('method'=>'POST', 'id'=>'insertar')); ?>

                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Nombre:</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Direccion:</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">NIT:</label>
                                            <input type="number" class="form-control" id="nit" name="nit" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Ciudad:</label>
                                            <input type="text" class="form-control" id="ciudad" name="ciudad" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Telefono:</label>
                                            <input type="number" class="form-control" id="telefono" name="telefono" required="">
                                        </div>



                                        <div class="form-group">
                                            <label for="validationCustom01">Incio de Actividades</label>
                                            <input type="date" class="form-control" id="validationCustom01" placeholder="Fecha de Nacimiento" name="fecha_creacion_emp" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
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


