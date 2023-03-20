
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="validationCustom01">Marca :   </label>
                                            <input type="text" class="form-control" name="marca" onkeypress="return check_keyModelos(event)" value="<?php echo $datosA->marca; ?>" >
                                            <div class="valid-feedback">
                                                
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Modelo:</label>
                                            <input type="text" class="form-control" onkeypress="return check_keyModelos(event)" value="<?php echo $datosA->modelo; ?>"  id="modelo" name="modelo" >
                                        </div>                                                
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location1">N° de Serie :</label>
                                            <input type="text" class="form-control" onkeypress="return check_keyModelos(event)" value="<?php echo $datosA->serie; ?>" id="serie" name="serie" >
                                        </div>
                                    </div>
                                    

                