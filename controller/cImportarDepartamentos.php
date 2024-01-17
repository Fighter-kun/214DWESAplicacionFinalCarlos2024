<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 17/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cImportarDepartamentos' 
 * 
 */

// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirImportar'])) {
    $_SESSION['paginaAnterior'] = 'eliminarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Variable para almacenar los insert correctos
$_SESSION['contadorRegistrosCorrectos'] = 0;

// Estructura del botón importar, si el usuario pulsa el botón 'importar'
if (isset($_REQUEST['importarDepartamentos'])) {
    $aErrores = []; // Array para almacenar los errores
    $totalErrores = 0; // Contador de errores
    // Compruebo que se a cargado algún archivo al enviar el formulario
    if ($_FILES['archivo'] != null) {
        $miDB = new PDO(DSN, USERNAME, PASSWORD); // Instanciamos un objeto PDO y establecemos la conexión
        // Verificamos que existe una carpeta para archivos temporales
        if (!file_exists("../tmp/")) {
            mkdir("../tmp/", 0777, true); // En caso negativo la creamos
        }

        // Recuperamos el nombre temporal del archivo
        $nombreDelArchivo = $_FILES['archivo']['tmp_name'];

        // Ahora compruebo el tipo del archivo es JSON 
        if ($_FILES['archivo']['type'] == 'application/json') {
            // Movemos a la siguiente ruta y los renombramos el archivo
            move_uploaded_file($nombreDelArchivo, '../tmp/departamentos.json');

            // Leemos el contenido del archivo JSON
            $contenidoArchivoJSON = file_get_contents('../tmp/departamentos.json');

            // Decodificamos el JSON a un array asociativo
            $aContenidoDecodificadoArchivoJSON = json_decode($contenidoArchivoJSON, true);

            // Verificamos si la decodificación fue exitosa
            if ($aContenidoDecodificadoArchivoJSON === null && json_last_error() !== JSON_ERROR_NONE) {
                // En caso negativo "matamos" la ejecución del script
                die('Error al decodificar el archivo JSON.');
            }

            // CONSULTAS Y TRANSACCION
            $miDB->beginTransaction(); // Deshabilitamos el modo autocommit
            // Consultas SQL de inserción 
            $consultaInsercion = "INSERT INTO T02_Departamento(T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenDeNegocio, T02_FechaBajaDepartamento) "
                    . "VALUES (:CodDepartamento, :DescDepartamento, :FechaCreacionDepartamento, :VolumenDeNegocio, :FechaBajaDepartamento)";

            // Preparamos las consultas
            $resultadoconsultaInsercion = $miDB->prepare($consultaInsercion);

            foreach ($aContenidoDecodificadoArchivoJSON as $departamento) {
                try {
                // Recorremos los registros que vamos a insertar en la tabla
                $codDepartamento = $departamento['T02_CodDepartamento'];
                $descDepartamento = $departamento['T02_DescDepartamento'];
                $fechaCreacionDepartamento = $departamento['T02_FechaCreacionDepartamento'];
                $volumenNegocio = $departamento['T02_VolumenDeNegocio'];
                /*
                * Utilizamos un operador ternario para en caso de recibir un string "NULL" , almacene en la variable un 'NULL' o
                * su valor en caso de no ser así
                */
                $fechaBajaDepartamento = $departamento['T02_FechaBajaDepartamento'] === 'NULL' ? NULL : $departamento['T02_FechaBajaDepartamento'];

                $aRegistros = [
                    ':CodDepartamento' => $codDepartamento,
                    ':DescDepartamento' => $descDepartamento,
                    ':FechaCreacionDepartamento' => $fechaCreacionDepartamento,
                    ':VolumenDeNegocio' => $volumenNegocio,
                    ':FechaBajaDepartamento' => $fechaBajaDepartamento
                ];

                $resultadoconsultaInsercion->execute($aRegistros);
                $_SESSION['contadorRegistrosCorrectos']++; // Cuento cada Insert sin fallos que ocurra
                } catch (PDOException $ex) {
                    // En caso de error guardamos el código del departamento cuando ocurrio el error
                    $codDepartamentoError = $departamento['T02_CodDepartamento'];
                    $errorMensaje = $ex->getMessage(); // Y el mensaje de que error ocurrio
                    // Luego lo almaceno en el array de '$aErrores'
                    $aErrores[] = "Error al insertar departamento $codDepartamentoError: $errorMensaje";
                    $totalErrores++;
                }
            }

            $miDB->commit(); // Confirma los cambios y los consolida
            // En caso de contabilizar algún error
            if ($totalErrores > 0) {
                // Creo el mensaje introduciendo los errores
                $mensajeLog = implode(PHP_EOL, $aErrores);

                // Concateno el número de excepciones almacenadas en '$totalErrores'
                $mensajeLog .= PHP_EOL . 'Total de errores: ' . $totalErrores;

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
            }
        }
        // Ahora compruebo el tipo del archivo es XML
        if ($_FILES['archivo']['type'] == 'text/xml') {
            // Movemos a la siguiente ruta y los renombramos el archivo
            move_uploaded_file($nombreDelArchivo, '../tmp/departamentos.xml');

            // Creamos un objeto DOMDocument indicando la versión y la codificación del documento como parametros
            $archivoXML = new DOMDocument("1.0", "utf-8");
            // Cargamos el archivo 'xml' indicandole la ruta
            $archivoXML->load('../tmp/departamentos.xml');

            $archivoXML->formatOutput = true; //Le asigno la salida con formato

            $departamento = $archivoXML->getElementsByTagName('Departamento'); // Creo el nodo departamento
            // CONSULTAS Y TRANSACCION
            $miDB->beginTransaction(); // Deshabilitamos el modo autocommit
            // Consultas SQL de inserción 
            $consultaInsercion = "INSERT INTO T02_Departamento(T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenDeNegocio, T02_FechaBajaDepartamento) "
                    . "VALUES (:CodDepartamento, :DescDepartamento, :FechaCreacionDepartamento, :VolumenDeNegocio, :FechaBajaDepartamento)";

            // Preparamos las consultas
            $resultadoconsultaInsercion = $miDB->prepare($consultaInsercion);

            foreach ($departamento as $valor) {
                try {
                    $codDepartamento = $valor->getElementsByTagName("T02_CodDepartamento")->item(0)->nodeValue;
                    $descDepartamento = $valor->getElementsByTagName("T02_DescDepartamento")->item(0)->nodeValue;
                    $fechaCreacionDepartamento = $valor->getElementsByTagName("T02_FechaCreacionDepartamento")->item(0)->nodeValue;
                    $volumenDeNegocio = $valor->getElementsByTagName("T02_VolumenDeNegocio")->item(0)->nodeValue;
                    /*
                     * Utilizamos un operador ternario para en caso de recibir un string "NULL" , almacene en la variable un 'NULL' o
                     * su valor en caso de no ser así
                     */
                    $fechaBajaDepartamento = ($valor->getElementsByTagName("T02_FechaBajaDepartamento")->item(0)->nodeValue === 'NULL') ? NULL : $valor->getElementsByTagName("T02_FechaBajaDepartamento")->item(0)->nodeValue;

                    $aRegistros = [
                        ':CodDepartamento' => $codDepartamento,
                        ':DescDepartamento' => $descDepartamento,
                        ':FechaCreacionDepartamento' => $fechaCreacionDepartamento,
                        ':VolumenDeNegocio' => $volumenDeNegocio,
                        ':FechaBajaDepartamento' => $fechaBajaDepartamento
                    ];

                    $resultadoconsultaInsercion->execute($aRegistros); // Ejecuto la consulta preparada
                    $_SESSION['contadorRegistrosCorrectos']++; // Cuento cada Insert sin fallos que ocurra
                } catch (PDOException $ex) {
                    // En caso de error guardamos el código del departamento cuando ocurrio el error
                    $codDepartamentoError = $valor->getElementsByTagName("T02_CodDepartamento")->item(0)->nodeValue;
                    $errorMensaje = $ex->getMessage(); // Y el mensaje de que error ocurrio
                    // Luego lo almaceno en el array de '$aErrores'
                    $aErrores[] = "Error al insertar departamento $codDepartamentoError: $errorMensaje";
                    $totalErrores++;
                }
            }

            $miDB->commit(); // Confirma los cambios y los consolida
            // En caso de contabilizar algún error
            if ($totalErrores > 0) {
                // Creo el mensaje introduciendo los errores
                $mensajeLog = implode(PHP_EOL, $aErrores);

                // Concateno el número de excepciones almacenadas en '$totalErrores'
                $mensajeLog .= PHP_EOL . 'Total de errores: ' . $totalErrores;

                // Escribe en el archivo de registro
                file_put_contents('../tmp/errorImportar(XML).log', $mensajeLog, FILE_APPEND | LOCK_EX);

                // Descargamos el archivo
                header('Content-Type: text/xml');
                header('Content-disposition: attachment; filename=' . basename('../tmp/errorImportar(XML).log'));
                header('Content-Length: ' . filesize('../tmp/errorImportar(XML).log'));

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
                readfile('../tmp/errorImportar(XML).log');

                // Por último eliminamos los archivos temporales después de la descarga
                unlink('../tmp/errorImportar(XML).log');
                exit(); // Detenemos el script
            }
        }
    }
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'ImportarDepartamentos'