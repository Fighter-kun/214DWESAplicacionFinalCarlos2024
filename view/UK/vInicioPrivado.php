<!DOCTYPE html>
<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- vInicioPublico.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 12/01/2024
-->

<style>
    /* RELOJ */
    #date {
        letter-spacing:10px;
        font-size:20px;
        font-family:'helvetica';
        color:#D4AF37;
    }

    .digit {
        width: 50px;
        height: 100px;
        display: inline-block;
        background-size: cover;
    }
</style>

<div class="container mt-3">
    <div class="row d-flex justify-content-start">
        <div class="col"><!-- Formulario donde recogemos los botones para ir a detalle o cerrar sesión -->
            <form name="Programa" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button class="btn btn-secondary" aria-disabled="true" type="submit" name="cerrarSesion">Logout</button><br><br>
                <button class="btn btn-secondary" aria-disabled="true" type="submit" name="detalle">Detail</button><br><br>
                <button class="btn btn-secondary" aria-disabled="true" type="submit" name="editarPerfil">Edit Profile</button><br><br>
                <button class="btn btn-secondary" aria-disabled="true" type="submit" name="mtoDepartamentos">Mt. Department</button>
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
             * @Annotation Proyecto LoginLogoutMulticapaPOO - Parte de 'cInicioPrivado' 
             * 
             */
            if ($numeroConexionesUsuario == 1) { // Compruebo si es la primera vez que se conecta y omito la fecha y hora de última conexión
                echo("<div>Welcome ".$descripcionUsuario." this is the ".$numeroConexionesUsuario." time you connect;</div>");
            } else {
                // Si se a conectado más veces muestro toda la información
                echo("<div>Welcome ".$descripcionUsuario." this is the ".$numeroConexionesUsuario." time you connect; "
                        . "you last logged in on ".$fechaHoraUltimaConexionAnterior."</div>");
            }
            ?> 
        </div>
    </div>
