<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vMtoAnimales.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 16/01/2024
-->
<div class="container mt-3">
    <div class="row mb-2">
        <div class="col text-center">
            <form name="indexMtoAnimales" method="post">
                <div class="btn-container">
                    <div class="descripcionExportar">Si pulsas exportar descarga un fichero '.zip' que contiene todos los Animales en '.json' y '.xml'</div>
                    <button id="exportButton" class="botones" role="button" aria-disabled="true" type="submit" name="exportarAnimales">Exportar</button>
                </div>
                <button class="botones" role="button" aria-disabled="true" type="submit" name="importarAnimales">Importar</button>
                <button class="botones" role="button" aria-disabled="true" type="submit" name="añadirAnimal">Añadir Animal</button>
                <button class="botones" role="button" aria-disabled="true" type="submit" name="salirGranja">Salir</button>
            </form>
            <form name="buscarDepartamentos" id="buscarDepartamentos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table class="bordeBusquedaAnimal">
                        <thead></thead>
                        <tbody>
                            <tr>
                                <!-- CodDepartamento Obligatorio -->
                                <td class="d-flex justify-content-start" colspan='2'>
                                    <label for="DescAnimal">Descripción:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="d-flex justify-content-start" type="text" name="DescAnimal" value="<?php echo $_SESSION['criterioBusquedaAnimales']['descripcionBuscada'] ?? ''; ?>">
                                    <div>
                                        <a class="pBuscarDepartamento">Estado: </a>
                                        <label for="tipoDepartamentoTodos"><a class="rFiltrarDepartamento">Todos</a></label>
                                        <input name="estado" id="tipoDepartamentoTodos" type="radio" value="todos" <?php echo isset($_SESSION['criterioBusquedaAnimales']['estado']) ? ($_SESSION['criterioBusquedaAnimales']['estado'] == ESTADO_TODOS ? 'checked' : '') : ''; ?>>
                                        <label for="tipoDepartamentoAltas"><a class="rFiltrarDepartamento">Altas</a></label>
                                        <input name="estado" id="tipoDepartamentoAltas" type="radio" value="altas" <?php echo isset($_SESSION['criterioBusquedaAnimales']['estado']) ? ($_SESSION['criterioBusquedaAnimales']['estado'] == ESTADO_ALTAS ? 'checked' : '') : 'checked'; ?>>
                                        <label for="tipoDepartamentoBajas"><a class="rFiltrarDepartamento">Bajas</a></label>
                                        <input name="estado" id="tipoDepartamentoBajas" type="radio" value="bajas" <?php echo isset($_SESSION['criterioBusquedaAnimales']['estado']) ? ($_SESSION['criterioBusquedaAnimales']['estado'] == ESTADO_BAJAS ? 'checked' : '') : ''; ?>>
                                    </div>
                                </td>
                                <td><button class="botones" role="button" aria-disabled="true" type="submit" name="buscarAnimalPorDesc">Buscar</button></td>
                            </tr>
                            <tr>
                                <td class="error error-MtoDep" colspan="3">
                                    <?php
                                    if (!empty($aErrores['DescAnimal'])) {
                                        echo $aErrores['DescAnimal'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </fieldset>
            </form>
            <?php
            if ($aAnimalesBuscadosVista != null) {
                echo ("<div class='list-group text-center tablaMuestra'>");
                echo ("<table>
                        <thead>
                        <tr>
                            <th>Código De Referencia</th>
                            <th>Descripción Del Animal <i class='fas fa-arrow-up'></i></th>
                            <th>Fecha de Nacimiento</th>
                            <th>Sexo</th>
                            <th>Raza</th>
                            <th>Precio del Animal</th>
                            <th>Fecha de Baja</th>
                            <th colspan='4'><-T-></th>
                        </tr>
                        </thead>");
                echo ("<tbody>");
            }
            ?>
            <?php
            if ($aAnimalesBuscadosVista) {

                foreach ($aAnimalesBuscadosVista as $aAnimales) {//Recorro el objeto del resultado que contiene un array
                    echo ("<tr class='" . (empty($aAnimales['fechaBajaAnimal']) ? 'sin-baja' : 'con-baja') . "'>");

                    echo ("<td>" . $aAnimales['codAnimal'] . "</td>");
                    echo ("<td>" . $aAnimales['descAnimal'] . "</td>");
                    echo ("<td>" . $aAnimales['fechaNacimientoAnimal'] . "</td>");
                    echo "<td>";

                    if ($aAnimales['sexoAnimal'] == 'macho') {
                        echo "<i class='fas fa-mars'></i>"; // Icono de Macho
                    }  else {
                        echo "<i class='fas fa-venus'></i>"; // Icono de Hembra
                    }

                    echo "</td>";
                    
                    echo ("<td>" . $aAnimales['razaAnimal'] . "</td>");
                    echo ("<td>" . $aAnimales['precioAnimal'] . "</td>");
                    echo ("<td class='fecha-baja'>" . $aAnimales['fechaBajaAnimal'] . "</td>");

                    // Formulario para eliminar
                    echo ("<td>");
                    echo ("<form method='post'>");
                    echo ("<input type='hidden' name='cDetalleAnimal' value='" . $aAnimales['codAnimal'] . "'>");
                    echo ("<button type='submit'><i class='fas fa-eye'></i></button>");
                    echo ("</form>");
                    echo ("</td>");
                    
                    // Formulario para editar
                    echo ("<td>");
                    // Compruebo la variable que almacena la fecha de baja para mostrar/ocultar el elemento
                    if (empty($aAnimales['fechaBajaAnimal'])) {
                        echo ("<form method='post'>");
                        echo ("<input type='hidden' name='cConsultarModificarAnimal' value='" . $aAnimales['codAnimal'] . "'>");
                        echo ("<button type='submit'><img src='webroot/media/images/consultarModificarDepartamento.png' alt='EDIT'></button>");
                        echo ("</form>");
                    }
                    echo ("</td>");

                    // Formulario para eliminar
                    echo ("<td>");
                    echo ("<form method='post'>");
                    echo ("<input type='hidden' name='cEliminarAnimal' value='" . $aAnimales['codAnimal'] . "'>");
                    echo ("<button type='submit'><img src='webroot/media/images/eliminarDepartamento.png' alt='DELETE'></button>");
                    echo ("</form>");
                    echo ("</td>");

                    // Formulario para alta lógica
                    echo ("<td>");
                    // Compruebo la variable que almacena la fecha de baja para mostrar/ocultar el elemento
                    if (!empty($aAnimales['fechaBajaAnimal'])) {
                        echo ("<form method='post'>");
                        echo ("<input type='hidden' name='cRehabilitacionAnimal' value='" . $aAnimales['codAnimal'] . "'>");
                        echo ("<button type='submit'><img src='webroot/media/images/flechaAlta.png' alt='ALTA'></button>");
                        echo ("</form>");
                    }

                    // Formulario para baja lógica
                    // Compruebo la variable que almacena la fecha de baja para mostrar/ocultar el elemento
                    if (empty($aAnimales['fechaBajaAnimal'])) {
                        echo ("<form method='post'>");
                        echo ("<input type='hidden' name='cBajaLogicaAnimal' value='" . $aAnimales['codAnimal'] . "'>");
                        echo ("<button type='submit'><img src='webroot/media/images/flechaBaja.png' alt='BAJA'></button>");
                        echo ("</form>");
                    }
                    echo ("</td>");

                    echo ("</tr>");
                }
            }
            if ($aAnimalesBuscadosVista != null) {
                echo ("</tbody>");
                echo ("</table>");
                echo ("</div>");
            }
            ?>
        </div>
    </div>
    <div class="row grupoDeBotones">
        <script src="webroot/js/e4845e6bf2.js" crossorigin="anonymous"></script>
        <div class="col">
            <form name="indexMtoAnimales" method="post">
                <div class="row grupoDeBotonesPaginacion">
                    <div class="col">
                        <button class="fas fa-angle-double-left" type="submit" name="paginaPrimera" <?php if ($_SESSION['numPaginacionAnimales'] == 1) {echo "hidden";} ?>></button>
                    </div>
                    <div class="col">
                        <button class="fas fa-angle-left"type="submit" name="paginaAnterior" <?php if ($_SESSION['numPaginacionAnimales'] == 1) {echo "hidden";} ?>></button>
                    </div>
                    <div class="col tamaño-paginacion">
                        <?php echo $_SESSION['numPaginacionAnimales'] ?> / <?php echo ceil($iAnimalesTotales) ?>
                    </div>
                    <div class="col">
                        <button class="fas fa-angle-right" type="submit" name="paginaSiguiente" <?php if ($_SESSION['numPaginacionAnimales'] == ceil($iAnimalesTotales)) {echo "hidden";} ?>></button>
                    </div>
                    <div class="col">
                        <button class="fas fa-angle-double-right" type="submit" name="paginaUltima" <?php if ($_SESSION['numPaginacionAnimales'] == ceil($iAnimalesTotales)) {echo "hidden";} ?>></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>