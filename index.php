<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 27/12/2023
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'index' 
 * 
 */
// Incluyo la configuracion de la app, la Base de Datos y los idiomas
require_once 'config/confAPP.php'; 
require_once 'config/confDBPDO.php'; 

// Creo/Recupero la sesión
session_start(); 

// Si no hay una pagina en curso dentro de la sesión
if(!isset($_SESSION['paginaEnCurso'])){ 
    $_SESSION['paginaEnCurso'] = 'inicioPublico'; // Asigno a la pagina en curso la pagina de 'inicioPublico'
}

if(isset($_REQUEST['tecnologias'])){ // Si desde el footer pulso el boton de tecnologias
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'tecnologias';
}

 if (!isset($_COOKIE['idioma'])) { // Comprobamos si la cookie esta declarada
   setcookie("idioma", "SP", time() + 2592000); // En caso negativo la creamos y ponemos el valor por defecto
   header('Location: index.php'); // Redirecciono al index de la APP
   exit();
}

if (isset($_REQUEST['botonIdioma'])) { // Comprobamos si el usuario a pulsado algún botón de idioma
    setcookie("idioma", $_REQUEST['botonIdioma'], time() + 2592000); // En caso afirmativo creamos la cookie y la cargamos con el valor seleccionado y ponemos una fecha de caducidad de 1 mes
    header('Location: index.php'); // Redirecciono al index de la APP
    exit();
}

require_once $aController[$_SESSION['paginaEnCurso']]; // Cargo la pagina en curso