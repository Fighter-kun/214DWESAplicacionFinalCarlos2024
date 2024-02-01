<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 27/12/2023
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cInicioPublico'
 * 
 */

// Si el usuario pulsa el botón 'Iniciar Sesión', mando al usuario a la página del login
if(isset($_REQUEST['login'])){ 
    $_SESSION['paginaEnCurso'] = 'login'; // Asigno a la pagina en curso la pagina de login
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}
 
require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'inicioPublico' 