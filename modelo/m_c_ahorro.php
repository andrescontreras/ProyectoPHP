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
    public static function retirarMonto(){
        $conBD = new conexion();
        //echo "SELECT * FROM c_ahorro WHERE Usuario ="."'".$_SESSION['usuario']."'";
        $sql = "SELECT * FROM c_ahorro WHERE Usuario ="."'".$_SESSION['usuario']."'";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function disminuirJaveCoins($monto_cuenta,$pagar){
        $conBD = new conexion();
        $id_ahorro=$_SESSION['id_ahorro'];
        //echo "UPDATE c_ahorro SET JAVECOINS = $monto_cuenta-$pagar WHERE IDC_AHORRO = $id_ahorro";
        $sql = "UPDATE c_ahorro SET JAVECOINS = $monto_cuenta-$pagar WHERE IDC_AHORRO = $id_ahorro";
        return $conBD->ejecutarconsulta($sql);
    }
}
?>