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
    $_SESSION['codAnimalActual'] = $_REQUEST['cConsultarModificarAnimal']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'editarAnimal'; // Asigno a la página en curso la pagina de ConsultarModificarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón eliminarDepartamento, si el usuario pulsa el botón del icono de una 'X'
if (isset($_REQUEST['cEliminarAnimal'])) {
    $_SESSION['codAnimalActual'] = $_REQUEST['cEliminarAnimal']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'eliminarAnimal'; // Asigno a la página en curso la pagina de eliminarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton baja, si el usuario pulsa el icono de la flecha roja 
if (isset($_REQUEST['cBajaLogicaAnimal'])) {
    $_SESSION['codAnimalActual'] = $_REQUEST['cBajaLogicaAnimal']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'bajaAnimal'; // Asigno a la página en curso la pagina de bajaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton alta, si el usuario pulsa el icono de la flecha verde 
if (isset($_REQUEST['cRehabilitacionAnimal'])) {
    $_SESSION['codAnimalActual'] = $_REQUEST['cRehabilitacionAnimal']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'rehabilitacionAnimal'; // Asigno a la página en curso la pagina de altaDepartamento
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
    $_SESSION['paginaEnCurso'] = 'añadirAnimal'; // Asigno a la página en curso la pagina de añadirDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Si la variable no esta declarada le asigno un valor por defecto
if (!isset($_SESSION['criterioBusquedaAnimales']['descripcionBuscada'])) {
    $_SESSION['criterioBusquedaAnimales']['descripcionBuscada'] = '';
}

// Si la variable no esta declarada le asigno un valor por defecto
if (!isset($_SESSION['criterioBusquedaAnimales']['estado'])) {
    $_SESSION['criterioBusquedaAnimales']['estado'] = ESTADO_TODOS;
}

// Si la variable no esta declarada le asigno un valor por defecto
if (!isset($_SESSION['numPaginacionAnimales'])) {
    $_SESSION['numPaginacionAnimales'] = 1;
}

/*
 * Por medio del método 'buscaAnimalesTotales' de la clase 'AnimalPDO' cuento todos los Animales 
 * que le pido según los parametros y los almaceno en una variable.
 * 
 * Divido por 5 para obtener el número total de páginas, ya que cada página tiene 5 resultados.
 */
$iAnimalesTotales = AnimalPDO::buscaAnimalesTotales($_SESSION['criterioBusquedaAnimales']['descripcionBuscada']) / 5;

if(isset($_REQUEST['paginaPrimera'])){ //Si el usuario pulsa el boton de paginaPrimera
    $_SESSION['numPaginacionAnimales'] = 1; //Le situo en la primera pagina
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['paginaAnterior']) && $_SESSION['numPaginacionAnimales'] >= 2){ //Si el usuario pulsa el boton de paginaAnterior
    $_SESSION['numPaginacionAnimales']--; //Le situo una pagina mas atras
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['paginaSiguiente']) && $_SESSION['numPaginacionAnimales'] < $iAnimalesTotales){ //Si el usuario pulsa el boton de paginaSiguiente
    $_SESSION['numPaginacionAnimales']++; //Le situo una pagina mas adelante
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['paginaUltima'])){ //Si el usuario pulsa el boton de paginaUltima
    $_SESSION['numPaginacionAnimales'] = ceil($iAnimalesTotales); // Redondeo hacia arriba el número
    header('Location: index.php');
    exit;
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
    // Almacenamos el valor en el array en la variable de sesion e inicializamos el número de paginas a 1
    $_SESSION['criterioBusquedaAnimales']['descripcionBuscada'] = $_REQUEST['DescAnimal'];
    
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
    $_SESSION['criterioBusquedaAnimales']['estado'] = $sEstado; // Guardo el valor del estado en la sesión
    $_SESSION['numPaginacionAnimales'] = 1;
}


/*
 * Por medio del método 'buscaAnimalesTotales' de la clase 'AnimalPDO' cuento todos los Animales 
 * que le pido según los parametros y los almaceno en una variable.
 * 
 * Divido por 5 para obtener el número total de páginas, ya que cada página tiene 5 resultados.
 */
$iAnimalesTotales = AnimalPDO::buscaAnimalesTotales($_SESSION['criterioBusquedaAnimales']['descripcionBuscada']) / 5;

/*
 * Por medio del método 'buscaDepartamentosPorDescPaginados' de la clase 'AnimalPDO' busco todos los Animales
 * con los siguientes parametros. 
 * La descripción y el número de paginación también.
 * 
 * Le restamos 1 a la variable de '$_SESSION['numPaginacionAnimales']' para indicar el indice 0 de la paginación y que así nos muestre los 5 primeros resultado,
 * si no hicieramos esto nos mostraría a partir de los 5 siguiente, porque es lo que le indico en el método.
 */

$aAnimalesBuscados = AnimalPDO::buscarAnimalesPorDescYEstadoPaginados($_SESSION['criterioBusquedaAnimales']['descripcionBuscada'], $_SESSION['criterioBusquedaAnimales']['estado'], $_SESSION['numPaginacionAnimales']-1);
$aAnimalesBuscadosVista = []; // Array para guardar el contenido de los animales
// Ejecutando la declaración SQL
if ($aAnimalesBuscados) {
    foreach ($aAnimalesBuscados as $oAnimal) {//Recorro el objeto del resultado que contiene un array
        $aAnimalesBuscadosVista[] = [
            'codAnimal' => $oAnimal->getCodAnimal(),
            'descAnimal' => $oAnimal->getDescAnimal(),
            'fechaNacimientoAnimal' => $oAnimal->getFechaNacimiento(),
            'sexoAnimal' => $oAnimal->getSexo(),
            'razaAnimal' => $oAnimal->getRaza(),
            'precioAnimal' => $oAnimal->getPrecio(),
            'fechaBajaAnimal' => !is_null($oAnimal->getFechaBaja()) ? $oAnimal->getFechaBaja() : ''
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