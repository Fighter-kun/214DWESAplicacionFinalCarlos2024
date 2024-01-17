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

//Recupero el código del departamento almacenado en la variable de sesión
$codigoDepartamentoActual = $_SESSION['codDepartamentoActual'];
// Bloque para recoger datos que mostramos en el formulario
try {
    $miDB = new PDO(DSN, USERNAME, PASSWORD); // Instanciamos un objeto PDO y establecemos la conexión
    // CONSULTA - SELECT
    /*
     * Hacemos un 'SELECT' sobre la tabla 'T02_Departamento' para recuperar toda la información del departamento que vamos a modificar.
     * En la variable '$_REQUEST['codDepartamento']' esta almacenado el codigo de departamento que hemos recuperado del index al pulsar el botón
     */ 
    $sqlDepartamento = $miDB->prepare("SELECT * FROM T02_Departamento WHERE T02_CodDepartamento = '" . $codigoDepartamentoActual . "';");

    $sqlDepartamento->execute(); // Ejecuto la consulta con el array de parametros
    $oDepartamentoAEditar = $sqlDepartamento->fetchObject(); // Obtengo un objeto con el departamento
    // Almaceno la información del departamento actual en las siguiente variables, para mostrarlas en el formulario
    $codDepartamentoAEditar = $oDepartamentoAEditar->T02_CodDepartamento;
    $descripcionDepartamentoAEditar = $oDepartamentoAEditar->T02_DescDepartamento;
    $fechaCreacionDepartamentoAEditar = $oDepartamentoAEditar->T02_FechaCreacionDepartamento;
    $volumenNegocioAEditar = $oDepartamentoAEditar->T02_VolumenDeNegocio;
    $fechaBajaDepartamentoAEditar = $oDepartamentoAEditar->T02_FechaBajaDepartamento;

    if (isset($_REQUEST['confirmarCambiosEliminar'])) { // Comprobamos que el usuario haya enviado el formulario para 'confirmar los cambios'
    // CONSULTA - DELETE
    // Usamos un 'DELETE' para eliminar el departamento seleccionado 
        $consultaDelete = <<<CONSULTA
            DELETE FROM T02_Departamento WHERE T02_CodDepartamento = '{$codigoDepartamentoActual}';
        CONSULTA;

        $sqlDeleteDepartamento = $miDB->prepare($consultaDelete); // Preparamos la consulta
        $sqlDeleteDepartamento->execute(); // Ejecutamos la consulta
        
        $_SESSION['paginaAnterior'] = 'eliminarDepartamento'; // Almaceno la página anterior para poder volver
        $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
        header('Location: index.php'); // Redirecciono al index de la APP
        exit;
    }

    
} catch (PDOException $miExcepcionPDO) {
    $errorExcepcion = $miExcepcionPDO->getCode(); // Almacenamos el código del error de la excepción en la variable '$errorExcepcion'
    $mensajeExcepcion = $miExcepcionPDO->getMessage(); // Almacenamos el mensaje de la excepción en la variable '$mensajeExcepcion'

    echo ("<span class='errorException'>Error: </span>" . $mensajeExcepcion . "<br>"); // Mostramos el mensaje de la excepción
    echo ("<span class='errorException'>Código del error: </span>" . $errorExcepcion); // Mostramos el código de la excepción
} finally {
    unset($miDB); //Cerramos la conexión con la base de datos
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'EliminarDepartamento'