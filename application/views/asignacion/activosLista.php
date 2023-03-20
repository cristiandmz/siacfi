                <div class="col-md-7" > 
                                                  
                                 <div class="form-group">
                                            <label for="location1">Lista de Activos :<span class="text-danger"> *</span></label>
                                            <select class="listadoactivos" style="width: 100%;" id="activo" name="activo">
                                                <option value="">Seleccione una opcion</option>
                                                <?php foreach ($listadoActivos as $tp) : ?>
                                                    <option value="<?php echo $tp->codigoAsign_id; ?>"><?php echo $tp->codigoAsign." ".$tp->oficina; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                </div>
                  <div class="col-md-1" align="right">      <label for="location1"><span class="text-danger"> *</span></label>
                                            <button type="button" class="btn waves-effect waves-light  btn-info"  onclick="agregar();">Agregar</button>
                                        </div>
                        

                            <script>
      $(document).ready(function() {
        $('.listadoactivos').select2();
    });  
         </script>