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
     * Busca a un Animal por su descripción de manera paginada
     * 
     * Metodo que nos sirve para buscar un Animal mediante la descripción del departamento en la BD 
     * 
     * @param string $descAnimal Descripción del Animal a buscar
     * @param int $iPagina Número de pagina que ha solicitado el usuario
     * 
     * @return array[object] $aAnimales Con todos los Animales de la busqueda
     * @return boolean false En caso de que la consulta sea incorrecta
     */
    public static function buscaDepartamentosPorDescPaginados($descAnimal = '', $iPagina = 0) {
        /*
         * Variable para determinar desde qué registro empezar a obtener resultados en la consulta SQL.
         * Cada vez que se pasa a una nueva página, se multiplica el número de página por 5 
         * para obtener el índice de inicio de la siguiente página.
         */
        $iPagina = $iPagina * 5;

        /*
         * Consulta SQL para validar si la descripción del Departamento existe, filtrar por estado, y comprobar el número de pagina.
         * Y devolvemos 5 registros desde el 'puntero' asociado a esta variable '$iPagina'.
         */
        $consultaBuscarDepartamentoDesc = <<<CONSULTA
            SELECT * FROM T06_Animal 
            WHERE T06_DescAnimal LIKE'%{$descAnimal}%' LIMIT {$iPagina}, 5;
        CONSULTA;

        $resultadoConsulta = DBPDO::ejecutaConsulta($consultaBuscarDepartamentoDesc); // Ejecutamos la consulta

        $aAnimales = []; // Declaro el array para almacenar los Departamentos
        if ($resultadoConsulta !== false) {
            while ($oAnimal = $resultadoConsulta->fetchObject()) { // Recorro el resultado de la consulta y creo un objeto por iteración (elemento)
                $aAnimales[$oAnimal->T06_CodAnimal] = new Animal(
                        $oAnimal->T06_CodAnimal, 
                        $oAnimal->T06_DescAnimal, 
                        $oAnimal->T06_FechaNacimiento, 
                        $oAnimal->T06_Sexo, 
                        $oAnimal->T06_Raza, 
                        $oAnimal->T06_Precio, 
                        $oAnimal->T06_FechaBaja);
            }
            return $aAnimales; // Devuelvo el 'array' con todos los Departamentos
        } else {
            return false; // Si ocurre algún error devolvemos 'false'
        }
    }
    
    /**
     * Cuenta todos los Animales 
     * 
     * Metodo que permite devolver el total de Animales que existen en la BD
     * 
     * @param string $descAnimal Descripción del Departamento
     * 
     * @return int $iAnimales El número total de Animales
     */
    public static function buscaAnimalesTotales($descAnimal = '') {
        //Consulta SQL para obtener el total de Departamentos según el criterio que aplicamos
        $consultaBuscarDepartamentoTotales = <<<CONSULTA
            SELECT * FROM T06_Animal 
            WHERE T06_DescAnimal LIKE'%{$descAnimal}%';
        CONSULTA;

        $resultadoConsulta = DBPDO::ejecutaConsulta($consultaBuscarDepartamentoTotales); //Ejecuto la consulta
        $iAnimales = $resultadoConsulta->rowCount(); //Cuento el total de departamentos que tiene la consulta

        return $iAnimales; //Devuelvo el total de departamentos
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
