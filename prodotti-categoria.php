<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Categoria - Negozio Alcolici";
$templateParams["nome"] = "filtro-categorie.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["prodottiCasuali"] = $dbh->getRandomProducts(2);
$idcategoria = -1;
if(isset($_GET["id"])){
    $idcategoria = $_GET["id"];
}
$nomecategoria = $dbh->getCategoryById($idcategoria);
if(count($nomecategoria)>0){
    $templateParams["titolo_pagina"] = "Categoria: ".$nomecategoria[0]["nome"];
    $templateParams["prodottiCategoria"] = $dbh->getProductsByCategory($idcategoria);
}
else{
    $templateParams["titolo_pagina"] = "Categoria non trovata"; 
    $templateParams["prodottiCategoria"] = array();   
}

require 'template/filtro-categoria.php';
?>