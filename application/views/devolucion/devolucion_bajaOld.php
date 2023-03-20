             

                        <?php echo form_open('Devolucion/baja'); ?>  

                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Empleado: <?php echo $row->nombre; ?></label>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Motivo:</label>
                                            <input type="text" class="form-control" id="motivo" name="motivo" required="" >
                                        </div>
                                        <input type="hidden" class="form-control" id="empleado" name="empleado" value="<?php echo $row->persona_id; ?>" >
                                        <input type="hidden" class="form-control" id="asignacion_id" name="asignacion_id" value="<?php echo $row->asignacion_id; ?>" >
                                        <div class="modal-footer">                                            
                                            <button type="button" class="btn btn-default" data-dismiss="modal" data-backdrop="false">Cancelar</button>                                                          
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>                    

