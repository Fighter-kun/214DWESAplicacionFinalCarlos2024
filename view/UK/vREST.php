<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vREST.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 22/01/2024
-->
<br>
<form method="post">
    <button class="botones" aria-disabled="true" type="submit" name="salirREST">Exit</button>
</form>
<div class="row">
    <div class="col">
        <p class="card-text">
            It shows an image of the space with a title and a brief description of a specific date that we enter as a parameter.<br>
            Requires an APIKEY which is requested at this link: <a target="_blank" href="https://api.nasa.gov/">https://api.nasa.gov/</a><br>
            API web link: https://api.nasa.gov/planetary/apod?api_key={$apiKey}&date={$fecha}<br>
            Example:
            https://api.nasa.gov/planetary/apod?api_key=APIKEY&date=2024-01-31 It would return the image from that date.

        </p>
        <form name="apiREST" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset>
                <table>
                    <thead>
                        <tr>
                            <th class="rounded-top" colspan="3"><legend>NASA IMAGE</legend></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- CodDepartamento Obligatorio -->
                            <td class="d-flex justify-content-start">
                                <label for="fechaImagen">Image Date:</label>
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
                    <button class="botones" aria-disabled="true" type="submit" name="confirmarFechaREST">Request image</button>
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
        <p class="card-text">
            Shows information about the character and actor who plays him in the Harry Potter saga, about a specific house that we introduce as a parameter.<br>
            Requires an APIKEY which is requested at this link: <a target="_blank" href="https://hp-api.onrender.com">https://hp-api.onrender.com</a><br>
            API web link:<br> https://hp-api.onrender.com/api/characters/house/{$home}<br>
            Example:<br><a target="_blank" href="https://hp-api.onrender.com/api/characters/house/slytherin">https://hp-api.onrender.com/api/characters/house/slytherin</a><br>.
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
                                <label for="casa">Home:</label>
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
                    <button class="botones" aria-disabled="true" type="submit" name="pedirHP">Send Home</button>
                </div>
            </fieldset>
        </form>
        <div class="row mt-5 text-center">
            <?php
            if (isset($_SESSION['HP']) && !is_null($_SESSION['HP'])) {
                $aHP = $_SESSION['HP'];
                echo "<table class='text-center'>";
                echo "<tr><th>Character</th><th>Actor</th></tr>";
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
        <p class="card-text">
            Shows information on the business volume of a specific Department that we request in the form.<br>
        </p>
        <form name="apiREST" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset>
                <table>
                    <thead>
                        <tr>
                            <th class="rounded-top" colspan="3"><legend>API SEARCH DEPARTMENTS</legend></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- CodDepartamento Obligatorio -->
                            <td class="d-flex justify-content-start">
                                <label for="casa">Code:</label>
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
                    <button class="botones" aria-disabled="true" type="submit" name="pedirDepartamento">Search</button>
                </div>
            </fieldset>
        </form>
        <div class="row mt-5 text-center">
            <?php
            ?>
        </div>
    </div>
</div>