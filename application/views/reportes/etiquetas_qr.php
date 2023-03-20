<!doctype html>
    <html lang="es">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
        <title>Reporte de Activos</title>

        <style type="text/css">
            @page {
                margin-top: 0.4cm;
                margin-bottom: 0.4cm;
                margin-left: 0.4cm;
                margin-right: 0.4cm;
            }

            body {

            }

            * {
                font-family: Verdana, Arial, sans-serif;
            }

            a {
                color: #fff;
                text-decoration: none;
            }

            table {
                font-size: x-small;
            }

            tfoot tr td {
                font-weight: bold;
                font-size: x-small;
            }

            .code {
                font-size: 8px;
            }

            tr.border_bottom td {
              border-bottom:1pt solid black;

          }

          .invoice table {
            margin: 0px;
        }

        .invoice h3 {
            margin-left: 15px;
        }

        

        .information .logo {
            margin: 10px;
        }

        .information table {
            padding: 0px;
            font-size: 10px;
        }
        .codigo  {
            font-size: 10px;
        }

        .codigo_activo  {
            font-size: 14px;

            margin-top: 2px;
            margin-bottom:  1px;
        }

        .tabla {
            border-left: 0.01em solid #493B3B;
            border-right: 0;
            border-top: 0.01em solid #493B3B;
            border-bottom: 0;
            border-collapse: collapse;
        }
        .tabla td,
        .tabla th {
            border-left: 0;
            border-right: 0.01em solid #493B3B;
            border-top: 0;
            border-bottom: 0.01em solid #493B3B;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/barcode/jquery-barcode.js"></script>

</head>
<body>

    <div class="information">
        <table width="100%">
            <tr>
                <td align="right">
                    <?php echo $fecha; ?> 
                </td>
            </tr>
            <tr>
                <td align="center" style="width: 25%;">
                    <?php echo $encabezado->texto_uno; ?> 
                </td> 
            </tr><tr>
                <td style="width: 25%;">



                    <b><?php echo $oficina->oficina; ?>   </b>


                </td>

            </tr>

        </table>
    </div>

    <div class="invoice">


        <table class="code tabla" >

            <tbody> 

                <?php foreach ($data_table_activos as $row) { ?>                    
                    <tr >
                        <td align="center" class="codigo">
                            <b>
                            PROPIEDAD DE: <p></p>
                            COMPASS SOLUTIONS SRL  <p></p>
                            Producto: <?php echo $row->auxiliar; ?>
                          <p class="codigo_activo">
                              <?php echo $row->codigoAsign; ?></b>
                          </p>
                      </td>
                      <td>
                          <img src="<?php echo base_url(); ?>qr/<?php echo $row->codigoAsign_id.'.png';?>" width="100x" /> 
                      </td>
                  </tr>
                  <?php 
              } ?>
          </tbody>
      </table>
  </div>


  <script type="text/php">
    if ( isset($pdf) ){
        $pdf->page_script('
        if($PAGE_COUNT >= 1){
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif","normal");
            $size = 10;
            $pageText = $PAGE_NUM . "-". $PAGE_COUNT;
            $x = $pdf->get_width() / 2;
            $y = $pdf->get_height() - 24;        
            $pdf->text($x, $y, $pageText, $font, $size);
        }
        ');
    }

    
</script> 
</body>
</html>