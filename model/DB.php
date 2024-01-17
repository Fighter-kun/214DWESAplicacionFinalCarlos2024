<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 03/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Proyecto LoginLogoutMulticapaPOO - Interfaz DB
 * 
 */
interface DB {
    /**
     * Ejecuta las sentencias recibidas junto con los parametros
     *
     * @param string $sentenciaSQL Sentencia SQL a ejecutar.
     * @param array | null $parametros 'Array' de parámetros para integrar en la sentencia o 'null' en caso de no tenerlos.
     */
    public static function ejecutaConsulta($sentenciaSQL, $parametros = null);
}
