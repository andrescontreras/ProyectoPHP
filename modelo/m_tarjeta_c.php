<?php
class tarjeta_c {

    public static function crearTCredito($id_cuenta){
        $conBD = new conexion();
        $sql = "INSERT INTO tarjeta_c (USUARIO,C_AHORRO,ESTADO) VALUES ("."'".$_SESSION["usuario"]."'".",$id_cuenta,'PENDIENTE')";
        return $conBD->ejecutarconsulta($sql);
    }
}
?>