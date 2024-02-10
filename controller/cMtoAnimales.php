<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 09/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cMtoAnimales' 
 * 
 */
// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirGranja'])) {
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'inicioPrivado'; // Asigno a la página en curso la pagina de inicioPrivado
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón editarDepartamento, si el usuario pulsa el botón del icono de un 'lapiz'
if (isset($_REQUEST['cConsultarModificarAnimal'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cConsultarModificarDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de ConsultarModificarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón eliminarDepartamento, si el usuario pulsa el botón del icono de una 'X'
if (isset($_REQUEST['cEliminarAnimal'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cEliminarDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de eliminarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton baja, si el usuario pulsa el icono de la flecha roja 
if (isset($_REQUEST['cBajaLogicaAnimal'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cBajaLogicaDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de bajaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton alta, si el usuario pulsa el icono de la flecha verde 
if (isset($_REQUEST['cRehabilitacionAnimal'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cRehabilitacionDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de altaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón exportar, si el usuario pulsa el botón 'exportar'
if (isset($_REQUEST['exportarAnimales'])) {
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de exportarDepartamentos
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón importar, si el usuario pulsa el botón 'importar'
if (isset($_REQUEST['importarAnimales'])) {
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de importarDepartamentos
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón añadir departamento, si el usuario pulsa el botón 'añadir departameto'
if (isset($_REQUEST['añadirAnimal'])) {
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de añadirDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

if (!isset($_SESSION['criterioBusquedaAnimal']['descripcionBuscada'])) {
    $_SESSION['criterioBusquedaAnimal']['descripcionBuscada'] = '';
}
//Declaración de variables de estructura para validar la ENTRADA de RESPUESTAS o ERRORES
//Valores por defecto
$entradaOK = true; //Indica si todas las respuestas son correctas
$aErrores ['DescAnimal'] = ''; // Almacena los errores
// //Almacena los errores
//Comprobamos si se ha enviado el formulario
if (isset($_REQUEST['buscarAnimalPorDesc'])) {
    //Introducimos valores en el array $aErrores si ocurre un error
    $aErrores['DescAnimal'] = validacionFormularios::comprobarAlfabetico($_REQUEST['DescAnimal'], 255, 1, 0);

    //Recorremos el array de errores
    foreach ($aErrores as $sCampo => $sError) {
        if ($sError != null) { // Si hay errores
            $_REQUEST[$sCampo] = ''; // Limpio el campo del formulario
            $entradaOK = false; // Y cambio el valor de entrada a False
        }
    }
} else {
    $entradaOK = false; //Si no ha pulsado el botón de enviar la validación es incorrecta.  
}

//Si la entrada es Ok almacenamos el valor de la respuesta del usuario en el array $aRespuestas
if ($entradaOK) {
    //Almacenamos el valor en el array
    $_SESSION['criterioBusquedaAnimal']['descripcionBuscada'] = $_REQUEST['DescAnimal'];
}

$aAnimalesBuscados = AnimalPDO::buscaDepartamentosPorDesc($_SESSION['criterioBusquedaAnimal']['descripcionBuscada']);
$aAnimalesBuscadosVista = [];
// Ejecutando la declaración SQL
if ($aAnimalesBuscados) {
    foreach ($aAnimalesBuscados as $aAnimal) {//Recorro el objeto del resultado que contiene un array
        $aAnimalesBuscadosVista[] = [
            'codAnimal' => $aAnimal->getCodAnimal(),
            'descAnimal' => $aAnimal->getDescAnimal(),
            'fechaNacimientoAnimal' => $aAnimal->getFechaNacimiento(),
            'sexoAnimal' => $aAnimal->getSexo(),
            'razaAnimal' => $aAnimal->getRaza(),
            'precioAnimal' => $aAnimal->getPrecio(),
            'fechaBajaAnimal' => !is_null($aAnimal->getFechaBaja()) ? $aAnimal->getFechaBaja() : ''
        ];
    }
} else {
    if ($_COOKIE['idioma'] == 'SP') {
        $aErrores['DescAnimal'] = "No existen animales con esa descripcion";
    } else {
        $aErrores['DescAnimal'] = "There are no animals with that description";
    }
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'MtoDepartamento'