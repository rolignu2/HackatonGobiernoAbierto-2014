<?php
session_start();
if(isset($_SESSION['id']))
{
        unset($_SESSION['id']);
         unset($_SESSION['user']);
         unset($_SESSION['nombre']); 
         unset($_SESSION['facebook']);
         unset( $_SESSION['twitter']); 
         unset( $_SESSION['imagen']); 
         header("Location:index.php");
}

?>