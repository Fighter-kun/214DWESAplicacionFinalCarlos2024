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
    $_SESSION['criterioBusquedaAnimales']['descripcionBuscada'] = '';
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón editarDepartamento, si el usuario pulsa el botón del icono de un 'lapiz'
if (isset($_REQUEST['cConsultarModificarAnimal'])) {
    $_SESSION['codAnimalActual'] = $_REQUEST['cConsultarModificarAnimal']; // Almaceno en una variable de sesión el Codigo del Animal Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'editarAnimal'; // Asigno a la página en curso la pagina de ConsultarModificarAnimal
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón eliminarDepartamento, si el usuario pulsa el botón del icono de una 'X'
if (isset($_REQUEST['cEliminarAnimal'])) {
    $_SESSION['codAnimalActual'] = $_REQUEST['cEliminarAnimal']; // Almaceno en una variable de sesión el Codigo del Animal Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'eliminarAnimal'; // Asigno a la página en curso la pagina de eliminarAnimal
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton baja, si el usuario pulsa el icono de la flecha roja 
if (isset($_REQUEST['cBajaLogicaAnimal'])) {
    $_SESSION['codAnimalActual'] = $_REQUEST['cBajaLogicaAnimal']; // Almaceno en una variable de sesión el Codigo del Animal Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'bajaAnimal'; // Asigno a la página en curso la pagina de bajaAnimal
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton alta, si el usuario pulsa el icono de la flecha verde 
if (isset($_REQUEST['cRehabilitacionAnimal'])) {
    $_SESSION['codAnimalActual'] = $_REQUEST['cRehabilitacionAnimal']; // Almaceno en una variable de sesión el Codigo del Animal Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'rehabilitacionAnimal'; // Asigno a la página en curso la pagina de altaAnimal
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton detalle Animal, si el usuario pulsa el boton
if (isset($_REQUEST['cDetalleAnimal'])) {
    $_SESSION['codAnimalActual'] = $_REQUEST['cDetalleAnimal']; // Almaceno en una variable de sesión el Codigo del Animal Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'detalleAnimal'; // Asigno a la página en curso la pagina de detalleAnimal
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón exportar, si el usuario pulsa el botón 'exportar'
if (isset($_REQUEST['exportarAnimales'])) {
    AnimalPDO::exportarAnimalesJSON();
}

// Estructura del botón importar, si el usuario pulsa el botón 'importar'
if (isset($_REQUEST['importarAnimales'])) {
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'importarAnimales'; // Asigno a la página en curso la pagina de importarAnimal
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón añadir departamento, si el usuario pulsa el botón 'añadir Animal'
if (isset($_REQUEST['añadirAnimal'])) {
    $_SESSION['paginaAnterior'] = 'consultarAnimales'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'añadirAnimal'; // Asigno a la página en curso la pagina de añadirAnimal
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Si la variable no esta declarada le asigno un valor por defecto
if (!isset($_SESSION['criterioBusquedaAnimales']['descripcionBuscada'])) {
    $_SESSION['criterioBusquedaAnimales']['descripcionBuscada'] = '';
}

// Si la variable no esta declarada le asigno un valor por defecto
if (!isset($_SESSION['criterioBusquedaAnimales']['estado'])) {
    $_SESSION['criterioBusquedaAnimales']['estado'] = ESTADO_ALTAS;
}

// Si la variable no esta declarada le asigno un valor por defecto
if (!isset($_SESSION['numPaginacionAnimales'])) {
    $_SESSION['numPaginacionAnimales'] = 1;
}

/*
 * Por medio del método 'buscaAnimalesTotalesPorDescYEstado' de la clase 'AnimalPDO' cuento todos los Animales 
 * que le pido según los parametros y los almaceno en una variable.
 * 
 * Divido por 5 para obtener el número total de páginas, ya que cada página tiene 5 resultados.
 */
$iAnimalesTotales = AnimalPDO::buscaAnimalesTotalesPorDescYEstado($_SESSION['criterioBusquedaAnimales']['descripcionBuscada'], $_SESSION['criterioBusquedaAnimales']['estado']) / 5;

if(isset($_REQUEST['paginaPrimera'])){ //Si el usuario pulsa el boton de paginaPrimera
    $_SESSION['numPaginacionAnimales'] = 1; //Le situo en la primera pagina
}
if(isset($_REQUEST['paginaAnterior']) && $_SESSION['numPaginacionAnimales'] >= 2){ //Si el usuario pulsa el boton de paginaAnterior
    $_SESSION['numPaginacionAnimales']--; //Le situo una pagina mas atras 
}
if(isset($_REQUEST['paginaSiguiente']) && $_SESSION['numPaginacionAnimales'] < $iAnimalesTotales){ //Si el usuario pulsa el boton de paginaSiguiente
    $_SESSION['numPaginacionAnimales']++; //Le situo una pagina mas adelante  
}
if(isset($_REQUEST['paginaUltima'])){ //Si el usuario pulsa el boton de paginaUltima
    $_SESSION['numPaginacionAnimales'] = ceil($iAnimalesTotales); // Redondeo hacia arriba el número 
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
 * Por medio del método 'buscaAnimalesTotalesPorDescYEstado' de la clase 'AnimalPDO' cuento todos los Animales 
 * que le pido según los parametros y los almaceno en una variable.
 * 
 * Divido por 5 para obtener el número total de páginas, ya que cada página tiene 5 resultados.
 */
$iAnimalesTotales = AnimalPDO::buscaAnimalesTotalesPorDescYEstado($_SESSION['criterioBusquedaAnimales']['descripcionBuscada'], $_SESSION['criterioBusquedaAnimales']['estado']) / 5;

/*
 * Por medio del método 'buscaDepartamentosPorDescPaginados' de la clase 'AnimalPDO' busco todos los Animales
 * con los siguientes parametros. 
 * La descripción y el número de paginación también.
 */

$aAnimalesBuscados = AnimalPDO::buscarAnimalesPorDescYEstadoPaginados($_SESSION['criterioBusquedaAnimales']['descripcionBuscada'], $_SESSION['criterioBusquedaAnimales']['estado'], $_SESSION['numPaginacionAnimales']);
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