<!DOCTYPE html>
<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO - Mto.Departamentos - vConsultarModificarDepartamento.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 16/01/2024
-->
<style>
    .obligatorio {
        background-color: #ffff7a;
    }
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
                                <th class="rounded-top" colspan="3"><legend>Modificar Departamento</legend></th>
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
                            <!-- Descripcion Departamento Opcional -->
                            <td class="d-flex justify-content-start">
                                <label for="T02_DescDepartamento">Descripción de Departamento:</label>
                            </td>
                            <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                <input class="d-flex justify-content-start" type="text" name="T02_DescDepartamento" value="<?php echo (isset($_REQUEST['T02_DescDepartamento']) ? $_REQUEST['T02_DescDepartamento'] : $descripcionDepartamentoAEditar); ?>">
                            </td>
                            <td class="error">
                                <?php
                                if (!empty($aErrores['T02_DescDepartamento'])) {
                                    echo $aErrores['T02_DescDepartamento'];
                                }
                                ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
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
                            <!-- Volumen Negocio Departamento Opcional -->
                            <td class="d-flex justify-content-start">
                                <label for="T02_VolumenDeNegocio_">Volumen de Negocio:</label>
                            </td>
                            <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                <input class="d-flex justify-content-start" type="text" name="T02_VolumenDeNegocio_" value="<?php echo (isset($_REQUEST['T02_VolumenDeNegocio']) ? $_REQUEST['T02_VolumenDeNegocio'] : $volumenNegocioAEditar); ?>">
                            </td>
                            <td class="error">
                                <?php
                                if (!empty($aErrores['T02_VolumenDeNegocio'])) {
                                    echo $aErrores['T02_VolumenDeNegocio'];
                                }
                                ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
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
                        <button class="btn btn-secondary" aria-disabled="true" type="submit" name="confirmarCambiosEditar">Confirmar Cambios</button>
                        <button class="btn btn-secondary" aria-disabled="true" type="submit" name="cancelarEditar">Cancelar</button>
                    </div>
                </fieldset>
            </form> 
        </div>
    </div>
</div>