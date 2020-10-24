<?php
include_once("./Empleado.php");
include_once("./Fabrica.php");

//var_dump($_POST);

$path = "../archivos/empleados.txt";
$miFabrica = new Fabrica("Una Razon", 7);
$miFabrica->TraerDeArchivo($path);
$miEmpleado=null;
$pathDestino = "./fotos/" . $_FILES["archivos"]["name"];
$tipoArch = pathinfo($pathDestino, PATHINFO_EXTENSION);//obtengo la extension

if(strlen($_POST["hdnModificar"]) > 3){
    foreach($miFabrica->GetEmpleado() as $emp){
        if(strcmp($emp->GetDni(), $_POST["hdnModificar"]) == 0){
            $miFabrica->EliminarEmpleado($emp);
            break;
        }
    }
}


if(getimagesize($_FILES["archivos"]["tmp_name"])){//tomo el tamaño de la imagen
    if($tipoArch == "jpg" || $tipoArch == "bmp" || $tipoArch == "gif" || $tipoArch == "png" || $tipoArch == "jpeg" ){
        if($_FILES["archivos"]["size"] <= 1000000){//control del tamaño
            if(!file_exists($pathDestino)){//control de arch con mismo nombre
                $miEmpleado = new Empleado($_POST["txtNombre"], $_POST["txtApellido"], $_POST["txtDni"], $_POST["cboSexo"], $_POST["txtLegajo"], $_POST["txtSueldo"], $_POST["rdoTurno"]);
                $_FILES["Archivos"]["name"] = $_POST["txtDni"] . " - " . $_POST["txtApellido"] . " - " . $tipoArch;
                $pathDestino = "./fotos/" . $_FILES["archivos"]["name"];
                move_uploaded_file($_FILES["archivos"]["tmp_name"], $pathDestino);
                $miEmpleado->SetPathFoto($pathDestino);
            }
        }
    }
}




if($miFabrica->AgregarEmpleado($miEmpleado)){
    $miFabrica->GuardarEnArchivo($path);
    echo " <h4>Agregado exitosamente!!!!</h4>";
    echo '<br><br> >>>>> ' . '<a href="./mostrar.php">Mostrar</a>' . ' <<<<<';
}
else{
    echo " <h4>No se puedo cargar el empleado!!!!</h4>";
    echo '<br><br> >>>>> ' . '<a href="../index.php">Inicio</a>' . ' <<<<<';
}

 
?>