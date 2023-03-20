<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
    <title>Reporte de Activos</title>

    <style type="text/css">
        @page {
            margin-top: 1cm;
            margin-bottom: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
        }

        /*body {
            background-image: url('<?php echo base_url(); ?>public/assets/images/reporte/menbrete_H.png');
           background-repeat: no-repeat; 
        }*/

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
            margin: 0px;
        }

         .code {
            font-size: 10px;
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
            
            color: #FFF;
        }
         .code_thead {
            font-size: 12px;
        }
    </style>
    

</head>
<body>

<div class="encabezado">
    <table width="25%">
        <tr>
            <td align="center" style="width: 100%;"> 
            <?php echo $encabezado->texto_uno; ?>             
            </td>
        </tr>
    </table>
    <h3 align="center">LISTADO GENERAL DE ACTIVOS FIJOS</h3> 
    <h3 align="center"><?php echo $nombregrupo; ?> </h3>
</div>
<div class="invoice">
<table width="100%">
        <tr>
            <td align="justify" style="width: 100%;">
           Detalle de los activos fijos de la institucion:               
        </td>
       
    </tr>
</table>

    <table width="100%" class="code">
        <thead>
            <tr align="center">
                <th class="code_thead">CODIGO GENERICO</th> 
                <th class="code_thead">CODIGO ASIGNADO</th>
                <th class="code_thead">FECHA DE COMPRA</th>                 
                <th class="code_thead">PRODUCTO</th>
                <!-- <th class="code_thead">DESCRIPCION</th>             -->
                <th class="code_thead">ESTADO</th>
                <th class="code_thead">RESPONSABLE</th>                            
                <th class="code_thead">UBICACION</th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($datosListaActivos as $row) { ?>
                <tr align="center">                    
                    <td><?php echo $row->codigoGen; ?></td>
                    <td><?php echo $row->codigoAsign; ?></td>
                    <td><?php echo $row->fecha_incorporacion; ?></td>    
                    <td><?php echo $row->auxiliar; ?></td> 
                    <!-- <td><?php echo $row->descripcion; ?></td>                     -->
                    <td><?php echo $row->estado; ?></td>
                    <td><?php echo $row->nombre; ?></td>
                    
                    <td><?php echo $row->oficina; ?></td>
                </tr>
                <?php 
            } ?>
        </tbody>
    </table>
    <p>
    <table width="100%">        
        <tbody>
            <tr>
                <td align="right">
                    La Paz, <?php echo $fecha; ?>
                    <br><br>
                </td>
            </tr>
        <tr>
            <td align="center" style="width: 50%;">
                    .........................................................<p></p>      
                    <?php echo $firmas[0]['nombre']; ?><p></p>   
                    <b><?php echo $firmas[0]['cargo_f']; ?></b><p></p>      
                    <br><br><br><br><br>
                    .........................................................<p></p>      
                    <?php echo $firmas[2]['nombre']; ?><p></p>   
                    <b><?php echo $firmas[2]['cargo_f']; ?> </b>    
              
              
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
