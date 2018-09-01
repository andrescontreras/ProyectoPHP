<?php
class c_ahorro {
    public static function setC_manejo($cuota_manejo)
    {
        
    }
    public static function crearCuentaAhorro($monto){
        $conBD = new conexion();
        $sql = "INSERT INTO c_ahorro (USUARIO,JAVECOINS) VALUES ("."'".$_SESSION['usuario']."'".",$monto)";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function retirarMonto(){
        $conBD = new conexion();
        //echo "SELECT * FROM c_ahorro WHERE Usuario ="."'".$_SESSION['usuario']."'";
        $sql = "SELECT * FROM c_ahorro WHERE USUARIO ="."'".$_SESSION['usuario']."'";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function disminuirJaveCoins($monto_cuenta,$pagar){
        $conBD = new conexion();
        $id_ahorro=$_SESSION['id_ahorro'];
        //echo "UPDATE c_ahorro SET JAVECOINS = $monto_cuenta-$pagar WHERE IDC_AHORRO = $id_ahorro";
        $sql = "UPDATE c_ahorro SET JAVECOINS = $monto_cuenta-$pagar WHERE IDC_AHORRO = $id_ahorro";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function buscarCAhorroxUsuario(){
        $conBD = new conexion();
        $id_usu=$_SESSION['usuario'];
        $sql = "SELECT * FROM c_ahorro WHERE USUARIO = $id_usu";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function allSelectAhorro(){
        $conBD = new conexion();
        $id_usu=$_SESSION['usuario'];
        $sql = "SELECT * FROM c_ahorro";
        return $conBD->ejecutarconsulta($sql);
        
    }
    public static function consignarMonto($pagar,$usuario_depositar){
        $conBD = new conexion();
        $id_usu=$_SESSION['usuario'];
        $sql = "UPDATE c_ahorro SET JAVECOINS = JAVECOINS + $pagar WHERE IDC_AHORRO =$usuario_depositar";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function allSelectAhorrobyUsuario(){
        $conBD = new conexion();
        $sql = "SELECT * FROM c_ahorro WHERE USUARIO ="."'".$_SESSION['usuario']."'";
        return $conBD->ejecutarconsulta($sql);
    }
}
?>