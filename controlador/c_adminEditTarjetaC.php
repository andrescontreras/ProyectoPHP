<?php
include_once "../modelo/m_tarjeta_c.php";
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
    public function setDatosTarjeta($cuota_manejo, $cupo, $sobrecupo, $tasa_interes, $estado)
    {
        tarjeta_c::setDatosTarjeta($cuota_manejo, $cupo, $sobrecupo, $tasa_interes, $estado, $this->tarjeta_c);
    }

    }
?>