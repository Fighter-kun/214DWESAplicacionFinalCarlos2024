<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 11/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'editarDepartamento' 
 * 
 */
// Estructura del botón cancelar, si el usuario pulsa el botón 'cancelar'
if (isset($_REQUEST['cancelarEditar'])) {
    $_SESSION['paginaAnterior'] = 'editarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Declaracion de la variable de confirmación de envio de formulario correcto
$entradaOK = true;

// Declaramos el array de errores y lo inicializamos vacío
$aErrores = ['T02_DescDepartamento' => '',
    'T02_VolumenDeNegocio' => ''];
// Recuperamos el código del departamento que hemos seleccionamo mediante el metodo 'POST'
$codDepartamentoSeleccionado = $_SESSION['codDepartamentoActual'];
// Bloque para recoger datos que mostramos en el formulario
try {
    $miDB = new PDO(DSN, USERNAME, PASSWORD); // Instanciamos un objeto PDO y establecemos la conexión
// CONSULTA
// Hacemos un 'SELECT' sobre la tabla 'T02_Departamento' para recuperar toda la información del departamento que vamos a modificar
    $sqlDepartamento = $miDB->prepare("SELECT * FROM T02_Departamento WHERE T02_CodDepartamento = '" . $codDepartamentoSeleccionado . "';");

    $sqlDepartamento->execute(); // Ejecuto la consulta con el array de parametros
    $oDepartamentoAEditar = $sqlDepartamento->fetchObject(); // Obtengo un objeto con el departamento
// Almaceno la información del departamento actual en las siguiente variables, para mostrarlas en el formulario
    $codDepartamentoAEditar = $oDepartamentoAEditar->T02_CodDepartamento;
    $descripcionDepartamentoAEditar = $oDepartamentoAEditar->T02_DescDepartamento;
    $fechaCreacionDepartamentoAEditar = $oDepartamentoAEditar->T02_FechaCreacionDepartamento;
    $volumenNegocioAEditar = $oDepartamentoAEditar->T02_VolumenDeNegocio;
    $fechaBajaDepartamentoAEditar = $oDepartamentoAEditar->T02_FechaBajaDepartamento;

    if (isset($_REQUEST['confirmarCambiosEditar'])) { // Comprobamos que el usuario haya enviado el formulario para 'confirmar los cambios'
        $aErrores['T02_DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['T02_DescDepartamento'], 255, 3, 1);
        $aErrores['T02_VolumenDeNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['T02_VolumenDeNegocio_'], PHP_FLOAT_MAX, -PHP_FLOAT_MAX, 0);

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
    if ($entradaOK) { // Si el usuario ha rellenado el formulario correctamente rellenamos el array aFormulario con las respuestas introducidas por el usuario
// CONSULTA
// Usamos un 'UPDATE' para aplicar los cambios de la nueva descripción o volumen de negocio 
        $consultaUpdate = <<<CONSULTA
                UPDATE T02_Departamento SET 
                T02_DescDepartamento='{$_REQUEST['T02_DescDepartamento']}', 
                T02_VolumenDeNegocio='{$_REQUEST['T02_VolumenDeNegocio_']}'
                WHERE T02_CodDepartamento='{$codDepartamentoSeleccionado}';
            CONSULTA;

        $sqlUpdateDepartamento = $miDB->prepare($consultaUpdate); // Preparamos la consulta
        $sqlUpdateDepartamento->execute(); // Ejecutamos la consulta
        
        $_SESSION['paginaAnterior'] = 'editarDepartamento'; // Almaceno la página anterior para poder volver
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

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'consultarModificarDepartamento'