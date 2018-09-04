<?php
  session_start();
  if (isset($_SESSION["id_admin"]))
  {
    header('Location: v_adminPrincipal.php');
  }else
  {
    header('Location: v_clientePrincipal.php');
  }
?>
