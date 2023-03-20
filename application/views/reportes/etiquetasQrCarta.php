<!doctype html>
    <html lang="es">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
        <title>Reporte de Activos</title>

        <style type="text/css">
            @page {
                margin-top: 2,5cm;
                margin-bottom: 2,5cm;
                margin-left: 2,5cm;
                margin-right: 2,5cm;
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
            font-size: 7px;
        }

        .codigo_activo  {
            font-size: 10px;

            margin-top: 2px;
            margin-bottom:  1px;
        }

        .tabla {
            border-left: 1 solid #493B3B;
            border-right: 1 solid #493B3B;
            border-top: 1 solid #493B3B;
            border-bottom: 1 solid #493B3B;
            border-collapse: collapse;
        }
        .tabla td,
        .tabla th {
            border-left: 1 solid #493B3B;
            border-right: 1 solid #493B3B;
            border-top: 1 solid #493B3B;
            border-bottom: 1 solid #493B3B;
        }
    </style>
   

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
                <td style="width: 25%;">
                    <b><?php echo $oficina; ?>   </b>
                </td>
            </tr>
        </table>
    </div>

    <div class="invoice">
        <table class="code tabla" >
            <tbody> 
                <?php for ($i=0; $i <count($dta) ; $i++) { ?>                    
                    <tr>
                         <td class="codigo" align="center">
                         <b>                          
                            SEPDEP 
                            <br><img src="<?php echo base_url(); ?>qr/<?php echo $dta[$i].'.png';?>" width="100px" alt="qr" /><?php echo $codigos[$i];?>
                           <!-- ?php echo $dta[$i]['codigoAsign']; ?> -->
                       </b>                          
                      </td>

                        <?php for ($j=0; $j <5 ; $j++) { ?> 
                             <?php $i++; ?>
                                    <?php if ($i <count($dta)): ?>
                       <td class="codigo" align="center">
                         <b>                          
                         SEPDEP 
                            <br><img src="<?php echo base_url(); ?>qr/<?php echo $dta[$i].'.png';?>" width="100px" /><?php echo $codigos[$i];?>
                           <!-- ?php echo $dta[$i]['codigoAsign']; ?> -->
                       </b>                          
                      </td>
                            <?php endif ?>
                   
                                  <?php 
                      } ?>
                  
                       
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