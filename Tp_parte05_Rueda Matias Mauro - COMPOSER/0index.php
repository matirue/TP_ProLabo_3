<?php

include_once("./backend/Fabrica.php");
include_once("./backend/Empleado.php");

$path = "./archivos/empleados.txt";
$modificar = false;

if(isset($_POST["hdnMod"]) ? TRUE:FALSE){
    $dni = $_POST["hdnMod"];
    $miFabrica = new Fabrica("Una Razon");
    $miFabrica->TraerDeArchivo($path);
    $empleados = $miFabrica->GetEmpleado();

    foreach($empleados as $emp){
        $empDni = $emp->GetDni();

        if($dni == $empDni){
            $empApellido = $emp->GetApellido();
            $empNombre = $emp->GetNombre();
            $empSexo = $emp->GetSexo();
            $empLegajo = $emp->GetLegajo();
            $empSueldo = $emp->GetSueldo();
            $empTurno = $emp->GetTurno();

            $modificar = true;
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./archivos/imagenes/sensible.png" rel="icon" type="image/png" />

    <?php
    if(!$modificar)
        echo '<title>HTML 5 - Formulario Alta Empleado</title>';
    else
        echo '<title>HTML 5 - Formulario para Modificar Empleado</title>';
    ?>  

    <script src="./Javascript/funciones.js"></script>
</head>
<body>
    
    <?php
    if(!$modificar)
        echo '<h2>Alta de Empleados</h2>';
    else
        echo '<h2>Modificar de Empleados</h2>';
    ?>  

    <form action="./backend/administracion.php" method="POST" id="form_ingreso" enctype="multipart/form-data">
        <table align="center">
            <tr>
                <td colspan="2">
                    <h4>Datos Personales</h4>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td> 
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td>DNI:</td>
                <td style="text-align: left;padding-left: 15px;">

                    <?php
                    if(!$modificar)
                        echo '<input type="number" name="txtDni" id="txtDni"  min="1000000" max="55000000" required>';
                    else
                        echo '<input type="number" name="txtDni" id="txtDni" value='. $empDni .' min="1000000" max="55000000" required>';
                    ?>                    

                    <span style="display: none;" id="spanDni">*</span>
                </td>
            </tr>
            <tr>
                <td>Apellido:</td>
                <td style="text-align: left;padding-left: 15px;">
               
                    <?php
                    if(!$modificar)
                        echo '<input type="text" name="txtApellido" id="txtApellido" minlength="1" required>';
                    else
                        echo '<input type="text" name="txtApellido" id="txtApellido" value=' . $empApellido . ' minlength="1" required>';
                    ?>  
                    
                    <span style="display: none;" id="spanApellido">*</span>
                </td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td style="text-align: left;padding-left: 15px;">
                
                    <?php
                    if(!$modificar)
                        echo '<input type="text" name="txtNombre" id="txtNombre" minlength="1" required>';
                    else
                        echo '<input type="text" name="txtNombre" id="txtNombre" value=' . $empNombre . ' minlength="1" required>';
                    ?>  
                    
                    <span style="display: none;" id="spanNombre">*</span>
                </td>
            </tr>
            <tr>
                <td>Sexo:</td>
                <td style="text-align: left;padding-left: 15px;">
                
                    <?php
                    if(!$modificar){
                        echo '
                            <select name="cboSexo" id="cboSexo">
                                <option value="---" selected="true">Seleccione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>';
                    }
                    else{
                        if($empSexo == "M"){
                            echo '
                            <select name="cboSexo" id="cboSexo">
                                <option value="---">Seleccione</option>
                                <option value="M" selected="true">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>';
                        }
                        if($empSexo == "F"){
                            echo '
                            <select name="cboSexo" id="cboSexo">
                                <option value="---">Seleccione</option>
                                <option value="M">Masculino</option>
                                <option value="F" selected="true">Femenino</option>
                            </select>';
                        }
                    }
                    ?> 

                    <span style="display: none;" id="spanSexo">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h4>Datos Laborales</h4>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td> 
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td>Legajo:</td>
                <td style="text-align: left;padding-left: 15px;">

                    <?php
                    if(!$modificar)
                        echo '<input type="number" name="txtLegajo" id="txtLegajo" min="100" max="550" size="5" required>';
                    else
                        echo '<input type="number" name="txtLegajo" id="txtLegajo" value=' . $empLegajo . ' min="100" max="550" size="5" required>';
                    ?> 
                    
                    <span style="display: none;" id="spanLegajo">*</span>
                </td>
            </tr>
            <tr>
                <td>Sueldo:</td>
                <td style="text-align: left;padding-left: 15px;">

                    <?php
                    if(!$modificar)
                        echo '<input type="number" name="txtSueldo" id="txtSueldo" min="8000" step="500" required>';
                    else
                        echo '<input type="number" name="txtSueldo" id="txtSueldo" value=' . $empSueldo . ' min="8000" step="500" required>';
                    ?> 
                    
                    <span style="display: none;" id="spanSueldo">*</span>
                </td>
            </tr>
            <tr>
                <td>Turno:</td>
            </tr>

            <?php
                if(!$modificar){
                    echo '
                    <tr>
                        <td></td>
                        <td>
                            <input type="radio" name="rdoTurno" id="rdoTurno" checked value="Mañana">Mañana
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="radio" name="rdoTurno" id="rdoTurno" value="Tarde">Tarde
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="radio" name="rdoTurno" id="rdoTurno" value="Noche">Noche
                        </td>
                    </tr>';
                }
                else{
                    if($empTurno == "Mañana"){
                        echo '
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" checked value="Mañana">Mañana
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" value="Tarde">Tarde
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" value="Noche">Noche
                            </td>
                        </tr>';
                    }
                    else if($empTurno == "Tarde"){
                        echo '
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" value="Mañana">Mañana
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" checked value="Tarde">Tarde
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" value="Noche">Noche
                            </td>
                        </tr>';
                    }
                    else if($empTurno == "Noche"){
                        echo '
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" value="Mañana">Mañana
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" value="Tarde">Tarde
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="radio" name="rdoTurno" id="rdoTurno" checked value="Noche">Noche
                            </td>
                        </tr>';
                    }
                }
            ?>
            
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="2">Foto: 
                    <input type="file" name="archivos" id="inputFile" accept="image/png, image/jpg, image/jpeg, image/bmp, image/gif" required>
                    <span style="display: none;" id="spanFile">*</span>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="2"><hr></td> 
            </tr>
            <tr>
                <td></td>
                <td align="right">
                    <input type="reset" value="Limpiar">
                </td>
            </tr>
            <tr>
                <td></td>
                <td align="right">

                    <?php
                    if(!$modificar)
                        echo '<input type="submit" onclick="AdministrarValidaciones()" value="Enviar">';
                    else{
                        echo '<input type="submit" onclick="AdministrarValidaciones()" value="Modificar">';
                        echo '<input type="hidden" name="hdnModificar" id="hiddenDni" value=' . $empDni . ' value="Modificar">';
                    }
                        
                    ?> 
                    
                </td>
            </tr>
        </table>

        <br><br>
        <h4>Atajos</h4>
        <a href="./Javascript/login.html"> >>> Login</a>
        <br>
        <a href="./backend/mostrar.php"> >>> Mostrar</a>


    </form>
    
</body>
</html>