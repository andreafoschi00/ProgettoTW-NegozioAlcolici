<?php
    session_start();
    define("UPLOAD_DIR", "./img/");
    define("INDIRIZZI", array("Via Cesare Pavese, 50, 47521 Cesena FC (1° Piano)", "Via Nicolò Macchiavelli, 47521 Cesena FC (Piano Terra)"));
    define("PAGAMENTI", array("Contanti alla consegna", "Carta di credito"));
    require_once("db/database.php");
    require_once("utils/functions.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "negozio_alcolici_tw", 3306);
    
    if(!isset($_SESSION["carrello"])) {
        $_SESSION["carrello"] = array();
        $_SESSION["costoCarrello"] = 0;
    }
    
    if(!isset($_SESSION["rank"])) {
        $_SESSION["rank"] = "unlogged";
    }
?>