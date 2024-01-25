<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 17/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cEliminarDepartamento' 
 * 
 */
// Estructura del botón cancelar, si el usuario pulsa el botón 'cancelar'
if (isset($_REQUEST['cancelarEliminar'])) {
    $_SESSION['paginaAnterior'] = 'eliminarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

/*
 * Recuperamos el código del departamento seleccionado anteriormente por medio de una variable de sesión
 * Y usando el metodo 'validarCodNoExiste' de la clase 'DepartamentoPDO' recuperamos el objeto completo
 */
$oDepartamentoAEliminar = DepartamentoPDO::buscaDepartamentoPorCod($_SESSION['codDepartamentoActual']);

// Almaceno la información del departamento actual en las siguiente variables, para mostrarlas en el formulario
if ($oDepartamentoAEliminar) {
    $codDepartamentoAEliminar = $oDepartamentoAEliminar->get_CodDepartamento();
    $descripcionDepartamentoAEliminar = $oDepartamentoAEliminar->get_DescDepartamento();
    $fechaCreacionDepartamentoAEliminar = $oDepartamentoAEliminar->get_FechaCreacionDepartamento();
    $volumenNegocioAEliminar = $oDepartamentoAEliminar->get_VolumenDeNegocio();
    $fechaBajaDepartamentoAEliminar = $oDepartamentoAEliminar->get_FechaBajaDepartamento();
}

if (isset($_REQUEST['confirmarCambiosEliminar'])) { // Comprobamos que el usuario haya enviado el formulario para 'confirmar los cambios'
    // Y usando el metodo 'bajaFisicaDepartamento' de la clase 'DepartamentoPDO' recuperamos el objeto completo
    DepartamentoPDO::bajaFisicaDepartamento($_SESSION['codDepartamentoActual']);
    $_SESSION['paginaAnterior'] = 'eliminarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}


require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'EliminarDepartamento'