<?php
include ("m_conexion.php");
    class m_banco {
        

        public static function getDatosBanco()
        {
            $conBD = new conexion();
            $sql ="SELECT * FROM banco";
            return $conBD->ejecutarconsulta($sql);
        }
        public static function setDatosBAnco($cuota_manejo,$interes,$costo_operacion,$interes_mora,$nombreBanco,$nombreAnterior)
        {
            $sql = "UPDATE BANCO SET CUOTA_MANEJO = $cuota_manejo, INTERES = $interes, CUOTA_OPERACION = $costo_operacion, INTERES_MORA = $interes_mora, NOMBRE = '$nombreBanco' WHERE NOMBRE = '$nombreAnterior' ";

            $conBD = new conexion();
            return $conBD->ejecutarconsulta($sql);

        }
        
    } 
?>