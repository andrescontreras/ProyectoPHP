<?php
include ("m_conexion.php");
    class m_banco {
        

        public static function getDatosBanco()
        {
            $conBD = new conexion();
            $sql ="SELECT * FROM banco";
            return $conBD->ejecutarconsulta($sql);
        }
        public static function setDatosBAnco()
        {
            $sql = "";
        }
        
    } 
?>