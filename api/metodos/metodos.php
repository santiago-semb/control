<?php 

// config.php

$db_host="localhost";            
$db_name="control_gastos";
$db_user="root";
$db_password="";

// conexion.php

    class Conectar {
        public static function conexion() {

            try{
                $conexion=new PDO("mysql:host=localhost;dbname=control_gastos", "root", "");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexion->exec("SET CHARACTER SET utf8");
            }catch(Exception $e){
                die("Error: " . $e->getMessage());
                echo "Linea del error: " . $e->getLine();
            }
            return $conexion;
        }
    }  

// clase datos

class Datos {

    protected $dodocument;
    protected $fact;
    protected $nombre_tabla;
    protected $url;

    public static function dodocument() {
        // si se apreto el boton con el name="boton-enviar"
        if(isset($_POST["boton-enviar"])) {
            // entonces $dodocument es igual a lo que se haya escrito en el input con el name="documento"
            $dodocument = $_POST["documento"];
        }else{
            // si no se apreto el boton, entonces $dodocument es igual a 1
            $dodocument = 1;
        }
        // imprime $dodocument
        echo $dodocument;
    }
    public static function nombre_tabla() {
        // si se apreto el boton con el name="boton-enviar"
       if(isset($_POST["boton-enviar"])) {
           // entonces $fact es igual a lo que se haya escrito en el input con el name="factura"
           $fact = $_POST["factura"];
           // mientras que $nombre_tabla va a ser igual al string "factura_" + lo que se haya almacenado en $fact
           $nombre_tabla = "factura_" . $fact;
       }else{
           // sino, $fact tiene un valor por defecto, en este caso el string "factura_fallidas"
           $fact = "factura_fallidas";
           // la variable $nombre_tabla es igual a $fact ya que se encuentra dentro del else (no se cumple ninguna condicion)
           $nombre_tabla = $fact;
       }
       // imprime $nombre_tabla
        echo $nombre_tabla;
    }
    public static function concepto() {
        if(isset($_POST["boton-enviar"])) {

            $concepto = $_POST["concepto"];
            
        }else {

            $concepto = "concepto fallido";

        }
        echo $concepto;
    }

}

// clase afip

    class Metodos {
        
        //atributos

        private $dni;
        private $concepto;
        private $periodo;
        private $importe;
        private $propietario;
        private $fecha_vencimiento1;
        private $fecha_vencimiento2;
        private $total;

        //constructor

        public function __construct($dni,$concepto,$periodo,$importe,$propietario,$fecha_vencimiento1,$fecha_vencimiento2,$total) {
            $this->dni = $dni;
            $this->concepto = $concepto;
            $this->periodo = $periodo;
            $this->importe = $importe;
            $this->propietario = $propietario;
            $this->fecha_vencimiento1 = $fecha_vencimiento1;
            $this->fecha_vencimiento2 = $fecha_vencimiento2;
            $this->total = $total;
        }

        //metodos getter

        public function getInfo() {
            $info = "<h1>Informacion</h1>";
            $info.= "DNI: " . $this->dni;
            $info.= "Concepto: " . $this->concepto;
            $info.= "Periodo: " . $this->periodo;
            $info.= "Importe: $" . $this->importe;
            $info.= "Propietario: " . $this->propietario;
            $info.= "Primer vencimiento: " . $this->fecha_vencimiento1;
            $info.= "Segundo vencimiento: " . $this->fecha_vencimiento2;
            $info.= "Total: $" . $this->total;
            return $info;
        }

        public function getDocumento() {
            return "Documento: " . $this->dni;
        }
        public function getPeriodo() {
            return "Periodo: " . $this->periodo;
        }
        public function getConcepto() {
            return "Concepto: " . $this->modelo;
        }
        public function getImporte() {
            return "Importe: $" . $this->importe;
        }
        public function getPropietario() {
            return "Propietario: " . $this->propietario;
        }
        public function getPrimerVencimiento() {
            return "Primer vencimiento: " . $this->fecha_vencimiento1;
        }
        public function getSegundoVencimiento() {
            return "Segundo vencimiento: " . $this->fecha_vencimiento2;
        }
        public function getTotal() {
            return "Total: $" . $this->total;
        }

        //metodos setter

        public function setPeriodo($periodo) {
            $this->periodo = $periodo;
        }
        public function setConcepto($concepto) {
            $this->modelo = $concepto;
        }
        public function setImporte($importe) {
            $this->importe = $importe;
        }
        public function setPropietario($propietario) {
           $this->propietario = $propietario;
        }
        public function setPrimerVencimiento($vencimiento) {
            $this->fecha_vencimiento1 = $vencimiento;
         }
         public function setSegundoVencimiento($vencimiento) {
            $this->fecha_vencimiento2 = $vencimiento;
         }
        public function setTotal($total) {
            $this->total = $total;
        }

        //metodos sql getter

        public static function mostrarInformacion() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT * FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $documento = $fase["DNI"];
            $concepto = $fase["CONCEPTO"];
            $periodo = $fase["PERIODO"];
            $importe = $fase["IMPORTE"];
            $propietario = $fase["PROPIETARIO"];
            $fecha_vencimiento1 = $fase["VENCIMIENTO1"];
            $fecha_vencimiento2 = $fase["VENCIMIENTO2"];
            $total = $fase["TOTAL"];
            echo "<table>" +
                "<tr>" +
                    "<th>DNI</th>
                    <th>CONCEPTO</th>
                    <th>PERIODO</th>
                    <th>IMPORTE</th>
                    <th>PROPIETARIO</th>
                    <th>PRIMER VENCIMIENTO</th>
                    <th>SEGUNDO VENCIMIENTO</th>
                    <th>TOTAL</th>" +
                "</tr>" +
                "<tr>" + 
                    "<td>" + $documento + "</td>" +
                    "<td>" + $concepto + "</td>" +
                    "<td>" + $periodo + "</td>" +
                    "<td>" + $importe + "</td>" +
                    "<td>" + $propietario + "</td>" +
                    "<td>" + $fecha_vencimiento1 + "</td>" +
                    "<td>" + $fecha_vencimiento2 + "</td>" +
                    "<td>" + $total + "</td>" +
                "</tr>" +
                "</table>";

            
        }

        public static function mostrarDocumento() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT DNI FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $documento = $fase["DNI"];
            echo $documento;
        }
        public static function mostrarPeriodo() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT PERIODO FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $periodo = $fase["PERIODO"];
            echo $periodo;
        }
        public static function mostrarConcepto() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT CONCEPTO FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $concepto= $fase["CONCEPTO"];
            echo $concepto;
        }
        public static function mostrarImporte() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT IMPORTE FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $importe = $fase["IMPORTE"];
            echo $importe;
        }
        public static function mostrarPropietario() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT PROPIETARIO FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $propietario = $fase["PROPIETARIO"];
            echo $propietario;
        }
        public static function mostrarPrimerVencimiento() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT VENCIMIENTO1 FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $primer_vencimiento = $fase["VENCIMIENTO1"];
            echo $primer_vencimiento;
        }
        public static function mostrarSegundoVencimiento() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT VENCIMIENTO2 FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $segundo_vencimiento = $fase["VENCIMIENTO2"];
            echo $segundo_vencimiento;
        }
        public static function mostrarTotal() {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "SELECT TOTAL FROM $nombre_tabla WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $fase = $resulset->fetch(PDO::FETCH_ASSOC);
            $total = $fase["TOTAL"];
            echo $total;
        }

        //metodos sql setter

        public static function cambiarDocumento($documento, $nombreCompleto) {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $query = "UPDATE $nombre_tabla SET DNI=$documento WHERE PROPIETARIO='$nombreCompleto'";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            $documento = Metodos::$dni;
            $documento = $resulset;
            return $resulset;
        }
        public static function cambiarConcepto($concepto) {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $dodocument = Datos::dodocument();
            $query = "UPDATE $nombre_tabla SET CONCEPTO='$concepto' WHERE DNI=$dodocument";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            return $resulset;
        }
        public static function cambiarPeriodo($periodo, $dni) {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $query = "UPDATE $nombre_tabla SET PERIODO='$periodo' WHERE DNI=$dni";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            return $resulset;
        }
        public static function cambiarImporte($importe, $dni) {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $query = "UPDATE $nombre_tabla SET IMPORTE=$importe WHERE DNI=$dni";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            return $resulset;
        }
        public static function cambiarPropietario($propietario, $dni) {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $query = "UPDATE $nombre_tabla SET PROPIETARIO='$propietario' WHERE DNI=$dni";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            return $resulset;
        }
        public static function cambiarPrimerVencimiento($vencimiento, $dni) {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $query = "UPDATE $nombre_tabla SET VENCIMIENTO1='$vencimiento' WHERE DNI=$dni";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            return $resulset;
        }
        public static function cambiarSegundoVencimiento($vencimiento, $dni) {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $query = "UPDATE $nombre_tabla SET VENCIMIENTO2='$vencimiento' WHERE DNI=$dni";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            return $resulset;
        }
        public static function cambiarTotal($total, $dni) {
            $conexion = Conectar::conexion();
            $nombre_tabla = Datos::nombre_tabla();
            $query = "UPDATE $nombre_tabla SET TOTAL=$total WHERE DNI=$dni";
            $resulset = $conexion->prepare($query);
            $resulset->execute();
            return $resulset;
        }
        


    }

    Datos::dodocument();
    Datos::nombre_tabla();
    Datos::concepto();

?>