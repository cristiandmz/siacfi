<?php echo form_open('Gerencias/update'); ?>
                                         
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Nivel de Jerarquía:</label>
                                            <input type="hidden" class="form-control" id="gerencia_id" name="gerencia_id" value="<?php echo $gerencia->gerencia_id; ?>">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $gerencia->gerencia; ?>" required>
                                        </div>  
                                         <div class="form-group">
                                            <label for="recipient-name" class="control-label">Sigla:</label>
                                            
                                            <input type="text" class="form-control" id="codGerencia" name="codGerencia" value="<?php echo $gerencia->codGerencia; ?>" onkeypress="return check_keyLetras(event)" onkeyup="mayus(this);" required>
                                        </div>
                                     
                                 
                                     

                                                                          
                                        <div class="modal-footer">  

                                             <button type="button" class="btn btn-default" data-dismiss="modal" data-backdrop="false">Cerrar</button>
                                                                                                     
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>  