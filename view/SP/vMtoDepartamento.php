<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vMtoDepartamento.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 16/01/2024
-->
<style>
    header {
        height: 6%;
    }
    .error {
        color: red;
        width: 450px;
    }
    input[name="DescDepartamento"] {
        width: 110%;
        margin-right: 50%;
    }
    .tablaMuestra {
        position: absolute;
        top: 20%;
        right: 15%;
        width: 70%;
        /*SOLUCIÓN HASTA IMPLANTAR SISTEMA DE PAGINACIÓN*/
        max-height: 60vh; /* Establece una altura máxima del 50% de la altura visible del navegador */
        overflow-y: auto; /* Agrega una barra de desplazamiento vertical si es necesario */
    }
    .grupoDeBotones {
        margin-top: 35%;
    }
    /*******************/
    .btn-container {
        position: relative;
        display: inline-block;
    }

    .descripcionExportar {
        display: none;
        position: absolute;
        width: 500px;
        top: -200%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #555;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
    }

    .btn-container:hover .descripcionExportar {
        display: block;
    }
</style>
<div class="container mt-3">
    <div class="row mb-5">
        <div class="col text-center">
            <form name="buscarDepartamentos" id="buscarDepartamentos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <thead></thead>
                        <tbody>
                            <tr style="background-color: #f2f2f2;">
                                <!-- CodDepartamento Obligatorio -->
                                <td class="d-flex justify-content-start" colspan='2'>
                                    <label for="DescDepartamento">Descripción:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="d-flex justify-content-start" type="text" name="DescDepartamento" value="<?php echo (isset($_REQUEST['DescDepartamento']) ? $_REQUEST['DescDepartamento'] : $criterioDeBusqueda); ?>">
                                </td>
                                <td><button class="btn btn-secondary" role="button" aria-disabled="true" type="submit" name="enviar">Buscar</button></td>
                            </tr>
                            <tr style="background-color: #f2f2f2;">
                                <td class="error" colspan="3">
                                    <?php
                                    if (!empty($aErrores['DescDepartamento'])) {
                                        echo $aErrores['DescDepartamento'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </fieldset>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col grupoDeBotones">
            <form name="indexMtoDepartamentos" method="post">
                <div class="btn-container">
                    <div class="descripcionExportar">Si pulsas exportar descarga un fichero '.zip' que contiene todos los departamentos en '.json' y '.xml'</div>
                    <button id="exportButton" class="btn btn-secondary" role="button" aria-disabled="true" type="submit" name="exportarDepartamentos">Exportar</button>
                </div>
                <button class="btn btn-secondary" role="button" aria-disabled="true" type="submit" name="importarDepartamentos">Importar</button>
                <button class="btn btn-secondary" role="button" aria-disabled="true" type="submit" name="añadirDepartamento">Añadir Departamento</button>
                <button class="btn btn-secondary" role="button" aria-disabled="true" type="submit" name="salirDepartamentos">Salir</button>
            </form>
        </div>
    </div>
</div>