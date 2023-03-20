
<table id="auxiliar_tablesss" class="table table-bordered table-striped" style="font-size: 12px">
                                        <thead>
                                            <tr>
                                            	<th>Nro</th>
                                            	<th>Codigo Generico</th>
                                                <th>Codigo Asignacion</th>
                                                <th>Producto</th>
                                                <th>Ubicacion</th>
                                                <th>Imagen</th>
                                               
                                                                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            <?php foreach ($solicitud as $row) { 
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row->codigo; ?></td>
                                                    <td><?php echo $row->codigoAsign; ?></td>
                                                    <td><?php echo $row->auxiliar; ?></td>
                                                     <td><?php echo $row->oficina; ?></td>

                                                    <td>
                                                        <img src="<?php echo base_url(); ?><?php echo $row->url; ?>/<?php echo $row->imagen; ?>" alt="user" width="100px"/>
                                                                        
                                                    </td>
                                                    
                                                
                                                
                                                   
                                                </tr>
                                                <?php 
                                            } ?>
                                        </tbody>
                                    </table>


         
 

