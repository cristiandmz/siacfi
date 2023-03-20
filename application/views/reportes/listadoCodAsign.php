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

                                <h4 class="card-title">Listado de activos de la Oficina: <?php echo $oficina; ?></h4>                                
                            </div>                           
                        </div>                       
                        <p></p>                       
                        <!-- Step 1 -->     
                <?php echo form_open('Reportes/etiquetasQr',array('method'=>'POST',  'target' => '_blank')); ?>  
                       <input type="hidden" name="oficina" value="<?php echo $oficina; ?>" >
                       <input type="hidden" name="total" value="<?php echo count($lista); ?>" >
                        <div class="row" >
                               
                        <div class="card">
                            <div class="card-body">
                           <table id="auxiliar_tablesss" class="table table-bordered table-striped" style="font-size: 12px">
                                        <thead>
                                            <tr>
                                                
                                                <th>Codigo Asignacion</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                          
                                            <?php for ($i=0; $i < count($lista); $i++) 
                                            { ?>
                                                <tr>
                                                    <td>
                                                         <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo $lista[$i]['codigoAsign_id']; ?>" name="a<?php echo $i; ?>" value="<?php echo $lista[$i]['codigoAsign_id']; ?>">
                                            <label class="custom-control-label" for="<?php echo $lista[$i]['codigoAsign_id']; ?>"><?php echo $lista[$i]['codigoAsign']; ?></label>

                                            <input type="hidden" class="custom-control-input"  name="code<?php echo $i; ?>" value="<?php echo $lista[$i]['codigoAsign']; ?>">
                                                        </div>
                                                    </td>
                                                    <td><?php echo $lista[$i]['producto']; ?></td>
                                                    <td><input type="number" class="form-control" onkeypress="return soloNumeros(event)" min="1" max="6" name="c<?php echo $i; ?>" value="1"></td>
                                                  
                                                   
                                                   
                                                
                                                
                                                   
                                                </tr>
                                                <?php 
                                            } ?>
                                        </tbody>
                                    </table>
                      
                         </div> </div>
                         
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

