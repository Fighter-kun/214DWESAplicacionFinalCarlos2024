<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 04/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cBorrarCuenta'
 * 
 */

//Si el usuario pulsa el botón 'Cancelar', mando al usuario al index de DWES
if(isset($_REQUEST['salirBorrarCuenta'])){ 
    $_SESSION['paginaEnCurso'] = 'miCuenta'; // Asigno a la página en curso la pagina de inicioPrivado
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

if (isset($_REQUEST['eliminarUsuario'])) { // Comprobamos que el usuario a pulsado el boton 'Eliminar Usuario'
    $oUsuarioAEliminar = $_SESSION['usuarioMiAplicacion']->get_codUsuario(); // Recupero y almaceno el código del usuario actual
    
    if (UsuarioPDO::borrarUsuario($oUsuarioAEliminar)) {
        session_destroy(); // Elimino la sesión
        $_SESSION['paginaEnCurso'] = 'inicioPublico'; // Asigno a la pagina en curso la pagina de inicioPublico
        header('Location: index.php'); // Redirecciono al index de la APP
        exit;
    }
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'borrarCuenta'