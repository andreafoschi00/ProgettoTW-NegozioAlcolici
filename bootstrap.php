<?php
    session_start();
    define("UPLOAD_DIR", "./img/");
    require_once("db/database.php");
    require_once("utils/functions.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "negozio_alcolici_tw", 3306);
    
    if(!isset($_SESSION["carrello"])) {
        $_SESSION["carrello"] = array();
    }
    
    if(!isset($_SESSION["rank"])) {
        $_SESSION["rank"] = "unlogged";
    }
?>