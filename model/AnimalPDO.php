<?php

/**
 * Clase AnimalPDO
 *
 * Fichero con la clase AnimalPDO 
 *
 */

/**
 * Clase AnimalPDO
 * 
 * Clase que utilizamos de acceso a datos con todos los metodos que usamos con los objetos Animal
 * 
 * @author Carlos García Cachón
 * @version 1.0
 * @since 09/02/2024
 * 
 * @Annotation Aplicación Final - Clase AnimalPDO
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
    public static function buscarAnimalesPorDesc($descAnimal = '') {
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
     * Metodo que nos sirve para buscar un Animal mediante la descripción y el estado de un Animal en la BD 
     * 
     * @param string $descAnimal Descripción del Animal a buscar
     * @param int $sEstado Estado del filtrado de la busqueda por altas o bajas
     * @param int $iPagina Número de pagina que ha solicitado el usuario
     * 
     * @return array[object] $aAnimales Con todos los Animales de la busqueda
     * @return boolean false En caso de que la consulta sea incorrecta
     */
    public static function buscarAnimalesPorDescYEstadoPaginados($descAnimal = '', $sEstado = 0, $iPagina = 0) {
        /*
         * Variable para determinar desde qué registro empezar a obtener resultados en la consulta SQL.
         * Cada vez que se pasa a una nueva página, se multiplica el número de página por 5 
         * para obtener el índice de inicio de la siguiente página.
         * 
         * Le restamos 1 a la variable de '$iPagina' para indicar el indice 0 de la paginación y que así nos muestre los 5 primeros resultado.
         */
        $iPagina = ($iPagina - 1) * 5;

        // Switch para añadir código a la consulta en función de los parámetros de búsqueda
        switch ($sEstado) {
            case 0:
                $sEstado = '';
                break;
            case 1:
                $sEstado = 'AND T06_FechaBaja IS NULL';
                break;
            case 2:
                $sEstado = 'AND T06_FechaBaja IS NOT NULL';
                break;
        }

        /*
         * Consulta SQL para validar si la descripción del Departamento existe, filtrar por estado, y comprobar el número de pagina.
         * Y devolvemos 5 registros desde el 'puntero' asociado a esta variable '$iPagina'.
         * También se agrega la cláusula ORDER BY para ordenar por T06_DescAnimal de manera ascendente.
         */
        $consultaBuscarDepartamentoDesc = <<<CONSULTA
        SELECT * FROM T06_Animal 
        WHERE T06_DescAnimal LIKE'%{$descAnimal}%' {$sEstado} ORDER BY T06_DescAnimal ASC LIMIT {$iPagina}, 5;
    CONSULTA;

        $resultadoConsulta = DBPDO::ejecutaConsulta($consultaBuscarDepartamentoDesc); // Ejecutamos la consulta

        $aAnimales = []; // Declaro el array para almacenar los Departamentos
        if ($resultadoConsulta !== false) {
            while ($oT06_Animal = $resultadoConsulta->fetchObject()) { // Recorro el resultado de la consulta y creo un objeto por iteración (elemento)
                $aAnimales[$oT06_Animal->T06_CodAnimal] = new Animal(
                        $oT06_Animal->T06_CodAnimal,
                        $oT06_Animal->T06_DescAnimal,
                        $oT06_Animal->T06_FechaNacimiento,
                        $oT06_Animal->T06_Sexo,
                        $oT06_Animal->T06_Raza,
                        $oT06_Animal->T06_Precio,
                        $oT06_Animal->T06_FechaBaja
                );
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
     * @param int $sEstado Estado del filtrado de la busqueda por altas o bajas
     * 
     * 
     * @return int $iAnimales El número total de Animales
     */
    public static function buscaAnimalesTotalesPorDescYEstado($descAnimal = '', $sEstado = 0) {
        //Consulta SQL para obtener el total de Departamentos según el criterio que aplicamos
        // Switch para añadir código a la consulta en función de los parámetros de búsqueda
        switch ($sEstado) {
            case 0:
                $sEstado = '';
                break;
            case 1:
                $sEstado = 'AND T06_FechaBaja IS NULL';
                break;
            case 2:
                $sEstado = 'AND T06_FechaBaja IS NOT NULL';
                break;
        }
        $consultaBuscarDepartamentoTotales = <<<CONSULTA
            SELECT * FROM T06_Animal 
            WHERE T06_DescAnimal LIKE'%{$descAnimal}%' {$sEstado};
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

    /**
     * Metodo que permite dar de alta un nuevo Animal en la BD
     * 
     * @param string $codAnimal El codigo de Animal
     * @param string $descAnimal La descripción de Animal
     * @param string $fechaNacimientoAnimal La fecha de nacimiento del Animal
     * @param string $sexoAnimal Sexo de Animal
     * @param string $razaAnimal Raza de Animal
     * @param string $precioAnimal Precio de Animal
     * 
     * @return boolean false | object Animal Devuelve un objeto Animal nuevo si se ha podido crear, de lo contrario devuelve un @boolean que sera 'false'
     */
    public static function altaAnimal($codAnimal, $descAnimal, $fechaNacimientoAnimal, $sexoAnimal, $razaAnimal, $precioAnimal) {
        //CONSULTA SQL - INSERT
        $consulta = <<<CONSULTA
            INSERT INTO T06_Animal VALUES ('{$codAnimal}','{$descAnimal}', '{$fechaNacimientoAnimal}', '{$sexoAnimal}', '{$razaAnimal}', '{$precioAnimal}', NULL);
        CONSULTA;

        if (DBPDO::ejecutaConsulta($consulta)) { // Ejecuto la consulta
            return new Animal($codAnimal, $descAnimal, $fechaNacimientoAnimal, $sexoAnimal, $razaAnimal, $precioAnimal, NULL); // Creo el Animal con los valores recogidos
        } else {
            return false; // Si la consulta falla devuelvo 'false'
        }
    }

    /**
     * Eliminar un Animal (Baja Física)
     *
     * @param string $codAnimal Codigo del Animal a eliminar
     * 
     * @return PDOStatment Devuelve el resultado de la consulta
     */
    public static function bajaFisicaAnimal($codAnimal) {
        // Consulta de busqueda según el valor del parametro introducido
        $consulta = <<<CONSULTA
            DELETE FROM T06_Animal WHERE T06_CodAnimal = '{$codAnimal}';
        CONSULTA;

        return DBPDO::ejecutaConsulta($consulta); // Ejecutamos y devolvemos la consulta
    }

    /**
     * Modifica el valor de la fecha de baja a un Animal (Baja Lógica)
     *
     * @param string $codAnimal Codigo del Animal a modificar
     * 
     * @return PDOStatment Devuelve el resultado de la coonsulta
     */
    public static function bajaLogicaAnimal($codAnimal) {
        // Consulta - UPDATE
        $consulta = <<<CONSULTA
            UPDATE T06_Animal SET T06_FechaBaja = NOW() WHERE T06_CodAnimal = '{$codAnimal}';
        CONSULTA;

        return DBPDO::ejecutaConsulta($consulta); // Ejecutamos y devolvemos la consulta
    }

    /**
     * Modifica el valor de la fecha de baja a un Animal (Alta Lógica)
     *
     * @param string $codAnimal Codigo del Animal a modificar
     * 
     * @return PDOStatment Devuelve el resultado de la coonsulta
     */
    public static function rehabilitarAnimal($codAnimal) {
        // Consulta - UPDATE
        $consulta = <<<CONSULTA
            UPDATE T06_Animal SET T06_FechaBaja = NULL WHERE T06_CodAnimal = '{$codAnimal}';
        CONSULTA;

        return DBPDO::ejecutaConsulta($consulta); // Ejecutamos y devolvemos la consulta
    }

    public static function exportarAnimalesJSON() {
        // Consulta - SELECT
        $consulta = <<<CONSULTA
            SELECT * FROM T06_Animal;
        CONSULTA;

        $resultadoConsulta = DBPDO::ejecutaConsulta($consulta); // Ejecutamos y devolvemos la consulta

        $oResultadoJson = $resultadoConsulta->fetchObject();

        $aAnimales = []; // Inicializamos un array vacío para almacenar todos los Animales
        $numeroAnimales = 0; // Inicializamos el contador
        // Recorro los registros que devuelve la consulta y obtengo por cada valor su resultado
        while ($oResultadoJson) {
            //Guardamos los valores en un array asociativo
            $aAnimal = [
                'T06_CodAnimal' => $oResultadoJson->T06_CodAnimal,
                'T06_DescAnimal' => $oResultadoJson->T06_DescAnimal,
                'T06_FechaNacimiento' => $oResultadoJson->T06_FechaNacimiento,
                'T06_Sexo' => $oResultadoJson->T06_Sexo,
                'T06_Raza' => $oResultadoJson->T06_Raza,
                'T06_Precio' => $oResultadoJson->T06_Precio,
                'T06_FechaBaja' => $oResultadoJson->T06_FechaBaja
            ];

            // Añadimos el array $aDepartamento al array $aAnimal
            $aAnimales[] = $aAnimal;

            //Incremento el contador de departamentos para almacenar información en la siguiente posición        
            $numeroAnimales++;

            //Guardo el registro actual y avanzo el puntero al siguiente registro que obtengo de la consulta
            $oResultadoJson = $resultadoConsulta->fetchObject();
        }


        /**
         * La funcion json_encode devuelve un string con la representacion JSON
         * Le pasamos el array aDepartamentos y utilizanos el atributo JSON_PRRETY_PRINT para que use espacios en blanco para formatear los datos devueltos.
         */
        $json = json_encode($aAnimales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        /**
         * Mediante la funcion file_put_contents() podremos escribir informacion en un fichero
         * Pasandole como parametros la ruta donde queresmos que se guarde y el que queremos sobrescribir
         * JSON_UNESCAPED_UNICODE: Codifica caracteres Unicode multibyte literalmente
         */
        // Ruta del archivo JSON
        $rutaArchivoJSON = "../tmp/animales.json";
        
        // Intenta escribir en el archivo
        file_put_contents($rutaArchivoJSON, $json);

        // Verificamos que existe una carpeta para archivos temporales
        if (!file_exists("../tmp/")) {
            mkdir("../tmp/", 0777, true); // En caso negativo la creamos
        }

        // Ruta del archivo ZIP
        $rutaArchivoZIP = "../tmp/animales.zip";

        $oZip = new ZipArchive(); // Intancio un objeto de la clase 'ZipArchive()' para guardar en zip ambos archivos 
        /*
         * En la siguiente condición abrimos el objeto '$oZIP' y en los parámetros le indicamos
         * la ruta donde se encuentra el ZIP y que debe crear el archivo si no existe, o actualizarlo.
         * Comprobamos con el operador '=== true' que 'open()' a sido exitoso.
         */
        if ($oZip->open($rutaArchivoZIP, ZipArchive::CREATE) === true) {

            // Agregamos los archivos JSON y XML al ZIP
            $oZip->addFile("../tmp/animales.json", "animales.json");

            $oZip->close(); // Cerramos el ZIP
            // Descarga el archivo ZIP
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . basename($rutaArchivoZIP));
            header('Content-Length: ' . filesize($rutaArchivoZIP));

            /*
             * La función 'ob_clean()' la utilizaremos para limpiar el almacenamiento del 
             * buffer antes de enviar los datos al navegador de manera que solo se manden el arhivo zip 
             */
            ob_clean();

            /*
             * La función 'flush()' asegura que todos los datos almacenados en el buffer se envíen 
             * inmediatamente al navegador para evitar que el navegador espere a que se ejecute todo el script
             */
            flush();

            /*
             * La función 'readfile()' que recibe como parámetro la ruta del archivo zip, se encarga de leer
             * el archivo y enviarlo directamente a la salida del buffer
             */
            readfile($rutaArchivoZIP);

            // Por último eliminamos los archivos temporales después de la descarga
            unlink($rutaArchivoZIP);
            unlink("../tmp/animales.json");
        }
    }
}
