<?php
include ("../modelo/m_banco.php");
    class c_adminPrincipal 
    {
        public static function datosBanco()
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
    }
?>