<?php
    require_once 'bootstrap.php';

    $templateParams["titolo"] = "Catalogo - Negozio Alcolici";
    $templateParams["nome"] = "sfoglia-catalogo.php";
    $templateParams["prodottiRecenti"] = $dbh->getLatestProducts();
    $templateParams["prodottiCasuali"] = $dbh->getRandomProducts(2);
    $templateParams["categorie"] = $dbh->getCategories();

    require 'template/sfoglia-catalogo.php';
?>