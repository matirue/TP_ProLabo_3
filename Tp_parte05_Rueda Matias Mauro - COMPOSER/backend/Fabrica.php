<?php

include_once("Empleado.php");
include_once("interfaces.php");


class Fabrica implements IArchivo{

    private $_cantidadMaxima;
    private $_empleados;
    private $_razonSocial;

    public function __construct($razonSocial, $cantidadMaxima=5){
        $this->_cantidadMaxima=$cantidadMaxima;
        $this->_empleados=array();
        $this->_razonSocial=$razonSocial;        
    }

    public function AgregarEmpleado($empleado):bool{
        if(is_a($empleado, "Empleado"))
        {
            if(count($this->_empleados) < $this->_cantidadMaxima)
            {
                array_push($this->_empleados, $empleado);
                $this->EliminarEmpleadosRepetidos();
                return true;
            }
        }
        return false;
    }

    public function CalcularSueldos(){        
        $total=0;
        foreach($this->_empleados as $aux){
            $total += $aux->GetSueldo();
        } 
        return $total;
    }

    public function EliminarEmpleado($empleado){
        foreach($this->_empleados as $key => $i){
            if($i == $empleado){
                unset($this->_empleados[$key]);//destruye la variable indicada
                return true;
            }
        }
        return false;
    }

    private function EliminarEmpleadosRepetidos(){
        $this->_empleados=array_unique($this->_empleados, SORT_REGULAR);//Elimina valores duplicados de un array - REGULAR: compara ítems normalmente
    }

    public function ToString(){
        $cadena = " Cantidad Maxima: " . $this->_cantidadMaxima . "<br> Razon Social: " . $this->_razonSocial . "<br> Lista de Empleados: ";

        foreach($this->_empleados as $aux){
            $cadena .= "<br>" . " >> " . $aux->GetLegajo() . " - " . $aux->GetApellido() . ", " . $aux->GetNombre() . " - " . $aux->GetDni() 
            . " - " . $aux->GetSexo() . " - " . $aux->GetSueldo() . " - " . $aux->GetTurno();
        }
        return $cadena;
    }

    /**Recibe el nombre del archivo de texto donde se guardarán los
    * empleados de la fábrica (empleados.txt). Recorre el array de Empleados y sobreescribe en
    *el archivo de texto, utilizando el método ToString.
    */
    function GuardarEnArchivo($nombreArchivo){
        $archivo = fopen($nombreArchivo, "w");

        if($archivo){
            foreach($this->_empleados as $emp){
                fwrite($archivo, $emp->ToString() . "\r\n");
            }
            fclose($archivo);
        }

    }

    /**
     * Recibe el nombre del archivo de texto donde se encuentran los empleados
     * (empleados.txt). Por cada registro leído, genera un objeto de tipo Empleado y lo agrega a la
     * fábrica (utilizando el método AgregarEmpleado), y tambien la foto de cada empleado
     */
    function TraerDeArchivo($nombreArchivo){
        if(is_file($nombreArchivo)){
            $cadena = "";
            $dato = array();
            $unEmpleado=null;
            $archivo = fopen($nombreArchivo, "r");

            if($archivo){
                while(!feof($archivo)){
                    $cadena = fgets($archivo);
                    $dato = explode(" - ", $cadena);
                    if(count($dato) > 2){
                        $unEmpleado = new Empleado($dato[1], $dato[0], $dato[2], $dato[3], $dato[4], $dato[5], $dato[6]);
                        $unEmpleado->SetPathFoto($dato[7]);//cargo la img
                        $this->AgregarEmpleado($unEmpleado);
                    }
                }
                fclose($archivo);
            }
        }  
    }


    public function GetEmpleado(){
        return $this->_empleados;
    }


}


?>