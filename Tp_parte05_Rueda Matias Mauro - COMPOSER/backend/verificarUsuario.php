<?php
$path = "../archivos/empleados.txt";
$archivos = fopen($path, "r");
$cadena = "";
$dato = array();
$esta = false;

if($archivos){
    while(!feof($archivos)){
        $cadena = fgets($archivos);
        $dato = explode(" - ", $cadena);        

        if(count($dato) > 2){
            $dni = $dato[2];
            $apellido = $dato[0];
            
            if($_POST["txtDni"] == $dni && (strcasecmp($_POST["txtApellido"], $apellido) == 0 )){
                $esta = true;

                session_start();
                //DNIEmpleado permitirá saber si un visitante está identificado o no, y con esta información
                //determinar si puede acceder a una página de nuestro sitio o no
                $_SESSION["DNIEmpleado"] = $dni;
            
                break;
            }
        }
    }
}

if($esta)
    header("LOCATION: ./mostrar.php");//header envia un encabezado sin formato http - location devuelve tmb el status
else{
    echo "Error!, no se encuentra al Empleado";
    echo "<br><br> <a href='../frontend/login.html'>Volver al Login</a>";
}
    
?>