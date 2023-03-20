  <div class="form-group">
                                            <label for="location1">Bien :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="auxiliar_id" name="auxiliar_id" required>
                                                <option value="">Seleccione Producto</option>
                                                <?php foreach ($datosAuxiliares as $tp) : ?>
                                                    <option value="<?php echo $tp->auxiliar_id; ?>"><?php echo $tp->nombre; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>