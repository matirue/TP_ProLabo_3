function AdministrarValidaciones() {
    var error = ""; //mensaje a mostar si hay un error
    AdministrarSpanError("spanApellido", ValidarCamposVacios(document.getElementById("txtApellido").value));
    AdministrarSpanError("spanApellido", ValidarCamposVacios(document.getElementById("txtNombre").value));
    /**********************************************************************************************************/
    var dni = parseInt(document.getElementById("txtDni").value);
    var dniMinimo = parseInt(document.getElementById("txtDni").min);
    var dniMaximo = parseInt(document.getElementById("txtDni").max);
    AdministrarSpanError("spanDni", ValidarRangoNumerico(dni, dniMinimo, dniMaximo));
    /**********************************************************************************************************/
    var valor = document.getElementById("cboSexo").value;
    var valorIncorrecto = "---";
    AdministrarSpanError("spanSexo", ValidarCombo(valor, valorIncorrecto));
    /**********************************************************************************************************/
    var legajo = parseInt(document.getElementById("txtLegajo").value);
    var legajoMinimo = parseInt(document.getElementById("txtLegajo").min);
    var legajoMaximo = parseInt(document.getElementById("txtLegajo").max);
    AdministrarSpanError("spanLegajo", ValidarRangoNumerico(legajo, legajoMinimo, legajoMaximo));
    /**********************************************************************************************************/
    var sueldo = parseInt(document.getElementById("txtSueldo").value);
    var sueldoMinimo = parseInt(document.getElementById("txtSueldo").min);
    var sueldoMaximo = ObtenerSueldoMaximo(ObtenerTurnoSeleccionado());
    AdministrarSpanError("spanSueldo", ValidarRangoNumerico(sueldo, sueldoMinimo, sueldoMaximo));
    /**********************************************************************************************************/
}
/**
 * Retorna true si no está vacío o false caso contrario.
 * @param cadena valor del atributo id del campo a ser validado
 */
function ValidarCamposVacios(cadena) {
    if (cadena.length > 0)
        return true;
    return false;
}
/**
 * Retorna true si el valor pertenece al rango o false caso contrario.
 * @param numero valor a ser validado
 * @param minimo valores mínimos
 * @param maximo máximos del rango.
 */
function ValidarRangoNumerico(numero, minimo, maximo) {
    if (numero >= minimo && numero <= maximo)
        return true;
    return false;
}
/**
 * Retorna true si no coincide o false caso contrario
 * @param cadena valor del atributo id del combo a ser validado
 * @param cadenaIncorrecta valor que no debe de tener
 */
function ValidarCombo(cadena, cadenaIncorrecta) {
    return cadena != cadenaIncorrecta;
}
/**
 * Retorna el valor del elemento (type=radio) seleccionado por el usuario
 */
function ObtenerTurnoSeleccionado() {
    //tomo todos los inputs
    var radio = document.getElementsByTagName("input");
    var seleccion = "";
    for (var index = 0; index < radio.length; index++) { //recorro los inputs
        var input = radio[index];
        if (input.type === "radio") { //verifica que sea de tipo radio
            if (input.checked === true) { //verifica que este seleccionado
                seleccion += input.value + "-";
            }
        }
    }
    seleccion = seleccion.substr(0, seleccion.length - 1); //elimino el ultimo -
    return seleccion;
}
/**
 * Retornará el valor del sueldo máximo.
 * @param cadena valor del turno elegido
 */
function ObtenerSueldoMaximo(cadena) {
    var ret = 0;
    switch (cadena) {
        case "Mañana":
            ret = 20000;
            break;
        case "Tarde":
            ret = 18500;
            break;
        case "Noche":
            ret = 25000;
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
function AdministrarSpanError(id, flag) {
    if (!flag)
        document.getElementById(id).style.display = "block";
    else
        document.getElementById(id).style.display = "none";
}
/**
 * Funcion que verifica los campos de logino Todo ok retorna true.
 */
function AdministrarValidacionesLogin() {
    var dni = parseInt(document.getElementById("txtDni").value);
    var dniMaximo = parseInt(document.getElementById("txtDni").max);
    var dniMinimo = parseInt(document.getElementById("txtDni").min);
    AdministrarSpanError("spanDni", ValidarRangoNumerico(dni, dniMinimo, dniMaximo));
    var apellido = document.getElementById("txtApellido").value;
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));
    if (document.getElementById("spanDni").style.display == "none") {
        if (document.getElementById("spanApellido").style.display == "none") {
            return true;
        }
    }
    return false;
}
function AdministrarModificar(dni) {
    document.getElementById("hiddenDni").value = dni;
    var form = document.getElementById("form");
    form.submit();
}
