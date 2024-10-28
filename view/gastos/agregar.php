<?php
    require_once "../validar_sesion.php";
    //Obtenemos el mensaje enviado por el controlador
    $msj = @$_REQUEST["msj"];
    $fecha_actual = @ date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EJEMPLO DE CRUD PHP CON ORM ACTIVERECORD</title>
</head>

<body>
    <center>
        <h1>AGREGAR GASTOS</h1>
        <hr>
        <!-- EL FORMULARIO HTML -->
        <form action="../../controllers/GastoController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right">USUARIO:</th>
                    <td><input type="number" id="cc" name="cc" required placeholder="Digita la cedula"></td>
                </tr>
                <tr>
                    <th style="text-align: right">FECHA:</th>
                    <td><input type="date" id="fecha" name="fecha" value="<?=$fecha_actual?>" placeholder="Y-m-d"></td>
                </tr>
                <tr>
                    <th style="text-align: right">VALOR:</th>
                    <td><input type="number" id="valor" name="valor" required placeholder="Digita el Valor"></td>
                </tr>
                <tr>
                    <th style="text-align: right">DETALLES:</th>
                    <td><input type="text" id="detalles" name="detalles" placeholder="Escriba detalles del gasto"></td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <input type="reset" id="limpiar" value="Limpiar">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="action" name="action" value="Guardar">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Mostramos el mensaje enviado por el controlador -->
        <span style="color: red;"><?= ($msj != NULL || isset($msj)) ? $msj : "" ?></span>
    </center>
</body>

</html>