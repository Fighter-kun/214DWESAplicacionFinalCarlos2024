<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vConsultarModificarDepartamento.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 16/01/2024
-->
<style>
    .bloqueado:disabled {
        background-color: #665 ;
        color: white;
    }
    .error {
        color: red;
        width: 450px;
    }
    .errorException {
        color:#FF0000;
        font-weight:bold;
    }
    .respuestaCorrecta {
        color:#4CAF50;
        font-weight:bold;
    }
    .btn-danger {
        background-color: red;
    }
    input {
        width: 90%;
    }
</style>
<div class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col">
            <!-- Codigo del formulario -->
            <form name="editarDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <thead>
                            <tr>
                                <th class="rounded-top" colspan="3"><legend>Eliminar Departamento</legend></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                        <input type="hidden" name="codDepartamento" value="<?php echo $codDepartamentoAEditar; ?>">
                        <!-- Codigo Departamento Deshabilitado -->
                        <td class="d-flex justify-content-start">
                            <label for="codDepartamentoAEditar">Código de Departamento:</label>
                        </td>
                        <td>
                            <input class="bloqueado d-flex justify-content-start" type="text" name="codDepartamentoAEditar"
                                   value="<?php echo ($codDepartamentoAEditar); ?>" disabled>
                        </td>
                        <td class="error">
                        </td>
                        </tr>
                        <tr>
                            <!-- Descripcion Departamento Deshabilitado -->
                            <td class="d-flex justify-content-start">
                                <label for="descripcionDepartamentoAEditar">Descripción de Departamento:</label>
                            </td>
                            <td>                                                                                                
                                <input class="bloqueado d-flex justify-content-start" type="text" name="descripcionDepartamentoAEditar" value="<?php echo ($descripcionDepartamentoAEditar); ?>" disabled>
                            </td>
                            <td class="error">
                            </td>
                        </tr>
                        <tr>
                            <!-- Fecha Creación Departamento Deshabilitado -->
                            <td class="d-flex justify-content-start">
                                <label for="fechaCreacionDepartamentoAEditar">Fecha de Creación:</label>
                            </td>
                            <td>
                                <input class="bloqueado d-flex justify-content-start" type="text" name="fechaCreacionDepartamentoAEditar"
                                       value="<?php echo ($fechaCreacionDepartamentoAEditar); ?>" disabled>
                            </td>
                            <td class="error">
                            </td>
                        </tr>
                        <tr>
                            <!-- Volumen Negocio Departamento Bloqueado -->
                            <td class="d-flex justify-content-start">
                                <label for="T02_VolumenDeNegocio_">Volumen de Negocio:</label>
                            </td>
                            <td>                                                                                                
                                <input class="bloqueado d-flex justify-content-start" type="number" name="T02_VolumenDeNegocio_" value="<?php echo ($volumenNegocioAEditar); ?>" disabled>
                            </td>
                            <td class="error">
                            </td>
                        </tr>
                        <?php
                        if (!is_null($fechaBajaDepartamentoAEditar)) {
                            echo ("<tr>
                                                    <!-- Fecha Baja Departamento Deshabilitado -->
                                                    <td class=\"d-flex justify-content-start\">
                                                        <label for=\"fechaBajaDepartamentoAEditar\">Fecha de Baja:</label>
                                                    </td>
                                                    <td>
                                                        <input class=\"bloqueado d-flex justify-content-start\" type=\"text\" name=\"fechaBajaDepartamentoAEditar\"
                                                               value=\"$fechaBajaDepartamentoAEditar\" disabled>
                                                    </td>
                                                    <td class=\"error\">
                                                    </td>
                                                </tr>");
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button class="btn btn-danger" aria-disabled="true" type="submit" name="confirmarCambiosEliminar">Eliminar</button>
                        <button class="btn btn-secondary" aria-disabled="true" type="submit" name="cancelarEliminar">Cancelar</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>