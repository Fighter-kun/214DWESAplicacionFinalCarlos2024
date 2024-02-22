<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vAltaAnimal.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 16/02/2024
-->

<div class="container mt-3">
    <div class="row text-center">
        <div class="col">
            <!-- Codigo del formulario -->
            <form name="insercionValoresTablaDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <tbody>
                            <tr>
                                <!-- codAnimal Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="codAnimal">Codigo de Referencia:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" placeholder="A01" name="codAnimal" value="<?php echo (isset($_REQUEST['codAnimal']) ? $_REQUEST['codAnimal'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['codAnimal'])) {
                                        echo $aErrores['codAnimal'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- descAnimal Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="descAnimal">Descripción del Animal:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" name="descAnimal" placeholder="Vaca" value="<?php echo (isset($_REQUEST['descAnimal']) ? $_REQUEST['descAnimal'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['descAnimal'])) {
                                        echo $aErrores['descAnimal'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="fechaNacimientoAnimal">Fecha de Creación:</label>
                                </td>
                                <td>
                                    <input class="obligatorio d-flex justify-content-start" type="text" name="fechaNacimientoAnimal"  placeholder="YYYY-mm-dd HH:ii:ss" value="<?php echo (isset($_REQUEST['fechaNacimientoAnimal']) ? $_REQUEST['fechaNacimientoAnimal'] : ''); ?>">
                                </td>
                                <td class="error">
                                     <?php
                                    if (!empty($aErrores['fechaNacimientoAnimal'])) {
                                        echo $aErrores['fechaNacimientoAnimal'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- Raza Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="sexoAnimal">Sexo:</label>
                                </td>
                                <td>                                                                                                
                                    <input class="obligatorio" type="radio" id="macho" name="sexoAnimal" value="macho" <?php
                                    if (is_null($aErrores['sexoAnimal']) && isset($_REQUEST['sexoAnimal']) && $_REQUEST['sexoAnimal'] == 'macho') {echo 'checked';}?>
                                           <!-- Si el campo es correcto se queda seleccionado. -->
                                    <label for="sexoAnimal">Macho</label>
                                    <input class="obligatorio" type="radio" id="hembra" name="sexoAnimal" value="hembra" <?php
                                    if (is_null($aErrores['sexoAnimal']) && isset($_REQUEST['sexoAnimal']) && $_REQUEST['sexoAnimal'] == 'hembra') {echo 'checked';}?>
                                           <!-- Si el campo es correcto se queda seleccionado. -->
                                    <label for="sexoAnimal">Hembra</label>
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['sexoAnimal'])) {
                                        echo $aErrores['sexoAnimal'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="razaAnimal">Raza:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" name="razaAnimal" placeholder="Holstein" value="<?php echo (isset($_REQUEST['razaAnimal']) ? $_REQUEST['razaAnimal'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['razaAnimal'])) {
                                        echo $aErrores['razaAnimal'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-start">
                                    <label for="precioAnimal">Precio Del Animal:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" name="precioAnimal" placeholder="1200.50" value="<?php echo (isset($_REQUEST['precioAnimal']) ? $_REQUEST['precioAnimal'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['precioAnimal'])) {
                                        echo $aErrores['precioAnimal'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><?php echo $mensajeDeConfirmacion;?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <button class="botones" role="button" aria-disabled="true" type="submit" name="añadirAnimal">Añadir Animal</button>
                    <button class="botones" role="button" aria-disabled="true" type="submit" name="salirAñadirAnimal">Salir</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>