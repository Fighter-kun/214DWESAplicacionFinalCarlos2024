<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 02/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cLogin' 
 * 
 */

//Si el usuario pulsa el botón 'Cancelar', mando al usuario al index de DWES
if(isset($_REQUEST['cancelar'])){ 
    $_SESSION['paginaEnCurso'] = 'inicioPublico'; // Asigno a la pagina en curso la pagina de inicioPublico
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

//Si el usuario pulsa el botón 'Registrarse', mando al usuario al index de DWES
if(isset($_REQUEST['registrarse'])){ 
    $_SESSION['paginaAnterior'] = 'login'; // Asigno a la página anterior la página de login
    $_SESSION['paginaEnCurso'] = 'registro'; // Asigno a la pagina en curso la pagina de registro
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Declaracion de variables universales
define("OBLIGATORIO", 1);
define("OPCIONAL", 0);
$entradaOK = true;

// Declaramos el array de errores y lo inicializamos vacío
$aErrores = ['user' => ''];
$aErrores = ['password' => ''];

//Si el usuario pulsa el botón 'IniciarSesion', mando al usuario al index de DWES
if(isset($_REQUEST['iniciarSesion'])){ 
    // Valido la sintaxis del usuario y contraseña introducidos
    $aErrores['user'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['user'], 15, 3, OBLIGATORIO);
    $aErrores['password'] = validacionFormularios::validarpassword($_REQUEST['password'], 8, 3, 1, OBLIGATORIO);
    
    // Validamos si el usuario existe y es valido utilizando el metodo 'validarUsuario()' de la clase 'UsuarioPDO'
    $oUsuarioValido = UsuarioPDO::validarUsuario($_REQUEST['user'], $_REQUEST['password']);
    
    // Comprobamos si '$oUsuarioValido' no esta declarado o es 'null'
    if(!isset($oUsuarioValido)){
        $entradaOK = false; // En caso verdadero cambiamos el valor de '$entradaOK' a 'false'
    }
    
    // Recorremos el array de errores
    foreach ($aErrores as $campo => $error) {
        if ($error != null) { // Comprobamos que el campo no esté vacio
            $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario
            $_REQUEST[$campo] = ""; // Limpiamos los campos del formulario
        }
    }
} else {
    $entradaOK = false;
}
if($entradaOK) {
    /**
     * Si los datos anteriores estan correctos, por medio del metodo 'registrarUltimaConexion' 
     * actualizaremos el número de conexiones y la fecha y hora de última conexión
     */ 
    $oUsuarioValido = UsuarioPDO::registrarUltimaConexion($oUsuarioValido);
    
    $_SESSION['usuarioMiAplicacion'] = $oUsuarioValido; // Almaceno el Usuario en una variable de sesión 
    $_SESSION['paginaEnCurso'] = 'inicioPrivado'; // Asigno a la pagina en curso la pagina de inicioPrivado
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'login'