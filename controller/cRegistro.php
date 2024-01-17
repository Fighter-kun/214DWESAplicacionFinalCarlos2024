<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 02/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cRegistro' 
 * 
 */

//Si el usuario pulsa el botón 'Cancelar', mando al usuario al index de DWES
if (isset($_REQUEST['cancelar'])) {
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior']; // Asigno a la pagina en curso la pagina de anterior que es la de login
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Declaración de constantes por OBLIGATORIEDAD
define('OPCIONAL', 0);
define('OBLIGATORIO', 1);

// Declaración de variables de estructura para validar la ENTRADA de RESPUESTAS o ERRORES
// Valores por defecto
$entradaOK = true;

$aRespuestas = [
    'T01_CodUsuario' => "",
    'T01_DescUsuario' => "",
    'T01_Password' => "",
    'repetirPassword' => ""
];

$aErrores = [
    'T01_CodUsuario' => "",
    'T01_DescUsuario' => "",
    'T01_Password' => "",
    'repetirPassword' => ""
];

//Si el usuario pulsa el botón 'Registrarse', mando al usuario al index de DWES
if (isset($_REQUEST['registrarse'])) {
    /*
     * Ahora inicializo cada 'key' del ARRAY utilizando las funciónes de la clase de 'validacionFormularios' , la cuál 
     * comprueba el valor recibido (en este caso el que recibe la variable '$_REQUEST') y devuelve 'null' si el valor es correcto,
     * o un mensaje de error personalizado por cada función dependiendo de lo que validemos.
     */
    //Introducimos valores en el array $aErrores si ocurre un error
    $aErrores['T01_CodUsuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['T01_CodUsuario'], 8, 3, OBLIGATORIO);
    $aErrores['T01_DescUsuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['T01_DescUsuario'], 255, 3, OBLIGATORIO);
    $aErrores['T01_Password'] = validacionFormularios::validarPassword($_REQUEST['T01_Password'], 8, 3, 1, OBLIGATORIO);
    $aErrores['repetirPassword'] = validacionFormularios::validarPassword($_REQUEST['repetirPassword'], 8, 3, 1, OBLIGATORIO);

    // Comprobamos por medio del metodo 'validarCodNoExiste()' de la clase 'UsuarioPDO' si el código del usuario existe
        $oUsuarioExistente = UsuarioPDO::validarCodNoExiste($_REQUEST['T01_CodUsuario']);
                
    // En caso de existir cargamos un mensaje al array de errores
    if ($oUsuarioExistente) {
        $aErrores['T01_CodUsuario'] = "El usuario ya existe";
    }

    // Comprobamos si son distintas las contraseñas y cargamos un mensaje de error
    if ($_REQUEST['T01_Password'] != $_REQUEST['repetirPassword']) {
            $aErrores['T01_Password'] = "Las contraseñas no coinciden.";
            $aErrores['repetirPassword'] = "Las contraseñas no coinciden.";
    }
            
    /*
     * En este foreach recorremos el array buscando que exista NULL (Los metodos anteriores si son correctos devuelven NULL)
     * y en caso negativo cambiara el valor de '$entradaOK' a false y borrara el contenido del campo.
     */
    foreach ($aErrores as $campo => $error) {
        if ($error != null) {
            $_REQUEST[$campo] = "";
            $entradaOK = false;
        }
    }
} else {
    $entradaOK = false;
}
//En caso de que '$entradaOK' sea true, cargamos las respuestas en el array '$aRespuestas'
if ($entradaOK) {
    $aRespuestas['T01_CodUsuario'] = $_REQUEST['T01_CodUsuario'];
    $aRespuestas['T01_DescUsuario'] = $_REQUEST['T01_DescUsuario'];
    $aRespuestas['T01_Password'] = $_REQUEST['T01_Password'];
    $aRespuestas['repetirPassword'] = $_REQUEST['repetirPassword'];

    $oRegistroUsuario = UsuarioPDO::altaUsuario($_REQUEST['T01_CodUsuario'], $_REQUEST['T01_Password'], $_REQUEST['T01_DescUsuario']);

    $_SESSION['usuarioMiAplicacion'] = $oRegistroUsuario; // Almaceno el nuevo Usuario en una variable de sesión 
    $_SESSION['paginaEnCurso'] = 'inicioPrivado'; // Asigno a la pagina en curso la pagina de inicioPrivado
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'registro'
