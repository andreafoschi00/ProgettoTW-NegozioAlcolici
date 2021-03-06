<?php 

require_once "bootstrap.php";

if($_GET["titoloarticolo"] != "" && $_GET["testoarticolo"] != "" && $_GET["imgarticolo"] != "" && $_GET["prezzoarticolo"] != ""
   && $_GET["quantitàarticolo"] != "" && $_GET["testomedio"] != "" && $_GET["testolungo"] != ""){
    
    $ext = pathinfo($_GET["imgarticolo"], PATHINFO_EXTENSION);
    if($ext != "png"){
        $templateParams["checkImgExt"] = "Devi allegare un'immagine con estensione .png";
    }

    if(!is_numeric($_GET["prezzoarticolo"])){
        $templateParams["checkPrezzo"] = "Devi inserire un valore numerico";
    }

    if(!is_numeric($_GET["quantitàarticolo"])){
        $templateParams["checkQuantità"] = "Devi inserire un valore numerico";
    }

    if(!isset($templateParams["checkImgExt"]) && !isset($templateParams["checkPrezzo"]) && !isset($templateParams["checkQuantità"])){
        
        $idCategory = $dbh->getIdByCategory($_GET["optradio"]);
        $idProduct = $dbh->getProductIdFromName($_SESSION["modificaProdotto"]["nomeProdotto"]);
        
        $dbh->updateProduct($idProduct, $_GET["titoloarticolo"], $_GET["imgarticolo"], $_GET["quantitàarticolo"], $_GET["disponibilitàarticolo"],
        $_GET["prezzoarticolo"], $_GET["testoarticolo"], $_GET["testomedio"], $_GET["testolungo"], date("Y-m-d"), $idCategory);
        unset($_SESSION["modificaProdotto"]);

        $id = $dbh->getIdSeller($_SESSION["email"]);

        $templateParams["checkInserimento"] = "Modifica eseguita con successo!";
        $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
        $templateParams["nome"] = "temp-amministrazione.php";
        $templateParams["articoli"] = $dbh->getSellerProducts($id[0]["ID"]);

        require "template/temp-amministrazione.php";
    } else {
        $templateParams["titolo"] = "Inserimento Articolo - Negozio Alcolici";
        $templateParams["nome"] = "temp-inserimento.php";
        $templateParams["categorie"] = $dbh->getCategories();
        require "template/temp-inserimento.php";
    }
} else {
    $templateParams["titolo"] = "Inserimento Articolo - Negozio Alcolici";
    $templateParams["nome"] = "temp-inserimento.php";
    $templateParams["categorie"] = $dbh->getCategories();
    require "template/temp-inserimento.php";
}

?>