<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
    <title>Reporte de Asignacion</title>

    <style type="text/css">
        @page {
            margin-top: 2cm;
            margin-bottom: 2cm;
            margin-left: 3cm;
            margin-right: 2cm;
        }

     /*   body {
             background-image: url('<?php echo base_url(); ?>public/assets/images/reporte/menbrete_V.png');
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
            padding: 0px;
            color: #000000;
        }
        .piedpagina {
            
            padding-top: 50px;
            padding-bottom: 50px;
            padding-left:  40px;
            padding-right:  40px;
        }

 .code_thead {
            font-size: 12px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/barcode/jquery-barcode.js"></script>

</head>
<body>

    <div class="encabezado">
    <table >
        <tr>
            <td align="center" style="width: 100%;">                
             <?php echo $encabezado->texto_uno; ?> 
          
            </td>
           
        </tr>

    </table>
</div>






    <div class="invoice">
        <h3 align="center">ACTA DE ASIGNACION DE ACTIVO FIJO</h3>
        <table width="100%">
            <tr>
                <td align="justify" style="width: 100%;">
                 En la ciudad de La Paz se procede a la asignacion del bien de acuerdo al siguiente detalle:                  
             </td>

         </tr>
     </table>

     <table width="100%" >
        <thead>
            <tr align="center">
                <th class="code_thead">CODIGO GENERICO</th> 
                <th class="code_thead">CODIGO ASIGNADO</th>
                
                <th class="code_thead">PRODUCTO</th>
            
                <th class="code_thead">ESTADO</th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($datosSubActivos as $row) { ?>
                <tr align="center">                    
                    <td><?php echo $row->codigo; ?></td>
                    <td><?php echo $row->codigoAsign; ?></td>
                                                                          
                    <td><?php echo $row->auxiliar; ?></td> 
        
                    <td><?php echo $row->estado; ?></td>    
                </tr>


                <?php 
            } ?>
        </tbody>
    </table>
    <p>

    </p><p></p>



    <table width="100%">
        <tr>
            <td align="justify" style="width: 100%;">
             La presente acta de recepción y entrega de bienes demuestra la asignación de bienes de uso (Activo Fijo) que la institución efectúa al funcionario para la realización de las funciones y tareas.
             <p></p>
             <br>
             La asignación de bienes genera en el funcionario la consiguiente responsabilidad sobre el debido uso, custodia y  mantenimiento de los mismos; la pérdida, destrucción, maltrato o negligencia será imputada a su persona. Asimismo, el funcionario que ahora tiene a su cargo dichos bienes, por ningún concepto podrá prestarlos o transferirlos por cuenta propia, en tal caso la institución asumirá acciones de acuerdo a ley y reglamentos en actual vigencia. 
             <p></p>
             <br>
             Para efectos de determinar al usuario responsable, en conformidad firma el presente acta:   


         </td>

     </tr>
 </table>

    <table width="100%">        
    <tbody>
        <tr>
                <td align="right" colspan="2">
                    La Paz, <?php echo $fecha; ?>
                    <br><br><br><br><br><br><br>
                </td>
            </tr>
        <tr>
            <td align="center" style="width: 50%;">
                .........................................................<p></p>      
                    <?php echo $firmas[0]['nombre']; ?><p></p>   
                    <b><?php echo $firmas[0]['cargo_f']; ?></b><p></p>      
                    


            </td>
            <td align="center" style="width: 50%;">    
                .........................................................<p></p>      
                    <?php echo $empleado->empleado ?><p></p>   
                    <b><?php echo strtoupper($empleado->cargo); ?></b><p></p>      
                    

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
        $x = $pdf->get_width() / 2 ;
        $y = $pdf->get_height() - 24;        
        $pdf->text($x, $y, $pageText, $font, $size);
    }
    ');
}

    
</script> 
</body>
</html>