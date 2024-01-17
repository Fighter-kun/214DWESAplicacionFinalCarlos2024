<style>
    .obligatorio {
        background-color: #ffff7a;
    }
    .bloqueado:disabled {
        background-color: #665 ;
        color: white;
    }
    .error {
        color: red;
        width: 450px;
    }
    .mensajeDeConfirmacion {
        color:#4CAF50;
        font-weight:bold;
    }
</style>

<div class="container mt-3">
    <div class="row text-center">
        <div class="col">
            <!-- Codigo del formulario -->
            <form name="insercionValoresTablaDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <table>
                        <thead>
                            <tr>
                                <th class="rounded-top" colspan="3"><legend>Añadir Departamento</legend></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- CodDepartamento Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="CodDepartamento">Codigo de Departamento:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" placeholder="AAD" name="CodDepartamento" value="<?php echo (isset($_REQUEST['CodDepartamento']) ? $_REQUEST['CodDepartamento'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['CodDepartamento'])) {
                                    echo $aErrores['CodDepartamento'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- DescDepartamento Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="DescDepartamento">Descripción de Departamento:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" name="DescDepartamento" placeholder="Departamento de Ventas" value="<?php echo (isset($_REQUEST['DescDepartamento']) ? $_REQUEST['DescDepartamento'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['DescDepartamento'])) {
                                    echo $aErrores['DescDepartamento'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- FechaCreacionDepartamento Opcional -->
                                <td class="d-flex justify-content-start">
                                    <label for="FechaCreacionDepartamento">Fecha de Creación:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input disabled class="d-flex justify-content-start bloqueado" type="text" name="FechaCreacionDepartamento"  value="<?php echo ($fechaYHoraActualCreacionFormateada); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['FechaCreacionDepartamento'])) {
                                    echo $aErrores['FechaCreacionDepartamento'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- VolumenNegocio Obligatorio -->
                                <td class="d-flex justify-content-start">
                                    <label for="VolumenDeNegocio">Volumen de Negocio:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input class="obligatorio d-flex justify-content-start" type="text" name="VolumenDeNegocio" placeholder="1234.5" value="<?php echo (isset($_REQUEST['VolumenDeNegocio']) ? $_REQUEST['VolumenDeNegocio'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['VolumenDeNegocio'])) {
                                    echo $aErrores['VolumenDeNegocio'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                            <tr>
                                <!-- FechaBaja Opcional -->
                                <td class="d-flex justify-content-start">
                                    <label for="FechaBaja">Fecha de Baja:</label>
                                </td>
                                <td>                                                                                                <!-- El value contiene una operador ternario en el que por medio de un metodo 'isset()'
                                                                                                                                    comprobamos que exista la variable y no sea 'null'. En el caso verdadero devovleremos el contenido del campo
                                                                                                                                    que contiene '$_REQUEST' , en caso falso sobrescribira el campo a '' .-->
                                    <input disabled class="d-flex justify-content-start bloqueado" type="text" name="FechaBaja" placeholder="YYYY/mm/dd HH:ii:ss" value="<?php echo (isset($_REQUEST['FechaBaja']) ? $_REQUEST['FechaBaja'] : ''); ?>">
                                </td>
                                <td class="error">
                                    <?php
                                    if (!empty($aErrores['FechaBaja'])) {
                                    echo $aErrores['FechaBaja'];
                                    }
                                    ?> <!-- Aquí comprobamos que el campo del array '$aErrores' no esta vacío, si es así, mostramos el error. -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-secondary" role="button" aria-disabled="true" type="submit" name="añadirDepartamento">Añadir Departamento</button>
                    <button class="btn btn-secondary" role="button" aria-disabled="true" type="submit" name="salirAñadirDepartamento">Salir</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>