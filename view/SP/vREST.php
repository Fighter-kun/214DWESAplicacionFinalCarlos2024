<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vREST.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 22/01/2024
-->
<br>
<form method="post">
    <button class="botones" aria-disabled="true" type="submit" name="salirREST">Salir</button>
</form>
<div class="row">
    <div class="col">
        <p class="card-text-instruction">
            Muestra una imagen del espacio con un título y una breve descripción de una fecha concreta que introducimos como parámetro.<br>
            Requiere una APIKEY que se solicita en este enlace: <a target="_blank" href="https://api.nasa.gov/">https://api.nasa.gov/</a><br>
            Enlace web de la API: https://api.nasa.gov/planetary/apod?api_key={$apiKey}&date={$fecha}<br>
            Ejemplo:
            https://api.nasa.gov/planetary/apod?api_key=APIKEY&date=2024-01-31 Devolvería la imagen de esa fecha.

        </p>
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
                </div>
                <?php
                if (isset($_SESSION['apiNasa']) && !is_null($_SESSION['apiNasa'])) {
                    $respuestaAPI = <<<IMAGENTITULOAPI
            <div class="container">
            <div class="row-description row align-items-center">
                <div class="col mt-5">
                    <img class='card-img-top' src='{$_SESSION['apiNasa']['url']}' alt='{$_SESSION['apiNasa']['titulo']}' style="width:250px; heigth:100px;">
                </div>
            </div>
            <div class="row">
                    <div class="col ">
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
            </fieldset>
        </form>
    </div>
    <div class="col">
        <p class="card-text-instruction">
            Muestra información del personaje y actor que lo interpreta en la saga de Harry Potter, de una casa concreta que introducimos como parámetro.<br>
            Requiere una APIKEY que se solicita en este enlace: <a target="_blank" href="https://hp-api.onrender.com">https://hp-api.onrender.com</a><br>
            Enlace web de la API:<br> https://hp-api.onrender.com/api/characters/house/{$casa}<br>
            Ejemplo:<br><a target="_blank" href="https://hp-api.onrender.com/api/characters/house/slytherin">https://hp-api.onrender.com/api/characters/house/slytherin</a><br>Devolvería la imagen de esa fecha.
        </p>
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
                                <input class="d-flex justify-content-start" type="text" name="casa" value="<?php echo $_SESSION['casaSeleccionada'] ?>">
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
    </div>
    <div class="col">
        <p class="card-text-instruction">
            Muestra información del volumen de negocio de un Departamento concreto que solicitamos en el formulario.<br>
        </p>
        <form name="apiREST" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset>
                <table>
                    <thead>
                        <tr>
                            <th class="rounded-top" colspan="3"><legend>API BUSCAR DEPARTAMENTOS</legend></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- CodDepartamento Obligatorio -->
                            <td class="d-flex justify-content-start">
                                <label for="casa">Código:</label>
                            </td>
                            <td>
                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                     comprobamos que exista la variable y no sea 'null'. En el caso verdadero devolveremos el contenido del campo
                                     que contiene '$_REQUEST' , en caso falso sobrescribirá el campo a '' .-->
                                <input class="d-flex justify-content-start" type="text" name="casa">
                            </td>
                            <td class="error">
                                <?php
                                if (!empty($aErrores[''])) {
                                    echo $aErrores[''];
                                }
                                ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no está vacío, si es así, mostramos el error. -->
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="text-center">
                    <button class="botones" aria-disabled="true" type="submit" name="pedirDepartamento">Buscar</button>
                </div>
            </fieldset>
        </form>
        <div class="row mt-5 text-center">
            <?php
            ?>
        </div>
    </div>
</div>