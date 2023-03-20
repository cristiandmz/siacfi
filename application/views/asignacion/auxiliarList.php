  <div class="form-group">
                                            <label for="location1">Auxiliar :<span class="text-danger"> *</span></label>
                                            <select class="custom-select form-control" id="auxiliar_id" name="auxiliar_id">
                                                <option value="">Seleccione Auxiliar</option>
                                                <?php foreach ($datosAuxiliares as $tp) : ?>
                                                    <option value="<?php echo $tp->auxiliar_id; ?>"><?php echo $tp->nombre; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- script ajax -->
<script>

    $('#auxiliar_id').change(function() {



    
        
              var auxiliarId = $('#auxiliar_id').val();
        
           

              if (auxiliarId!=0) {
                                  
                  $('#listactivos').empty();

                  $.ajax({
                    url: 'apiActivosList',
                    type: 'post',
                    data: {auxiliarId: auxiliarId},
                    dataType: "html",
                    success: function(response){ 
                     
                      $('#listactivos').html(response);
                  }
                });
                //fin ajax
              }else{
                $('#listactivos').empty();
              }

            
    // alert($(this).val());
});
</script>