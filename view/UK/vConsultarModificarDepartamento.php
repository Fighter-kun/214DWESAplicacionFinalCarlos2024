<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vConsultarModificarDepartamento.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 16/01/2024
-->

<div class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col">
            <!-- Codigo del formulario -->
            <form name="editarDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <tbody>
                            <tr>
                        <input type="hidden" name="codDepartamento" value="<?php echo $codDepartamentoAEditar; ?>">
                        <!-- Codigo Departamento Deshabilitado -->
                        <td class="d-flex justify-content-start">
                            <label for="codDepartamentoAEditar">Department Code:</label>
                        </td>
                        <td>
                            <input class="bloqueado d-flex justify-content-start modDep" type="text" name="codDepartamentoAEditar"
                                   value="<?php echo ($codDepartamentoAEditar); ?>" disabled>
                        </td>
                        <td class="error">
                        </td>
                        </tr>
                        <tr>
                            <!-- Descripcion Departamento Obligatorio -->
                            <td class="d-flex justify-content-start">
                                <label for="T02_DescDepartamento">Department Description:</label>
                            </td>
                            <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                <input class="d-flex justify-content-start obligatorio modDep" type="text" name="T02_DescDepartamento" value="<?php echo (isset($_REQUEST['T02_DescDepartamento']) ? $_REQUEST['T02_DescDepartamento'] : $descripcionDepartamentoAEditar); ?>">
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
                                <label for="fechaCreacionDepartamentoAEditar">Creation date:</label>
                            </td>
                            <td>
                                <input class="bloqueado d-flex justify-content-start modDep" type="text" name="fechaCreacionDepartamentoAEditar"
                                       value="<?php echo ($fechaCreacionDepartamentoAEditar); ?>" disabled>
                            </td>
                            <td class="error">
                            </td>
                        </tr>
                        <tr>
                            <!-- Volumen Negocio Departamento Opcional -->
                            <td class="d-flex justify-content-start">
                                <label for="T02_VolumenDeNegocio_">Business Volume:</label>
                            </td>
                            <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                <input class="d-flex justify-content-start modDep" type="text" name="T02_VolumenDeNegocio_" value="<?php echo (isset($_REQUEST['T02_VolumenDeNegocio']) ? $_REQUEST['T02_VolumenDeNegocio'] : $volumenNegocioAEditar); ?>">
                            </td>
                            <td class="error">
                                <?php
                                if (!empty($aErrores['T02_VolumenDeNegocio'])) {
                                    echo $aErrores['T02_VolumenDeNegocio'];
                                }
                                ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button class="botones" aria-disabled="true" type="submit" name="confirmarCambiosEditar">Confirm Changes</button>
                        <button class="botones" aria-disabled="true" type="submit" name="cancelarEditar">Cancel</button>
                    </div>
                </fieldset>
            </form> 
        </div>
    </div>
</div>