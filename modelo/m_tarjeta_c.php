<?php
class tarjeta_c {
    //Crea una tarjeta de credito
    public static function crearTCredito($id_cuenta){
        $conBD = new conexion();
        $sql = "INSERT INTO tarjeta_c (USUARIO,C_AHORRO,ESTADO) VALUES ("."'".$_SESSION["usuario"]."'".",$id_cuenta,'PENDIENTE')";
        return $conBD->ejecutarconsulta($sql);
    }
    //Devuelve el resultado de la busqueda de las tarjetas de credito asociadas a una cuenta de ahorro
    public static function tcreditoxCuentaAhorro(){
        $conBD = new conexion();
        $id_ahorro = $_SESSION['id_ahorro'];
        $sql ="SELECT * FROM tarjeta_c WHERE C_AHORRO = $id_ahorro";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function allTCredito(){
        $conBD = new conexion();
        $sql ="SELECT * FROM tarjeta_c";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function disminuir_saldo($monto,$id_TCredito){
        $conBD = new conexion();
        $sql = "UPDATE tarjeta_c SET SALDO = SALDO - $monto WHERE IDTARJETA_C =$id_TCredito";
        return $conBD->ejecutarconsulta($sql);
    }
}
?>