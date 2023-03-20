
                                  <?php echo form_open('Activos/updateSubactivos'); ?>
                                         
                                       	<input type="hidden" value="<?php echo $idsubactivo ?>" name="idsubactivo">
                                       	<input type="hidden" value="<?php echo $idactivo ?>" name="idactivo">
                                        <div class="form-group">
                                            <label for="location1">Localizacion :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="oficina" name="oficina">
                                               
                                                <?php foreach ($getOficinaList as $tp) : ?>
                                                	<?php if ($DataSubactivo->oficina_id!=$tp->oficina_id): ?>
                                                		 <option value="<?php echo $tp->oficina_id; ?>"><?php echo $tp->oficina; ?></option >
                                                		<?php else: ?>
                                                			 <option value="<?php echo $tp->oficina_id; ?>" selected><?php echo $tp->oficina; ?></option>
                                                	<?php endif ?>
                                                   
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                    <label>Observaciones :<span class="text-danger"> *</span></label>
                                    <textarea class="form-control" rows="5"    id="observaciones" name="observaciones" ><?php echo $DataSubactivo->observaciones; ?></textarea>
                                </div>
                                     

                                                                          
                                        <div class="modal-footer">  


                                                                                                     
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>  