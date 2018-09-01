<?php
class c_ahorro {
    public static function setC_manejo($cuota_manejo)
    {
        
    }
    public static function crearCuentaAhorro($monto){
        $conBD = new conexion();
        $sql = "INSERT INTO c_ahorro (Usuario,JaveCoins) VALUES ("."'".$_SESSION['usuario']."'".",$monto)";
        return $conBD->ejecutarconsulta($sql);
    }
}
?>