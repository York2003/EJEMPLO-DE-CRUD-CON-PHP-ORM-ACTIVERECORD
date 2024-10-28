<?php
require_once "../validar_sesion.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/reportes/models/Reporte.php";

$msj = isset($_GET["msj"]) ? $_GET["msj"] : null;
$codigo = isset($_GET["codigo"]) ? $_GET["codigo"] : '';
$password = isset($_GET["password"]) ? $_GET["password"] : '';
$email = isset($_GET["email"]) ? $_GET["email"] : '';
$tipoReporte = isset($_GET["tipoReporte"]) ? $_GET["tipoReporte"] : '';
$fechaReporte = isset($_GET["fechaReporte"]) ? $_GET["fechaReporte"] : '';
$detalles = isset($_GET["detalles"]) ? $_GET["detalles"] : '';
$estado = isset($_GET["estado"]) ? $_GET["estado"] : '';
$comentarios = isset($_GET["comentarios"]) ? $_GET["comentarios"] : '';
$usuario_encontrado = !empty($codigo);

if (!empty($fechaReporte)) {
    $fechaReporte = date('Y-m-d', strtotime($fechaReporte));
}
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
        <h1>BUSCAR REPORTES</h1>
        <hr>
        <form action="../../controllers/ReporteController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right">CODIGO:</th>
                    <td><input type="number" id="codigo" name="codigo" value="<?= htmlspecialchars($codigo) ?>" required placeholder="Digita el codigo"></td>
                </tr>
                <tr>
                    <th style="text-align: right">PASSWORD:</th>
                    <td><input type="password" id="password" name="password" value="<?= htmlspecialchars($password) ?>" placeholder="Escriba la contraseña"></td>
                </tr>
                <tr>
                    <th style="text-align: right">EMAIL:</th>
                    <td><input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Escriba el email"></td>
                </tr>
                <tr>
                    <th style="text-align: right">tipoREPORTE:</th>
                    <td><input type="text" id="tipoReporte" name="tipoReporte" value="<?= htmlspecialchars($tipoReporte) ?>" placeholder="Escriba el tipo de reporte"></td>
                </tr>
                <tr>
                    <th style="text-align: right">fechaREPORTE:</th>
                    <td><input type="date" id="fechaReporte" name="fechaReporte" value="<?= htmlspecialchars($fechaReporte) ?>" placeholder="Y-m-d"></td>
                </tr>
                <tr>
                    <th style="text-align: right">DETALLES:</th>
                    <td><input type="text" id="detalles" name="detalles" value="<?= htmlspecialchars($detalles) ?>" placeholder="Escriba los detalles"></td>
                </tr>
                <tr>
                    <th style="text-align: right">ESTADO:</th>
                    <td><input type="text" id="estado" name="estado" value="<?= htmlspecialchars($estado) ?>" placeholder="Escriba el estado"></td>
                </tr>
                <tr>
                    <th style="text-align: right">COMENTARIOS:</th>
                    <td><input type="text" id="comentarios" name="comentarios" value="<?= htmlspecialchars($comentarios) ?>" placeholder="Escriba un comentario"></td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <input type="reset" id="limpiar" value="Limpiar">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="buscar" name="action" value="Buscar">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="editar" name="action" value="Editar" <?= $usuario_encontrado ? '' : 'disabled' ?> >&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="eliminar" name="action" value="Eliminar" <?= $usuario_encontrado ? '' : 'disabled' ?> >
                    </td>
                </tr>
            </table>
        </form>
        <span style="color: red;">
            <?= htmlspecialchars($msj) ?>
        </span>
    </center>
</body>
</html>
