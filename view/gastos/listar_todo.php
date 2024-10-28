<?php
@session_start();

require_once "../validar_sesion.php";
require_once $_SERVER["DOCUMENT_ROOT"]."gastos/models/Gasto.php";

//Obtenemos el mensaje enviado por el controlador
$msj = @$_REQUEST["msj"];
$gastos = @$_SESSION["Gastos.all"];
$gastos = unserialize($gastos);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EJEMPLO DE CRUD PHP CON ORM ACTIVERECORD</title>
    <script src="../js/validaciones.js"></script>
    <link rel="stylesheet" href="../css/estilos.css"></link>
</head>

<body>
    <center>
        <h1>REPORTE DE gastos</h1>
        <hr>
        <?php
        if($gastos == null || count($gastos) <= 0){
        ?>
            <span style="color: #900D40; background-color: #FAD7CE;">
                No existen Gastos registrados
            </span>
        <?php
        } else {
        ?>
            <fieldset style="width:70%">
                <legend>Informacion de los gastos:</legend>
                <table>
                    <!-- CREAR UNA FILA (TR: TABLE ROW) PARA LAS COLUMNAS-->
                    <tr>
                        <!-- CREAR LA CELDA  DE CABECERA (TH: TABLE HEAD) PARA LOS DATOS DE USUARIO-->
                        <th>#</th>
                        <th>ID</th>
                        <th>USUARIO</th>
                        <th>FECHA</th>
                        <th>VALOR</th>
                        <th>DETALLES</th>
                    </tr>
                    <?php
                    //RECORRER CADA UNO DE LOS gastos EN LA LISTA
                    foreach($gastos as $i =>$g){
                    ?>
                        <!-- CREAR UNA FILA (TR: TABLE ROW) POR CADA USUARIO -->
                        <tr style="text-align: left;">
                            <!-- CREAR UNA CELDA DE DATO (TD: TABLE DATA) POR CADA GASTO -->
                            <td><?= ($i+1) ?></td>
                            <td><?= $g->id ?></td>
                            <td><?= $g->usuario_id ?></td>
                            <td><?= $g->fecha ?></td>
                            <td><?= $g->valor ?></td>
                            <td><?= $g->detalles ?></td>                            
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </fieldset>
        <?php
        }
        ?>

        <!-- Mostramos el mensaje enviado por el controlador-->
        <span style="color:red;"><?= ($msj != NULL || isset($msj)) ? $msj:""?></span>   
    </center>
</body>
</html>