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
}