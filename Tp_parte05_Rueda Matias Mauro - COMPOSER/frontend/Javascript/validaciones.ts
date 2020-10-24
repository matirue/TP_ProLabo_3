
function AdministrarValidaciones():void{

    let error:string=""; //mensaje a mostar si hay un error

    AdministrarSpanError("spanApellido", ValidarCamposVacios((<HTMLInputElement>document.getElementById("txtApellido")).value));
    AdministrarSpanError("spanApellido", ValidarCamposVacios((<HTMLInputElement>document.getElementById("txtNombre")).value));
    
    /**********************************************************************************************************/
    
    let dni:number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).value);
    let dniMinimo:number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).min);
    let dniMaximo:number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).max);
    
    AdministrarSpanError("spanDni", ValidarRangoNumerico(dni, dniMinimo, dniMaximo));

    /**********************************************************************************************************/

    let valor:string=(<HTMLInputElement>document.getElementById("cboSexo")).value;
    let valorIncorrecto = "---";
    AdministrarSpanError("spanSexo", ValidarCombo(valor, valorIncorrecto));
    
    /**********************************************************************************************************/

    let legajo:number = parseInt((<HTMLInputElement>document.getElementById("txtLegajo")).value);
    let legajoMinimo:number = parseInt((<HTMLInputElement>document.getElementById("txtLegajo")).min);
    let legajoMaximo:number = parseInt((<HTMLInputElement>document.getElementById("txtLegajo")).max);
    AdministrarSpanError("spanLegajo", ValidarRangoNumerico(legajo, legajoMinimo, legajoMaximo));
    
    /**********************************************************************************************************/
    
    let sueldo:number = parseInt((<HTMLInputElement>document.getElementById("txtSueldo")).value);
    let sueldoMinimo:number = parseInt((<HTMLInputElement>document.getElementById("txtSueldo")).min);
    let sueldoMaximo:number = ObtenerSueldoMaximo( ObtenerTurnoSeleccionado() );
    AdministrarSpanError("spanSueldo", ValidarRangoNumerico(sueldo, sueldoMinimo, sueldoMaximo));
    
    /**********************************************************************************************************/   

}

/**
 * Retorna true si no está vacío o false caso contrario. 
 * @param cadena valor del atributo id del campo a ser validado
 */
function ValidarCamposVacios(cadena:string):boolean{
    if(cadena.length>0)
        return true;
    return false;
}

/**
 * Retorna true si el valor pertenece al rango o false caso contrario.
 * @param numero valor a ser validado 
 * @param minimo valores mínimos
 * @param maximo máximos del rango.
 */
function ValidarRangoNumerico(numero:number, minimo:number, maximo:number):boolean{
    if(numero >= minimo && numero <= maximo)
        return true;
    return false;
}

/**
 * Retorna true si no coincide o false caso contrario
 * @param cadena valor del atributo id del combo a ser validado
 * @param cadenaIncorrecta valor que no debe de tener
 */
function ValidarCombo(cadena:string, cadenaIncorrecta:string):boolean{
    return cadena != cadenaIncorrecta;
}

/**
 * Retorna el valor del elemento (type=radio) seleccionado por el usuario
 */
function ObtenerTurnoSeleccionado():string{
    //tomo todos los inputs
    let radio : HTMLCollectionOf<HTMLInputElement> = <HTMLCollectionOf<HTMLInputElement>>document.getElementsByTagName("input");
    let seleccion:string="";

    for (let index = 0; index < radio.length; index++) {//recorro los inputs
        let input = radio[index];
        
        if(input.type==="radio"){ //verifica que sea de tipo radio
            if(input.checked===true){ //verifica que este seleccionado
                seleccion += input.value + "-";
            }
        }
    }
    seleccion=seleccion.substr(0, seleccion.length-1); //elimino el ultimo -
    return seleccion;
}

/**
 * Retornará el valor del sueldo máximo.
 * @param cadena valor del turno elegido
 */
function ObtenerSueldoMaximo(cadena :string): number{
    let ret=0;

    switch(cadena){
        case "Mañana":
            ret=20000;
            break;

        case "Tarde":
            ret=18500;
            break;

        case "Noche":
            ret=25000;
            break;
    }
    return ret;
}


/**
 * Es la encargada de, según el parámetro booleano, ocultar o no al elemento 
 * cuyo id coincida con el parámetro de tipo string.
 * @param id input a tratar
 * @param flag boleano
 */
function AdministrarSpanError(id:string, flag:boolean): void{
    if(!flag)
        (<HTMLInputElement>document.getElementById(id)).style.display="block";
    else
        (<HTMLInputElement>document.getElementById(id)).style.display="none";
}

/**
 * Funcion que verifica los campos de logino Todo ok retorna true.
 */
function AdministrarValidacionesLogin():boolean{
    let dni:number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).value);
    let dniMaximo:number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).max);
    let dniMinimo:number = parseInt((<HTMLInputElement>document.getElementById("txtDni")).min);
    AdministrarSpanError("spanDni", ValidarRangoNumerico(dni, dniMinimo, dniMaximo));

    let apellido:string = (<HTMLInputElement>document.getElementById("txtApellido")).value;
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));

    if((<HTMLInputElement>document.getElementById("spanDni")).style.display=="none"){
        if((<HTMLInputElement>document.getElementById("spanApellido")).style.display=="none"){
            return true;
        }
    }
    return false;
}


function AdministrarModificar(dni:string):void{
    (<HTMLInputElement>document.getElementById("hiddenDni")).value = dni;
    let form:HTMLFormElement = <HTMLFormElement>document.getElementById("form");
    form.submit();
}