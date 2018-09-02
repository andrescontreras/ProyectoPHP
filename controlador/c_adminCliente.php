<?php
include_once "../modelo/m_tarjeta_c.php";
include_once "../modelo/m_credito.php";
class c_adminCliente
{
    public $tarjetas_c = array();
    public $creditos = array();
    public function __construct()
    {

    }

    public function getTajetas_c()
    {
        $_SESSION['adminCliente'] =  $_GET["cliente"];
        $id_cliente =  $_GET["cliente"];
        echo "CLIENTE: ".$id_cliente;
        $consulta = tarjeta_c::getTarjetas_cCliente($id_cliente);
            $str_datos = "";
            while($fila = mysqli_fetch_array($consulta)) {
                $this->tarjetas_c[] = $fila;
             }
    }
    
    public function getCreditos()
    {
        $id_cliente =  $_GET["cliente"];
        echo "CLIENTE: ".$id_cliente;
        $consulta = m_credito::getCreditosCliente($id_cliente);
            $str_datos = "";
            while($fila = mysqli_fetch_array($consulta)) {
                $this->creditos[] = $fila;
             }
    }
}
?>