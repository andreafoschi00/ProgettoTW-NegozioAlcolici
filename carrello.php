<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Carrello - Negozio Alcolici";
$templateParams["nome"] = "temp-carrello.php";

$newProdotto = array();

$currentPage = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION['currentPage']) || $_SESSION['currentPage'] != $currentPage){
    $_SESSION['currentPage'] = $currentPage;
    if(isset($_GET["id"]) && isset($_GET["quantità"])) {
        $id = $_GET["id"];
        $quantità = $_GET["quantità"];
        $newProdotto = array("id"=>$id, "quantità"=> $quantità);
    } else if(isset($_GET["action"]) && isset($_GET["id"])) {
        if($_GET["action"] == "rimuovi") {
            $id = $_GET["id"];
            $quantità = "";
            foreach($_SESSION["carrello"] as $prodotto) {
                if($prodotto["id"] == $_GET["id"]) {
                    $quantità = $prodotto["quantità"];
                }
            }
            if (($key = array_search(array("id"=>$id, "quantità"=>$quantità), $_SESSION["carrello"])) !== false) {
                unset($_SESSION["carrello"][$key]);
            }
        }
    } 
}

if(count($newProdotto) != 0) {
    $found = false;
    foreach($_SESSION["carrello"] as $prodotto) {
        if($prodotto["id"] == $newProdotto["id"]) {
            $found = true;
            break;
        }
    }
    if($found == false) {
        array_push($_SESSION["carrello"], $newProdotto);
    }
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
    $_SESSION["costoCarrello"] = $totalPrice;
    $templateParams["prezzoTotale"] = $totalPrice;
    $templateParams["titolo_pagina"] = "Carrello";
}

if($_SESSION["rank"] == "venditore") {
    $templateParams["titolo_pagina"] = "Non puoi avere accesso a questa pagina!";
}

require 'template/temp-carrello.php';
?>