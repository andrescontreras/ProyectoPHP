<?php
include_once "../modelo/m_credito.php";
class c_adminEditCredito
{
    public $datos;
    public $id_credito;
    public function __construct()
    {

    }
    public function getDatosCredito()
    {

        $this->tarjeta_c = $_GET["credito"];
        echo "ENTRO FUNCION11111111111111" . $this->tarjeta_c;
        $consulta = m_credito::getDatosCredito($this->tarjeta_c);
        $str_datos = "";
        while ($fila = mysqli_fetch_array($consulta)) {
            $this->datos = $fila;
        }
    }
    public function setDatosCredito( $interes, $estado, $id_credito)
    {
        echo "ENTRO FUNCION" . $this->tarjeta_c;
        m_credito::setDatosCredito( $interes ,$estado,$id_credito);
    }

}
?>