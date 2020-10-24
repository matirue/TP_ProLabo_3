<?php
include_once("./Empleado.php");
include_once("./Fabrica.php");
include_once("./verificarSesion.php");

$path = "../archivos/empleados.txt";
//$archivo = fopen($path, "r");
$miFabrica = new Fabrica("Una Razon", 15);
$listEmpleados = array();
$miFabrica->TraerDeArchivo($path);
$listEmpleados = $miFabrica->GetEmpleado();


echo ' 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../archivos/imagenes/listado.png" rel="icon" type="image/png" />
    <title>HTML 5 - Listado de Empleados</title>

    <script src="../frontend/Javascript/funciones.js"></script>

</head>
<body>
    <h2>Listado de Empleados</h2>
    <table align="center">
        <tr>
            <td>Info</td>
        </tr>
        <tr>
            <td><hr></td>
        </tr>
';
            foreach($listEmpleados as $emp){
                echo '<tr>' .
                    '<td>' .
                        $emp->ToString() . 
                    '</td>' .
                    '<td>' .
                        '<img src=' . $emp->GetPathFoto() . ' width="90" height="90">' . 
                    '</td>' .
                    '<td>' . 
                        '<a href="./eliminar.php?legajo=' . $emp->GetLegajo() . '">Eliminar</a><br>'.
                    '</td>'. 
                    '<td>' .
                        '<input type="button" id="btnModificar" value="Modificar" onclick="AdministrarModificar(' . $emp->GetDni() . ')">' . 
                    '</td>' .
                '</tr>';
            }
echo '  <tr>
            <td><hr></td>
        </tr>         
    </table>';
echo '

    <br><br> >>>>> ' . '<a href="./hacerPDF.php">Mostrar en PDF</a>' . ' <<<<<
    <br><br> >>>>> ' . '<a href="../0index.php">Cargar un nuevo empleado</a>' . ' <<<<<
    <br><br> >>>>> ' . '<a href="./cerrarSesion.php">Desloguearse</a>' . ' <<<<<
    

    <form id="form" method="POST" action="../index.php">
        <input type="hidden" id="hiddenDni" name="hdnMod">
    </form>';

echo'
</body>
</html>';

?>
