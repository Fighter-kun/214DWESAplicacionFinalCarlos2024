<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 31/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cTecnologias' 
 * 
 */

// Si el usuario pulsa el botón 'Salir', mando al usuario a la página 'inicioPublico'
if(isset($_REQUEST['salirDeTecnologias'])){
    if ($_SESSION['paginaAnterior'] != 'tecnologias') {
        $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior']; // Asigno a la pagina en curso la página anterior
    } else {
        $_SESSION['paginaEnCurso'] = 'inicioPublico'; // Asigno a la pagina en curso la página anterior
    }
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'WIP'