<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 22/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cREST' 
 * 
 */
//Si el usuario pulsa el botón 'salir'...
if (isset($_REQUEST['salirREST'])) {
    $_SESSION['paginaAnterior'] = 'apiREST'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'inicioPrivado'; // Asigno a la página en curso la pagina de inicioPrivado
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

$entradaOK = true;
// Declaramos el array de errores y lo inicializamos vacío
$aErrores = ['fechaImagen' => ''];
// Almaceno el valor de la fecha actual formateada
$fechaYHoraActualCreacion = new DateTime('now', new DateTimeZone('Europe/Madrid'));
$fechaYHoraActualFormateada = $fechaYHoraActualCreacion->format('Y/m/d');

$fechaActualFormateada = $fechaYHoraActualCreacion->format('Y-m-d');

// Si la variable no se a declarado, le doy un valor por defecto 
if (!isset($_SESSION['fechaApi'])) {
    $_SESSION['fechaApi'] = $fechaActualFormateada;
}

if (isset($_REQUEST['confirmarFechaREST'])) {
    // Valido la fecha
    $aErrores['fechaImagen'] = validacionFormularios::validarFecha($_REQUEST['fechaImagen'], $fechaYHoraActualFormateada, '06/16/1995', 1);

    // Recorremos el array de errores
    foreach ($aErrores as $campo => $error) {
        if ($error != null) { // Comprobamos que el campo no esté vacio
            $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario
            $_REQUEST[$campo] = ""; // Limpiamos los campos del formulario
        }
    }
} else {
    $entradaOK = false;
}
if ($entradaOK) {
    $_SESSION['fechaApi'] = $_REQUEST['fechaImagen'];
    $_SESSION['paginaAnterior'] = 'inicioPrivado'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'apiREST'; // Asigno a la página en curso la pagina de apiREST
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Si la variable no se a declarado, le doy un valor por defecto
if (!isset($_SESSION['casaSeleccionada'])) {
    $_SESSION['casaSeleccionada'] = "slytherin";
}

// Si pulso el botón 'Enviar Casa' en la Vista
if (isset($_REQUEST["pedirHP"])) {
    // Pregunto si el valor de request es el correcto
    if ($_REQUEST['casa'] == "gryffindor" || $_REQUEST['casa'] == "slytherin" || $_REQUEST['casa'] == "hufflepuff" || $_REQUEST['casa'] == "ravenclaw" ) {
        // Si el valor es correcto, cargo el valor de request dentro de una variable de sesión
        $_SESSION['casaSeleccionada'] = $_REQUEST['casa'];
        header('Location: index.php');
        exit; 
    } else {
        // Caso incorrecto cargo un mensaje de error
        $aErrores['casa'] = "Valor incorrecto, prueba con: gryffindor, slytherin, hufflepuff o ravenclaw";
    }
}

// Ejecuto las APIs con sus valores por defecto o valores correctos seleccionados por el usuario
$_SESSION['apiNasa'] = REST::apiNasa($_SESSION['fechaApi']);
$_SESSION['HP'] = REST::apiHarryPotter($_SESSION['casaSeleccionada']);


require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'REST'