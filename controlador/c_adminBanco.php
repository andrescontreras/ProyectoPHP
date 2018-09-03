<?php
include("../modelo/m_banco.php");
class c_adminBanco
{
    public $cuota_manejo; // conexion de la base de datos
    public $interes;
    public $costo_operacion;
    public $interes_mora;
    public $nombreBanco;

    public function __construct()
    {

    }

    function getDatosBanco()
    {
        $consulta = m_banco::getDatosBanco();
        $str_datos = "";
        while ($fila = mysqli_fetch_array($consulta)) {
            $this->cuota_manejo = $fila['0'];
            $this->interes = $fila['1'];
            $this->costo_operacion = $fila['2'];
            $this->interes_mora = $fila['3'];
            $this->nombreBanco = $fila['4'];
        }

    }

    function setDatosbanco($cuota_manejo, $interes, $costo_operacion, $interes_mora, $nombreBanco)
    {
        $consulta = m_banco::getDatosBanco();
        $str_datos = "";
        while ($fila = mysqli_fetch_array($consulta)) {
            $this->nombreBanco = $fila['4'];
        }
        
        $bandera = true;
        if (!is_numeric($cuota_manejo)) {
            echo "<div class='alert alert-danger' role='alert'>
            Cuota manejo debe ser numerico
          </div>";
            $bandera = false;
        }
        
        if (!is_numeric($interes)) {
            echo "<div class='alert alert-danger' role='alert'>
            Interes debe ser numerico
          </div>";
            $bandera = false;
        }
        
        if (!is_numeric($costo_operacion)) {
            echo "<div class='alert alert-danger' role='alert'>
            Costo operacion debe ser numerico
          </div>";
            $bandera = false;
        }
        
        if (!is_numeric($interes_mora)) {
            echo "<div class='alert alert-danger' role='alert'>
            Interes mora debe ser numerico
          </div>";
            $bandera = false;
        }

        if (empty($nombreBanco)) {
            echo "<div class='alert alert-danger' role='alert'>
            Nombre no debe quedar vacio
          </div>";
            $bandera = false;
        }

        if ($bandera) {
            echo "<div class='alert alert-success' role='alert'>
            Se actualizaron los datos correctamente
          </div>";
            echo m_banco::setDatosBanco($cuota_manejo, $interes, $costo_operacion, $interes_mora, $nombreBanco, $this->nombreBanco);
            echo "ENTRO A  LA FUNCION";
        }
    }
}
?>