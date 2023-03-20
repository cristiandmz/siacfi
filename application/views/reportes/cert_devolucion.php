<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>Acta de devolucion</title>

    <style type="text/css">
        @page {
            margin: 0px;
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

            margin: 35px;
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
            padding: 30px;
            color: #000000;
        }
        .piedpagina {
            
            color: #FFF;
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
    <table width="30%">
        <tr>
            <td align="center" style="width: 30%;">            
             <?php echo $encabezado->texto_uno; ?>    
            </td>
           
        </tr>

    </table>
</div>


<div class="invoice">
    <h3 align="center">ACTA DE DEVOLUCION DE ACTIVO FIJO</h3>
        
        
  



<table width="100%">
        <tr>
            <td align="justify" style="width: 100%;">
           En la ciudad de La Paz en fecha se procede a la devolución de el/los bienes de acuerdo al siguiente detalle:                  
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
                Para ser liberado de la responsabilidad, el funcionario deberá devolver a la unidad responsable de activos fijos, el o los bienes que estaban a su cargo, debiendo recabar la conformidad escrita de esta unidad o responsable. Mientras no lo haga, estará sujeto al régimen de responsabilidad establecida en la ley Nº 1178 y sus reglamentos.
                <p></p>
           <br>
                En señal de conformidad y aceptación se firma la presente acta.
        </td>
       
    </tr>
</table>
    
    <br><br><br><br><br><br>
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
                    <br><br><br><br><br><br>     


            </td>
            <td align="center" style="width: 50%;">    
                .........................................................<p></p>      
                    <?php echo $empleado->empleado ?><p></p>   
                    <b><?php echo strtoupper($empleado->cargo); ?></b><p></p>      
                   <br><br><br><br><br><br>      

            </td>           
        </tr>
        <tr>
            <td></td>
            <td></td>          
        </tr>
        <tr>
            <td></td>
            <td></td>         
        </tr>
    </tbody>     
</table>

    
</div>

<div class="piedpagina" style="position: absolute; bottom: 0;">
    <hr>
</div>

</body>
</html>