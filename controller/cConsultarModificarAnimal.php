<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 10/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'editarAnimal' 
 * 
 */
// Estructura del botón cancelar, si el usuario pulsa el botón 'cancelar'
if (isset($_REQUEST['cancelarEditar'])) {
    $_SESSION['paginaAnterior'] = 'editarAnimal'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Declaracion de la variable de confirmación de envio de formulario correcto
$entradaOK = true;

// Declaramos el array de errores y lo inicializamos vacío
$aErrores['DescAnimal'] = '';
$aErrores['Precio'] = '';

/*
 * Recuperamos el código del Animal seleccionado anteriormente por medio de una variable de sesión
 * Y usando el metodo 'buscarAnimalPorCod' de la clase 'AnimalPDO' recuperamos el objeto completo
 */
$oAnimalAEditar = AnimalPDO::buscarAnimalPorCod($_SESSION['codAnimalActual']);

// Almaceno la información del Animal actual en las siguiente variables, para mostrarlas en el formulario
if ($oAnimalAEditar) {
    $codAnimalAEditar = $oAnimalAEditar->getCodAnimal();
    $descAnimalAEditar = $oAnimalAEditar->getDescAnimal();
    $fechaNacimientoAEditar = $oAnimalAEditar->getFechaNacimiento();
    $sexoAEditar = $oAnimalAEditar->getSexo();
    $razaAEditar = $oAnimalAEditar->getRaza();
    $precioAEditar = $oAnimalAEditar->getPrecio();
}

if (isset($_REQUEST['confirmarCambiosEditar'])) { // Comprobamos que el usuario haya enviado el formulario para 'confirmar los cambios'
    $aErrores['DescAnimal'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescAnimal'], 255, 3, 1);
    $aErrores['Precio'] = validacionFormularios::comprobarFloatMejorado($_REQUEST['Precio'], PHP_FLOAT_MAX, -PHP_FLOAT_MAX, 2, 2, 1);

// Recorremos el array de errores
    foreach ($aErrores as $campo => $error) {
        if ($error != null) { // Comprobamos que el campo no esté vacio
            $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario
            $_REQUEST[$campo] = ""; // Limpiamos los campos del formulario
        }
    }
} else {
    $entradaOK = false; // Si el usuario no ha enviado el formulario asignamos a entradaOK el valor false para que rellene el formulario
}
if ($entradaOK) { // Si el usuario ha rellenado el formulario correctamente 
    // Usando el metodo 'modificarAnimal' de la clase 'AnimalPDO' para modificar el Animal
    AnimalPDO::modificarAnimal($_SESSION['codAnimalActual'],$_REQUEST['DescAnimal'],$_REQUEST['Precio']);
    $_SESSION['paginaAnterior'] = 'editarAnimal'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'consultarModificarDepartamento'