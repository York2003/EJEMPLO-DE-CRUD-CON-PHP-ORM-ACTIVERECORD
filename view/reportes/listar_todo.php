<?php
@session_start();

require_once "../validar_sesion.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/reportes/models/Reporte.php";

//Obtenemos el mensaje enviado por el controlador
$msj = @$_REQUEST["msj"];
$reportes = @$_SESSION["reportes.all"];
$reportes = unserialize($reportes);

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
        <h1>LISTA DE REPORTES</h1>
        <hr>
        <?php
        if($reportes == null || count($reportes) <= 0){
        ?>
            <span style="color: #900D40; background-color: #FAD7CE;">
                No existen Reportes registrados
            </span>
        <?php
        } else {
        ?>
            <fieldset style="width:70%">
                <legend>Informacion de los reportes:</legend>
                <table>
                    <!-- CREAR UNA FILA (TR: TABLE ROW) PARA LAS COLUMNAS-->
                    <tr>
                        <!-- CREAR LA CELDA  DE CABECERA (TH: TABLE HEAD) PARA LOS DATOS DE USUARIO-->
                        <th>#</th>
                        <th>CODIGO</th>
                        <th>PASSWORD</th>
                        <th>EMAIL</th>
                        <th>tipoREPORTE</th>
                        <th>fechaREPORTE</th>
                        <th>DETALLES</th>
                        <th>ESTADO</th>
                        <th>COMENTARIOS</th>
                    </tr>
                    <?php
                    //RECORRER CADA UNO DE LOS USUARIOS EN LA LISTA
                    foreach($reportes as $i =>$u){
                    ?>
                        <!-- CREAR UNA FILA (TR: TABLE ROW) POR CADA USUARIO -->
                        <tr style="text-align: left;">
                            <!-- CREAR UNA CELDA DE DATO (TD: TABLE DATA) POR CADA USUARIO -->
                            <td><?= ($i+1) ?></td>
                            <td><?= $u->codigo ?></td>
                            <td><?= $u->password ?></td>
                            <td><?= $u->email ?></td>
                            <td><?= $u->tipo ?></td>
                            <td><?= $u->fecha ?></td>
                            <td><?= $u->detalles ?></td>
                            <td><?= $u->estado ?></td>
                            <td><?= $u->comentarios ?></td>
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