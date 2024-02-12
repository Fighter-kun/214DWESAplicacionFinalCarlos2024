<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 02/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cMtoDepartamento' 
 * 
 */
// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirDepartamentos'])) {
    $_SESSION['numPaginacionDepartamentos'] = 1; // Si salgo posiciono la página en la primera
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'inicioPrivado'; // Asigno a la página en curso la pagina de inicioPrivado
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón editarDepartamento, si el usuario pulsa el botón del icono de un 'lapiz'
if (isset($_REQUEST['cConsultarModificarDepartamento'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cConsultarModificarDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'editarDepartamento'; // Asigno a la página en curso la pagina de ConsultarModificarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón eliminarDepartamento, si el usuario pulsa el botón del icono de una 'X'
if (isset($_REQUEST['cEliminarDepartamento'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cEliminarDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'eliminarDepartamento'; // Asigno a la página en curso la pagina de eliminarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton baja, si el usuario pulsa el icono de la flecha roja 
if (isset($_REQUEST['cBajaLogicaDepartamento'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cBajaLogicaDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'bajaDepartamento'; // Asigno a la página en curso la pagina de bajaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton alta, si el usuario pulsa el icono de la flecha verde 
if (isset($_REQUEST['cRehabilitacionDepartamento'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cRehabilitacionDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'altaDepartamento'; // Asigno a la página en curso la pagina de altaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón exportar, si el usuario pulsa el botón 'exportar'
if (isset($_REQUEST['exportarDepartamentos'])) {
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de exportarDepartamentos
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón importar, si el usuario pulsa el botón 'importar'
if (isset($_REQUEST['importarDepartamentos'])) {
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de importarDepartamentos
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón añadir departamento, si el usuario pulsa el botón 'añadir departameto'
if (isset($_REQUEST['añadirDepartamento'])) {
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'añadirDepartamento'; // Asigno a la página en curso la pagina de añadirDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Si la variable no esta declarada le asigno un valor por defecto
if (!isset($_SESSION['numPaginacionDepartamentos'])) {
    $_SESSION['numPaginacionDepartamentos'] = 1;
}


// Si la variable no esta declarada le asigno un valor por defecto
if (!isset($_SESSION['criterioBusquedaDepartamentos']['estado'])) {
    $_SESSION['criterioBusquedaDepartamentos']['estado'] = ESTADO_TODOS;
}

/*
 * Por medio del método 'buscaDepartamentosTotales' de la clase 'DepartamentoPDO' cuento todos los Departamentos 
 * que le pido según los parametros y los almaceno en una variable.
 * 
 * Divido por 5 para obtener el número total de páginas, ya que cada página tiene 5 resultados.
 */
$iDepartamentosTotales = DepartamentoPDO::buscaDepartamentosTotales($_SESSION['criterioBusquedaDepartamentos']['descripcionBuscada'] ?? '', $_SESSION['criterioBusquedaDepartamentos']['estado']) / 5;

if(isset($_REQUEST['paginaPrimera'])){ //Si el usuario pulsa el boton de paginaPrimera
    $_SESSION['numPaginacionDepartamentos'] = 1; //Le situo en la primera pagina
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['paginaAnterior']) && $_SESSION['numPaginacionDepartamentos'] >= 2){ //Si el usuario pulsa el boton de paginaAnterior
    $_SESSION['numPaginacionDepartamentos']--; //Le situo una pagina mas atras
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['paginaSiguiente']) && $_SESSION['numPaginacionDepartamentos'] < $iDepartamentosTotales){ //Si el usuario pulsa el boton de paginaSiguiente
    $_SESSION['numPaginacionDepartamentos']++; //Le situo una pagina mas adelante
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['paginaUltima'])){ //Si el usuario pulsa el boton de paginaUltima
    $_SESSION['numPaginacionDepartamentos'] = ceil($iDepartamentosTotales); // Redondeo hacia arriba el número
    header('Location: index.php');
    exit;
}

//Declaración de variables de estructura para validar la ENTRADA de RESPUESTAS o ERRORES
//Valores por defecto
$entradaOK = true; //Indica si todas las respuestas son correctas
$aErrores ['DescDepartamento'] = ''; // Almacena los errores
// //Almacena los errores
//Comprobamos si se ha enviado el formulario
if (isset($_REQUEST['buscarDepartamentoPorDesc'])) {
    //Introducimos valores en el array $aErrores si ocurre un error
    $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['DescDepartamento'], 255, 1, 0);

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
    $_SESSION['criterioBusquedaDepartamentos']['descripcionBuscada'] = $_REQUEST['DescDepartamento'];
    
    switch ($_REQUEST['estado']){ //Guardo el estado que ha seleccionado el usuario en el filtrado de la busqueda
        case 'todos':
            $sEstado = ESTADO_TODOS;
            break;
        case 'altas':
            $sEstado = ESTADO_ALTAS;
            break;
        case 'bajas':
            $sEstado = ESTADO_BAJAS;
            break;
    }
    // El valor de $sEstado son una constantes que valen (0-1-2)
    $_SESSION['numPaginacionDepartamentos'] = 1;
    $_SESSION['criterioBusquedaDepartamentos']['estado'] = $sEstado; // Guardo el valor del estado en la sesión
}

/*
 * Por medio del método 'buscaDepartamentosTotales' de la clase 'DepartamentoPDO' cuento todos los Departamentos 
 * que le pido según los parametros y los almaceno en una variable.
 * 
 * Divido por 5 para obtener el número total de páginas, ya que cada página tiene 5 resultados.
 */
$iDepartamentosTotales = DepartamentoPDO::buscaDepartamentosTotales($_SESSION['criterioBusquedaDepartamentos']['descripcionBuscada'] ?? '', $_SESSION['criterioBusquedaDepartamentos']['estado']) / 5;

$aDepartamentosVista = []; //Array para guardar el contenido de un departamento

/*
 * Por medio del método 'buscaDepartamentosPorEstado' de la clase 'DepartamentoPDO' busco todos los Departamentos
 * con los siguientes parametros. 
 * La descripción si esta declarada si no vacío, el estado esta declarado por defecto y el número de paginación también.
 * 
 * Le restamos 1 a la variable de '$_SESSION['numPaginacionDepartamentos']' para indicar el indice 0 de la paginación y que así nos muestre los 5 primeros resultado,
 * si no hicieramos esto nos mostraría a partir de los 5 siguiente, porque es lo que le indico en el método.
 */
$aDepartamentosBuscados = DepartamentoPDO::buscaDepartamentosPorEstado($_SESSION['criterioBusquedaDepartamentos']['descripcionBuscada'] ?? '', $_SESSION['criterioBusquedaDepartamentos']['estado'], $_SESSION['numPaginacionDepartamentos']-1); 


// Ejecutando la declaración SQL
if ($aDepartamentosBuscados) {
    foreach ($aDepartamentosBuscados as $aDepartamento) {//Recorro el objeto del resultado que contiene un array
        array_push($aDepartamentosVista, [//Hago uso del metodo array push para meter los valores en el array $aDepartamentosVista
            'codDepartamento' => $aDepartamento->get_CodDepartamento(), //Guardo en el valor codDepartamento el codigo del departamento
            'descDepartamento' => $aDepartamento->get_DescDepartamento(), //Guardo en el valor descDepartamento la descripcion del departamento
            'fechaCreacionDep' => $aDepartamento->get_FechaCreacionDepartamento(), //Guardo en el valor fechaAlta la fecha de alta del departamento
            'volumenDeNegocio' => $aDepartamento->get_VolumenDeNegocio(), //Guardo en el valor volumenNegocio el volumen de negocio del departamento
            'fechaBajaDep' => !is_null($aDepartamento->get_FechaBajaDepartamento()) ? $aDepartamento->get_FechaBajaDepartamento() : '' //Guardo en el valor fechaBaja la fecha de baja del departamento
        ]);
    }
} else {
    if ($_COOKIE['idioma'] == 'SP') {
        $aErrores['DescDepartamento'] = "No existen departamentos con esa descripcion";
    } else {
        $aErrores['DescDepartamento'] = "There are no departments with that description";
    }
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'MtoDepartamento'