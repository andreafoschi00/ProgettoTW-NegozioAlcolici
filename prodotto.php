<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Articolo - Negozio Alcolici";
$templateParams["nome"] = "singolo-prodotto.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["prodottiCasuali"] = $dbh->getRandomProducts(2);

$idProdotto = -1;
if(isset($_GET["id"])){
    $idProdotto
 = $_GET["id"];
}
$templateParams["prodotto"] = $dbh->getProductByID($idProdotto);

require 'template/singolo-prodotto.php';
?>