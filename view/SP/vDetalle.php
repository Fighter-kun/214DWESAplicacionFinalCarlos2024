<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- vDetalle.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 10/01/2024
-->
<style>
    .ejercicio {
        text-align: justify;
    }
</style>
<div class="row d-flex justify-content-start">
    <div class="col">
        <form name="tecnologias" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button class="btn btn-secondary" aria-disabled="true" type="submit" name="salirTecnologias">Salir</button>
        </form>        
    </div>
    <div class="col">
        <?php
        /*
         * @author Original Rebeca Sánchez Pérez
         * @version 1.2
         * @since 10/01/2024
         * Modificado por @author Carlos García Cachón
         *
         * @Annotation Proyecto LoginLogoffTema5 - Parte de 'vTecnologias' 
         * 
         */
        // $_SESSION
        echo('<div class="ejercicio">');
        echo('<h3>$_SESSION</h3>');
        foreach ($_SESSION as $key => $valor) {
            if ($key === 'user214DWESLoginLogoutMulticapaPOO' && $valor instanceof Usuario) {
                // Accede a las propiedades o métodos del objeto Usuario para obtener la información deseada
                echo('<pre>');
                var_dump($_SESSION['user214DWESLoginLogoutMulticapaPOO']);
                echo ('</pre>');
            } else {
                echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
            }
        }
        echo('</div>');

        // $_COOKIE
        echo('<div class="ejercicio">');
        echo('<h3>$_COOKIE</h3>');
        foreach ($_COOKIE as $key => $valor) {
            echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
        }
        echo('</div>');

        // $_SERVER
        echo('<div class="ejercicio">');
        echo('<h3>$_SERVER</h3>');
        foreach ($_SERVER as $key => $valor) {
            echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
        }
        echo('</div>');

        // $GLOBALS
        echo('<div class="ejercicio">');
        echo('<h3>$GLOBALS</h3>');
        foreach ($GLOBALS as $key => $valor) {
            if (is_object($valor) && $valor instanceof Usuario) {
                // Accede a las propiedades o métodos del objeto Usuario para obtener la información deseada
                echo('<u>' . $key . '</u> => <b>' . $valor->get_CodUsuario() . '</b><br>');
            } elseif (is_array($valor)) {
                foreach ($valor as $clave => $valor2) {
                    if (is_array($valor2)) {
                        // Manejar el caso de un array
                        echo('<u>' . $clave . '</u> => <b>Array</b><br>');
                    } elseif (is_object($valor2) && $valor2 instanceof Usuario) {
                        // Accede a las propiedades o métodos del objeto Usuario para obtener la información deseada
                        echo('<pre>');
                        var_dump($_SESSION['user214DWESLoginLogoutMulticapaPOO']);
                        echo ('</pre>');
                    } else {
                        // Otros tipos de datos
                        echo('<u>' . $clave . '</u> => <b>' . $valor2 . '</b><br>');
                    }
                }
            } else {
                echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
            }
        }
        echo('</div>');

        // $_GET
        echo('<div class="ejercicio">');
        echo('<h3>$_GET</h3>');
        foreach ($_GET as $key => $valor) {
            echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
        }
        echo('</div>');

        // $_POST
        echo('<div class="ejercicio">');
        echo('<h3>$_POST</h3>');
        foreach ($_POST as $key => $valor) {
            echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
        }
        echo('</div>');

        // $_FILES
        echo('<div class="ejercicio">');
        echo('<h3>$_FILES</h3>');
        foreach ($_FILES as $key => $valor) {
            echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
        }
        echo('</div>');

        // $_REQUEST
        echo('<div class="ejercicio">');
        echo('<h3>$_REQUEST</h3>');
        foreach ($_REQUEST as $key => $valor) {
            echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
        }
        echo('</div>');

        // $_ENV
        echo('<div class="ejercicio">');
        echo('<h3>$_ENV</h3>');
        foreach ($_ENV as $key => $valor) {
            echo('<u>' . $key . '</u> => <b>' . $valor . '</b><br>');
        }
        echo('</div>');

        // Se muestra en pantalla la información de PHP de nuestro servidor
        phpinfo();
        ?> 
    </div>
</div>