<?php
include_once "../modelo/m_credito.php";
include_once "../modelo/m_mensaje.php";
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
        //operacion
        m_credito::setDatosCredito( $interes ,$estado,$id_credito);
        // mensaje
        $usuario = $_SESSION['id_admin'];
        $mensaje = "el administrador $usuario ha $estado el credito con id $id_credito el dia ".date("Y-m-d H:i:s");
        m_mensaje::mensaje(-1, $this->datos[2], $mensaje);
        }
    }

}
?>