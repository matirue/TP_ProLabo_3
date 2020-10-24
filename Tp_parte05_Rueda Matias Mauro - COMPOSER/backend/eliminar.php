<?php

include_once("Empleado.php");
include_once("Fabrica.php");

$path = "../archivos/empleados.txt";
$archivo = fopen($path, "r");
$cadena = "";
$dato = array();
$esta = true;

if($archivo){
    while(!feof($archivo)){
        $cadena = fgets($archivo);
        $dato = explode(" - ", $cadena);

        if(count($dato) > 2){
            if(strcmp($dato[4], $_GET["legajo"]) == 0){//el indice 4 es el legajo
                $esta = true;
                break;
            }
        }
    }
    fclose($archivo);

    if($esta){
        $miEmpleado = new Empleado($dato[1], $dato[0], $dato[2], $dato[3], $dato[4], $dato[5], $dato[6]);
        $miEmpleado->SetPathFoto($dato[7]);

        $miFabrica = new Fabrica("Una Razon", 7);
        $miFabrica->TraerDeArchivo($path);

        if($miFabrica->EliminarEmpleado($miEmpleado)){
            $miFabrica->GuardarEnArchivo($path);
            echo "El empleado eliminado!!!";
        }
        else{
            echo "El empleado no fue eliminado!!!";
        }
    }
    else{
        echo "No se encontro al empleado!!!";
    }
    
}

echo '<br><br> >>>>>' . '<a href="./mostrar.php">Listar</a>' . '<<<<<';
echo '<br> >>>>>' . '<a href="../index.html">Inicio</a>' . '<<<<<';
?>