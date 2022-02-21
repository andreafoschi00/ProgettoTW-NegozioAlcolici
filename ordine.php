<?php 

require_once "bootstrap.php";

$templateParams["titolo"] = "Ordine - Negozio Alcolici";
$templateParams["nome"] = "temp-ordine.php";
$templateParams["titolo-pagina"] = "Ordine selezionato";

if(isset($_GET["id"])){
    $templateParams["prodotti"] = $dbh->getProductsFromoRDER($_GET["id"]);
    require "template/temp-ordine.php";
}



?>