<!DOCTYPE html>
<!--
        Descripción: Aplicación Final -- vBorrarCuenta.php (Inglés)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 04/01/2024
-->

<style>
    .btn-danger {
        background-color: red;
    }
   .icono-rojo {
    filter: invert(18%) sepia(97%) saturate(7495%) hue-rotate(353deg) brightness(106%) contrast(114%);
    }
</style>

<body>
    <main>
        <div class="container mt-3">
            <div class="row mb-5">
                <div class="col text-center">
                    <h2>ARE YOU SURE YOU WANT TO DELETE THE USER?</h2>
                    <img src="webroot/media/images/vBorrarCuenta-icono.svg" class="img-fluid icono-rojo" alt="Icono Eliminar Usuario">
                </div>
            </div>
            <div class="row d-flex justify-content-start">
                <div class="col">
                    <form name="Programa" method="post">
                        <button class="botones" type="submit" name="salirBorrarCuenta">Cancel</button>
                        <button class="botones" type="submit" name="eliminarUsuario">Delete User</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</main>