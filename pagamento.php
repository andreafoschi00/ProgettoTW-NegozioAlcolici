<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn()) {
    $templateParams["errorelogin"] = "Devi prima fare l'accesso!";
    require 'carrello.php';
}
$templateParams["titolo"] = "Pagamento - Negozio Alcolici";
$templateParams["nome"] = "temp-pagamento.php";
$templateParams["titolo_pagina"] = "Pagamento";
$templateParams["indirizzi"] = array("Via Cesare Pavese, 50, 47521 Cesena FC (1° Piano)", "Via Nicolò Macchiavelli, 47521 Cesena FC (Piano Terra)");
$templateParams["metodi_pagamento"] = array("Contanti alla consegna", "Carta di credito");

$ids = array();
foreach($_SESSION["carrello"] as $prodotto) {
    array_push($ids, $prodotto["id"]);
}
$templateParams["prodottiNelCarrello"] = $dbh->getProductsFromID($ids);
$templateParams["prezzoTotale"] = $_SESSION["costoCarrello"];

require 'template/temp-pagamento.php';
?>