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
$fechaYHoraActualFormateada = $fechaYHoraActualCreacion->format('Y-m-d H:i:s');

if (isset($_REQUEST['confirmarFechaREST'])) {


    // Valido la sintaxis del usuario y contraseña introducidos
    $aErrores['fechaImagen'] = validacionFormularios::validarFecha($_REQUEST['fechaImagen'], $fechaYHoraActualFormateada, '01/01/2010', 1);

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
    $_SESSION['apiNasa'] = REST::apiNasa($_REQUEST['fechaImagen']);
    $_SESSION['paginaAnterior'] = 'inicioPrivado'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'apiREST'; // Asigno a la página en curso la pagina de apiREST
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}



require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'REST'