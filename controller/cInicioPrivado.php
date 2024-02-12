<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 02/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cInicioPrivado' 
 * 
 */

//Si el usuario pulsa el botón 'Cerrar Sesion', mando al usuario al index de DWES
if(isset($_REQUEST['cerrarSesion'])){
    session_destroy(); // Elimino la sesión
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

//Si el usuario pulsa el botón 'Detalle', mando al usuario al index de DWES
if(isset($_REQUEST['detalle'])){
    $_SESSION['paginaAnterior'] = 'inicioPrivado'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'detalle'; // Asigno a la página en curso la pagina de detalle
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

//Si el usuario pulsa el botón 'Editar Perfil', mando al usuario al index de DWES
if(isset($_REQUEST['editarPerfil'])){
    $_SESSION['paginaAnterior'] = 'inicioPrivado'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'miCuenta'; // Asigno a la página en curso la pagina de miCuenta
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

//Si el usuario pulsa el botón 'Mto.Departamentos', mando al usuario al index de DWES
if(isset($_REQUEST['mtoDepartamentos'])){
    $_SESSION['paginaAnterior'] = 'inicioPrivado'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

//Si el usuario pulsa el botón 'REST', mando al usuario al index de DWES
if(isset($_REQUEST['apiREST'])){
    $_SESSION['paginaAnterior'] = 'inicioPrivado'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'apiREST'; // Asigno a la página en curso la pagina de apiREST
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

//Si el usuario pulsa el botón 'Mto.Animales', mando al usuario al index de DWES
if(isset($_REQUEST['mtoAnimales'])){
    $_SESSION['paginaAnterior'] = 'inicioPrivado'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de apiREST
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

$descripcionUsuario = $_SESSION['usuarioMiAplicacion']->get_descUsuario(); // Recupero y almaceno la descripción del usuario actual
$numeroConexionesUsuario = $_SESSION['usuarioMiAplicacion']->get_numAcceso(); // Recupero y almaceno el número de conexiones del usuario actual
$fechaHoraUltimaConexionAnterior = $_SESSION['usuarioMiAplicacion']->get_fechaHoraUltimaConexionAnterior(); // Recupero y almaceno la fecha y hora de conexión anterior del usuario actual

/*
 * Una vez el usuario este "logeado" de manera correcta, cambiamos el "encabezado" y 
 * guardamos el nombre del usuario, sustituyendo la imagen de inicio de login
 */ 
$_SESSION['encabezadoLogin'] = $descripcionUsuario;

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'inicioPrivado'