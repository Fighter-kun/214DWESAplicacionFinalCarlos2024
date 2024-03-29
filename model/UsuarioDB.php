<?php

/**
 * Interfaz UsuarioDB
 *
 * Fichero con la clase UsuarioDB 
 *
 */

/**
 * Interfaz UsuarioDB
 * 
 * Interfaz de UsuarioDB, con un método estatico para validar el usuario
 * 
 * @author Carlos García Cachón
 * @version 1.0
 * @since 03/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Interfaz UsuarioDB
*/
interface UsuarioDB {
    /**
     * Valida las credenciales de un usuario.
     *
     * @param string $codUsuario El código de usuario a validar.
     * @param string $password La contraseña del usuario a validar.
     */
    public static function validarUsuario($codUsuario, $password);
}
