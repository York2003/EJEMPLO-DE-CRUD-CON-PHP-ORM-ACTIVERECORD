<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/reportes/lib/config.php";

class Reporte extends ActiveRecord\Model{
    public static $primary_key = "codigo";
    public static $table_name = "reportes";
}