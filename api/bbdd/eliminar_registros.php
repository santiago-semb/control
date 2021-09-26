<?php 

    require("../conexion/conexion.php");
    $base = Conectar::conexion();

    $dni = $_POST["dni-delete"];

    $nom = $_POST["url"];
    
    $nombre_tabla = "factura_" . $nom;

    $sql = "DELETE FROM $nombre_tabla WHERE DNI=$dni";
    $resultado = $base->prepare($sql);
    $resultado->execute();

    header("Location:../../web/" . $nom . ".php");

?>