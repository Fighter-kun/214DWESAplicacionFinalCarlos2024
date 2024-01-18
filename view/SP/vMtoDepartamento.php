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
    #buscarDepartamentos {
        height: 15%;
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
    <div class="row mb-2">
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
                                    <input class="d-flex justify-content-start" type="text" name="DescDepartamento" value="<?php echo $_SESSION['criterioBusquedaDepartamentos']['descripcionBuscada'] ?? ''; ?>">
                                </td>
                                <td><button class="btn btn-secondary" role="button" aria-disabled="true" type="submit" name="buscarDepartamentoPorDesc">Buscar</button></td>
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
            <?php
            if ($aDepartamentosVista != null) {
                echo ("<table>
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Fecha de Creación</th>
                            <th>Volumen de Negocio</th>
                            <th>Fecha de Baja</th>
                            <th colspan='4'><-T-></th>
                        </tr>
                        </thead>");
                echo ("<div class='list-group text-center tablaMuestra'>");
                echo ("<tbody>");
            }
            ?>
            <?php
            if ($aDepartamentosVista) {

                foreach ($aDepartamentosVista as $aDepartamento) {//Recorro el objeto del resultado que contiene un array


                    /* Aqui recorremos todos los valores de la tabla, columna por columna, usando el parametro 'PDO::FETCH_ASSOC' , 
                     * el cual nos indica que los resultados deben ser devueltos como un array asociativo, donde los nombres de las columnas de 
                     * la tabla se utilizan como claves (keys) en el array.
                     */


                    echo ("<tr>");

                    echo ("<td>" . $aDepartamento['codDepartamento'] . "</td>");
                    echo ("<td>" . $aDepartamento['descDepartamento'] . "</td>");
                    echo ("<td>" . $aDepartamento['fechaCreacionDep'] . "</td>");
                    echo ("<td>" . $aDepartamento['volumenDeNegocio'] . "</td>");
                    echo ("<td>" . $aDepartamento['fechaBajaDep'] . "</td>");

                    // Formulario para editar
                    echo ("<td>");
                    if (empty($aDepartamento['fechaBajaDep'])) {
                        echo ("<form method='post'>");
                        echo ("<input type='hidden' name='cConsultarModificarDepartamento' value='" . $aDepartamento['codDepartamento'] . "'>");
                        echo ("<button type='submit'>EDITAR</button>");
                        echo ("</form>");
                    }
                    echo ("</td>");

                    // Formulario para eliminar
                    echo ("<td>");
                    echo ("<form method='post'>");
                    echo ("<input type='hidden' name='cEliminarDepartamento' value='" . $aDepartamento['codDepartamento'] . "'>");
                    echo ("<button type='submit'><img src='doc/eliminarDepartamento.png' alt='DELETE'></button>");
                    echo ("</form>");
                    echo ("</td>");

                    // Formulario para alta lógica
                    echo ("<td>");
                    echo ("<form method='post'>");
                    echo ("<input type='hidden' name='cRehabilitacionDepartamento' value='" . $aDepartamento['codDepartamento'] . "'>");
                    echo ("<button type='submit'><img src='doc/flechaAlta.png' alt='ALTA'></button>");
                    echo ("</form>");
                    echo ("</td>");

                    // Formulario para baja lógica
                    echo ("<td>");
                    echo ("<form method='post'>");
                    echo ("<input type='hidden' name='cBajaLogicaDepartamento' value='" . $aDepartamento['codDepartamento'] . "'>");
                    echo ("<button type='submit'><img src='doc/flechaBaja.png' alt='BAJA'></button>");
                    echo ("</form>");
                    echo ("</td>");

                    echo ("</tr>");
                }
            }
            if ($aDepartamentosVista != null) {
                echo ("</tbody>");
                /* Ahora usamos la función 'rowCount()' que nos devuelve el número de filas afectadas por la consulta y 
                 * almacenamos el valor en la variable '$numeroDeRegistros'
                 */
                // Y mostramos el número de registros
                echo ("<tfoot ><tr style='background-color: #666; color:white;'><td colspan='9'>Número de registros en la tabla Departamento: " . $numeroDeRegistrosConsulta . '</td></tr></tfoot>');
                echo ("</table>");
                echo ("</div>");
            }
            ?>
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