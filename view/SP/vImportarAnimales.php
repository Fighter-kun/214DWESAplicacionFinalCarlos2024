<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vImportarAnimales.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 22/02/2024
-->

<div class="container mt-3">
    <div class="row mb-5">
        <div class="col text-center">
            <form name="importarAnimales" method="post" enctype="multipart/form-data">
                <div class="fileControl">
                    <label class="form-control" for="archivo">JSON</label>
                    <input class="form-control" type="file" name="archivo" id="archivo" accept=".json">
                </div>
                <br><br>
                <button class="botones" type="submit" name="importarAnimales">Importar</button>
                <button class="botones" role="button" aria-disabled="true" type="submit" name="salirImportar">Salir</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <?php
            if (isset($resultadoImportacion)) {
                echo ("<div class='respuestaCorrecta'>" . $resultadoImportacion . "</div>");
            }
            ?>
        </div>
    </div>
</div>