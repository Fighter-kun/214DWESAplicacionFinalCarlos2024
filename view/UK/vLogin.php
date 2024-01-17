<!DOCTYPE html>
<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- vLogin.php (Inglés)
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

<body>
    <main>
        <div class="container mt-3">
            <div class="row d-flex justify-content-start">
                <div class="col">
                    <!-- Codigo del formulario -->
                    <form name="controlAcceso" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <fieldset>
                            <table>
                                <thead>
                                    <tr>
                                        <th class="rounded-top" colspan="3"><legend>Login</legend></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- CodDepartamento Obligatorio -->
                                        <td class="d-flex justify-content-start">
                                            <label for="user">User:</label>
                                        </td>
                                        <td>
                                            <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                 comprobamos que exista la variable y no sea 'null'. En el caso verdadero devolveremos el contenido del campo
                                                 que contiene '$_REQUEST' , en caso falso sobrescribirá el campo a '' .-->
                                            <input class="obligatorio d-flex justify-content-start" type="text" name="user"
                                                   value="<?php echo (isset($_REQUEST['user']) ? $_REQUEST['user'] : ''); ?>">
                                        </td>
                                        <td class="error">
                                            <?php
                                            if (!empty($aErrores['user'])) {
                                                echo $aErrores['user'];
                                            }
                                            ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no está vacío, si es así, mostramos el error. -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- CodDepartamento Obligatorio -->
                                        <td class="d-flex justify-content-start">
                                            <label for="password">Password:</label>
                                        </td>
                                        <td>
                                            <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                 comprobamos que exista la variable y no sea 'null'. En el caso verdadero devolveremos el contenido del campo
                                                 que contiene '$_REQUEST' , en caso falso sobrescribirá el campo a '' .-->
                                            <input class="obligatorio d-flex justify-content-start" type="password" name="password"
                                                   value="<?php echo (isset($_REQUEST['password']) ? $_REQUEST['password'] : ''); ?>">
                                        </td>
                                        <td class="error">
                                            <?php
                                            if (!empty($aErrores['password'])) {
                                                echo $aErrores['password'];
                                            }
                                            ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no está vacío, si es así, mostramos el error. -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <button class="btn btn-secondary" aria-disabled="true" type="submit" name="iniciarSesion">Login</button>
                                <button class="btn btn-secondary" aria-disabled="true" type="submit" name="registrarse">Sign In</button>
                                <button class="btn btn-secondary" aria-disabled="true" type="submit" name="cancelar">Cancel</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>