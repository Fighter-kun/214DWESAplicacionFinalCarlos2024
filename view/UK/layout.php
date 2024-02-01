<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- layout.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 24/01/2024
-->
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Carlos García Cachón">
        <meta name="description" content="Aplicación Final">
        <meta name="keywords" content="Aplicación Final, DWES">
        <meta name="generator" content="Apache NetBeans IDE 19">
        <meta name="generator" content="60">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Carlos García Cachón</title>
        <link rel="icon" type="image/jpg" href="webroot/media/images/favicon.ico"/>
        <link rel="stylesheet" href="webroot/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="webroot/bootstrap-5.3.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="webroot/css/style.css">
        <style>
        </style>
    </head>

    <body onload="startTime()">
        <header>
            <div class="row text-center navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="col">
                    <form method="post">
                        <img width="25px" src="webroot/media/images/lupa.png" alt="LUPA"/>
                </div>
                <div class="col-6">
                    <p class="titulo">FINAL APPLICATION</p>
                </div>
                <div class="col">
                    <button type="submit" name="login"><img width="45px" src="webroot/media/images/login.svg" alt="LOGIN"/></button>
                    <img width="25px" src="webroot/media/images/iconoMenu.svg" alt="MENU"/>
                    </form>
                </div>
            </div>
        </header>
        <script src="webroot/js/scrollBannerTitulo.js"></script>

        <main>
            <!-- Banner -->
            <div id="banner">
                <h1><?php echo $aTitleLang[$_COOKIE['idioma']][$_SESSION['paginaEnCurso']] ?></h1>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <?php require_once $aView[$_COOKIE['idioma']][$_SESSION['paginaEnCurso']]; ?>
                    </div>
                </div>
            </div>


        </main>


        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row text-center">
                    <div class="col">
                        <h5>CORPORATE INFORMATION</h5>
                        <a target="_blank" href="webroot/pdf/Currículum.pdf">Curriculum</a><br>
                        <a target="_blank" href="doc/index.html">PHPDOC</a>
                        <form method='post'>
                        <button type="submit" name="tecnologias">Technologies</button>
                        </form>
                        <a target="_blank" href="webroot/rss/rss.xml">RSS</a>
                    </div>
                    <div class="col">
                        <h5>IMITATED PAGE</h5>
                        <a target="_blank" href="https://www.plein.com/es/home/"><img width="50px" src="webroot/media/images/logoPP.png" alt="LOGO-PP"/></a>
                    </div>
                    <div class="col">
                        <h5>REPOSITORY</h5>
                        <a target="_blank" href="https://github.com/Fighter-kun/214DWESAplicacionFinalCarlos2024.git"><img src="webroot/media/images/github.png" alt="GITHUB"/></a>
                    </div>
                    <div class="col">
                        <h5>COUNTRY / LANGUAGE</h5>
                        <form class="opcionesDelIdioma">
                            <button type="submit" value="SP" name="botonIdioma">Spanish</button><br>
                            <button type="submit" value="UK" name="botonIdioma">English</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col">
                        <img src="webroot/media/images/logo1.png" alt="logo1"/>
                    </div>
                    <div class="col">
                        <img src="webroot/media/images/logo2.png" alt="logo2"/>
                    </div>
                    <div class="col">
                        <img src="webroot/media/images/logo3.png" alt="logo3"/>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col">
                    </div>
                    <div class="col">
                        <a target="_blank" href="https://daw214.ieslossauces.es/">©2024 Carlos García Cachón — All rights reserved</a>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </footer>

        <script src="webroot/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>

    </body>

</html>