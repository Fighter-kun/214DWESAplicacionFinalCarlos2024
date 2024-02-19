<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vDetalleAnimal.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 19/02/2024
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
                                    <label for="codAnimalAMostrar">Código de Referencia:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="codAnimalAMostrar"
                                           value="<?php echo ($codAnimalAMostrar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="descAnimalAMostrar">Descripción Del Animal:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="descAnimalAMostrar"
                                           value="<?php echo ($descAnimalAMostrar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="fechaNacimientoAMostrar">Fecha de Nacimiento:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="fechaNacimientoAMostrar"
                                           value="<?php echo ($fechaNacimientoAMostrar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="sexoAMostrar">Sexo:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="sexoAMostrar"
                                           value="<?php echo ($sexoAMostrar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="razaAMostrar">Raza:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="razaAMostrar"
                                           value="<?php echo ($razaAMostrar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="precioAMostrar">Precio:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start modDep" type="text" name="precioAMostrar"
                                           value="<?php echo ($precioAMostrar); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <?php
                            if (!is_null($fechaBajaAMostrar)) {
                                echo ("<tr>
                                        <!-- Fecha Baja Departamento Deshabilitado -->
                                        <td class=\"d-flex justify-content-start modDep\">
                                            <label for=\"fechaBajaDepartamentoAMostrar\">Fecha de Baja:</label>
                                        </td>
                                        <td>
                                            <input class=\"bloqueado d-flex justify-content-start\" type=\"text\" name=\"fechaBajaDepartamentoAMostrar\"
                                                   value=\"$fechaBajaAMostrar\" disabled>
                                        </td>
                                        <td class=\"error\">
                                        </td>
                                    </tr>");
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button class="botones" type="submit" name="salirDetalle">Salir</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>