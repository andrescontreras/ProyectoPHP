<?php
include ("modelo/m_conexion.php");
    class banco {
        

        public static function getDatosBanco()
        {
            $conBD = new conexion();
            $sql ="SELECT * FROM banco";
            return $conBD->ejecutarconsulta($sql);
        }
        public static function setC_manejo($cuota_manejo)
        {
            $conBD = new conexion();
            $conBD->conectarBD();
            $sql ="SELECT * FROM banco";
            $conBD->desconectarDB();

        }
        

        public static function setInteres($cuota_manejo)
        {
            
        }
        

        public static function setCosto_operacion($cuota_manejo)
        {
            
        }
        

    } 
?>