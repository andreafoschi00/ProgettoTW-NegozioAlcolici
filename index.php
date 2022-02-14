<?php
    require_once 'bootstrap.php';

    $templateParams["titolo"] = "Home - Negozio Alcolici";
    $templateParams["nome"] = "home.php";
    $templateParams["prodottiRecenti"] = $dbh->getLatestProducts();
    $templateParams["prodottiCasuali"] = $dbh->getRandomProducts(2);
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titolo_pagina"] = "Prodotti recenti";

    require 'template/home.php';
?>