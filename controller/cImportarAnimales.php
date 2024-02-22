<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 22/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cImportarAnimales' 
 * 
 */

// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirImportar'])) {
    $_SESSION['paginaAnterior'] = 'importarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de consultarAnimales
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón importar, si el usuario pulsa el botón 'importar'
if (isset($_REQUEST['importarAnimales'])) { 
    $resultadoImportacion = AnimalPDO::importarAnimalesJSON();
}


require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'ImportarAnimales'