<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 03/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Proyecto LoginLogoutMulticapaPOO - Clase Usuario 
 * 
 */

class Usuario {
    /**
     * Codigo del Usuario
     * @var string
     */
    private $codUsuario;
    /**
     * Contraseña del Usuario
     * @var string
     */
    private $password;
    /**
     * Descripción del Usuario
     * @var string
     */
    private $descUsuario;
    /**
     * Número de accesos del Usuario
     * @var int
     */
    private $numAcceso;
    /**
     * Fecha y hora de la última conexión del Usuario
     * @var datetime
     */
    private $fechaHoraUltimaConexion;
    /**
     * Fecha y hora de la última conexión anterior del Usuario
     * @var datetime
     */
    private $fechaHoraUltimaConexionAnterior;
    /**
     * Tipo de perfil del Usuario (Administrador o Usuario)
     * @var string
     */
    private $perfil;
    
    /**
     * Contructor de la clase Usuario
     * 
     * @param string $codUsuario
     * @param string $password
     * @param string $descUsuario
     * @param int $numAcceso
     * @param datetime $fechaHoraUltimaConexion
     * @param datetime $fechaHoraUltimaConexionAnterior
     * @param string $perfil
     */
    public function __construct($codUsuario, $password, $descUsuario, $numAcceso, $fechaHoraUltimaConexion, $fechaHoraUltimaConexionAnterior, $perfil) {
        $this->codUsuario = $codUsuario;
        $this->password = $password;
        $this->descUsuario = $descUsuario;
        $this->numAcceso = $numAcceso;
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
        $this->perfil = $perfil;
    }
    
    
    /**
     * Obtiene el código de usuario.
     *
     * @return int El código de usuario.
     */
    public function get_codUsuario() {
        return $this->codUsuario;
    }

    /**
     * Obtiene la contraseña del usuario.
     *
     * @return string La contraseña del usuario.
     */
    public function get_password() {
        return $this->password;
    }

    /**
     * Obtiene la descripción del usuario.
     *
     * @return string La descripción del usuario.
     */
    public function get_descUsuario() {
        return $this->descUsuario;
    }

    /**
     * Obtiene el número de accesos del usuario.
     *
     * @return int El número de accesos del usuario.
     */
    public function get_numAcceso() {
        return $this->numAcceso;
    }

    /**
     * Obtiene la fecha y hora de la última conexión del usuario.
     *
     * @return DateTime La fecha y hora de la última conexión del usuario.
     */
    public function get_fechaHoraUltimaConexion() {
        return $this->fechaHoraUltimaConexion;
    }

    /**
     * Obtiene la fecha y hora de la última conexión anterior del usuario.
     *
     * @return DateTime La fecha y hora de la última conexión anterior del usuario.
     */
    public function get_fechaHoraUltimaConexionAnterior() {
        return $this->fechaHoraUltimaConexionAnterior;
    }

    /**
     * Establece el código de usuario.
     *
     * @param int $codUsuario El nuevo código de usuario.
     */
    public function set_codUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    /**
     * Establece la contraseña del usuario.
     *
     * @param string $password La nueva contraseña del usuario.
     */
    public function set_password($password) {
        $this->password = $password;
    }

    /**
     * Establece la descripción del usuario.
     *
     * @param string $descUsuario La nueva descripción del usuario.
     */
    public function set_descUsuario($descUsuario) {
        $this->descUsuario = $descUsuario;
    }

    /**
     * Establece el número de accesos del usuario.
     *
     * @param int $numAcceso El nuevo número de accesos del usuario.
     */
    public function set_numAcceso($numAcceso) {
        $this->numAcceso = $numAcceso;
    }

    /**
     * Establece la fecha y hora de la última conexión del usuario.
     *
     * @param DateTime $fechaHoraUltimaConexion La nueva fecha y hora de la última conexión del usuario.
     */
    public function set_fechaHoraUltimaConexion($fechaHoraUltimaConexion) {
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
    }

    /**
     * Establece la fecha y hora de la última conexión anterior del usuario.
     *
     * @param DateTime $fechaHoraUltimaConexionAnterior La nueva fecha y hora de la última conexión anterior del usuario.
     */
    public function set_fechaHoraUltimaConexionAnterior($fechaHoraUltimaConexionAnterior) {
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
    }

    /**
     * Establece el perfil del usuario.
     *
     * @param string $perfil El nuevo perfil del usuario.
     */
    public function set_perfil($perfil) {
        $this->perfil = $perfil;
    }



}
