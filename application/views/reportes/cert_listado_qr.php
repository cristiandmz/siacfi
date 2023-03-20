<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
    <title>Reporte de Activos</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }

        body {
            margin: 15px;
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
            margin: 15px;
        }

        .invoice h3 {
            margin-left: 15px;
        }

        

        .information .logo {
            margin: 10px;
        }

        .information table {
            padding: 10px;
        }
        .codigo  {
            font-size: 10px;
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
            <td>
                Fecha: <?php echo $fecha; ?> 
            </td>
        </tr>
        <tr>
            <td align="center" style="width: 25%;">
    
                <br>
            COMANDO GENERAL DEL EJERCITO <br>  
            DEPARTAMENTO I – ADM. RR. HH. <br>
            <u>BOLIVIA</u>
                    <br>
                    <p>
                        <b>ETIQUETAS QR DE ACTIVOS FIJOS</b>
                    </p>
                
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
                        <br>
                      <img src="<?php echo base_url(); ?>public/assets/images/reporte/logoqr.png" alt="Logo" width="60" class="logo"/>
                      <br>
                      <?php echo $row->unidad ?>
                      <br>
                      <?php echo $row->oficina ?>
                      <br>
                      <?php echo $row->codigo ?>
                  </td>
                  <td>
                      <img src="<?php echo base_url(); ?>images/<?php echo $row->activo_id.'.png';?>" alt="Logo" width="80" class="logo"/> 
                  </td>
                  
            </tr>
            
            

            
                <?php 
            } ?>
        </tbody>
    </table>
</div>



</body>
</html>