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

        body {
            background-image: url('<?php echo base_url(); ?>public/img/reporte/menbrete_V.jpg');
           background-repeat: no-repeat; 
        }

        * {
            font-family: Verdana, Arial, sans-serif;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        table {
            font-size: 12px;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: 12px;
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

        .colorGuindo {
            padding: 0px;
            color: #900A0A;
        }
        .tabla {
            border-left: 1 solid #900A0A;
            border-right: 1 solid #900A0A;
            border-top: 1 solid #900A0A;
            border-bottom: 1 solid #900A0A;
            border-collapse: collapse;
          
        }
        .tabla td,
        .tabla th {
            border-left: 1 solid #900A0A;
            border-right: 1 solid #900A0A;
            border-top: 1 solid #900A0A;
            border-bottom: 1 solid #900A0A;
            padding:6px;

        }
    </style>
 

</head>
<body>

<div class="encabezado">
    <table style="width: 100%;">

        <tr>
            <td align="left" style="width: 30%;">                
             <img src="<?php echo base_url(); ?>public/img/logo.jpg" alt="Logo" height="80px" class="logo"/>
            </td>
            <td align="center" style="width: 40%;">  
              <h1 align="center" class="colorGuindo">    Ficha de Registro <br>
            Activos Fijos</h1>              
        
            </td>
            <td align="center" style="width: 20%;">                
            Fecha: <br> <?php echo $fecha; ?>

            </td>
           
        </tr>

    </table>
</div>







<div class="invoice">
    
        
     <table style="width: 100%;" class=" tabla">
        <tr>
            <td align="left" style="width: 25%;">                
                    <b>Producto:</b>                 
            </td>
            <td align="left" style="width: 30%;">                
                    <?php echo $tabla->auxiliar; ?>
            </td>
            <td align="left" style="width: 25%;padding:1;" rowspan="6" >                
             <img src="<?php echo base_url(); ?>public/assets/images/activos/<?php echo $tabla->imagen; ?>"  height="250px" width="200px" />
            </td>
        </tr>
        <tr>
            <td align="left" style="width: 25%;">
                    <b>Clasificación:</b>
            </td>
            <td align="left" style="width: 30%;">                                        
                    <?php echo $tabla->grupo; ?>
            </td>
            
        </tr>
        <tr>
            <td align="left" style="width: 25%;">   
                    <b>Cantidad:</b>
            </td>
            <td align="left" style="width: 30%;">                                   
                    <?php echo $tabla->cantidad; ?>
            </td>           
        </tr>
          <tr>
            <td align="left" style="width: 25%;"> 
                    <b>Forma y medio de Pago:</b> 
            </td>
            <td align="left" style="width: 30%;">                
                    <?php echo $tabla->forma_pago; ?>
            </td>
            
        </tr>
         <tr>
            <td align="left" style="width: 25%;"> 
                    <b>Nro de Recibo/Factura o Invoice:</b> 
            </td>
            <td align="left" style="width: 30%;">                
                    <?php echo $tabla->nrofactura; ?>
            </td>
            
        </tr>
          <tr>
            <td align="left" style="width: 25%;"> 
                    <b>Fecha de Compra:</b> 
            </td>
            <td align="left" style="width: 30%;">                
                    <?php echo $tabla->fecha_incorporacion; ?>
            </td>
            
        </tr>
       
        <tr>
            <td align="left" style="width: 25%;"> 
                    <b>Descripcion:</b>
            </td>
            <td align="left" style="width: 75%;" colspan="2">
                    <?php echo $tabla->descripcion; ?>
            </td>            
        </tr>
          <tr>
            <td align="left" style="width: 25%;">                           
                    <b>Accesorios:</b>
            </td>
            <td align="left" style="width: 50%;" colspan="2">                   
                    <?php echo $tabla->accesorios; ?>
            </td>            
        </tr>
          <tr>
            <td align="left" style="width: 25%;">                  
                    <b>Otros:</b>
            </td>
            <td align="left" style="width: 50%;" colspan="2">
                    <?php echo $tabla->observaciones; ?>
            </td>            
        </tr>
          <tr>
            <td align="left" style="width: 25%;"> 
                    <b>Codigo Generico:</b>
            </td>
            <td align="left" style="width: 50%;" colspan="2">
                    <?php echo $tabla->codigo; ?>
            </td>            
        </tr>
          <tr>
            <td align="left" style="width: 25%;"> 
                    <b>Codigos Asignados:</b>
            </td>
            <td align="left" style="width: 50%;" colspan="2">
                   <?php foreach ($subActivos as $sa) { ?>
                 <?php echo $sa->codigoAsign.' '; ?>
                 
                
         <?php } ?> 
            </td>            
        </tr>
       
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