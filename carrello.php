<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Carrello - Negozio Alcolici";
$templateParams["nome"] = "temp-carrello.php";

$newProdotto = array();

if(isset($_GET["id"]) && isset($_GET["quantità"])) {
    $id = $_GET["id"];
    $quantità = $_GET["quantità"];
    $newProdotto = array("id"=>$id, "quantità"=> $quantità);
}

if(count($newProdotto) != 0) {
    array_push($_SESSION["carrello"], $newProdotto);
}

if(count($_SESSION["carrello"]) == 0) {
    $templateParams["titolo_pagina"] = "Il carrello è vuoto";
    $templateParams["prodottiNelCarrello"] = array();
    $templateParams["prezzoTotale"] = 0;
} else {
    $ids = array();
    foreach($_SESSION["carrello"] as $prodotto) {
        array_push($ids, $prodotto["id"]);
    }
    $templateParams["prodottiNelCarrello"] = $dbh->getProductsFromID($ids);
    $totalPrice = 0;
    foreach($templateParams["prodottiNelCarrello"] as $prodotto) {
        foreach($_SESSION["carrello"] as $prodotto2) {
            if($prodotto["IDprodotto"] == $prodotto2["id"]) {
                $totalPrice += $prodotto["prezzoUnitario"] * $prodotto2["quantità"];
            }
        }
    }
    $templateParams["prezzoTotale"] = $totalPrice;
    $templateParams["titolo_pagina"] = "Carrello";
}

require 'template/temp-carrello.php';
?>