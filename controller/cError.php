<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 03/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cError'
 * 
 */

// Si el usuario pulsa el botón 'Salir', mando al usuario a la página "anterior"
if(isset($_REQUEST['salirDelError'])){ 
    $_SESSION['paginaEnCurso'] = $_SESSION['error']->get_PaginaSiguiente(); // Asigno a la página en curso la página anterior
    unset($_SESSION['error']); // Cierro la sesión de error
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

if(isset($_SESSION['error'])){ 
    // Asigno a cada variable los datos almacenamos la variable se sesión 'error' 
    $sCodError = $_SESSION['error']->get_CodError(); // Código del error
    $sDescError = $_SESSION['error']->get_DescError(); // Descripción del error
    $sArchivoError = $_SESSION['error']->get_ArchivoError(); // Archivo donde ocurrio el error
    $iLineaError = $_SESSION['error']->get_LineaError(); // Línea en la cual se produjo el error
    
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'error'