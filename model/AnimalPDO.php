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
    public static function altaAnimal($codAnimal, $descAnimal, $fechaNacimientoAnimal, $sexoAnimal, $razaAnimal, $precioAnimal, $fechaBajaAnimal = null) {
        // Asegurémonos de que la fecha de baja tenga un formato válido si se proporciona
        $fechaBajaAnimal = ($fechaBajaAnimal !== null) ? "'{$fechaBajaAnimal}'" : 'NULL';

        //CONSULTA SQL - INSERT
        $consulta = <<<CONSULTA
        INSERT INTO T06_Animal VALUES ('{$codAnimal}','{$descAnimal}', '{$fechaNacimientoAnimal}', '{$sexoAnimal}', '{$razaAnimal}', '{$precioAnimal}', {$fechaBajaAnimal});
    CONSULTA;

        if (DBPDO::ejecutaConsulta($consulta)) { // Ejecuto la consulta
            return new Animal($codAnimal, $descAnimal, $fechaNacimientoAnimal, $sexoAnimal, $razaAnimal, $precioAnimal, $fechaBajaAnimal); // Creo el Animal con los valores recogidos
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
     * @return PDOStatment Devuelve el resultado de la consulta
     */
    public static function rehabilitarAnimal($codAnimal) {
        // Consulta - UPDATE
        $consulta = <<<CONSULTA
            UPDATE T06_Animal SET T06_FechaBaja = NULL WHERE T06_CodAnimal = '{$codAnimal}';
        CONSULTA;

        return DBPDO::ejecutaConsulta($consulta); // Ejecutamos y devolvemos la consulta
    }

    /**
     * Exporta la tabla T06_Animal en formato JSON
     * 
     * @return Devuelve un archivo ZIP con un archivo 'animales.json' dentro.
     */
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

    /**
     * Importa un fichero JSON y lo inserta en la tabla T06_Animal
     * 
     * 
     * @return string Devuelve un mensaje de confirmación si se insertan los valores de manera exitosa
     * 
     * @return null Devuelve null si el contenido del JSON no es del formato esperado o hay algún error al decodificarlo
     * @return 'archivo' Devuelve un 'log' con contenido de que problema hubo a la hora de insertar y si inserto algún valor
     */
    public static function importarAnimalesJSON() {
        // Verificamos que existe una carpeta para archivos temporales
        if (!file_exists("../tmp/")) {
            mkdir("../tmp/", 0777, true); // En caso negativo la creamos
        }

        // Recuperamos el nombre temporal del archivo
        $nombreDelArchivo = $_FILES['archivo']['tmp_name'];

        // Ahora compruebo el tipo del archivo es JSON 
        if ($_FILES['archivo']['type'] == 'application/json') {
            // Movemos a la siguiente ruta y los renombramos el archivo
            move_uploaded_file($nombreDelArchivo, '../tmp/animales.json');

            // Leemos el contenido del archivo JSON
            $contenidoArchivoJSON = file_get_contents('../tmp/animales.json');

            // Decodificamos el JSON a un array asociativo
            $aContenidoDecodificadoArchivoJSON = json_decode($contenidoArchivoJSON, true);

            // Verificamos si la decodificación fue exitosa
            if ($aContenidoDecodificadoArchivoJSON === null && json_last_error() !== JSON_ERROR_NONE) {
                // En caso negativo devolvemos null
                return null;
            }

            // Variable para contabilizar errores
            $totalErrores = 0;
            // Variable para contabilizar inserciones
            $totalInserciones = 0;
            // Array para almacenar los mensajes de error
            $aErrores = [];

            // Recorremos el array de animales decodificado
            foreach ($aContenidoDecodificadoArchivoJSON as $animal) {
                // Compruebo los indices de cada animal para comprobar que no esta mal el formato del JSON
                if (isset($animal['T06_CodAnimal'], $animal['T06_DescAnimal'], $animal['T06_FechaNacimiento'],$animal['T06_Sexo'], $animal['T06_Raza'], $animal['T06_Precio'], $animal['T06_FechaBaja'])) {
                    $codAnimal = $animal['T06_CodAnimal'];
                    $descAnimal = $animal['T06_DescAnimal'];
                    $fechaNacimientoAnimal = $animal['T06_FechaNacimiento'];
                    $sexoAnimal = $animal['T06_Sexo'];
                    $razaAnimal = $animal['T06_Raza'];
                    $precioAnimal = $animal['T06_Precio'];
                    $fechaBajaAnimal = $animal['T06_FechaBaja'];
                    
                    // Con el metodo 'validarAnimal()' de la propia clase, comprobamos si los valores del Animal son correctos
                    if (self::validarAnimal($animal)) {
                        // Verificamos si el animal ya existe en la base de datos
                        if (!self::buscarAnimalPorCod($codAnimal)) {
                            // Si no existe, procedemos a dar de alta el animal en la base de datos
                            // Llamamos al método altaAnimal para insertar el nuevo animal
                            $resultado = self::altaAnimal($codAnimal, $descAnimal, $fechaNacimientoAnimal, $sexoAnimal, $razaAnimal, $precioAnimal, $fechaBajaAnimal);

                            // Verificamos si el resultado es false (falló la inserción)
                            if ($resultado === false) {
                                $totalErrores++; // Cuento cuantos fallan
                                if ($_COOKIE['idioma'] == 'SP') {
                                    $aErrores[] = "Error al insertar el animal con código {$codAnimal}.";
                                } else {
                                    $aErrores[] = "Error when inserting the animal with code {$codAnimal}.";
                                }
                            } else {
                                $totalInserciones++; // Cuento cuantos se insertan correctamente
                            }
                        } else {
                            // El animal ya existe en la base de datos
                            $totalErrores++;
                            if ($_COOKIE['idioma'] == 'SP') {
                                $aErrores[] = "El animal con código {$codAnimal} ya existe en la base de datos.";
                            } else {
                                $aErrores[] = "The animal with code {$codAnimal} already exists in the database.";
                            }
                        }
                    }
                } else {
                    return null;
                }
            }

            // En caso de contabilizar algún error
            if ($totalErrores > 0) {
                // Creo el mensaje introduciendo los errores
                $mensajeLog = implode(PHP_EOL, $aErrores);

                // Concateno el número de excepciones almacenadas en '$totalErrores' (PHP_EOL: Representa un salto de línea)
                if ($_COOKIE['idioma'] == 'SP') {
                    $mensajeLog .= PHP_EOL . 'Total de errores: ' . $totalErrores;
                } else {
                    $mensajeLog .= PHP_EOL . 'Total errors: ' . $totalErrores;
                }


                if ($totalInserciones > 0) {
                    if ($_COOKIE['idioma'] == 'SP') {
                        $mensajeLog .= PHP_EOL . "Solo se han podido insertar " . $totalInserciones . " Animal(es).";
                    } else {
                        $mensajeLog .= PHP_EOL . "They could only be inserted " . $totalInserciones . " Animal(s).";
                    }
                }

                // Escribe en el archivo de registro
                file_put_contents('../tmp/errorImportar(JSON).log', $mensajeLog, FILE_APPEND | LOCK_EX);

                // Descargamos el archivo
                header('Content-Type: text/xml');
                header('Content-disposition: attachment; filename=' . basename('../tmp/errorImportar(JSON).log'));
                header('Content-Length: ' . filesize('../tmp/errorImportar(JSON).log'));

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
                readfile('../tmp/errorImportar(JSON).log');

                // Por último eliminamos los archivos temporales después de la descarga
                unlink('../tmp/errorImportar(JSON).log');
                exit(); // Detenemos el script
            } else {
                if ($_COOKIE['idioma'] == 'SP') {
                    return "Importación exitosa, se han podido insertar " . $totalInserciones . " Animal(es).";
                } else {
                    return "Successful import, could be inserted " . $totalInserciones . " Animal(s).";
                }
            }
        } else {
            return null; // En caso de subir un archivo que no sea JSON
        }
    }

    /**
     * Metodo para validar un animal dentro del metodo de importarAnimalesJSON()
     * 
     * @param array $aAnimal Recibe un array con los atributos de un Animal
     * 
     * @return null Devuelve null si hay algún error en el array
     * @return true Devuelve true si el array tiene el formato correcto
     */
    public static function validarAnimal($aAnimal) {
        // Iniciaizo las variables para comprobar el array
        $arrayOK = true;

        $aErrores = [
            'codAnimal' => "",
            'descAnimal' => "",
            'fechaNacimientoAnimal' => "",
            'sexoAnimal' => "",
            'razaAnimal' => "",
            'precioAnimal' => "",
            'fechaBajaAnimal' => ""
        ];

        // Variable DateTime
        $fechaYHoraActualCreacion = new DateTime('now', new DateTimeZone('Europe/Madrid'));

        /*
         * Ahora inicializo cada 'key' del ARRAY utilizando las funciónes de la clase de 'validacionFormularios' , la cuál 
         * comprueba el valor recibido (en este caso el que recibe la variable '$_REQUEST') y devuelve 'null' si el valor es correcto,
         * o un mensaje de error personalizado por cada función dependiendo de lo que validemos.
         */
        //Introducimos valores en el array $aErrores si ocurre un error
        $aErrores['codAnimal'] = validacionFormularios::comprobarAlfanumerico($aAnimal['T06_CodAnimal'], 3, 3, 1);

        // Ahora validamos que el codigo introducido no exista en la BD, haciendo una consulta 
        if ($aErrores['codAnimal'] == null) {
            /*
             * Por medio del metodo 'buscarAnimalPorCod' de la clase 'AnimalPDO' comprobamos que el código no este en uso
             */
            if (self::buscarAnimalPorCod($aAnimal['T06_CodAnimal'])) {
                return null;
            }
        }
        // Verifico las siguientes entradas de del formulario
        $aErrores['descAnimal'] = validacionFormularios::comprobarAlfaNumerico($aAnimal['T06_DescAnimal'], 255, 5, 1);
        $aErrores['fechaNacimientoAnimal'] = validacionFormularios::validarFechaHora($aAnimal['T06_FechaNacimiento'], $fechaYHoraActualCreacion->format('Y-m-d H:i:s'), '01/01/2010 00:00:00', 1);
        $aErrores['razaAnimal'] = validacionFormularios::comprobarAlfabetico($aAnimal['T06_Raza'], 255, 5, 1);
        $aErrores['precioAnimal'] = validacionFormularios::comprobarFloatMejorado($aAnimal['T06_Precio'], 9999999999, 0, 2, 2, 1);

        if (!is_null($aAnimal['T06_FechaBaja'])) {
            $aErrores['fechaBajaAnimal'] = validacionFormularios::validarFechaHora($aAnimal['T06_FechaBaja'], $fechaYHoraActualCreacion->format('Y-m-d H:i:s'), '01/01/2010 00:00:00', 1);
        }

        // Para verificar el input 'radio' 
        if ($aAnimal['T06_Sexo'] == 'macho' || $aAnimal['T06_Sexo'] == 'hembra') {
            $aErrores['sexoAnimal'] = null;
        }

        /*
         * En este foreach recorremos el array buscando que exista NULL (Los metodos anteriores si son correctos devuelven NULL)
         * y en caso negativo cambiara el valor de '$entradaOK' a false.
         */
        foreach ($aErrores as $campo => $error) {
            if ($error != null) {
                $arrayOK = false;
            }
        }

        //En caso de que '$arrayOK' sea true
        if ($arrayOK) {
            return true; // Devuelvo true 
        } else {
            return null; // En caso negativo devuelvo null
        }
    }
}
