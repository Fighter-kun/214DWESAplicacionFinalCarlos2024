<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vEliminarAnimal.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 16/02/2024
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
                                <td class="d-flex justify-content-start">
                                    <label for="codAnimalAEliminar">Código de Referencia:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="codAnimalAEliminar"
                                           value="<?php echo ($codAnimalAEliminar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="descAnimalAEliminar">Descripción Del Animal:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="descAnimalAEliminar"
                                           value="<?php echo ($descAnimalAEliminar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="fechaNacimientoAEliminar">Fecha de Nacimiento:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="fechaNacimientoAEliminar"
                                           value="<?php echo ($fechaNacimientoAEliminar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="sexoAEliminar">Sexo:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="sexoAEliminar"
                                           value="<?php echo ($sexoAEliminar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="razaAEliminar">Raza:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="razaAEliminar"
                                           value="<?php echo ($razaAEliminar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="precioAEliminar">Precio:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="precioAEliminar"
                                           value="<?php echo ($precioAEliminar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <?php
                            if (!is_null($fechaBajaAEliminar)) {
                                echo ("<tr>
                                        <!-- Fecha Baja Departamento Deshabilitado -->
                                        <td class=\"d-flex justify-content-start modDep\">
                                            <label for=\"fechaBajaDepartamentoAEditar\">Fecha de Baja:</label>
                                        </td>
                                        <td>
                                            <input class=\"bloqueado d-flex justify-content-start\" type=\"text\" name=\"fechaBajaDepartamentoAEditar\"
                                                   value=\"$fechaBajaAEliminar\" disabled>
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