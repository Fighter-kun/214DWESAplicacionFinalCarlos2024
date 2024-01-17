<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 16/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cAltaDepartamento' 
 * 
 */
// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirAñadirDepartamento'])) {
    $_SESSION['paginaAnterior'] = 'altaDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón añadir departamento, si el usuario pulsa el botón 'añadir departameto'
if (isset($_REQUEST['recargarAñadirDepartamento'])) {
    $_SESSION['paginaEnCurso'] = 'altaDepartamento'; // Asigno a la página en curso la pagina de altaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Declaración de constantes por OBLIGATORIEDAD
define('OPCIONAL', 0);
define('OBLIGATORIO', 1);

// Declaración de los limites para el metodo comprobar FLOAT
define('TAM_MAX_FLOAT', PHP_FLOAT_MAX);
define('TAM_MIN_FLOAT', PHP_FLOAT_MIN);

// Variable DateTime
$fechaYHoraActualCreacion = new DateTime('now', new DateTimeZone('Europe/Madrid'));
// Y formateo la variable '$fechaYHoraActualCreacion' para que aparezca en el input 'YYYY-mm-dd'
$fechaYHoraActualCreacionFormateada = $fechaYHoraActualCreacion->format('Y-m-d');

$mensajeDeConfirmacion = ''; // Variable para almacenar un mensaje si a salido bien o mal la inserción de datos
// Declaración de variables de estructura para validar la ENTRADA de RESPUESTAS o ERRORES
// Valores por defecto
$entradaOK = true;

$aRespuestas = [
    'CodDepartamento' => "",
    'DescDepartamento' => "",
    'FechaCreacionDepartamento' => "",
    'VolumenDeNegocio' => "",
    'FechaBajaDepartamento' => ""
];

$aErrores = [
    'CodDepartamento' => "",
    'DescDepartamento' => "",
    'FechaCreacionDepartamento' => "",
    'VolumenDeNegocio' => "",
    'FechaBajaDepartamento' => ""
];
//En el siguiente if pregunto si el '$_REQUEST' recupero el valor 'enviar' que enviamos al pulsar el boton de enviar del formulario.
if (isset($_REQUEST['añadirDepartamento'])) {
    /*
     * Ahora inicializo cada 'key' del ARRAY utilizando las funciónes de la clase de 'validacionFormularios' , la cuál 
     * comprueba el valor recibido (en este caso el que recibe la variable '$_REQUEST') y devuelve 'null' si el valor es correcto,
     * o un mensaje de error personalizado por cada función dependiendo de lo que validemos.
     */
    //Introducimos valores en el array $aErrores si ocurre un error
    $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['CodDepartamento'], 3, 3, OBLIGATORIO);

    // Ahora validamos que el codigo introducido no exista en la BD, haciendo una consulta 
    if ($aErrores['CodDepartamento'] == null) {
        try {
            // CONEXION BASE DE DATOS
            // Iniciamos la conexión con la BD
            $miDB = new PDO(DSN, USERNAME, PASSWORD);
            // CONSULTA
            // En esta línea utilizo 'quote()' se utiliza para escapar y citar el valor del $_REQUEST['CodDepartamento'], ayudando a prevenir la inyección de SQL.
            $codDepartamento = $miDB->quote($_REQUEST['CodDepartamento']);
            // Utilizamos una consulta simple para comprobar el codigo del departamento
            $consultaComprobarCodDepartamento = $miDB->query("SELECT * FROM T02_Departamento WHERE T02_CodDepartamento = $codDepartamento");
            // Y obtenemos el resultado de la consulta como un objeto.
            $departamentoExistente = $consultaComprobarCodDepartamento->fetchObject();

            // COMPROBACION DE ERROR
            if ($departamentoExistente) {
                $aErrores['CodDepartamento'] = "El código de departamento ya existe";
            }
        } catch (PDOException $miExcepcionPDO) {
            $errorExcepcion = $miExcepcionPDO->getCode(); // Almacenamos el código del error de la excepción en la variable '$errorExcepcion'
            $mensajeExcepcion = $miExcepcionPDO->getMessage(); // Almacenamos el mensaje de la excepción en la variable '$mensajeExcepcion'

            echo "<span style='color: red;'>Error: </span>" . $mensajeExcepcion . "<br>"; //Mostramos el mensaje de la excepción
            echo "<span style='color: red;'>Código del error: </span>" . $errorExcepcion; //Mostramos el código de la excepción
        } finally {
            unset($miDB); //Para cerrar la conexión
        }
    }
    $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 1, OBLIGATORIO);
    $aErrores['FechaCreacionDepartamento'] = NULL;
    $aErrores['VolumenDeNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['VolumenDeNegocio'], TAM_MAX_FLOAT, TAM_MIN_FLOAT, OBLIGATORIO);
    $aErrores['FechaBajaDepartamento'] = NULL;

    /*
     * En este foreach recorremos el array buscando que exista NULL (Los metodos anteriores si son correctos devuelven NULL)
     * y en caso negativo cambiara el valor de '$entradaOK' a false y borrara el contenido del campo.
     */
    foreach ($aErrores as $campo => $error) {
        if ($error != null) {
            $_REQUEST[$campo] = "";
            $entradaOK = false;
        }
    }
} else {
    $entradaOK = false;
}
//En caso de que '$entradaOK' sea true, cargamos las respuestas en el array '$aRespuestas'
if ($entradaOK) {

    // Utilizamos el bloque 'try'
    try {
        // CONEXION CON LA BD
        // Establecemos la conexión por medio de PDO
        $miDB = new PDO(DSN, USERNAME, PASSWORD);
        // Cargo el array con las respuestas
        $aRespuestas['CodDepartamento'] = strtoupper($_REQUEST['CodDepartamento']);
        $aRespuestas['DescDepartamento'] = $_REQUEST['DescDepartamento'];
        $aRespuestas['FechaCreacionDepartamento'] = 'now()'; // Cargo la fecha actual y hora actual
        $aRespuestas['VolumenDeNegocio'] = $_REQUEST['VolumenDeNegocio'];
        $aRespuestas['FechaBajaDepartamento'] = 'NULL';

        // CONSULTA CON QUERY()
        // Se ejecuta la consulta de insercion                    
        $numeroFilas = $miDB->exec("INSERT INTO T02_Departamento VALUES ('" . $aRespuestas['CodDepartamento'] . "','" . $aRespuestas['DescDepartamento'] . "'," . $aRespuestas['FechaCreacionDepartamento'] . "," . $aRespuestas['VolumenDeNegocio'] . "," . $aRespuestas['FechaBajaDepartamento'] . ");");

        // Ejecutando la declaración SQL y mostramos un mensaje en caso de que se inserte u ocurra un error.
        if ($numeroFilas > 0) {
            $_SESSION['paginaAnterior'] = 'añadirDepartamento'; // Almaceno la página anterior para poder volver
            $_SESSION['paginaEnCurso'] = 'consultarDepartamento'; // Asigno a la página en curso la pagina de consultarDepartamento
            header('Location: index.php'); // Redirecciono al index de la APP
            exit;
        }
    } catch (PDOException $miExcepcionPDO) {
        $errorExcepcion = $miExcepcionPDO->getCode(); // Almacenamos el código del error de la excepción en la variable '$errorExcepcion'
        $mensajeExcepcion = $miExcepcionPDO->getMessage(); // Almacenamos el mensaje de la excepción en la variable '$mensajeExcepcion'

        echo "<span style='color: red;'>Error: </span>" . $mensajeExcepcion . "<br>"; //Mostramos el mensaje de la excepción
        echo "<span style='color: red;'>Código del error: </span>" . $errorExcepcion; //Mostramos el código de la excepción
    } finally {
        unset($miDB); // Para cerrar la conexión
    }
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'AltaDepartamento'