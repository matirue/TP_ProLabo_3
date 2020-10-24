<?php

use Mpdf\HTMLParserMode;

include "./Fabrica.php";
require_once('../vendor/autoload.php');
header('Conten-Type:application/pdf');

$mpdf = new \Mpdf\Mpdf([
                        'pagenumPrefix' => 'Página nro. ',
                        'pagenumSuffix' => ' - ',
                        'nbpgPrefix' => ' de ',
                        'nbpgSuffix' => ' páginas'
                    ]);

session_start();
$dni=$_SESSION["DNIEmpleado"];
$mpdf->SetProtection(array('copy'), $dni  , 'MyPassword');

$mpdf->SetHeader('RUEDA Matias Mauro||{PAGENO}{nbpg}');
$mpdf->setFooter('|LocalHost|');

$htmlMostrar=ArmarGrilla();
$mpdf->WriteHTML($htmlMostrar, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output("Empleados.pdf", "I");


function ArmarGrilla()
{
    $path = "../archivos/empleados.txt";
    $listaEmpleados = array();
    $unaFabrica = new Fabrica("Una Razon", 15);
    $unaFabrica->TraerDeArchivo($path);
    $listaEmpleados = $unaFabrica->GetEmpleado();
    $grilla="";
    $grilla .= '<body>
                        <h1>Listado de Empleados</h1>
                        <table>
                            <tr>
                                <td><hr></td>
                            </tr>';
                            foreach ($listaEmpleados as $unEmpleado) {
                                $grilla .= '<tr>
                                                    <td>' . $unEmpleado->ToString() .'</td>
                                                    <td> <img src=' . $unEmpleado->GetPathFoto() . 'width="90" height="90"> </td> </tr>';    }
                 $grilla .= '<tr>
                                <td><hr></td>
                            </tr>
                        </table>
                </body>';
    return $grilla;
}

?>