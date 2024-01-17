<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- vCambiarContraseña.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 12/01/2024
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
</style>
<div class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col">
            <!-- Codigo del formulario -->
            <form name="controlAcceso" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <thead>
                            <tr>
                                <th class="rounded-top" colspan="3"><legend>Change Password</legend></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- contraseñaActual Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="contraseñaActual">Current Password:</label>
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
                                    <label for="nuevaContraseña">New Password:</label>
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
                                    <label for="repetirNuevaContraseña">Repeat New Password:</label>
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
                        <button class="btn btn-secondary" aria-disabled="true" type="submit" name="confirmarCambios">Confirm Changes</button>
                        <button class="btn btn-secondary" aria-disabled="true" type="submit" name="salirCambiarContraseña">Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>