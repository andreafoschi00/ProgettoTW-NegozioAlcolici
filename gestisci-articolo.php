<?php

require_once "bootstrap.php";

if(isset($_GET["action"]) && $_GET["action"] == "1"){
    
    $templateParams["titolo"] = "Inserimento Articolo - Negozio Alcolici";
    $templateParams["nome"] = "temp-inserimento.php";
    $_SESSION["azione"] = "Inserisci";
    $templateParams["categorie"] = $dbh->getCategories();
    require "template/temp-inserimento.php";
} else if(isset($_GET["action"]) && $_GET["action"] == "2"){

    $templateParams["titolo"] = "Modifica Articolo - Negozio Alcolici";
    $templateParams["nome"] = "temp-inserimento.php";
    $templateParams["categorie"] = $dbh->getCategories();
    $_SESSION["azione"] = "Modifica";
    $id = $_GET["id"];
    $templateParams["prodotto"] = $dbh->getProductsFromID(array($id));
    
    $_SESSION["modificaProdotto"] = $templateParams["prodotto"][0];
    
    require "template/temp-inserimento.php";

} else if(isset($_GET["action"]) && $_GET["action"] == "3"){
    $dbh->deleteProduct($_GET["id"]);

    $id = $dbh->getIdSeller($_SESSION["email"]);

    $templateParams["checkEliminazione"] = "Cancellazione eseguita con successo!";
    $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
    $templateParams["nome"] = "temp-amministrazione.php";
    $templateParams["articoli"] = $dbh->getSellerProducts($id[0]["ID"]);
    require "template/temp-amministrazione.php";

} else {
    require "amministrazione.php"; 
}


?>