<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vREST.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 22/01/2024
-->

<form name="apiREST" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
        <table>
            <thead>
                <tr>
                    <th class="rounded-top" colspan="3"><legend>IMAGEN DE LA NASA</legend></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- CodDepartamento Obligatorio -->
                    <td class="d-flex justify-content-start">
                        <label for="fechaImagen">Fecha de la Imagen:</label>
                    </td>
                    <td>
                        <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                             comprobamos que exista la variable y no sea 'null'. En el caso verdadero devolveremos el contenido del campo
                             que contiene '$_REQUEST' , en caso falso sobrescribirá el campo a '' .-->
                        <input class="obligatorio d-flex justify-content-start" type="date" name="fechaImagen" value="<?php echo $_SESSION['fechaApi'] ?>">
                    </td>
                    <td class="error">
                        <?php
                        if (!empty($aErrores['fechaImagen'])) {
                            echo $aErrores['fechaImagen'];
                        }
                        ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no está vacío, si es así, mostramos el error. -->
                    </td>
                </tr>

            </tbody>
        </table>
        <div class="text-center">
            <button class="botones" aria-disabled="true" type="submit" name="confirmarFechaREST">Solicitar imagen</button>
            <button class="botones" aria-disabled="true" type="submit" name="salirREST">Salir</button>
        </div>
    </fieldset>
</form>
<div class="row text-center">
    <?php
    if (isset($_SESSION['apiNasa']) && !is_null($_SESSION['apiNasa'])) {
        $respuestaAPI = <<<IMAGENTITULOAPI
            <div class="container">
            <div class="row-description row align-items-center">
                <div class="colum-img col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <img class='card-img-top' src='{$_SESSION['apiNasa']['url']}' alt='{$_SESSION['apiNasa']['titulo']}'>
                </div>
                <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card-body">
                        <p class="card-text">{$_SESSION['apiNasa']['titulo']}</p><br>
                        <p class="card-text">{$_SESSION['apiNasa']['explicacion']}</p>
                    </div>
                </div>
            </div>
        IMAGENTITULOAPI;
        echo $respuestaAPI;
    }
    ?>
</div>
<hr>
<form name="apiREST" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
        <table>
            <thead>
                <tr>
                    <th class="rounded-top" colspan="3"><legend>TASK LIST</legend></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- CodDepartamento Obligatorio -->
                    <td class="d-flex justify-content-start">
                        <label for="tarea">Descripción de la tarea:</label>
                    </td>
                    <td>
                        <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                             comprobamos que exista la variable y no sea 'null'. En el caso verdadero devolveremos el contenido del campo
                             que contiene '$_REQUEST' , en caso falso sobrescribirá el campo a '' .-->
                        <input class="obligatorio d-flex justify-content-start" type="text" name="tarea">
                    </td>
                    <td class="error">
                        <?php
                        if (!empty($aErrores['tarea'])) {
                            echo $aErrores['tarea'];
                        }
                        ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no está vacío, si es así, mostramos el error. -->
                    </td>
                </tr>

            </tbody>
        </table>
        <div class="text-center">
            <button class="botones" aria-disabled="true" type="submit" name="confirmarTarea">Tarea</button>
        </div>
    </fieldset>
</form>
<div class="row mt-5 text-center">
    <?php
    if (isset($_SESSION['apiTask']) && !is_null($_SESSION['apiTask'])) {
        echo ("<table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                        </thead>");
        echo ("<div class='list-group text-center'>");
        echo ("<tbody>");
        $totalPendientes = 0;
        foreach ($_SESSION['apiTask'] as $tarea) {
            echo '<tr>';
            echo '<td>' . $tarea['id'] . '</td>';
            echo '<td>' . $tarea['descripcion'] . '</td>';
            echo '<td>' . $tarea['estado'] . '</td>';
            echo '</tr>';
            if ($tarea['estado'] === 'pendiente') {
                $totalPendientes++;
            }
        }
        echo ("</tbody>");
        echo ("<tfoot ><tr style='background-color: black; color:white;'><td colspan='9'>Número de tareas pendientes: " . $totalPendientes . '</td></tr></tfoot>');
        echo ("</table>");
        echo ("</div>");
    }
    ?>
</div>
<hr>
<form name="apiREST" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
        <table>
            <thead>
                <tr>
                    <th class="rounded-top" colspan="3"><legend>API HP</legend></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- CodDepartamento Obligatorio -->
                    <td class="d-flex justify-content-start">
                        <label for="casa">Casa:</label>
                    </td>
                    <td>
                        <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                             comprobamos que exista la variable y no sea 'null'. En el caso verdadero devolveremos el contenido del campo
                             que contiene '$_REQUEST' , en caso falso sobrescribirá el campo a '' .-->
                        <input class="d-flex justify-content-start" type="text" name="casa" value="<?php echo $_SESSION['casaSeleccionada']?>">
                    </td>
                    <td class="error">
                        <?php
                        if (!empty($aErrores['casa'])) {
                            echo $aErrores['casa'];
                        }
                        ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no está vacío, si es así, mostramos el error. -->
                    </td>
                </tr>

            </tbody>
        </table>
        <div class="text-center">
            <button class="botones" aria-disabled="true" type="submit" name="pedirHP">Enviar Casa</button>
        </div>
    </fieldset>
</form>
<div class="row mt-5 text-center">
    <?php
    if (isset($_SESSION['HP']) && !is_null($_SESSION['HP'])) {
        $aHP = $_SESSION['HP'];
        echo "<table class='text-center'>";
        echo "<tr><th>Personaje</th><th>Actor</th></tr>";
        foreach ($aHP as $item) {
            echo "<tr><td>" . $item['name'] . "</td>";
            echo "<td>" . $item['actor'] . "</td></tr>";
        }
        echo "</table>";
    }
    ?>
</div>