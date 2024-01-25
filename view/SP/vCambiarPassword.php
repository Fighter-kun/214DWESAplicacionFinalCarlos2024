<!--
        Descripción: Aplicación Final -- vCambiarContraseña.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 12/01/2024
-->

<div class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col">
            <!-- Codigo del formulario -->
            <form name="controlAcceso" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <tbody>
                            <tr>
                                <!-- contraseñaActual Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="contraseñaActual">Contraseña Actual:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="password" name="contraseñaActual" value="<?php echo (isset($_REQUEST['contraseñaActual']) ? $_REQUEST['contraseñaActual'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['contraseñaActual'])) {
                                        echo $aErrores['contraseñaActual'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- nuevaContraseña Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="nuevaContraseña">Nueva Contraseña:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="password" name="nuevaContraseña" value="<?php echo (isset($_REQUEST['nuevaContraseña']) ? $_REQUEST['nuevaContraseña'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['nuevaContraseña'])) {
                                        echo $aErrores['nuevaContraseña'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- repetirNuevaContraseña Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="repetirNuevaContraseña">Repetir Nueva Contraseña:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="password" name="repetirNuevaContraseña" value="<?php echo (isset($_REQUEST['repetirNuevaContraseña']) ? $_REQUEST['repetirNuevaContraseña'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['repetirNuevaContraseña'])) {
                                        echo $aErrores['repetirNuevaContraseña'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button class="botones" aria-disabled="true" type="submit" name="confirmarCambios">Confirmar Cambios</button>
                        <button class="botones" aria-disabled="true" type="submit" name="salirCambiarContraseña">Cancelar</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>