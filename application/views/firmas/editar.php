<?php echo form_open('firmas/update'); ?>
        <input type="hidden" class="form-control" id="firma_id" name="firma_id" value="<?php echo $firma_id; ?>">

    

    

                                        <div class="form-group">
                                                    <label for="location1">Persona :<span class="text-danger"> *</span></label>
                                                    <select class="custom-select form-control" id="persona_id" name="persona_id">
                                                        <option value="<?php echo $solicitud->persona_id; ?>" selected><?php echo $solicitud->nombre; ?></option>                                                       
                                                        <?php foreach ($personas as $tp) : ?>
                                                            <?php if (($solicitud->persona_id) != $tp->persona_id): ?>
                                                            <option value="<?php echo $tp->persona_id; ?>"><?php echo $tp->nombres; ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>



                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Cargo:</label>
                                                    <input type="text" class="form-control" id="cargo" name="cargo" required="" value="<?php echo $solicitud->cargo_f ?>">
                                                </div>
<!-- 
                                                <?php if ($solicitud->nivel!=3): ?>
                                                     <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Abrev. unidad:</label>
                                                    <input type="text" class="form-control" id="firma" name="firma" required="" value="<?php echo $solicitud->firma ?>">
                                                </div>
                                                <?php endif ?>
                                                <?php if ($solicitud->nivel==3): ?>
                                                     
                                                    <input type="hidden" class="form-control" id="firma" name="firma" required="" value="<?php echo $solicitud->firma ?>">
                                                
                                                <?php endif ?> -->

                                               
                                          


                                        
                                      


                                        

                                     <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            
            <button type="submit" class="btn btn-info">Guardar  </button>
          
        </div>
    </form>