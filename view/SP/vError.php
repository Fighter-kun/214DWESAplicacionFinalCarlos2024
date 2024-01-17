<!--
        Descripción: 214DWESLoginLogoutMulticapaPOO -- vError.php (Castellano)
        Autor: Carlos García Cachón
        Fecha de creación/modificación: 03/02/2024
-->
<div class="container mt-3">
    <div class="row mb-5">
        <div class="col text-center">
            <table>
                <thead>
                    <tr>
                        <th class="rounded-top" colspan="2"><legend>ERROR</legend></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Código:</td>
                        <td><?php echo $sCodError ?></td>
                    </tr>
                    <tr>
                        <td>Descripción:</td>
                        <td><?php echo $sDescError ?></td>
                    </tr>
                    <tr>
                        <td>Archivo:</td>
                        <td><?php echo $sArchivoError ?></td>
                    </tr>
                    <tr>
                        <td>Línea:</td>
                        <td><?php echo $iLineaError ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <form method="post" action="index.php">
                <button class="btn btn-secondary" type="submit" name="salirDelError">Salir</button>
            </form>
        </div>
    </div>
</div>