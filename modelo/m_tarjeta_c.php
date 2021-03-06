<?php
include_once "../modelo/m_conexion.php";
class tarjeta_c {
    //Crea una tarjeta de credito
    public static function crearTCredito($id_cuenta){
        $conBD = new conexion();
        $sql = "INSERT INTO tarjeta_c (USUARIO,C_AHORRO,ESTADO,SALDO) VALUES ("."'".$_SESSION["usuario"]."'".",$id_cuenta,'EN ESPERA',0)";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function getTarjetas_cCliente($id_usuario){
        $conBD = new conexion();
        $sql = "SELECT * FROM tarjeta_c WHERE usuario = $id_usuario ";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function getDatosTarjeta($id_tarjeta)
    {
        $conBD = new conexion();
        $sql = "SELECT * FROM tarjeta_c WHERE IDTARJETA_C= $id_tarjeta ";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function setDatosTarjeta($cuota_manejo, $cupo, $sobrecupo, $tasa_interes, $estado,$id_tarjeta){
        $conBD = new conexion();
        echo "<h1> ESSSS:".$id_tarjeta."</h1>";
        $sql = "UPDATE tarjeta_c SET CUOTA_MANEJO = $cuota_manejo, CUPO = $cupo, SOBRECUPO = $sobrecupo, TASA_INTERES = $tasa_interes, ESTADO = '$estado' WHERE IDTARJETA_C =$id_tarjeta";
        return $conBD->ejecutarconsulta($sql);
    }
    //Devuelve el resultado de la busqueda de las tarjetas de credito asociadas a una cuenta de ahorro
    public static function tcreditoxCuentaAhorro(){
        $conBD = new conexion();
        $id_ahorro = $_SESSION['id_ahorro'];
        $sql ="SELECT * FROM tarjeta_c WHERE C_AHORRO = $id_ahorro";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function tCreditoAsociada($id_ahorro){
        $conBD = new conexion();
        $sql ="SELECT * FROM tarjeta_c WHERE C_AHORRO = $id_ahorro AND ESTADO = 'APROBADO'";
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
    public static function obtenerSaldo($id_tarjetaC){
        $conBD = new conexion();
        $sql ="SELECT * FROM tarjeta_c WHERE IDTARJETA_C = $id_tarjetaC";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function aumentar_saldo($monto){
        $conBD = new conexion();
        $id_tarjeta = $_SESSION['id_credito'];
        $sql = "UPDATE tarjeta_c SET SALDO = SALDO + $monto WHERE IDTARJETA_C = $id_tarjeta";
        return $conBD->ejecutarconsulta($sql);
    }

}
?>