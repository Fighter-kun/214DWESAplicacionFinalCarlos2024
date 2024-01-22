<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vREST.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 22/01/2024
-->
<style>
    .obligatorio {
        background-color: #ffff7a;
    }
    .error {
        color: red;
        width: 450px;
    }
    .respuestaCorrecta {
        color:#4CAF50;
        font-weight:bold;
    }
</style>
<form name="apiREST" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
        <table>
            <thead>
                <tr>
                    <th class="rounded-top" colspan="3"><legend>API REST</legend></th>
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
                        <input class="obligatorio d-flex justify-content-start" type="date" name="fechaImagen"
                               value="<?php echo (isset($_REQUEST['fechaImagen']) ? $_REQUEST['fechaImagen'] : ''); ?>">
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

