<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn()) {
    $templateParams["errorelogin"] = "Devi prima fare l'accesso!";
    require 'carrello.php';
} else {
    $templateParams["titolo"] = "Pagamento - Negozio Alcolici";
    $templateParams["nome"] = "temp-pagamento.php";
    $templateParams["titolo_pagina"] = "Pagamento";
    $templateParams["indirizzi"] = INDIRIZZI;
    $templateParams["metodi_pagamento"] = PAGAMENTI;

    $ids = array();
    foreach($_SESSION["carrello"] as $prodotto) {
        array_push($ids, $prodotto["id"]);
    }
    $templateParams["prodottiNelCarrello"] = $dbh->getProductsFromID($ids);
    $templateParams["prezzoTotale"] = $_SESSION["costoCarrello"];

    require 'template/temp-pagamento.php';
}
?>