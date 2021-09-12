<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            background-color: black;
            color: white;
        }
        td {
            border-left: 1px solid white;
            border-right: 1px solid white;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php 
    
        require("../api/metodos/metodos.php"); 

      
    ?>

        <!--<form action="<?php //echo $_SERVER['PHP_SELF'];?>" method="post">-->
        <form action="../api/metodos/metodos.php" method="POST">
        <div>
            <input type="hidden" name="factura" value="afip">

            <label for="input">Documento</label>
            <input name="documento" class="input" type="number">
            <input name="concepto" class="input" type="text">

            <input type="submit" name="boton-enviar">
        </div>
        <table>
                <tr>
                    <th>DNI</th>
                    <th>CONCEPTO</th>
                    <th>PERIODO</th>
                    <th>IMPORTE</th>
                    <th>PROPIETARIO</th>
                    <th>PRIMER VENCIMIENTO</th>
                    <th>SEGUNDO VENCIMIENTO</th>
                    <th>TOTAL</th>
                </tr>
                <tr>
                    <td><?php  ?></td>
                    <td><?php  ?></td>
                    <td><?php  ?></td>
                    <td>$ <?php 

                    
                    Metodos::cambiarConcepto("concepto alteradisimo");
                    

                    ?></td>
                    <td><?php ?></td>
                    <td><?php ?></td>
                    <td><?php ?></td>
                    <td>$ <?php ?></td>
                </tr>
        </table>
        </form>

        <div>
            <?php //Afip::mostrarInformacion($documento) ?>
        </div>

</body>
</html>