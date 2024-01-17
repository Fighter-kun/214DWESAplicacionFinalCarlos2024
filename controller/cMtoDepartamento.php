<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 02/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cMtoDepartamento' 
 * 
 */


// Estructura del botón salir, si el usuario pulsa el botón 'salir'
if (isset($_REQUEST['salirDepartamentos'])) {
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'inicioPrivado'; // Asigno a la página en curso la pagina de inicioPrivado
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón editarDepartamento, si el usuario pulsa el botón del icono de un 'lapiz'
if (isset($_REQUEST['cConsultarModificarDepartamento'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cConsultarModificarDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'editarDepartamento'; // Asigno a la página en curso la pagina de ConsultarModificarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón eliminarDepartamento, si el usuario pulsa el botón del icono de una 'X'
if (isset($_REQUEST['cEliminarDepartamento'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cEliminarDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'eliminarDepartamento'; // Asigno a la página en curso la pagina de eliminarDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton baja, si el usuario pulsa el icono de la flecha roja 
if (isset($_REQUEST['cBajaLogicaDepartamento'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cBajaLogicaDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'bajaDepartamento'; // Asigno a la página en curso la pagina de bajaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del boton alta, si el usuario pulsa el icono de la flecha verde 
if (isset($_REQUEST['cRehabilitacionDepartamento'])) {
    $_SESSION['codDepartamentoActual'] = $_REQUEST['cRehabilitacionDepartamento']; // Almaceno en una variable de sesión el Codigo del Departamento Seleccionado
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'altaDepartamento'; // Asigno a la página en curso la pagina de altaDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón exportar, si el usuario pulsa el botón 'exportar'
if (isset($_REQUEST['exportarDepartamentos'])) {
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'exportarDepartamento'; // Asigno a la página en curso la pagina de exportarDepartamentos
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón importar, si el usuario pulsa el botón 'importar'
if (isset($_REQUEST['importarDepartamentos'])) {
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'wip'; // Asigno a la página en curso la pagina de importarDepartamentos
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

// Estructura del botón añadir departamento, si el usuario pulsa el botón 'añadir departameto'
if (isset($_REQUEST['añadirDepartamento'])) {
    $_SESSION['paginaAnterior'] = 'consultarDepartamento'; // Almaceno la página anterior para poder volver
    $_SESSION['paginaEnCurso'] = 'añadirDepartamento'; // Asigno a la página en curso la pagina de añadirDepartamento
    header('Location: index.php'); // Redirecciono al index de la APP
    exit;
}

//Declaración de variables de estructura para validar la ENTRADA de RESPUESTAS o ERRORES
//Valores por defecto
$entradaOK = true; //Indica si todas las respuestas son correctas
$aRespuestas = [
    'DescDepartamento' => '',
]; //Almacena las respuestas
$aErrores = [
    'DescDepartamento' => '',
]; //Almacena los errores
//Comprobamos si se ha enviado el formulario
if (isset($_REQUEST['enviar'])) {
    //Introducimos valores en el array $aErrores si ocurre un error
    $aErrores = [
        'DescDepartamento' => validacionFormularios::comprobarAlfabetico($_REQUEST['DescDepartamento'], 255, 1, 0),
    ];

    //Recorremos el array de errores
    foreach ($aErrores as $campo => $error) {
        if ($error == !null) {
            //Limpiamos el campos
            $entradaOK = false;
            $_REQUEST[$campo] = '';
            //Si ha dado un error la respuesta pasa a valer el valor que ha introducido el usuario
        } else {
            $aRespuestas['DescDepartamento'] = $_REQUEST['DescDepartamento'];
        }
    }
} else {
    $entradaOK = false; //Si no ha pulsado el botón de enviar la validación es incorrecta.
    try {
        //Establecimiento de la conexion
        /*
          Instanciamos un objeto PDO y establecemos la conexión
          Construccion de la cadena PDO: (ej. 'mysql:host=localhost; dbname=midb')
          host – nombre o dirección IP del servidor
          dbname – nombre de la base de datos
         */
        $miDB = new PDO(DSN, USERNAME, PASSWORD);

        
        if (!isset($_SESSION['criterioBusquedaDepartamentos']['estado'])) {
            $criterioDeBusqueda = '';
        } else {
            $criterioDeBusqueda = $_SESSION['criterioBusquedaDepartamentos']['estado'];
        }
         
        //Preparamos la consulta
        $resultadoConsulta = $miDB->query("SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE '%" . $criterioDeBusqueda . "%';");
        // Ejecutando la declaración SQL
        if ($resultadoConsulta->rowCount() == 0) {
            $aErrores['DescDepartamento'] = "No existen departamentos con esa descripcion";
        }
        // Creamos una tabla en la que mostraremos la tabla de la BD
        echo ("<div class='list-group text-center tablaMuestra'>");
        echo ("<table>
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Fecha de Creación</th>
                                            <th>Volumen de Negocio</th>
                                            <th>Fecha de Baja</th>
                                            <th colspan='3'><-T-></th>
                                        </tr>
                                        </thead>");

        /* Aqui recorremos todos los valores de la tabla, columna por columna, usando el parametro 'PDO::FETCH_ASSOC' , 
         * el cual nos indica que los resultados deben ser devueltos como un array asociativo, donde los nombres de las columnas de 
         * la tabla se utilizan como claves (keys) en el array.
         */
        echo ("<tbody>");
        while ($oDepartamento = $resultadoConsulta->fetchObject()) {
            
            
            echo ("<tr>");
            
            echo ("<td>" . $oDepartamento->T02_CodDepartamento . "</td>");
            echo ("<td>" . $oDepartamento->T02_DescDepartamento . "</td>");
            echo ("<td>" . $oDepartamento->T02_FechaCreacionDepartamento . "</td>");
            echo ("<td>" . $oDepartamento->T02_VolumenDeNegocio . "</td>");
            echo ("<td>" . $oDepartamento->T02_FechaBajaDepartamento . "</td>");

            // Formulario para editar
            echo ("<td>");
            echo ("<form " . (!is_null($oDepartamento->T02_FechaBajaDepartamento) ? 'style="display: none;"' : '') . " method='post'>");
            // Almaceno el código de departamento en una variable de sesión para poder seleccionar un departamento concreto. Tanto para editar como eliminar
            echo ("<input type='hidden' name='cConsultarModificarDepartamento' value='" . $oDepartamento->T02_CodDepartamento . "'>");
            echo ("<button type='submit'><svg fill='#666' width='16' height='16' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M4.481 15.659c-1.334 3.916-1.48 4.232-1.48 4.587 0 .528.46.749.749.749.352 0 .668-.137 4.574-1.492zm1.06-1.061 3.846 3.846 11.321-11.311c.195-.195.293-.45.293-.707 0-.255-.098-.51-.293-.706-.692-.691-1.742-1.74-2.435-2.432-.195-.195-.451-.293-.707-.293-.254 0-.51.098-.706.293z' fill-rule='evenodd'/></svg></button>");
            echo ("</form>");
            echo ("</td>");

            // Formulario para eliminar
            echo ("<td>");
            echo ("<form method='post'>");
            echo ("<input type='hidden' name='cEliminarDepartamento' value='" . $oDepartamento->T02_CodDepartamento . "'>");
            echo ("<button type='submit'><svg width='16' height='16' clip-rule='evenodd' fill-rule='evenodd' stroke-linejoin='round' stroke-miterlimit='2' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='m12 10.93 5.719-5.72c.146-.146.339-.219.531-.219.404 0 .75.324.75.749 0 .193-.073.385-.219.532l-5.72 5.719 5.719 5.719c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.385-.073-.531-.219l-5.719-5.719-5.719 5.719c-.146.146-.339.219-.531.219-.401 0-.75-.323-.75-.75 0-.192.073-.384.22-.531l5.719-5.719-5.72-5.719c-.146-.147-.219-.339-.219-.532 0-.425.346-.749.75-.749.192 0 .385.073.531.219z' fill='red'/></svg></button>");
            echo ("</form>");
            echo ("</td>");

            // Formulario para alta lógica
            echo ("<td>");
            echo ("<form method='post'>");
            echo ("<input type='hidden' name='cRehabilitacionDepartamento' value='" . $oDepartamento->T02_CodDepartamento . "'>");
            echo ("<button type='submit'>ALTA</button>");
            echo ("</form>");
            echo ("</td>");
            
            // Formulario para baja lógica
            echo ("<td>");
            echo ("<form method='post'>");
            echo ("<input type='hidden' name='cBajaLogicaDepartamento' value='" . $oDepartamento->T02_CodDepartamento . "'>");
            echo ("<button type='submit'>BAJA</button>");
            echo ("</form>");
            echo ("</td>");
            
            echo ("</tr>");
        }

        echo ("</tbody>");
        /* Ahora usamos la función 'rowCount()' que nos devuelve el número de filas afectadas por la consulta y 
         * almacenamos el valor en la variable '$numeroDeRegistros'
         */
        $numeroDeRegistrosConsulta = $resultadoConsulta->rowCount();
        // Y mostramos el número de registros
        echo ("<tfoot ><tr style='background-color: #666; color:white;'><td colspan='8'>Número de registros en la tabla Departamento: " . $numeroDeRegistrosConsulta . '</td></tr></tfoot>');
        echo ("</table>");
        echo ("</div>");
        //Mediante PDOExprecion controlamos los errores
    } catch (PDOException $excepcion) {
        echo 'Error: ' . $excepcion->getMessage() . "<br>"; //Obtiene el valor de un atributo
        echo 'Código de error: ' . $excepcion->getCode() . "<br>"; // Establece el valor de un atributo
    }
}

//Si la entrada es Ok almacenamos el valor de la respuesta del usuario en el array $aRespuestas
if ($entradaOK) {
    //Almacenamos el valor en el array
    $_SESSION['criterioBusquedaDepartamentos']['estado'] = $_REQUEST['DescDepartamento'];
    $aRespuestas['DescDepartamento']= $_REQUEST['DescDepartamento'];
    
    try {
        //Establecimiento de la conexion
        /*
          Instanciamos un objeto PDO y establecemos la conexión
          Construccion de la cadena PDO: (ej. 'mysql:host=localhost; dbname=midb')
          host – nombre o dirección IP del servidor
          dbname – nombre de la base de datos
         */
        $miDB = new PDO(DSN, USERNAME, PASSWORD);

        //Preparamos la consulta
        $resultadoConsulta = $miDB->query("SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE'%$aRespuestas[DescDepartamento]%';");
        // Ejecutando la declaración SQL
        if ($resultadoConsulta->rowCount() == 0) {
            $aErrores['DescDepartamento'] = "No existen departamentos con esa descripcion";
        }
        // Creamos una tabla en la que mostraremos la tabla de la BD
        echo ("<div class='list-group text-center tablaMuestra'>");
        echo ("<table>
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Fecha de Creación</th>
                                            <th>Volumen de Negocio</th>
                                            <th>Fecha de Baja</th>
                                            <th colspan='3'><-T-></th>
                                        </tr>
                                        </thead>");

        /* Aqui recorremos todos los valores de la tabla, columna por columna, usando el parametro 'PDO::FETCH_ASSOC' , 
         * el cual nos indica que los resultados deben ser devueltos como un array asociativo, donde los nombres de las columnas de 
         * la tabla se utilizan como claves (keys) en el array.
         */
        echo ("<tbody>");
        while ($oDepartamento = $resultadoConsulta->fetchObject()) {
            echo ("<tr>");
            
            echo ("<td>" . $oDepartamento->T02_CodDepartamento . "</td>");
            echo ("<td>" . $oDepartamento->T02_DescDepartamento . "</td>");
            echo ("<td>" . $oDepartamento->T02_FechaCreacionDepartamento . "</td>");
            echo ("<td>" . $oDepartamento->T02_VolumenDeNegocio . "</td>");
            echo ("<td>" . $oDepartamento->T02_FechaBajaDepartamento . "</td>");            

            // Formulario para editar
            echo ("<td>");
            echo ("<form " . (!is_null($oDepartamento->T02_FechaBajaDepartamento) ? 'style="display: none;"' : '') . " method='post'>");
            // Almaceno el código de departamento en una variable de sesión para poder seleccionar un departamento concreto
            echo ("<input type='hidden' name='cConsultarModificarDepartamento' value='" . $oDepartamento->T02_CodDepartamento . "'>");
            echo ("<button type='submit'><svg fill='#666' width='16' height='16' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M4.481 15.659c-1.334 3.916-1.48 4.232-1.48 4.587 0 .528.46.749.749.749.352 0 .668-.137 4.574-1.492zm1.06-1.061 3.846 3.846 11.321-11.311c.195-.195.293-.45.293-.707 0-.255-.098-.51-.293-.706-.692-.691-1.742-1.74-2.435-2.432-.195-.195-.451-.293-.707-.293-.254 0-.51.098-.706.293z' fill-rule='evenodd'/></svg></button>");
            echo ("</form>");
            echo ("</td>");

            // Formulario para eliminar
            echo ("<td>");
            echo ("<form method='post'>");
            echo ("<input type='hidden' name='cEliminarDepartamento' value='" . $oDepartamento->T02_CodDepartamento . "'>");
            echo ("<button type='submit'><svg width='16' height='16' clip-rule='evenodd' fill-rule='evenodd' stroke-linejoin='round' stroke-miterlimit='2' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='m12 10.93 5.719-5.72c.146-.146.339-.219.531-.219.404 0 .75.324.75.749 0 .193-.073.385-.219.532l-5.72 5.719 5.719 5.719c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.385-.073-.531-.219l-5.719-5.719-5.719 5.719c-.146.146-.339.219-.531.219-.401 0-.75-.323-.75-.75 0-.192.073-.384.22-.531l5.719-5.719-5.72-5.719c-.146-.147-.219-.339-.219-.532 0-.425.346-.749.75-.749.192 0 .385.073.531.219z' fill='red'/></svg></button>");
            echo ("</form>");
            echo ("</td>");

            // Formulario para alta lógica
            echo ("<td>");
            echo ("<form method='post'>");
            echo ("<input type='hidden' name='cRehabilitacionDepartamento' value='" . $oDepartamento->T02_CodDepartamento . "'>");
            echo ("<button type='submit'>ALTA</button>");
            echo ("</form>");
            echo ("</td>");
            
            // Formulario para baja lógica
            echo ("<td>");
            echo ("<form method='post'>");
            echo ("<input type='hidden' name='cBajaLogicaDepartamento' value='" . $oDepartamento->T02_CodDepartamento . "'>");
            echo ("<button type='submit'>BAJA</button>");
            echo ("</form>");
            echo ("</td>");

            echo ("</tr>");
        }

        echo ("</tbody>");
        /* Ahora usamos la función 'rowCount()' que nos devuelve el número de filas afectadas por la consulta y 
         * almacenamos el valor en la variable '$numeroDeRegistros'
         */
        $numeroDeRegistrosConsulta = $resultadoConsulta->rowCount();
        // Y mostramos el número de registros
        echo ("<tfoot ><tr style='background-color: #666; color:white;'><td colspan='8'>Número de registros en la tabla Departamento: " . $numeroDeRegistrosConsulta . '</td></tr></tfoot>');
        echo ("</table>");
        echo ("</div>");
        //Mediante PDOExprecion controlamos los errores
    } catch (PDOException $excepcion) {
        echo 'Error: ' . $excepcion->getMessage() . "<br>"; //Obtiene el valor de un atributo
        echo 'Código de error: ' . $excepcion->getCode() . "<br>"; // Establece el valor de un atributo
    } finally {
        unset($miDB);
    }
}

require_once $aView[$_COOKIE['idioma']]['layout']; // Cargo la vista de 'MtoDepartamento'