<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 16/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cAltaDepartamento' 
 * 
 */
// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirAñadirDepartamento'])) {
    $_SESSION['paginaAnterior'] = 'altaDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón añadir departamento, si el usuario pulsa el botón 'añadir departameto'
if (isset($_REQUEST['recargarAñadirDepartamento'])) {
    $_SESSION['paginaEnCurso'] = 'altaDepartamento'; // Asigno a la página en curso la pagina de altaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Declaración de constantes por OBLIGATORIEDAD
define('OPCIONAL', 0);
define('OBLIGATORIO', 1);

// Declaración de los limites para el metodo comprobar FLOAT
define('TAM_MAX_FLOAT', PHP_FLOAT_MAX);
define('TAM_MIN_FLOAT', PHP_FLOAT_MIN);

$mensajeDeConfirmacion = ''; // Variable para almacenar un mensaje si a salido bien o mal la inserción de datos
// Declaración de variables de estructura para validar la ENTRADA de RESPUESTAS o ERRORES
// Valores por defecto
$entradaOK = true;

$aRespuestas = [
    'CodDepartamento' => "",
    'DescDepartamento' => "",
    'FechaCreacionDepartamento' => "",
    'VolumenDeNegocio' => "",
    'FechaBajaDepartamento' => ""
];

$aErrores = [
    'CodDepartamento' => "",
    'DescDepartamento' => "",
    'FechaCreacionDepartamento' => "",
    'VolumenDeNegocio' => "",
    'FechaBajaDepartamento' => ""
];

// Variable DateTime
$fechaYHoraActualCreacion = new DateTime('now', new DateTimeZone('Europe/Madrid'));
// Y formateo la variable '$fechaYHoraActualCreacion' para que aparezca en el input 'YYYY-mm-dd'
$fechaYHoraActualCreacionFormateada = $fechaYHoraActualCreacion->format('Y-m-d');

//En el siguiente if pregunto si el '$_REQUEST' recupero el valor 'enviar' que enviamos al pulsar el boton de enviar del formulario.
if (isset($_REQUEST['añadirDepartamento'])) {
    /*
     * Ahora inicializo cada 'key' del ARRAY utilizando las funciónes de la clase de 'validacionFormularios' , la cuál 
     * comprueba el valor recibido (en este caso el que recibe la variable '$_REQUEST') y devuelve 'null' si el valor es correcto,
     * o un mensaje de error personalizado por cada función dependiendo de lo que validemos.
     */
    //Introducimos valores en el array $aErrores si ocurre un error
    $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['CodDepartamento'], 3, 3, OBLIGATORIO);

    // Ahora validamos que el codigo introducido no exista en la BD, haciendo una consulta 
    if ($aErrores['CodDepartamento'] == null) {
        /*
         * Por medio del metodo 'validarCodNoExiste' de la clase 'DepartamentoPDO' comprobamos que el código no este en uso
         */
        if (DepartamentoPDO::validarCodNoExiste($_REQUEST['CodDepartamento'])) {
            $aErrores['CodDepartamento'] = "El código de departamento ya existe";
        }
    }
    $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 1, OBLIGATORIO);
    $aErrores['FechaCreacionDepartamento'] = NULL;
    $aErrores['VolumenDeNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['VolumenDeNegocio'], TAM_MAX_FLOAT, TAM_MIN_FLOAT, OBLIGATORIO);
    $aErrores['FechaBajaDepartamento'] = NULL;

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
//En caso de que '$entradaOK' sea true, cargamos las respuestas en el array '$aRespuestas'
if ($entradaOK) {
    // Usando el metodo 'altaDepartamento' de la clase 'DepartamentoPDO' añadimos el departamento
    DepartamentoPDO::altaDepartamento($_REQUEST['CodDepartamento'], $_REQUEST['DescDepartamento'], $_REQUEST['VolumenDeNegocio']);
    $_SESSION['paginaAnterior'] = 'añadirDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'AltaDepartamento'