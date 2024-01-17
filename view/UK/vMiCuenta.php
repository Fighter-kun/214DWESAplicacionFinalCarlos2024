<!DOCTYPE html>
<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- vMiCuenta.php (Inglés)
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
    .btn-danger {
        background-color: red;
    }
</style>

<div class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col">
            <form name="editarPerfil" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <thead>
                            <tr>
                                <th class="rounded-top" colspan="3"><legend>My Account</legend></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Usuario deshabilitado -->
                                <td class="d-flex justify-content-start">
                                    <label for="user">User:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start" type="text" name="user"
                                           value="<?php echo ($codigoUsuarioActual); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <!-- Contraseña deshabilitado -->
                                <td class="d-flex justify-content-start">
                                    <label for="passwordUsuarioAEditar">Password:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start" type="password" name="passwordUsuarioAEditar"
                                           value="<?php echo ($contraseñaUsuarioActual); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <tr>
                                <!-- descripcionUsuarioAEditar Opcional -->
                                <td class="d-flex justify-content-start">
                                    <label for="T01_DescUsuario">Description:</label>
                                </td>
                                <td>                                                      <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                          comprobamos que exista la variable y no sea 'null'. En el caso verdadero devolveremos el contenido del campo
                                                                                          que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '$descripcionUsuarioActual' .-->
                                    <input class="d-flex justify-content-start" type="text" name="T01_DescUsuario" 
                                           value="<?php echo (isset($_REQUEST['T01_DescUsuario']) ? $_REQUEST['T01_DescUsuario'] : $descripcionUsuarioActual); ?>">
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
                                <!-- nConexionesUsuarioAEditar deshabilitado -->
                                <td class="d-flex justify-content-start">
                                    <label for="nConexionesUsuarioAEditar">Number of connections:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start" type="text" name="nConexionesUsuarioAEditar"
                                           value="<?php echo ($nConexionesUsuarioActual); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <?php
                            if ($nConexionesUsuarioActual > 1) {
                                echo "<tr>
                                        <!-- fechaHoraUltimaConexionAnteriorUsuarioAEditar deshabilitado -->
                                        <td class=\"d-flex justify-content-start\">
                                            <label for=\"fechaHoraUltimaConexionAnteriorUsuarioAEditar\">Date and Time of Last Connection:</label>
                                        </td>
                                        <td>
                                            <input class=\"bloqueado d-flex justify-content-start\" type=\"text\" name=\"fechaHoraUltimaConexionAnteriorUsuarioAEditar\"
                                                value=\"$fechaHoraUltimaConexionAnteriorUsuarioActual\" disabled>
                                        </td>
                                        <td class=\"error\">
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="row d-flex justify-content-start">
                    <div class="col">
                        <form name="Programa" method="post">
                            <button class="btn btn-secondary" aria-disabled="true" type="submit" name="cambiarContraseña">Change Password</button>
                            <button class="btn btn-secondary" aria-disabled="true" type="submit" name="confirmarCambios">Confirm Changes</button>
                            <button class="btn btn-secondary" aria-disabled="true" type="submit" name="salirMiCuenta">Cancel</button>
                            <button class="btn btn-danger" aria-disabled="true" type="submit" name="eliminarU">Delete User</button>
                        </form> 
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>