<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 17/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cBajaLogicaDepartamento' 
 * 
 */
/*
 * Recuperamos el código del departamento por medio de una variable de sesión y 
 * buscamos el Departamento usando la clase 'buscaDepartamentoPorCod' de la clase DepartamentoPDO
 */
$oDepartamentoBaja = DepartamentoPDO::buscaDepartamentoPorCod($_SESSION['codDepartamentoActual']);


// Ahora pregunto si su valor recuperado del objeto Departamento es 'NULL'
if (is_null($oDepartamentoBaja->get_FechaBajaDepartamento())) {
    // En caso positivo le cambio el valor usando el metodo 'bajaLogicaDepartamento' de la clase DepartamentoPDO
    DepartamentoPDO::bajaLogicaDepartamento($_SESSION['codDepartamentoActual']);
    
}

$_SESSION['paginaAnterior'] = 'bajaDepartamento'; // Almaceno la página anterior para poder volver
$_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
header('Location: index.php'); // Redirecciono al index de la APP
exit;
