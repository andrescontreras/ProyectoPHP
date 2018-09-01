<?php
include ("m_conexion.php");
    class banco {
        

        public static function getDatosBanco()
        {
            $conBD = new conexion();
            $sql ="SELECT * FROM banco";
            return $conBD->ejecutarconsulta($sql);
        }
        public static function setC_manejo($cuota_manejo)
        {
            
            $sql ="SELECT * FROM banco";
            

        }
        

        public static function setInteres($cuota_manejo)
        {
            
        }
        

        public static function setCosto_operacion($cuota_manejo)
        {
            
        }
        

    } 
?>