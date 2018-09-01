<?php
    include ("../modelo/m_banco.php");
    class c_adminBanco 
    {
        public $cuota_manejo; // conexion de la base de datos
        public $interes;
        public $costo_operacion;
        public $interes_mora;
        public $nombreBanco;

        public function __construct()
        {
            
        }

        function getDatosBanco()
        {
             $consulta =  m_banco::getDatosBanco();
             $str_datos = "";
             $this->interes = 0;
             while($fila = mysqli_fetch_array($consulta)) {
                $this->cuota_manejo = $fila['0'];
                $this->interes = $fila['1'];
                $this->costo_operacion = $fila['2'];
                $this->interes_mora = $fila['3'];
                $this->nombreBanco = $fila['4'];
             }
            
        }

        function setDatosbanco($cuota_manejo,$interes,$costo_operacion,$interes_mora,$nombreBanco)
        {
            
        }
    }
?>