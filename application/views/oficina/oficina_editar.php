<?php echo form_open('Oficina/update'); ?>
                                         
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Localización:</label>
                                            <input type="hidden" class="form-control" id="oficina_id" name="oficina_id" value="<?php echo $row->oficina_id; ?>">
                                            <!-- <input type="text" class="form-control" id="nombre" name="nombre" onkeypress="return check_keyLetras(event)" onkeyup="mayus(this);" value="<?php echo $row->oficina; ?>" required> -->
                                        </div>  <input type="text" class="form-control" id="nombre" name="nombre" onkeypress="return check_keyLetras(event)";" value="<?php echo $row->oficina; ?>" required>
                                        <input type="text" class="form-control" id="nombre" name="nombre" onkeypress="return check_key(event);" value="<?php echo $row->oficina; ?>" required>


                                        <div class="modal-footer">  


                                                                                                     
                                            
                                            <button type="button" class="btn btn-default" data-dismiss="modal" data-backdrop="false">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>  