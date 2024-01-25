<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vConsultarModificarDepartamento.php (Castellano)
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
                        <input type="hidden" name="codDepartamento" value="<?php echo $codDepartamentoAEliminar; ?>">
                        <!-- Codigo Departamento Deshabilitado -->
                        <td class="d-flex justify-content-start">
                            <label for="codDepartamentoAEditar">Código de Departamento:</label>
                        </td>
                        <td>
                            <input class="bloqueado d-flex justify-content-start modDep" type="text" name="codDepartamentoAEditar"
                                   value="<?php echo ($codDepartamentoAEliminar); ?>" disabled>
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
                                <input class="bloqueado d-flex justify-content-start modDep" type="text" name="descripcionDepartamentoAEditar" value="<?php echo ($descripcionDepartamentoAEliminar); ?>" disabled>
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
                                <input class="bloqueado d-flex justify-content-start modDep" type="text" name="fechaCreacionDepartamentoAEditar"
                                       value="<?php echo ($fechaCreacionDepartamentoAEliminar); ?>" disabled>
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
                                <input class="bloqueado d-flex justify-content-start modDep" type="number" name="T02_VolumenDeNegocio_" value="<?php echo ($volumenNegocioAEliminar); ?>" disabled>
                            </td>
                            <td class="error">
                            </td>
                        </tr>
                        <?php
                        if (!is_null($fechaBajaDepartamentoAEliminar)) {
                            echo ("<tr>
                                                    <!-- Fecha Baja Departamento Deshabilitado -->
                                                    <td class=\"d-flex justify-content-start modDep\">
                                                        <label for=\"fechaBajaDepartamentoAEditar\">Fecha de Baja:</label>
                                                    </td>
                                                    <td>
                                                        <input class=\"bloqueado d-flex justify-content-start\" type=\"text\" name=\"fechaBajaDepartamentoAEditar\"
                                                               value=\"$fechaBajaDepartamentoAEliminar\" disabled>
                                                    </td>
                                                    <td class=\"error\">
                                                    </td>
                                                </tr>");
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button class="botones" type="submit" name="confirmarCambiosEliminar">Eliminar</button>
                        <button class="botones" type="submit" name="cancelarEliminar">Cancelar</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>