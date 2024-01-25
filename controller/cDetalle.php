<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 10/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cDetalle'
 * 
 */

//Si el usuario pulsa el botón 'Salir', mando al usuario al index de DWES
if(isset($_REQUEST['salirTecnologias'])){ 
    $_SESSION['paginaEnCurso'] = 'inicioPrivado'; // Asigno a la página en curso la pagina de inicioPrivado
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'detalle' 