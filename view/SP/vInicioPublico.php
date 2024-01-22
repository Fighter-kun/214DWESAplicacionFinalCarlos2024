<!--
        Descripción: Aplicación Final -- vInicioPublico.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 10/01/2024
-->
<div class="container mt-3">
    <div class="row mb-5">
        <div class="col text-center">
            <form class="opcionesDelIdioma">
                <button type="submit" value="UK" name="botonIdioma"><img src="doc/icono_UK.png" class="img-fluid" alt="Bandera_UK"></button>
                <!--<button type="submit" value="JP" name="botonIdioma"><img src="doc/icono_JP.png" class="img-fluid" alt="Bandera_JP"></button>-->
                <button type="submit" value="SP" name="botonIdioma"><img src="doc/icono_SP.png" class="img-fluid" alt="Bandera_SP"></button>
            </form>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col text-center">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="doc/esquemaApp.PNG" class="img-fluid" alt="Mapeo de la Aplicación">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="doc/archivosApp.PNG" class="img-fluid" alt="Mapeo de la Aplicación">
                    </div>
                    <div class="carousel-item">
                        <img src="doc/modelo.png" class="img-fluid" alt="Mapeo de la Aplicación">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <form method="post" action="index.php">
                <button class="botones" type="submit" name="login">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</div>