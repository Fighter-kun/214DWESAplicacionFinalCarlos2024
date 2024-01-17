<?php

/**
 * @author Original Alberto Fernández Ramírez
 * @version 1.0
 * @since 03/01/2024
 * Modificado por @author Carlos García Cachón
 * 
 * @Annotation Proyecto LoginLogoutMulticapaPOO - Clase UsuarioPDO
 * 
 */
class UsuarioPDO implements UsuarioDB {
    /**
     * Valida las credenciales de un usuario.
     *
     * @param string $codUsuario El código de usuario a validar.
     * @param string $password La contraseña del usuario a validar.
     * 
     * @return object Usuario Un objeto del usuario en caso positivo
     * @return boolena null En caso de no ser valido
     */
    public static function validarUsuario($codUsuario, $password) {
        $oUsuario = null; // Inicializamo la variable para el usuario a validar
        //CONSULTA SQL - SELECT
        $consulta = <<<CONSULTA
            SELECT * FROM T01_Usuario 
            WHERE T01_CodUsuario = '{$codUsuario}' 
            AND T01_Password = SHA2('{$codUsuario}{$password}', 256);
        CONSULTA;

        $resultado = DBPDO::ejecutaConsulta($consulta); // Ejecuto la consulta

        if ($resultado->rowCount() > 0) { // Si la consulta tiene más de '0' valores
            $oUsuario = $resultado->fetchObject(); // Guardo en la variable el resultado de la consulta en forma de objeto

            if ($oUsuario) { // Instancio un nuevo objeto Usuario con todos sus datos
               return $oUsuarioNuevo = new Usuario( // Y lo devuelvo
                        $oUsuario->T01_CodUsuario,
                        $oUsuario->T01_Password,
                        $oUsuario->T01_DescUsuario,
                        $oUsuario->T01_NumConexiones,
                        $oUsuario->T01_FechaHoraUltimaConexion,
                        $oUsuario->T01_FechaHoraUltimaConexionAnterior = NULL,
                        $oUsuario->T01_Perfil
                );
            } else {
                return $oUsuario;
            }
        }
    }

    /**
     * Metodo que permite dar de alta un usuario nuevo en la BD
     * 
     * @param string $codUsuario El codigo del usuario
     * @param string $password La password del usuario
     * @param string $descUsuario La descripcion del usuario
     * 
     * @return boolean false | object Usuario Devuelve un objeto Usuario nuevo si se ha podido crear, de lo contrario devuelve un @boolean que sera 'false'
     */
    public static function altaUsuario($codUsuario, $password, $descUsuario) {
        //CONSULTA SQL - INSERT
        $consultaCrearUsuario = <<<CONSULTA
            INSERT INTO T01_Usuario(T01_CodUsuario, T01_Password, T01_DescUsuario, T01_NumConexiones, T01_FechaHoraUltimaConexion) 
            VALUES ("{$codUsuario}", SHA2("{$codUsuario}{$password}", 256), "{$descUsuario}", 1, now());
        CONSULTA;
            
        if (DBPDO::ejecutaConsulta($consultaCrearUsuario)) { // Ejecuto la consulta
            return new Usuario($codUsuario, $password, $descUsuario, 1, date('Y-m-d H:i:s'), null, 'usuario'); // Creo el Usuario con los valores recogidos
        } else {
            return false; // Si la consulta falla devuelvo 'false'
        }
    }

    /**
     * 
     * Metodo que nos permite modificar la descripción de un Usuario existente en la BD
     * 
     * @param object $oUsuario Objeto usuario
     * @param string $descUsuario La nueva descripción
     * 
     * @return boolean | object Un objeto usuario, si el usuario existe y se puede cambiar, de lo contrario un boolean a 'false'
     */
    public static function modificarUsuario($oUsuario, $descUsuario) {
        //CONSULTA SQL - UPDATE
        $consultaModificarUsuario = <<<CONSULTA
            UPDATE T01_Usuario SET T01_DescUsuario="{$descUsuario}" WHERE T01_CodUsuario="{$oUsuario->get_CodUsuario()}";
        CONSULTA;

        $oUsuario->set_DescUsuario($descUsuario);

        if (DBPDO::ejecutaConsulta($consultaModificarUsuario)) { // Ejecuto la consulta
            return $oUsuario; // Devuelvo un objeto Usuario
        } else {
            return false;
        }
    }

    /**
     * Metodo que nos permite eliminar un usuario existente en la BD
     * 
     * @param string $codUsuario El código del usuario
     * 
     * @return bool True si el usuario se eliminó correctamente, False si hubo un error.
     */
    public static function borrarUsuario($codUsuario) {
        //CONSULTA SQL - DELETE
        $consultaEliminarUsuario = <<<CONSULTA
            DELETE FROM T01_Usuario WHERE T01_CodUsuario = '{$codUsuario}';
        CONSULTA;
        return DBPDO::ejecutaConsulta($consultaEliminarUsuario);
    }

    /**
     * Metodo que nos permite validar si el código de un usuario existe en la BD
     * 
     * @param string $codUsuario El código del usuario
     * 
     * @return Un objeto con el primer resultado de la consulta ejecutada
     */
    public static function validarCodNoExiste($codUsuario) {
        //CONSULTA SQL - SELECT
        $consultaExisteUsuario = <<<CONSULTA
            SELECT T01_CodUsuario FROM T01_Usuario WHERE T01_CodUsuario='{$codUsuario}';
        CONSULTA;
        return DBPDO::ejecutaConsulta($consultaExisteUsuario)->fetchObject();
    }

    /**
     * Metodo que nos permite actualizar la última conexión del usuario 
     * 
     * @param Object $oUsuario Contenido del objeto usuario
     * 
     * @return PDOStatement Devuelve el resultado de la consulta
     */
    public static function registrarUltimaConexion($oUsuario) {
        /**
         * Utilizando los metodos get() y set() de la clase Usuario,
         * sumaremos 1 al 'numAcceso' del Usuario y añadiremos la fecha anterior
         * como la de última conexión para la proxima vez que nos "logeemos"
         */
        $oUsuario->set_numAcceso($oUsuario->get_numAcceso() + 1);
        $oUsuario->set_fechaHoraUltimaConexionAnterior($oUsuario->get_fechaHoraUltimaConexion());

        //CONSULTA SQL - UPDATE
        $consultaActualizacionFechaUltimaConexion = <<<CONSULTA
            UPDATE T01_Usuario 
            SET T01_NumConexiones=T01_NumConexiones+1, T01_FechaHoraUltimaConexion=now() 
            WHERE T01_CodUsuario='{$oUsuario->get_CodUsuario()}';
        CONSULTA;

        DBPDO::ejecutaConsulta($consultaActualizacionFechaUltimaConexion);

        return $oUsuario;
    }
    
    /**
     * Metodo cambiarPassword()
     * 
     * Metodo que nos permite cambiar la password anterior por una nueva
     * 
     * @param object $oUsuario Objeto usuario
     * @param string $password La password nueva
     * 
     * @return boolean Un objeto usuario si el usuario existe y se puede cambiar la password, de lo contrario un boolean a false
     */
    public static function cambiarPassword($oUsuario, $password){
        //Consulta SQL para modificar la password de un usuario
        $consultaModificarPassword = <<<CONSULTA
            UPDATE T01_Usuario SET T01_Password=SHA2("{$oUsuario->get_CodUsuario()}{$password}", 256) WHERE T01_CodUsuario="{$oUsuario->get_CodUsuario()}";
        CONSULTA;
        
        /*
         * La siguente línea de código hago un hash con la nueva contraseña, para que cuando edite la 
         * contraseña del objeto Usuario, no me la guarde en el objeto sin encriptar.
         */
        $hashPassword = hash("sha256", ($oUsuario->get_CodUsuario() . $password)); 
        $oUsuario->set_Password($hashPassword);
        
        if(DBPDO::ejecutaConsulta($consultaModificarPassword)){
            return $oUsuario;
        }else{
            return false;
        }
    }
}
