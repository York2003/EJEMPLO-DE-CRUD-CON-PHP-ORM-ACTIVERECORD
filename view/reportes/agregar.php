<?php
    require_once "../validar_sesion.php";
    //Obtenemos el mensaje enviado por el controlador
    $msj = @$_REQUEST["msj"];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EJEMPLO DE CRUD PHP CON ORM ACTIVERECORD</title>
</head>

<body>
    <center>
        <h1>AGREGAR REPORTES</h1>
        <hr>
        <!-- EL FORMULARIO HTML -->
        <form action="../../controllers/ReporteController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right">CODIGO:</th>
                    <td><input type="number" id="codigo" name="codigo" required placeholder="Digita el codigo"></td>
                </tr>
                <tr>
                    <th style="text-align: right">PASSWORD:</th>
                    <td><input type="password" id="pass" name="pass" required placeholder="Escriba la contraseña"></td>
                </tr>
                <tr>
                    <th style="text-align: right">EMAIL:</th>
                    <td><input type="email" id="correo" name="correo" required placeholder="Escriba el email"></td>
                </tr>
                <tr>
                    <th style="text-align: right">TIPO:</th>
                    <td><input type="text" id="tipo" name="tipo" required placeholder="Escriba el tipo"></td>
                </tr>
                <tr>
                    <th style="text-align: right">DETALLES:</th>
                    <td><input type="text" id="detalles" name="detalles" placeholder="Escriba los detalles"></td>
                </tr>
                <tr>
                    <th style="text-align: right">FECHA:</th>
                    <td><input type="date" id="fecha" name="fecha" placeholder="Escriba los detalles"></td>
                </tr>
                <tr>
                    <th style="text-align: right">ESTADO:</th>
                    <td><input type="text" id="estado" name="estado" placeholder="Escriba el estado"></td>
                </tr>
                <tr>
                    <th style="text-align: right">COMENTARIOS:</th>
                    <td><input type="text" id="comentarios" name="comentarios" placeholder="Escriba un comentario"></td>
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