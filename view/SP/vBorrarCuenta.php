<!DOCTYPE html>
<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- vBorrarCuenta.php (Castellano)
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
                    <h2 style="color:#666;">¿SEGURO QUE QUIERES ELIMINAR EL USUARIO?</h2>
                    <img src="doc/vBorrarCuenta-icono.svg" class="img-fluid icono-rojo" alt="Icono Eliminar Usuario">
                </div>
            </div>
            <div class="row d-flex justify-content-start">
                <div class="col">
                    <form name="Programa" method="post">
                        <button class="btn btn-secondary" aria-disabled="true" type="submit" name="salirBorrarCuenta">Cancelar</button>
                        <button class="btn btn-danger" aria-disabled="true" type="submit" name="eliminarUsuario">Eliminar Usuario</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</main>