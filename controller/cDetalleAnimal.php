<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 19/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cDetalleAnimal' 
 * 
 */
// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirDetalle'])) {
    $_SESSION['paginaAnterior'] = 'detalleAnimal'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de consultarAnimales
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

/*
 * Recuperamos el código del Animal seleccionado anteriormente por medio de una variable de sesión
 * Y usando el metodo 'buscarAnimalPorCod' de la clase 'AnimalPDO' recuperamos el objeto completo
 */
$oAnimalAMostrar = AnimalPDO::buscarAnimalPorCod($_SESSION['codAnimalActual']);

// Almaceno la información del Animal actual en las siguiente variables, para mostrarlas en el formulario
if ($oAnimalAMostrar) {
    $codAnimalAMostrar = $oAnimalAMostrar->getCodAnimal();
    $descAnimalAMostrar = $oAnimalAMostrar->getDescAnimal();
    $fechaNacimientoAMostrar = $oAnimalAMostrar->getFechaNacimiento();
    $sexoAMostrar = $oAnimalAMostrar->getSexo();
    $razaAMostrar = $oAnimalAMostrar->getRaza();
    $precioAMostrar = $oAnimalAMostrar->getPrecio();
    $fechaBajaAMostrar = $oAnimalAMostrar->getFechaBaja();
}


require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'EliminarDepartamento'