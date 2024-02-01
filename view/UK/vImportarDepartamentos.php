<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vImportarDepartamentos.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 04/01/2024
-->

<div class="container mt-3">
    <div class="row mb-5">
        <div class="col text-center">
            <form name="importarDepartamentos" method="post" enctype="multipart/form-data">
                <div class="fileControl">
                    <label class="form-control" for="archivo">JSON - XML</label>
                    <input class="form-control" type="file" name="archivo" id="archivo" accept=".json , .xml">
                </div>
                <br><br>
                <button class="botones" type="submit" name="importarDepartamentos">Import</button>
                <button class="botones" role="button" aria-disabled="true" type="submit" name="salirImportar">Exit</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <?php
            if (!empty($_SESSION['contadorRegistrosCorrectos'])) {
                echo ("<div class='respuestaCorrecta'>Los datos se han insertado correctamente en la tabla Departamento " .($_SESSION['contadorRegistrosCorrectos']) . "</div>");
            }
            ?>
        </div>
    </div>
</div>