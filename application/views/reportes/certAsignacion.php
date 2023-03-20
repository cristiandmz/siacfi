<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
    <title>Reporte de Alta de Activos</title>

    <style type="text/css">
        @page {
            margin-top: 1cm;
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
            <td align="left" style="width: 10%;">                
             <img src="<?php echo base_url(); ?>public/img/logo.png" alt="Logo" height="100px" class="logo"/>
            </td>
            <td align="center" style="width: 40%;">  
              <h3 align="center" class="colorGuindo"><u>ACTA DE ASIGNACIÓN <br>DE ACTIVOS FIJOS</u></h3>
            </td>
            
            <td align="center" style="width: 20%;">                
            Fecha: <br> <?php echo  $tabla->fecha_asign ?>

            </td>
           
        </tr>

    </table>
</div>







<div class="invoice">
        <p align="center"><h4 align="center">DETALLE DEL ACTIVO</h4></p>
            
     <table style="width: 100%;" class=" tabla" >          
        <tr>
            <td align="left" style="width: 25%;">                
                    <b>Producto:</b>                 
            </td>
            <td align="left" style="width: 25%;">                
                    <?php echo $tabla->auxiliar; ?>
            </td>
            <td align="left" style="width: 25%;">
                    <b>Clasificación:</b>
            </td>
            <td align="left" style="width: 25%;">                                        
                    <?php echo $tabla->grupo; ?>
            </td>
            
        </tr>
        
        <tr>
            <td align="left" style="width: 25%;">   
                    <b>Cantidad:</b>
            </td>
            <td align="left" style="width: 25%;">                                   
                    1
            </td>           
            <td align="left" style="width: 25%;"> 
                    <b>Codigo Asignado:</b>
            </td>
            <td align="left" style="width: 25%;" >                  
                 <?php echo $tabla->codigoAsign; ?>
            </td>
        </tr>
        <tr>
            <td align="left" style="width: 25%;"> 
                    <b>Localización:</b> 
            </td>
            <td align="left" style="width: 25%;">                
                    <?php echo $tabla->oficina; ?>
            </td>
            <td align="left" style="width: 25%;"> 
                    <b>Estado:</b> 
            </td>
            <td align="left" style="width: 25%;">                
                    <?php echo $tabla->estado; ?>
            </td>
        </tr>
        <tr>
            <td align="left" style="width: 25%;"> 
                    <b>Descripcion:</b>
            </td>
            <td align="left" style="width: 25%;" >
                    <?php echo $tabla->descripcion; ?>
            </td>  
            <td align="left" style="width: 25%;">                           
                    <b>Accesorios:</b>
            </td>
            <td align="left" style="width: 25%;" >                   
                    <?php echo $tabla->accesorios; ?>
            </td>          
        </tr>
          
          <tr>
            <td align="left" style="width: 25%;">                           
                    <b>RESPONSABLE: </b>
            </td>
            <td align="left" style="width: 25%;" >                   
                    <?php echo $empleado->empleado; ?>
                    <br>
                    <?php echo $empleado->cargo; ?>
            </td> 
            <td align="left" style="width: 25%;">                  
                    <b>Observaciones:</b>
            </td>
            <td align="left" style="width: 25%;" >
                    <?php echo $tabla->obsubactivo; ?>
            </td> 

        </tr>
            </table>
    
           <h4 align="center">CLÁUSULA DE COMPROMISO</h4>
 

        <table style="width: 100%;" class=" tabla" >          
   
        <tr>
            <td colspan="4" align="justify">
Yo,<b><?php echo $empleado->empleado; ?></b> declaro que a partir de la fecha de asignación del activo detallado en el presente documento está bajo mi total responsabilidad, por lo cual, haré un uso adecuado del activo para el desempeño de mis funciones. En caso de cambio, extravió, daño, perdida o robo, me comprometo a informar de manera oportuna e inmediata al Área Administrativa o en su defecto denunciar a las autoridades competentes, de lo contrario me haré responsable de reponer el bien por otro de las mismas características (calidad y marca), en caso no reportar al área correspondiente asumiré las consecuencias económicas que conlleven la reposición del activo designado a mi persona, y de igual manera autorizó a la institución SERVICIO PLURINACIONAL DE DEFENSA PUBLICA a efectuar el descuento correspondiente al valor de reposición del activo afectado, deduciéndolo de mi salario.             

            </td>
        </tr>
          
       
    </table>






   
   
    
    <br><br><br><br>
    

    

    
</div>

<!--  <div style="page-break-after:always;"></div> -->

<div class="piedpagina" style="position: absolute; ">
    <table width="100%">        
        <tbody>
        <tr>
            <td align="center" style="width: 50%;">
                    .........................................................<p></p>      
                    <?php echo $empleado->empleado; ?><p></p>   
                   <b>RESPONSABLE DEL ACTIVO FIJO</b><p></p>   
            </td>
            <td align="center" style="width: 50%;">
                    .........................................................<p></p>      
                    <?php echo $firmas[2]['nombre']; ?><p></p>   
                   <b><?php echo $firmas[2]['cargo_f']; ?></b><p></p>   
            </td>
        </tr>
        
      
        
        </tbody>     
    </table>
</div>

</body>
</html>