<?php
include_once "../modelo/m_banco.php";
include_once "../modelo/m_usuario.php";
include_once "../modelo/m_credito.php";
    class c_adminPrincipal 
    {   
        public $usuarios = array();
        public $visitantes = array();
        public function __construct()
        {
            
        }
        public function datosBanco()
        {
             $consulta =  m_banco::getDatosBanco();
             $str_datos = "";
             while($fila = mysqli_fetch_array($consulta)) {
                $str_datos.='<tr>';
                $str_datos.= "<td>".$fila['4']."</td>";
                $str_datos.= "</tr>";
             }
             return $str_datos;
        }

        public function getUsuarios()
        {
            $consulta = m_usuario::getUsuarios();
            $str_datos = "";
            while($fila = mysqli_fetch_array($consulta)) {
                $this->usuarios[] = $fila;
             }
        }
        public function getVisitantes()
        {
            $consulta = m_credito::getVisitantes();
            $str_datos = "";
            while($fila = mysqli_fetch_array($consulta)) {
                $this->visitantes[] = $fila;
             }
        }
    }
?>