<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vInicioPrivado.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 03/02/2024
-->
<script type="text/javascript" src="webroot/js/reloj.js"></script>
<div class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col"><!-- Formulario donde recogemos los botones para ir a detalle o cerrar sesión -->
            <form name="Programa" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button class="botones" aria-disabled="true" type="submit" name="cerrarSesion">Log Out</button><br><br>
                <button class="botones" aria-disabled="true" type="submit" name="detalle">Detail</button><br><br>
                <button class="botones" aria-disabled="true" type="submit" name="editarPerfil">Edit profile</button><br><br>
                <button class="botones" aria-disabled="true" type="submit" name="mtoDepartamentos">Mt. Departments</button><br><br>
                <button class="botones" aria-disabled="true" type="submit" name="mtoAnimales">Mt. Animals</button><br><br>
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
                echo("<div>" .$aMessageLang[$_COOKIE['idioma']]['bienvenido'] .$descripcionUsuario. $aMessageLang[$_COOKIE['idioma']]['estaEsLa'] 
                        .$numeroConexionesUsuario. $aMessageLang[$_COOKIE['idioma']]['vezQueTeConectas']."</div>");
            } else {
                // Si se a conectado más veces muestro toda la información
                echo("<div>" .$aMessageLang[$_COOKIE['idioma']]['bienvenido'] .$descripcionUsuario. $aMessageLang[$_COOKIE['idioma']]['estaEsLa'] 
                        .$numeroConexionesUsuario. $aMessageLang[$_COOKIE['idioma']]['vezQueTeConectas']
                        . $aMessageLang[$_COOKIE['idioma']]['ustedSeConectoPorUltimaVez'] .$fechaHoraUltimaConexionAnterior."</div>");
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
