<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Catalogo - Negozio Alcolici";
$templateParams["nome"] = "filtro-catalogo.php";
$templateParams["categorie"] = $dbh->getCategories();

$categorie = array();
foreach($templateParams["categorie"] as $categoria) {
    if(isset($_GET[$categoria["nome"]])) {
        array_push($categorie, $categoria["nome"]);
    }
}
$filtro = $_GET["filtro"];
$esauriti = false;
if(isset($_GET["esauriti"])) {
    $esauriti = true;
}

$idcategoria = -1;
if(isset($_GET["id"])){
    $idcategoria = $_GET["id"];
}
if(count($categorie) == 0) {
    $templateParams["titolo_pagina"] = "Nessuna categoria selezionata";
    $templateParams["prodottiCategoria"] = array();
    $templateParams["mostraEsauriti"] = $esauriti;
} else {
    while(count($categorie) < 7) {
        array_push($categorie, "");
    }
    $templateParams["titolo_pagina"] = "Prodotti selezionati:";
    $templateParams["prodottiCategoria"] = $dbh->getProductsWithFilters($categorie, $filtro);
    $templateParams["mostraEsauriti"] = $esauriti;
}

require 'template/filtro-catalogo.php';
?>