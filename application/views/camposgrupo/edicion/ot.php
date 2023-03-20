									<div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location1">Marca :</label>
                                            <input type="text" class="form-control" id="color" name="marca" onkeypress="return check_keyModelos(event)" value="<?php echo $datosA->color; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="validationCustom01">Ancho :   </label>
                                            <input type="text" class="form-control" name="ancho" onkeypress="return check_keyMedidas(event)" value="<?php echo $datosA->ancho; ?>" >
                                            <div class="valid-feedback">
                                               
                                            </div>
                                        </div>

      

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Largo:</label>
                                            <input type="text" class="form-control" id="largo" name="largo" onkeypress="return check_keyMedidas(event)" value="<?php echo $datosA->largo; ?>" >
                                        </div>                                                
                                    </div>
                                    
                                    

                