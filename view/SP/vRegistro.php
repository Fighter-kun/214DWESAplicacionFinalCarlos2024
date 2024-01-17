<!DOCTYPE html>
<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- vRegistro.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 02/01/2024
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
</style>

<div class="container mt-3">
    <div class="row text-center">
        <div class="col">
            <!-- Codigo del formulario -->
            <form name="insercionValoresTablaDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <thead>
                            <tr>
                                <th class="rounded-top" colspan="3"><legend>Registro</legend></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- T01_CodUsuario Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="T01_CodUsuario">Usuario:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" name="T01_CodUsuario" value="<?php echo (isset($_REQUEST['T01_CodUsuario']) ? $_REQUEST['T01_CodUsuario'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['T01_CodUsuario'])) {
                                        echo $aErrores['T01_CodUsuario'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- T01_DescUsuario Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="T01_DescUsuario">Descripcion Usuarios:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" name="T01_DescUsuario" value="<?php echo (isset($_REQUEST['T01_DescUsuario']) ? $_REQUEST['T01_DescUsuario'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['T01_DescUsuario'])) {
                                        echo $aErrores['T01_DescUsuario'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- T01_Password Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="T01_Password">Contraseña:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="password" name="T01_Password" value="<?php echo (isset($_REQUEST['T01_Password']) ? $_REQUEST['T01_Password'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['T01_Password'])) {
                                        echo $aErrores['T01_Password'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- repetirPassword Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="T01_Password">Repetir Contraseña:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="password" name="repetirPassword" value="<?php echo (isset($_REQUEST['repetirPassword']) ? $_REQUEST['repetirPassword'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['repetirPassword'])) {
                                        echo $aErrores['repetirPassword'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-secondary" aria-disabled="true" type="submit" name="registrarse">Registrarse</button>
                    <button class="btn btn-secondary" aria-disabled="true" type="submit" name="cancelar">Cancelar</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>