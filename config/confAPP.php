<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 17/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de configuración
 * 
 */
require_once 'core/231018libreriaValidacion.php'; // Incluimos la librería de validación
// Incluimos los archivos de la parte del MODELO
require_once 'model/DB.php';
require_once 'model/DBPDO.php';
require_once 'model/ErrorApp.php';
require_once 'model/Usuario.php';
require_once 'model/UsuarioDB.php';
require_once 'model/UsuarioPDO.php';
require_once 'model/Departamento.php';
require_once 'model/DepartamentoPDO.php';
require_once 'model/REST.php';
require_once 'model/Animal.php';
require_once 'model/AnimalPDO.php';

// Constantes para la busqueda de Mto.Departamento
define("ESTADO_TODOS", 0);
define("ESTADO_ALTAS", 1);
define("ESTADO_BAJAS", 2);

// Creamos dos 'arrays' para indicar el 'path' de los archivos del controlador y la vista
$aController = [
    'inicioPublico' => 'controller/cInicioPublico.php',
    'login' => 'controller/cLogin.php',
    'inicioPrivado' => 'controller/cInicioPrivado.php',
    'detalle' => 'controller/cDetalle.php',
    'tecnologias' => 'controller/cTecnologias.php',
    'rss' => 'controller/cRSS.php',
    'registro' => 'controller/cRegistro.php',
    'miCuenta' => 'controller/cMiCuenta.php',
    'borrarCuenta' => 'controller/cBorrarCuenta.php',
    'wip' => 'controller/cWIP.php',
    'error' => 'controller/cError.php',
    'cambiarContraseña' => 'controller/cCambiarPassword.php',
    'consultarDepartamento' => 'controller/cMtoDepartamento.php',
    'añadirDepartamento' => 'controller/cAltaDepartamento.php',
    'editarDepartamento' => 'controller/cConsultarModificarDepartamento.php',
    'eliminarDepartamento' => 'controller/cEliminarDepartamento.php',
    'bajaDepartamento' => 'controller/cBajaLogicaDepartamento.php',
    'altaDepartamento' => 'controller/cRehabilitacionDepartamento.php',
    'exportarDepartamento' => 'controller/cExportarDepartamentos.php',
    'importarDepartamento' => 'controller/cImportarDepartamentos.php',
    'apiREST' => 'controller/cREST.php',
    'consultarAnimales' => 'controller/cMtoAnimales.php'
];

// En el array de '$aView' almacenamos un array por idioma, para mostrar la vista en el idioma elegído por el usuario
$aView = [
    'SP' => [
        'layout' => 'view/SP/layout.php',
        'inicioPublico' => 'view/SP/vInicioPublico.php',
        'login' => 'view/SP/vLogin.php',
        'inicioPrivado' => 'view/SP/vInicioPrivado.php',
        'detalle' => 'view/SP/vDetalle.php',
        'tecnologias' => 'view/SP/vTecnologias.php',
        'rss' => 'view/SP/vRSS.php',
        'registro' => 'view/SP/vRegistro.php',
        'miCuenta' => 'view/SP/vMiCuenta.php',
        'borrarCuenta' => 'view/SP/vBorrarCuenta.php',
        'wip' => 'view/SP/vWIP.php',
        'error' => 'view/SP/vError.php',
        'cambiarContraseña' => 'view/SP/vCambiarPassword.php',
        'consultarDepartamento' => 'view/SP/vMtoDepartamento.php',
        'añadirDepartamento' => 'view/SP/vAltaDepartamento.php',
        'editarDepartamento' => 'view/SP/vConsultarModificarDepartamento.php',
        'eliminarDepartamento' => 'view/SP/vEliminarDepartamento.php',
        'importarDepartamento' => 'view/SP/vImportarDepartamentos.php',
        'apiREST' => 'view/SP/vREST.php',
        'consultarAnimales' => 'view/SP/vMtoAnimales.php'
    ],
    'UK' => [
        'layout' => 'view/UK/layout.php',
        'inicioPublico' => 'view/UK/vInicioPublico.php',
        'login' => 'view/UK/vLogin.php',
        'inicioPrivado' => 'view/UK/vInicioPrivado.php',
        'detalle' => 'view/UK/vDetalle.php',
        'tecnologias' => 'view/UK/vTecnologias.php',
        'rss' => 'view/UK/vRSS.php',
        'registro' => 'view/UK/vRegistro.php',
        'miCuenta' => 'view/UK/vMiCuenta.php',
        'borrarCuenta' => 'view/UK/vBorrarCuenta.php',
        'wip' => 'view/UK/vWIP.php',
        'error' => 'view/UK/vError.php',
        'cambiarContraseña' => 'view/UK/vCambiarPassword.php',
        'consultarDepartamento' => 'view/UK/vMtoDepartamento.php',
        'añadirDepartamento' => 'view/UK/vAltaDepartamento.php',
        'editarDepartamento' => 'view/UK/vConsultarModificarDepartamento.php',
        'eliminarDepartamento' => 'view/UK/vEliminarDepartamento.php',
        'importarDepartamento' => 'view/UK/vImportarDepartamentos.php',
        'apiREST' => 'view/UK/vREST.php',
        'consultarAnimales' => 'view/UK/vMtoAnimales.php'
    ]
];

// Array asociativo para poner los titulos en distintos idiomas
$aTitleLang = [
    'SP' => [// Castellano
        'inicioPublico' => 'Inicio Público',
        'login' => 'Inicio de Sesión',
        'inicioPrivado' => 'Inicio Privado',
        'detalle' => 'Detalle',
        'tecnologias' => 'Tecnologias',
        'registro' => 'Registro',
        'miCuenta' => 'Mi Cuenta',
        'borrarCuenta' => 'Borrar Cuenta',
        'wip' => 'Zona En Construcción',
        'error' => 'Error',
        'cambiarContraseña' => 'Cambiar Contraseña',
        'consultarDepartamento' => 'Mantenimiento Departamento',
        'añadirDepartamento' => 'Añadir Departamento',
        'editarDepartamento' => 'Editar Departamento',
        'eliminarDepartamento' => 'Eliminar Departamento',
        'importarDepartamento' => 'Importar Departamentos',
        'apiREST' => 'REST',
        'consultarAnimales' => 'Mantenimiento Granja'
    ],
    'UK' => [//Inglés
        'inicioPublico' => 'Public Home',
        'login' => 'Login',
        'inicioPrivado' => 'Private Home',
        'detalle' => 'Detail',
        'tecnologias' => 'Technology',
        'registro' => 'Registration',
        'miCuenta' => 'My Account',
        'borrarCuenta' => 'Delete Account',
        'wip' => 'Work in Progress',
        'error' => 'Error',
        'cambiarContraseña' => 'Change Password',
        'consultarDepartamento' => 'Maintenance Department',
        'añadirDepartamento' => 'Add Department',
        'editarDepartamento' => 'Edit Department',
        'eliminarDepartamento' => 'Delete Department',
        'importarDepartamento' => 'Import Departments',
        'apiREST' => 'REST',
        'consultarAnimales' => 'Farm Maintenance '
    ]
];

// Array asociativo para poner el mensaje de bienvenida en distintos idiomas
$aMessageLang = [
    'SP' => [// Castellano
        'bienvenido' => 'Bienvenid@ ',
        'estaEsLa' => ' esta es la ',
        'vezQueTeConectas' => ' vez que te conectas;',
        'ustedSeConectoPorUltimaVez' => ' usted se conectó por última vez el '
    ],
    'UK' => [// Inglés
        'bienvenido' => 'Welcome ',
        'estaEsLa' => ' is this the ',
        'vezQueTeConectas' => ' time you connect;',
        'ustedSeConectoPorUltimaVez' => ' you last logged in on '
    ]
];
