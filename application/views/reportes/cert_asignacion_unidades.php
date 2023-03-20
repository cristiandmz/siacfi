<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
    <title>Reporte de Asignaciones <?php echo $oficina; ?></title>

    <style type="text/css">
        @page {
            margin-top: 3cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
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

        .invoice table {
            
            margin-top: 0px ;
            margin-bottom: 0px;
            margin-left: 0px ;
            margin-right: 0px;
        }

         .code {
            font-size: 9px;
        }

        .invoice h3 {
            margin-left: 15px;
        }

        .information {
            background-color: #60A7A6;
            color: #FFF;
        }

        .information .logo {
            margin: 5px;
        }

        .information table {
            padding: 10px;
        }

        .encabezado {
            padding-top: 0px ;
            padding-bottom: 0px  ;
            padding-left: 0px ;
            padding-right: 0px ;
            color: #000000;
        }
        .piedpagina {
            
            padding-top: 40px;
            padding-bottom: 50px;
            padding-left:  40px;
            padding-right:  40px;
        }

         .code_thead {
            font-size: 12px;
        }

        .firmas {
            font-size: 11px;
        }
    </style>
   
</head>
<body>

<div class="encabezado">
    <table width="25%">
        <tr>
            <td align="center" style="width: 30%;"> <b>
            <?php echo $encabezado->texto_uno; ?> <br>  
            <?php echo $encabezado->texto_dos; ?> <br>
            <u><?php echo $encabezado->texto_tres; ?></u></b>               
            </td>
           
        </tr>

    </table>
    <h4 align="center">LISTADO DE ACTIVOS FIJOS DE LA UNIDAD <?php echo $oficina; ?></h4>
</div>

<div class="invoice">
    
    <table width="100%" class="code">
        <thead>
            <tr align="center">
                
                <th class="code_thead">CODIGO</th> 
                <th class="code_thead">INCORPORACION</th> 
                <th class="code_thead">DESCRIPCION</th>
                <th class="code_thead">COSTO</th>    
                <th class="code_thead">ESTADO</th>
                <th class="code_thead">OBS.</th>                                        
                <th class="code_thead">OFICINA</th>
                <th class="code_thead">IMAGEN</th>



                
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($data_table_activos as $row) { ?>
                <tr align="center">                    
                    <td><?php echo $row->codigo; ?></td>
                    <td><?php echo $row->fecha_incorporacion; ?></td>    
                    <td><?php echo $row->descripcion; ?></td> 
                    <td><?php echo $row->costo; ?></td>                    
                    <td><?php echo $row->est; ?></td>
                    <td><?php echo $row->observaciones; ?></td>                                     
                    <td><?php echo $row->oficina; ?></td>
                    <td><img src="<?php echo base_url(); ?>public/assets/images/activos/<?php echo $row->imagen;?>" alt="Logo" width="54" class="logo"/></td>
                </tr>
                <?php 
            } ?>
        </tbody>        
    </table>
          <table width="100%" style="margin-top:0px;">        
        <tbody>
            <tr>
                <td align="right" colspan="3">
                    La Paz, <?php echo $fecha; ?>
                    <br><br><br><br> <br><br>
                </td>
            </tr>
        <tr>
            <td align="center" colspan="3">
                    .........................................................<p></p>      
                    <?php echo $firmas[0]['nombre']; ?><p></p>  
                    <b><?php echo $firmas[0]['cargo_f']; ?></b><p></p>      
                    <b><?php echo $firmas[0]['firma']; ?></b>
                    
                    
              
              
            </td>
            
           
        </tr>

        <tr>
            <td align="center"  colspan="3">   
                    <br><br><br><br><br><br>                                  
                    .........................................................<p></p>      
                    <?php echo $firmas[2]['nombre']; ?><p></p>   
                    <b><?php echo $firmas[2]['cargo_f']; ?></b>
              
              
            </td>
        </tr>      
                    
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
        $x = $pdf->get_width() - 410;
        $y = $pdf->get_height() - 24;        
        $pdf->text($x, $y, $pageText, $font, $size);
    }
    ');
}

    
</script> 

</body>
</html>
