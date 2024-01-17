<!DOCTYPE html>
<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- layout.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 02/01/2024
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Carlos García Cachón">
        <meta name="description" content="214DWESLoginLogoutMulticapaPOO">
        <meta name="keywords" content="214DWESLoginLogoutMulticapaPOO, DWES">
        <meta name="generator" content="Apache NetBeans IDE 19">
        <meta name="generator" content="60">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Carlos García Cachón</title>
        <link rel="icon" type="image/jpg" href="webroot/media/images/favicon.ico"/>
        <link rel="stylesheet" href="webroot/bootstrap-5.3.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="webroot/css/style.css">
        <style>
            button {
                all: unset;
            }
            .carousel-control-prev-icon {
                background-color: #666;
            }
            .carousel-control-next-icon {
                background-color: #666;
            }
        </style>
    </head>

    <body>
        <header class="text-center">
            <h1>Aplicación LoginLogoutMulticapaPOO - <?php echo $aTitleLang[$_COOKIE['idioma']][$_SESSION['paginaEnCurso']]?></h1>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <?php require_once $aView[$_COOKIE['idioma']][$_SESSION['paginaEnCurso']]; ?>
                    </div>
                </div>
            </div>
        </main>
        <footer class="position-fixed bottom-0 end-0">
            <div class="row text-center">
                <div class="footer-item">
                    <address>© <a href="../index.html" target="_blank" style="color: white; text-decoration: none; background-color: #666;">Carlos García Cachón</a>
                        IES LOS SAUCES 2023-24 </address>
                </div>
                <div class="footer-item"></div>
                <div class="footer-item">
                    <a href="https://github.com/Fighter-kun/214DWESLoginLogoutMulticapaPOO.git" target="_blank"><img
                            src="webroot/media/images/github.png" alt="LogoGitHub" /></a>
                </div>
            </div>
        </footer>

        <script src="webroot/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>

