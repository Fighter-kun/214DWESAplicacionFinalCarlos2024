<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 17/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cRehabilitacionDepartamento' 
 * 
 */
/*
 * Recuperamos el código del departamento por medio de una variable de sesión y 
 * buscamos el Departamento usando la clase 'buscaDepartamentoPorCod' de la clase DepartamentoPDO
 */
$oDepartamentoAlta = DepartamentoPDO::buscaDepartamentoPorCod($_SESSION['codDepartamentoActual']);

// Ahora pregunto si su valor es distinto de 'NULL'
if (!is_null($oDepartamentoAlta->get_FechaBajaDepartamento())) {
    // En caso positivo le cambio el valor usando el metodo 'rehabilitaDepartamento' de la clase DepartamentoPDO
    DepartamentoPDO::rehabilitaDepartamento($_SESSION['codDepartamentoActual']); 
}

$_SESSION['paginaAnterior'] = 'altaDepartamento'; // Almaceno la página anterior para poder volver
$_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
header('Location: index.php'); // Redirecciono al index de la APP
exit;
