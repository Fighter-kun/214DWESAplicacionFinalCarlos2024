<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 18/01/2024
 * 
 * @Annotation Aplicación Final - Clase DepartamentoPDO
 * 
 */
class DepartamentoPDO {
    /**
     * Valida las credenciales de un usuario.
     *
     * @param string $descDepartamento Descripción del Departamento a buscar
     * 
     * @return array[object] $aDepartamentos Con todos los departamentos de la busqueda
     * @return boolean false En caso de que la consulta sea incorrecta
     */
    public static function buscaDepartamentosPorDesc($descDepartamento = '') {
        $aDepartamentos = [];
        // Consulta de busqueda según el valor del parametro introducido
        $consulta = <<<CONSULTA
            SELECT * FROM T02_Departamento 
            WHERE T02_DescDepartamento LIKE'%$descDepartamento%';
        CONSULTA;
        
        $resultadoConsulta = DBPDO::ejecutaConsulta($consulta); // Ejecutamos la consulta
        
        if (!is_null($resultadoConsulta)) {
            while ($oDepartamento = $resultadoConsulta->fetchObject()) { // Guardo en la variable el resultado de la consulta en forma de objeto y lo recorro
                $aDepartamentos[$oDepartamento->T02_CodDepartamento] = new Departamento(
                    $oDepartamento->T02_CodDepartamento,
                    $oDepartamento->T02_DescDepartamento,
                    $oDepartamento->T02_FechaCreacionDepartamento,
                    $oDepartamento->T02_VolumenDeNegocio,
                    $oDepartamento->T02_FechaBajaDepartamento);
            }
            return $aDepartamentos;
        } else {
            return false;
        }
    }
    /**
     * Metodo que nos permite buscar un departamento por el código 
     * 
     * @param string $codDepartamento El código del Departamento
     * 
     * @return object Departamento 
     */
    public static function buscaDepartamentoPorCod($codDepartamento) {
        //CONSULTA SQL - SELECT
        $consulta = <<<CONSULTA
            SELECT * FROM T02_Departamento 
            WHERE T02_CodDepartamento = '{$codDepartamento}';
        CONSULTA;

        $resultado = DBPDO::ejecutaConsulta($consulta); // Ejecuto la consulta

        if ($resultado->rowCount() > 0) { // Si la consulta tiene más de '0' valores
            $oDepartamento = $resultado->fetchObject(); // Guardo en la variable el resultado de la consulta en forma de objeto

            if ($oDepartamento) { // Instancio un nuevo objeto Departamento con todos sus datos
               return new Departamento( // Y lo devuelvo
                        $oDepartamento->T02_CodDepartamento,
                        $oDepartamento->T02_DescDepartamento,
                        $oDepartamento->T02_FechaCreacionDepartamento,
                        $oDepartamento->T02_VolumenDeNegocio);
            } else {
                return $oDepartamento; // Si no devuelvo el valor por defecto 'NULL'
            }
        }
    }
    /**
     * Modifica los valores de un departamento
     *
     * @param string $codDepartamento Codigo del Departamento a editar
     * @param string $descDepartamento Descripción del Departamento a editar
     * @param float $volumenDeNegocio Volumen de Negocio del Departamento a editar
     * 
     * @return PDOStatment Devuelve el resultado de la coonsulta
     */
    public static function modificaDepartamento($codDepartamento, $descDepartamento, $volumenDeNegocio) {
        // Consulta de busqueda según el valor del parametro introducido
        $consulta = <<<CONSULTA
            UPDATE T02_Departamento SET 
            T02_DescDepartamento = '{$descDepartamento}',
            T02_VolumenDeNegocio = {$volumenDeNegocio}
            WHERE T02_CodDepartamento = '{$codDepartamento}';
        CONSULTA;
        
        return DBPDO::ejecutaConsulta($consulta); // Ejecutamos y devolvemos la consulta
    }
    
}