<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vInicioPrivado.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 03/02/2024
-->
<script type="text/javascript" src="webroot/js/reloj.js"></script>
<div onload="startTime()" class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col"><!-- Formulario donde recogemos los botones para ir a detalle o cerrar sesión -->
            <form name="Programa" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button class="botones" aria-disabled="true" type="submit" name="cerrarSesion">Cerrar Sesion</button><br><br>
                <button class="botones" aria-disabled="true" type="submit" name="detalle">Detalle</button><br><br>
                <button class="botones" aria-disabled="true" type="submit" name="editarPerfil">Editar Perfil</button><br><br>
                <button class="botones" aria-disabled="true" type="submit" name="mtoDepartamentos">Mto. Departamentos</button><br><br>
                <button class="botones" aria-disabled="true" type="submit" name="apiREST">REST</button>
            </form>        
        </div>
        <div class="col">
            <?php
            /**
             * @author Carlos García Cachón
             * @version 1.0
             * @since 04/01/2024
             * @copyright Todos los derechos reservados a Carlos García
             * 
             * @Annotation Aplicación Final - Parte de 'cInicioPrivado' 
             * 
             */
            if ($numeroConexionesUsuario == 1) { // Compruebo si es la primera vez que se conecta y omito la fecha y hora de última conexión
                echo("<div>Bienvenid@ ".$descripcionUsuario." esta es la ".$numeroConexionesUsuario." vez que te conectas;</div>");
            } else {
                // Si se a conectado más veces muestro toda la información
                echo("<div>Bienvenid@ ".$descripcionUsuario." esta es la ".$numeroConexionesUsuario." vez que te conectas; "
                        . "usted se conectó por última vez el ".$fechaHoraUltimaConexionAnterior."</div>");
            }
            ?> 
        </div>
    </div>
    <div class="row">
                    <div class="col"></div>
                    <div class="col mt-5">
                        <div id="clockdate"><!-- Bloque de código HTML donde va el reloj -->
                            <div id="clock"></div>
                            <div id="date"></div>
                        </div>
                    </div>
                </div>
