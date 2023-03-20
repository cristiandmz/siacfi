                     

                        <?php echo form_open('cargos/update'); ?>                                         
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Cargo:</label>
                                            <input type="hidden" class="form-control" id="cargo_id" name="cargo_id" value="<?php echo $row->cargo_id; ?>">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" onkeypress="return check_keyLetras(event)" value="<?php echo $row->descripcion; ?>" required>
                                        </div>                                       
                                        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal" data-backdrop="false">Cerrar</button>
         <button type="submit" class="btn btn-primary">Guardar</button>
     </div>
                                    </form>                    
            


