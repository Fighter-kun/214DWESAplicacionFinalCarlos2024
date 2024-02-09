<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vMtoAnimales.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 16/01/2024
-->
<div class="container mt-3">
    <div class="row mb-2">
        <div class="col text-center">
            <form name="buscarDepartamentos" id="buscarDepartamentos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <thead></thead>
                        <tbody>
                            <tr>
                                <!-- CodDepartamento Obligatorio -->
                                <td class="d-flex justify-content-start" colspan='2'>
                                    <label for="DescDepartamento">Descripción:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="d-flex justify-content-start" type="text" name="DescDepartamento" value="<?php echo $_SESSION['criterioBusquedaAnimales']['descripcionBuscada'] ?? ''; ?>">
                                    
                                </td>
                                <td><button class="botones" role="button" aria-disabled="true" type="submit" name="buscarDepartamentoPorDesc">Buscar</button></td>
                            </tr>
                            <tr>
                                <td class="error error-MtoDep" colspan="3">
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
                echo ("<div class='list-group text-center tablaMuestra'>");
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
                    // Compruebo la variable que almacena la fecha de baja para mostrar/ocultar el elemento
                    if (empty($aDepartamento['fechaBajaDep'])) { 
                        echo ("<form method='post'>");
                        echo ("<input type='hidden' name='cConsultarModificarDepartamento' value='" . $aDepartamento['codDepartamento'] . "'>");
                        echo ("<button type='submit'><img src='webroot/media/images/consultarModificarDepartamento.png' alt='EDIT'></button>");
                        echo ("</form>");
                    }
                    echo ("</td>");

                    // Formulario para eliminar
                    echo ("<td>");
                    echo ("<form method='post'>");
                    echo ("<input type='hidden' name='cEliminarDepartamento' value='" . $aDepartamento['codDepartamento'] . "'>");
                    echo ("<button type='submit'><img src='webroot/media/images/eliminarDepartamento.png' alt='DELETE'></button>");
                    echo ("</form>");
                    echo ("</td>");

                    // Formulario para alta lógica
                    echo ("<td>");
                    // Compruebo la variable que almacena la fecha de baja para mostrar/ocultar el elemento
                    if (!empty($aDepartamento['fechaBajaDep'])) {
                    echo ("<form method='post'>");
                    echo ("<input type='hidden' name='cRehabilitacionDepartamento' value='" . $aDepartamento['codDepartamento'] . "'>");
                    echo ("<button type='submit'><img src='webroot/media/images/flechaAlta.png' alt='ALTA'></button>");
                    echo ("</form>");
                    }
                    echo ("</td>");

                    // Formulario para baja lógica
                    echo ("<td>");
                    // Compruebo la variable que almacena la fecha de baja para mostrar/ocultar el elemento
                    if (empty($aDepartamento['fechaBajaDep'])) {
                    echo ("<form method='post'>");
                    echo ("<input type='hidden' name='cBajaLogicaDepartamento' value='" . $aDepartamento['codDepartamento'] . "'>");
                    echo ("<button type='submit'><img src='webroot/media/images/flechaBaja.png' alt='BAJA'></button>");
                    echo ("</form>");
                    }
                    echo ("</td>");

                    echo ("</tr>");
                }
            }
            if ($aDepartamentosVista != null) {
                echo ("</tbody>");
                echo ("</table>");
                echo ("</div>");
            }
            ?>
        </div>
    </div>
    <div class="row grupoDeBotones">
        <div class="col">
            <form name="indexMtoDepartamentos" method="post">
                <!-- 
                <div class="row grupoDeBotonesPaginacion">
                    <div class="col">
                        <button class="botones" type="submit" name="paginaPrimera">PRIMERA PAGINA</button>
                    </div>
                    <div class="col">
                        <button class="botones" type="submit" name="paginaAnterior">PAGINA ANTERIOR</button>
                    </div>
                    <div class="col">
                        <?php //echo $_SESSION['numPaginacionDepartamentos'] ?> / <?php //echo ceil($iDepartamentosTotales) ?>
                    </div>
                    <div class="col">
                        <button class="botones" type="submit" name="paginaSiguiente">PAGINA SIGUIENTE</button>
                    </div>
                    <div class="col">
                        <button class="botones" type="submit" name="paginaUltima">ULTIMA PAGINA</button>
                    </div>
                </div>
                -->
                <div class="btn-container">
                    <div class="descripcionExportar">Si pulsas exportar descarga un fichero '.zip' que contiene todos los departamentos en '.json' y '.xml'</div>
                    <button id="exportButton" class="botones" role="button" aria-disabled="true" type="submit" name="exportarAnimales">Exportar</button>
                </div>
                <button class="botones" role="button" aria-disabled="true" type="submit" name="importarAnimales">Importar</button>
                <button class="botones" role="button" aria-disabled="true" type="submit" name="añadirAnimal">Añadir Departamento</button>
                <button class="botones" role="button" aria-disabled="true" type="submit" name="salirGranja">Salir</button>
            </form>
        </div>
    </div>
</div>