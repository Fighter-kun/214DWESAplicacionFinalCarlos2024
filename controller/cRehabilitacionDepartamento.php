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
// Recuperamos el código del departamento que hemos seleccionamo mediante el metodo 'POST'
$codDepartamentoSeleccionado = $_SESSION['codDepartamentoActual'];
try {
    $miDB = new PDO(DSN, USERNAME, PASSWORD); // Instanciamos un objeto PDO y establecemos la conexión
    // CONSULTA
    // Hacemos un 'SELECT' sobre la tabla 'T02_Departamento' para recuperar toda la información del departamento que vamos a modificar
    $sqlDepartamento = $miDB->prepare("SELECT * FROM T02_Departamento WHERE T02_CodDepartamento = '" . $codDepartamentoSeleccionado . "';");

    $sqlDepartamento->execute(); // Ejecuto la consulta con el array de parametros
    $oDepartamentoAEditar = $sqlDepartamento->fetchObject(); // Obtengo un objeto con el departamento
    // Almaceno la información de la fecha de baja del departamento
    $fechaBajaDepartamento = $oDepartamentoAEditar->T02_FechaBajaDepartamento;
    
    // Ahora pregunto si su valor es distinto de 'NULL'
    if (!is_null($fechaBajaDepartamento)) {
        $sqlAltaDepartamento = $miDB->prepare("UPDATE T02_Departamento SET T02_FechaBajaDepartamento = NULL WHERE T02_CodDepartamento = '" . $codDepartamentoSeleccionado . "';");
        $sqlAltaDepartamento->execute(); // Ejecuto la consulta 
    } 
    
    $_SESSION['paginaAnterior'] = 'altaDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
    
} catch (PDOException $miExcepcionPDO) {
    $errorExcepcion = $miExcepcionPDO->getCode(); // Almacenamos el código del error de la excepción en la variable '$errorExcepcion'
    $mensajeExcepcion = $miExcepcionPDO->getMessage(); // Almacenamos el mensaje de la excepción en la variable '$mensajeExcepcion'

    echo ("<span class='errorException'>Error: </span>" . $mensajeExcepcion . "<br>"); // Mostramos el mensaje de la excepción
    echo ("<span class='errorException'>Código del error: </span>" . $errorExcepcion); // Mostramos el código de la excepción
} finally {
    unset($miDB); //Cerramos la conexión con la base de datos
}