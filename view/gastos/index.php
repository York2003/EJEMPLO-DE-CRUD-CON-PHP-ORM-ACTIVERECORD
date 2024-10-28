<?php
    require_once "../validar_sesion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <title>EJEMPLO DE CRUD PHP CON ORM ACTIVERECORD</title>
    <link rel="stylesheet" href="../css/estilos.css"></link>
</head>
<body>
    <center>
        <table>
            <tr>
                <th>MENU DE GASTOS</th>
            </tr>
            <tr>
                <td><a href="agregar.php">AGREGAR GASTO</a></td>
            </tr>
            <tr>
                <td><a href="buscar.php">BUSCAR GASTO</a></td>
            </tr>
            <tr>
                <td><a href="buscar.php">EDITAR GASTO</a></td>
            </tr>
            <tr>
                <td><a href="buscar.php">ELIMINAR GASTO</a></td>
            </tr>
            <tr>
                <td><a href="../../controllers/GastoController.php?action=todo">LISTAR TODOS</a></td>
            </tr>
        </table>
    </center>
</body>
</html>