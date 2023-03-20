    
        

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="validationCustom01">Nro oficina :   </label>
                                            <input type="text" class="form-control" name="nrooficina" onkeypress="return check_keyModelos(event)" value="<?php echo $datosA->nrooficina; ?>" >
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Dimension:</label>
                                            <input type="text" class="form-control" id="dimension" name="dimension" value="<?php echo $datosA->dimension; ?>" onkeypress="return check_keyMedidas(event)" >
                                        </div>                                                
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location1">N° Contrato :</label>
                                            <input type="text" class="form-control" id="nrocontrato" name="nrocontrato" value="<?php echo $datosA->nrocontrato; ?>" onkeypress="return check_keyModelos(event)" >
                                        </div>
                                    </div>
                                    

                