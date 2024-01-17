<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 03/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Proyecto LoginLogoutMulticapaPOO - Clase DBPDO
 * 
 */
class DBPDO implements DB {
    /**
     * Ejecuta las sentencias recibidas junto con los parametros
     *
     * @param string $sentenciaSQL Sentencia SQL a ejecutar.
     * @param array | null $parametros 'Array' de parámetros para integrar en la sentencia o 'null' en caso de no tenerlos.
     * 
     * @return PDOStatement | null Devuelve el resultado de la consulta o 'null' en caso de fallar
     */
    public static function ejecutaConsulta($sentenciaSQL, $parametros = null) {
        try {
            $miDB = new PDO(DSN, USERNAME, PASSWORD); // Instanciamos un objeto PDO y establecemos la conexión
            
            $resultadoConsulta = $miDB->prepare($sentenciaSQL); // Preparo la consulta antes de ejecutarla
            $resultadoConsulta -> execute($parametros); // Ejecuto la consulta con el 'array' de parametros

            return $resultadoConsulta; // Devuelvo el resultado de la consulta
        }catch(PDOException $excepcion){ // Código que se ejecuta si hay algún error
            $_SESSION['paginaEnCurso'] = 'error'; // Asigno a la página en curso la página de error
            /**
             * Creo una variable de SESSION llamada 'error' y almaceno un objeto de la clase ErrorApp
             * 
             * En la variable '$_SESSION['paginaAnterior']' almacenamos la página anterior para poder volver una vez visualicemos el error en 'vError.php'
             */
            $_SESSION['error'] = new ErrorApp($excepcion->getCode(), $excepcion->getMessage(), $excepcion->getFile(), $excepcion->getLine(), $_SESSION['paginaAnterior']);
        } finally{
            unset($miDB); // Cierro la conexión con la BD
        }
    }
}
