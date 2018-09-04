<?php
include_once "../modelo/m_tarjeta_c.php";
include_once "../modelo/m_mensaje.php";
    class c_adminEditTarjetaC{
        public $usuario;
        public $tarjeta_c;
        public $datos;
        public function __construct()
    {

    }
    public function getDatosTarjeta()
    {
        
        $this->tarjeta_c  = $_GET["tarjeta_c"];
        
        $consulta = tarjeta_c::getDatosTarjeta($this->tarjeta_c);
            $str_datos = "";
            while($fila = mysqli_fetch_array($consulta)) {
                $this->datos = $fila;
             }
    }
    public function setDatosTarjeta($cuota_manejo, $cupo, $sobrecupo, $tasa_interes, $estado, $id_tarjeta)
    {
        $bandera = true;
        if(!is_numeric($cuota_manejo))
        {
            echo "<div class='alert alert-danger' role='alert'>
            Cuota manejo debe ser numerico
          </div>";
          $bandera = false;
        }
        if(!is_numeric($cupo))
        {
            echo "<div class='alert alert-danger' role='alert'>
            Cupo debe ser numerico
          </div>";
          $bandera = false;
        }
        if(!is_numeric($sobrecupo))
        {
            echo "<div class='alert alert-danger' role='alert'>
            Sobrecupo debe ser numerico
          </div>";
          $bandera = false;
        }
        if(!is_numeric($tasa_interes))
        {
            echo "<div class='alert alert-danger' role='alert'>
            Tasa interes debe ser numerico
          </div>";
          $bandera = false;
        }

        if($bandera)
        {
            echo "<div class='alert alert-success' role='alert'>
            Se actualizaron los datos correctamente
          </div>";
            // operacion
            tarjeta_c::setDatosTarjeta($cuota_manejo, $cupo, $sobrecupo, $tasa_interes, $estado, $id_tarjeta);
            // mensaje
            $usuario = $_SESSION['id_admin'];
            $mensaje = "el administrador $usuario ha $estado la tarjeta de credito con id $id_credito el dia ".date("Y-m-d H:i:s");
            m_mensaje::mensaje(-1,$this->datos[2],$mensaje);
        }
        
    }

    }
?>