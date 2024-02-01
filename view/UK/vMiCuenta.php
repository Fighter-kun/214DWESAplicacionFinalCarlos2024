<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vMiCuenta.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 04/01/2024
-->

<div class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col">
            <form name="editarPerfil" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <tbody>
                            <tr>
                                <!-- Usuario deshabilitado -->
                                <td class="d-flex justify-content-start">
                                    <label for="user">Usuario:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start" type="text" name="user"
                                           value="<?php echo ($aVMiCuenta['codigoUsuarioActual']); ?>" disabled>
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
                                           value="<?php echo ($aVMiCuenta['contraseñaUsuarioActual']); ?>" disabled>
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
                                           value="<?php echo (isset($_REQUEST['T01_DescUsuario']) ? $_REQUEST['T01_DescUsuario'] : $aVMiCuenta['descripcionUsuarioActual']); ?>">
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
                                    <label for="nConexionesUsuarioAEditar">Number of Connections:</label>
                                </td>
                                <td>
                                    <input class="bloqueado d-flex justify-content-start" type="text" name="nConexionesUsuarioAEditar"
                                           value="<?php echo ($aVMiCuenta['nConexionesUsuarioActual']); ?>" disabled>
                                </td>
                                <td class="error">
                                </td>
                            </tr>
                            <?php
                            if ($aVMiCuenta['fechaHoraUltimaConexionAnteriorUsuarioActual'] > 1) {
                                echo "<tr>
                                        <!-- fechaHoraUltimaConexionAnteriorUsuarioAEditar deshabilitado -->
                                        <td class=\"d-flex justify-content-start\">
                                            <label for=\"fechaHoraUltimaConexionAnteriorUsuarioAEditar\">Fecha y Hora de Última Conexión:</label>
                                        </td>
                                        <td>
                                            <input class=\"bloqueado d-flex justify-content-start\" type=\"text\" name=\"fechaHoraUltimaConexionAnteriorUsuarioAEditar\"
                                                value=\"" . $aVMiCuenta['fechaHoraUltimaConexionAnteriorUsuarioActual'] . "\" disabled>
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
                            <button class="botones" type="submit" name="cambiarContraseña">Change Password</button>
                            <button class="botones" type="submit" name="confirmarCambios">Confirm Changes</button>
                            <button class="botones" type="submit" name="salirMiCuenta">Cancel</button>
                            <button class="botones" type="submit" name="eliminarU">Delete User</button>
                        </form> 
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>