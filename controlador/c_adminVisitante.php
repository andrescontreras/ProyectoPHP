<?php
include_once "../modelo/m_credito.php";
class c_adminVisitante
{
    public $tarjetas_c = array();
    public $creditos = array();
    public function __construct()
    {

    }

    public function getCreditos()
    {
        $id_visitante=  $_GET["visitante"];
        echo "CLIENTE: ".$id_visitante;
        $consulta = m_credito::getCreditosCliente($id_visitante);
            $str_datos = "";
            while($fila = mysqli_fetch_array($consulta)) {
                $this->creditos[] = $fila;
             }
    }
}
?>