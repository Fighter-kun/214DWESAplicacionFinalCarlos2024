<?php

/**
 * Origen @author: Alberto Fernandez Ramirez
 * 
 * Modificado por @author Carlos García Cachón
 * @version 1.0
 * @since 07/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - API Propia
 * 
 */
// Incluyo la configuracion de la app, la Base de Datos y los idiomas
require_once 'config/confAPP.php';
require_once 'config/confDBPDO.php';

// Inicializo las variables para la lógica
$aErrores['codigo'] = '';
$aErrores['mensaje'] = '';

$bEntradaOK = true;

// Si el usuario hace una solicitud a la API
if (isset($_REQUEST['codigoDepartamento'])) {
    /*
     * Por medio del metodo 'buscaDepartamentoPorCod' de la clase 'DepartamentoPDO' buscamos el codigo
     * introducido por el usuario y el objeto/booleano resultante lo almacenamos en la variable '$oDepartamento'
     */
    $oDepartamento = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['codigoDepartamento']);

    if ($oDepartamento !== false) { // compruebo que no me a devuelto 'false'
        // Creo un array con el contenido del Departamento obtenido y un codigo para comprobar si la conexión fue correcta
        $aDepartamento = [
            'resultado' => 'success',
            'codDepartamento' => $oDepartamento->get_CodDepartamento(),
            'descDepartamento' => $oDepartamento->get_DescDepartamento(),
            'fechaCreacionDepartamento' => $oDepartamento->get_FechaCreacionDepartamento(),
            'volumenDeNegocio' => $oDepartamento->get_VolumenDeNegocio(),
            'fechaBajaDepartamento' => $oDepartamento->get_FechaBajaDepartamento()
        ];
    } else {
        $aErrores['codigo'] = '404'; // Guardo en resultado el valor de incorrecto
        $aErrores['mensaje'] = 'No existe un departamento con el código introducido'; // Guardo en mensaje el error que se ha producido
        $bEntradaOK = false; // Pongo la entrada a 'false'
    }
} else {
    $aErrores['codigo'] = '404'; // Guardo en resultado el valor de incorrecto
    $aErrores['mensaje'] = 'No ha introducido un codigo de departamento'; // Guardo en mensaje el error que se ha producido
    $bEntradaOK = false; // Pongo la entrada a 'false'
}

if ($bEntradaOK) { //Si la entrada es correcta
    echo json_encode($aDepartamento, JSON_PRETTY_PRINT); // Codifico el array en tipo JSON y lo imprimo
} else { //Si la entrada no es correcta
    echo json_encode($aErrores, JSON_PRETTY_PRINT); // Codifico el array de errores en tipo JSON y lo imprimo
}