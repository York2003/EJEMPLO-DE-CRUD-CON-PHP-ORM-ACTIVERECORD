<?php
//obtenemos el mensaje enviado por el controlador

use ActiveRecord\DateTime;

@session_start();
require_once "../validar_sesion.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "gastos/models/Gasto.php";

$msj = @$_REQUEST["msj"];
$g = @$_SESSION["Gasto.find"];
$g = unserialize($g);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EJEMPLO DE CRUD CON PHP ORM ACTIVERECORD</title>
    <script src="../js/validaciones.js"></script>
</head>

<body>
    <center>
        <h1>BUSCAR GASTOS</h1>
        <hr>
        <!-- EL FORMULARIO HTML -->
        <form action="../../controllers/GastoController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right">ID:</th>
                    <td><input type="number" id="id" name="id" value="<?= @$g->id ?>" required placeholder="Digita la Id del gasto"></td>
                </tr>
                <tr>
                    <th style="text-align: right">CEDULA DEL USUARIO:</th>
                    <td><input type="number" id="cc" name="cc" value="<?= @$g->usuario_id ?>" readonly placeholder="Digita la Cedula"></td>
                </tr>
                <tr>
                    <th style="text-align: right">FECHA:</th>
                    <td><input type="date" id="fecha" name="fecha" readonly value="<?= @date_format($g->fecha,"Y-m-d")?>" placeholder="Digita la Fecha"></td>
                </tr>
                <tr>
                    <th style="text-align: right">VALOR:</th>
                    <td><input type="number" id="valor" name="valor" readonly value="<?= @$g->valor ?>" placeholder="Digita el Valor"></td>
                </tr>
                <tr>
                    <th style="text-align: right">DETALLES:</th>
                    <td><input type="text" id="detalles" name="detalles" readonly value="<?= @$g->detalles ?>" placeholder="Digita el Detalles"></td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <input type="reset" id="limpiar" value="Limpiar">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="buscar" name="action" value="Buscar">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="editar" name="action" value="Editar" disabled>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="eliminar" name="action" value="Eliminar" disabled>
                    </td>
                </tr>
            </table>
        </form>
        <!-- Mostramos el mensaje enviado por el controlador -->
        <span style="color: red;">
            <?= ($msj != NULL || isset($msj)) ? $msj : "" ?>
        </span>
    </center>
    <script>
        habilitarBotonesGastos();
        confirmarOperacion("Gasto");
    </script>
</body>

</html>