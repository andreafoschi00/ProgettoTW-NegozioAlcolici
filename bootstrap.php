<?php
    session_start();
    define("UPLOAD_DIR", "./img/");
    require_once("db/database.php");
    require_once("utils/functions.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "negozio_alcolici_tw", 3306);
?>