<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .header {
            text-align: center;
            border-bottom: 2px solid black; 
        }
        .form {
            margin-bottom: 25px;
        }
        .input-dni {
            width: 250px;
        }
    </style>
</head>
<body>

    <?php require("../api/metodos/metodos.php"); ?>

        <header class="header">
            <h2>Eliminar registros</h2>
            <form action="../api/bbdd/eliminar_registros.php" method="POST" class="form">
            <input type="hidden" name="url" value="afip">
                <input type="number" class="input-dni" name="dni-delete" placeholder="Documento del registro a eliminar" required>
                <input type="submit" value="Enviar">
            </form>

            <a href="../web/index.php"><button>Inicio</button></a>
        </header>


        <div>
            <?php Metodos::mostrarInformacion(); ?>
        </div>








</body>
</html>