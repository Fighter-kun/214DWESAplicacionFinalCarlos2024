<!DOCTYPE html>
<!--
        Descripción: Aplicación Final - vConsultarModificarAnimal.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 10/02/2024
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
                        <input type="hidden" name="codDepartamento" value="<?php echo $codAnimalAEditar ; ?>">
                        <!-- Codigo Departamento Deshabilitado -->
                        <td class="d-flex justify-content-start">
                            <label for="codAnimalAEditar ">Código de Animal:</label>
                        </td>
                        <td>
                            <input class="bloqueado d-flex justify-content-start modDep" type="text" name="codAnimalAEditar "
                                   value="<?php echo ($codAnimalAEditar ); ?>" disabled>
                        </td>
                        <td class="error">
                        </td>
                        </tr>
                        <tr>
                            <!-- Descripcion Departamento Obligatorio -->
                            <td class="d-flex justify-content-start">
                                <label for="DescAnimal_">Descripción de Animal:</label>
                            </td>
                            <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                <input class="d-flex justify-content-start obligatorio modDep" type="text" name="DescAnimal_" value="<?php echo (isset($_REQUEST['DescAnimal']) ? $_REQUEST['DescAnimal'] : $descAnimalAEditar ); ?>">
                            </td>
                            <td class="error">
                                <?php
                                if (!empty($aErrores['DescAnimal'])) {
                                    echo $aErrores['DescAnimal'];
                                }
                                ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                            </td>
                        </tr>
                        <tr>
                            <!-- Fecha Creación Departamento Deshabilitado -->
                            <td class="d-flex justify-content-start">
                                <label for="fechaNacimientoAEditar">Fecha de Nacimiento:</label>
                            </td>
                            <td>
                                <input class="bloqueado d-flex justify-content-start modDep" type="text" name="fechaNacimientoAEditar"
                                       value="<?php echo ($fechaNacimientoAEditar); ?>" disabled>
                            </td>
                            <td class="error">
                            </td>
                        </tr>
                        <tr>
                            <!-- Fecha Creación Departamento Deshabilitado -->
                            <td class="d-flex justify-content-start">
                                <label for="sexoAEditar ">Sexo:</label>
                            </td>
                            <td>
                                <input class="bloqueado d-flex justify-content-start modDep" type="text" name="sexoAEditar "
                                       value="<?php echo ($sexoAEditar ); ?>" disabled>
                            </td>
                            <td class="error">
                            </td>
                        </tr>
                        <tr>
                            <!-- Fecha Creación Departamento Deshabilitado -->
                            <td class="d-flex justify-content-start">
                                <label for="razaAEditar ">Raza:</label>
                            </td>
                            <td>
                                <input class="bloqueado d-flex justify-content-start modDep" type="text" name="razaAEditar "
                                       value="<?php echo ($razaAEditar ); ?>" disabled>
                            </td>
                            <td class="error">
                            </td>
                        </tr>
                        <tr>
                            <!-- Volumen Negocio Departamento Opcional -->
                            <td class="d-flex justify-content-start">
                                <label for="Precio">Precio:</label>
                            </td>
                            <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                <input class="obligatorio d-flex justify-content-start modDep" type="text" name="Precio" value="<?php echo (isset($_REQUEST['Precio']) ? $_REQUEST['Precio'] : $precioAEditar); ?>">
                            </td>
                            <td class="error">
                                <?php
                                if (!empty($aErrores['Precio'])) {
                                    echo $aErrores['Precio'];
                                }
                                ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button class="botones" aria-disabled="true" type="submit" name="confirmarCambiosEditar">Confirmar Cambios</button>
                        <button class="botones" aria-disabled="true" type="submit" name="cancelarEditar">Cancelar</button>
                    </div>
                </fieldset>
            </form> 
        </div>
    </div>
</div>