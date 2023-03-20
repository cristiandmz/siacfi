<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
    <title>Reporte de Alta de Activos</title>

    <style type="text/css">
        @page {
            margin-top: 2cm;
            margin-bottom: 2cm;
            margin-left: 3cm;
            margin-right: 2cm;
        }

      /*  body {
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
            
            padding-top: 40px;
            padding-bottom: 50px;
            padding-left:  40px;
            padding-right:  40px;
        }
    </style>
 

</head>
<body>

<div class="encabezado">
    <table>

        <tr>
            <td align="center" style="width: 100%;">                
            <?php echo $encabezado->texto_uno; ?> 
            </td>
           
        </tr>

    </table>
</div>







<div class="invoice">
    <h4 align="center">DOCUMENTO DE INGRESO DE ACTIVO FIJO</h4>

    <table width="100%">
        <tr>
            <td align="justify" style="width: 100%;">
           En la ciudad de La Paz se procede con el ingreso de el/los bienes de acuerdo al siguiente detalle:                  
        </td>
       
    </tr>
</table>
        
     <table width="100%">
        <tr>
            <td align="left" style="width: 20%;">                
                                                  
                    Rubro contable:<br>
                    Codigo Generico:<br>
                    Tipo de bien:<br>                    
                    Costo:<br>
                    Cantidad:<br>
                    Fecha de Compra: <br>
                    Sucursal: <br>
                    Estado: <br>
                    Descripcion:<br>                 
                    Accesorios:
                
            </td>
            <td align="left" style="width: 80%;">                
                                
                    <?php echo $tabla->grupo; ?><br>                    
                    <?php echo $tabla->codigo; ?><br>
                    <?php echo $tabla->auxiliar; ?><br>
                    <?php echo $tabla->costo; ?><br>                    
                    <?php echo $tabla->cantidad; ?><br>
                    <?php echo $tabla->fecha_incorporacion; ?><br>
                    <?php echo $tabla->sucursal; ?><br>
                    <?php echo $tabla->estado; ?><br>
                    <?php echo $tabla->descripcion; ?><br>
                    <?php echo $tabla->accesorios; ?>

               
            </td>
            <td>
                
            </td>
        </tr>
    </table>




<p></p>        
    <table width="100%" >
        <thead>
            <tr align="center">
                <th>Codigo Generico</th>
                <th>Codigo Asignado</th> 
                <th>Ubicacion</th> 
             
                
                
            </tr>
        </thead>
        <tbody>  

        <?php foreach ($subActivos as $sa) { ?> 
                <tr align="center">
                    <td><?php echo $sa->codigoGen; ?></td>                    
                    <td><?php echo $sa->codigoAsign; ?></td>
                    <td><?php echo $sa->oficina; ?></td>
                 
                </tr>
         <?php } ?>       
        </tbody>
    </table>
    
    
    <br><br><br><br><br><br>
    

    

    
</div>

<div class="piedpagina" style="position: absolute; ">
    <table width="100%">        
        <tbody>
        <tr>
            <td align="center" style="width: 50%;">
                    .........................................................<p></p>      
                    <?php echo $firmas[0]['nombre']; ?><p></p>   
                   <b><?php echo $firmas[0]['cargo_f']; ?></b><p></p>   
            </td>
        </tr>
        
      
        
        </tbody>     
    </table>
</div>

</body>
</html>