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
        $consulta = m_credito::getDatosCredito($this->tarjeta_c);
        $str_datos = "";
        while ($fila = mysqli_fetch_array($consulta)) {
            $this->datos = $fila;
        }
    }
    public function setDatosCredito( $interes, $estado, $id_credito)
    {
        $bandera = true;
        if(!is_numeric($interes))
        {
            echo "<div class='alert alert-danger' role='alert'>
            Interes debe ser numerico
          </div>";
          $bandera = false;
        }
        if($bandera)
        {
            echo "<div class='alert alert-success' role='alert'>
            Se actualizaron los datos correctamente
          </div>";
        echo "ENTRO FUNCION" . $this->tarjeta_c;
        //m_credito::setDatosCredito( $interes ,$estado,$id_credito);
        }
    }

}
?>