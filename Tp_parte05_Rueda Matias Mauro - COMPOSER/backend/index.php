<?php
include_once("Empleado.php");


$emp1 = new Empleado("Ana", "Rodriguez", 12345678, "f", 100, 111111, "Mañana");
$emp2 = new Empleado("Juan", "Martinez", 87654321, "m", 200, 222222, "Tarde");
$emp3 = new Empleado("Juana", "Gonzales", 13578234, "m", 300, 333333, "Noche");

echo "<h3>Test de Fc. Hablar: </h3>"  . $emp1->Hablar("Español, Ingles, Frances");
echo "<br><br>" . "<h3>Test de ToString: </h3>" . $emp2->ToString() . "<br>" . $emp3->ToString(); 
echo "<h3>Test de ambas Fc: </h3>" . $emp1->ToString() . " - " . $emp1->Hablar("Español, Ingles, Frances");


include_once("Fabrica.php");

$fab = new Fabrica("Una Razon social");

echo "<br><br> 
<hr>
<h3>Test de Clase Fabrica: </h3>";

$fab->AgregarEmpleado($emp1);
$fab->AgregarEmpleado($emp2);
$fab->AgregarEmpleado($emp3);
echo "<h4>Listo contenido de fabrica:</h4>" . $fab->ToString();

$fab->AgregarEmpleado($emp2);
$fab->AgregarEmpleado($emp3);
$fab->AgregarEmpleado($emp3);
echo "<br><h4>Listo contenido de fabrica sin repetir un mismo contenido:</h4>" . $fab->ToString();

$fab->EliminarEmpleado($emp3);
echo "<br><h4>Listo contenido de fabrica eliminando al empleado 3:</h4>" . $fab->ToString();

echo "<br><br>  <a href='./cerrarSesion.php'>Desloguear</a>";


?>