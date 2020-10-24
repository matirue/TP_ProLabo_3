<?php
session_start();
//verifico si existe o no (si no existe lo mando al login)
if(isset($_SESSION["DNIEmpleado"]) ==  false)
    header("LOCATION: ../frontend/login.html");
?>