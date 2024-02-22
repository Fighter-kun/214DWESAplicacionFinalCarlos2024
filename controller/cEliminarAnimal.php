<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 16/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cEliminarAnimal' 
 * 
 */
// Estructura del botón cancelar, si el usuario pulsa el botón 'cancelar'
if (isset($_REQUEST['cancelarEliminar'])) {
    $_SESSION['paginaAnterior'] = 'eliminarAnimal'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de consultarAnimales
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

/*
 * Recuperamos el código del Animal seleccionado anteriormente por medio de una variable de sesión
 * Y usando el metodo 'buscarAnimalPorCod' de la clase 'AnimalPDO' recuperamos el objeto completo
 */
$oAnimalAEliminar = AnimalPDO::buscarAnimalPorCod($_SESSION['codAnimalActual']);

// Almaceno la información del Animal actual en las siguiente variables, para mostrarlas en el formulario
if ($oAnimalAEliminar) {
    $codAnimalAEliminar = $oAnimalAEliminar->getCodAnimal();
    $descAnimalAEliminar = $oAnimalAEliminar->getDescAnimal();
    $fechaNacimientoAEliminar = $oAnimalAEliminar->getFechaNacimiento();
    $sexoAEliminar = $oAnimalAEliminar->getSexo();
    $razaAEliminar = $oAnimalAEliminar->getRaza();
    $precioAEliminar = $oAnimalAEliminar->getPrecio();
    $fechaBajaAEliminar = $oAnimalAEliminar->getFechaBaja();
}

if (isset($_REQUEST['confirmarCambiosEliminar'])) { // Comprobamos que el usuario haya enviado el formulario para 'confirmar los cambios'
    // Y usando el metodo 'bajaFisicaAnimal' de la clase 'AnimalPDO' eliminamos el Animal
    AnimalPDO::bajaFisicaAnimal($_SESSION['codAnimalActual']);
    $_SESSION['paginaAnterior'] = 'eliminarAnimal'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de consultarAnimales
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}


require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'EliminarDepartamento'