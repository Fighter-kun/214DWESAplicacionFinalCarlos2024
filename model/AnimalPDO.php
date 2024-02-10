<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 09/02/2024
 * 
 * @Annotation Aplicación Final - Clase AnimalPDO
 * 
 */
class AnimalPDO {
    /**
     * Busca a un Animal por su descripción.
     *
     * @param string $descAnimal Descripción del Animal a buscar
     * 
     * @return array[object] $aAnimales Con todos los Animales de la busqueda
     * @return boolean false En caso de que la consulta sea incorrecta
     */
    public static function buscaDepartamentosPorDesc($descAnimal = '') {
        $aAnimales = [];
        // Consulta de busqueda según el valor del parametro introducido
        $consulta = <<<CONSULTA
            SELECT * FROM T06_Animal 
            WHERE T06_DescAnimal LIKE'%$descAnimal%';
        CONSULTA;

        $resultadoConsulta = DBPDO::ejecutaConsulta($consulta); // Ejecutamos la consulta

        if (!is_null($resultadoConsulta)) {
            while ($oAnimal = $resultadoConsulta->fetchObject()) { // Guardo en la variable el resultado de la consulta en forma de objeto y lo recorro
                $aAnimales[$oAnimal->T06_CodAnimal] = new Animal(
                        $oAnimal->T06_CodAnimal, 
                        $oAnimal->T06_DescAnimal, 
                        $oAnimal->T06_FechaNacimiento, 
                        $oAnimal->T06_Sexo, 
                        $oAnimal->T06_Raza, 
                        $oAnimal->T06_Precio, 
                        $oAnimal->T06_FechaBaja);
            }
            return $aAnimales;
        } else {
            return false;
        }
    }
    
    /**
     * Modifica los valores de un Animal
     *
     * @param string $codAnimal Codigo del Animal a editar
     * @param string $descAnimal Descripción del Animal a editar
     * @param float $precioAnimal Precio del Animal a editar
     * 
     * @return PDOStatment | false Devuelve el resultado de la consulta o 'false' si a ocurrido algún error
     */
    public static function modificarAnimal($codAnimal, $descAnimal, $precioAnimal) {
        // Consulta de busqueda según el valor del parametro introducido
        $consulta = <<<CONSULTA
            UPDATE T06_Animal SET 
            T06_DescAnimal = '{$descAnimal}',
            T06_Precio = {$precioAnimal}
            WHERE T06_CodAnimal = '{$codAnimal}';
        CONSULTA;

        return DBPDO::ejecutaConsulta($consulta); // Ejecutamos y devolvemos la consulta
    }
    
    /**
     * Metodo que nos permite buscar un Animal por el código 
     * 
     * @param string $codAnimal El código del Animal
     * 
     * @return object Departamento | false Devuelve el objeto o 'false' si a ocurrido algún error
     */
    public static function buscarAnimalPorCod($codAnimal) {
        //CONSULTA SQL - SELECT
        $consulta = <<<CONSULTA
            SELECT * FROM T06_Animal 
            WHERE T06_CodAnimal = '{$codAnimal}';
        CONSULTA;

        $resultado = DBPDO::ejecutaConsulta($consulta); // Ejecuto la consulta

        if ($resultado->rowCount() > 0) { // Si la consulta tiene más de '0' valores
            $oAnimal = $resultado->fetchObject(); // Guardo en la variable el resultado de la consulta en forma de objeto

            if ($oAnimal) { // Instancio un nuevo objeto Departamento con todos sus datos
                return new Animal(// Y lo devuelvo
                        $oAnimal->T06_CodAnimal, 
                        $oAnimal->T06_DescAnimal, 
                        $oAnimal->T06_FechaNacimiento, 
                        $oAnimal->T06_Sexo, 
                        $oAnimal->T06_Raza, 
                        $oAnimal->T06_Precio, 
                        $oAnimal->T06_FechaBaja);
            } else {
                return $oAnimal; // Devuelvo el objeto Departamento
            }
        } else {
            return false; // En caso de fallar devuelvo false
        }
    }
}
