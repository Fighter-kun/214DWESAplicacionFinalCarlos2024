<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 16/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cAltaAnimal' 
 * 
 */
// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirAñadirAnimal'])) {
    $_SESSION['paginaAnterior'] = 'altaAnimal'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de consultarAnimales
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}


$mensajeDeConfirmacion = ''; // Variable para almacenar un mensaje si a salido bien o mal la inserción de datos
// Declaración de variables de estructura para validar la ENTRADA de RESPUESTAS o ERRORES
// Valores por defecto
$entradaOK = true;

$aErrores = [
    'codAnimal' => "",
    'descAnimal' => "",
    'fechaNacimientoAnimal' => "",
    'sexoAnimal' => "",
    'razaAnimal' => "",
    'precioAnimal' => ""
];


// Variable DateTime
$fechaYHoraActualCreacion = new DateTime('now', new DateTimeZone('Europe/Madrid'));

// Modificar la fecha para obtener el día de mañana
$fechaYHoraMañana = clone $fechaYHoraActualCreacion;
$fechaYHoraMañana->modify('+1 day');

// Formatear la variable '$fechaYHoraManana' para que aparezca en el formato 'YYYY-mm-dd'
$fechaYHoraMañanaFormateada = $fechaYHoraMañana->format('Y-m-d');

//En el siguiente if pregunto si el '$_REQUEST' recupero el valor 'enviar' que enviamos al pulsar el boton de enviar del formulario.
if (isset($_REQUEST['añadirAnimal'])) {
    /*
     * Ahora inicializo cada 'key' del ARRAY utilizando las funciónes de la clase de 'validacionFormularios' , la cuál 
     * comprueba el valor recibido (en este caso el que recibe la variable '$_REQUEST') y devuelve 'null' si el valor es correcto,
     * o un mensaje de error personalizado por cada función dependiendo de lo que validemos.
     */
    //Introducimos valores en el array $aErrores si ocurre un error
    $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfanumerico($_REQUEST['codAnimal'], 3, 3, 1);

    // Ahora validamos que el codigo introducido no exista en la BD, haciendo una consulta 
    if ($aErrores['CodDepartamento'] == null) {
        /*
         * Por medio del metodo 'validarCodNoExiste' de la clase 'DepartamentoPDO' comprobamos que el código no este en uso
         */
        if (AnimalPDO::buscarAnimalPorCod($_REQUEST['codAnimal'])) {
            $aErrores['codAnimal'] = "El código de Animal ya existe";
        }
    }
    $aErrores['descAnimal'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descAnimal'], 255, 1, 1);
    $aErrores['fechaNacimientoAnimal'] = validacionFormularios::validarFecha($_REQUEST['fechaNacimientoAnimal'], $fechaYHoraMañanaFormateada, '01/01/2010', 1);
    $aErrores['razaAnimal'] = validacionFormularios::comprobarAlfabetico($_REQUEST['razaAnimal'], 255, 3, 1);
    $aErrores['precioAnimal'] = validacionFormularios::comprobarFloatMejorado($_REQUEST['precioAnimal'], 9999999999, 0, 2, 2, 1);
    
    if (!isset($_REQUEST['sexoAnimal'])) {$aErrores['sexoAnimal'] = "Debes elegir al menos 1 opción.";}
    

    /*
     * En este foreach recorremos el array buscando que exista NULL (Los metodos anteriores si son correctos devuelven NULL)
     * y en caso negativo cambiara el valor de '$entradaOK' a false y borrara el contenido del campo.
     */
    foreach ($aErrores as $campo => $error) {
        if ($error != null) {
            $_REQUEST[$campo] = "";
            $entradaOK = false;
        }
    }
} else {
    $entradaOK = false;
}
//En caso de que '$entradaOK' sea true
if ($entradaOK) {
    // Usando el metodo 'altaAnimal' de la clase 'AnimalPDO' añadimos el Animal
    $oAnimalNuevo = AnimalPDO::altaAnimal($_REQUEST['codAnimal'], $_REQUEST['descAnimal'], $_REQUEST['fechaNacimientoAnimal'], $_REQUEST['sexoAnimal'], $_REQUEST['razaAnimal'], $_REQUEST['precioAnimal']);
    if ($oAnimalNuevo) {
        $mensajeDeConfirmacion = "Se añadio a la Granja de manera correcta.";
    } else {
        $mensajeDeConfirmacion = "Error al añadir el animal.";
    }
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'AltaAnimal'