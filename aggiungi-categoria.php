<?php

require_once "bootstrap.php";

if(isset($_GET["insCategoria"]) && ctype_alpha($_GET["insCategoria"])){
    $categories = $dbh->getCategories();
    $present = false;
    
    foreach($categories as $category){
        if($category["nome"] == $_GET["insCategoria"]){
            $present = true;
            break;
        }
    }

    if(!$present){
        $dbh->insertCategory($_GET["insCategoria"]);
        $templateParams["checkInsCategoria"] = "La categoria è stata inserita!";

        $id = $dbh->getIdSeller($_SESSION["email"]);
    
        $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
        $templateParams["nome"] = "temp-amministrazione.php";
        $templateParams["articoli"] = $dbh->getSellerProducts($id[0]["ID"]);

        require "template/temp-amministrazione.php";
    } else {
        $templateParams["checkInsCategoria"] = "La categoria è già presente oppure hai inserito caratteri numerici.";

        $id = $dbh->getIdSeller($_SESSION["email"]);
    
        $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
        $templateParams["nome"] = "temp-amministrazione.php";
        $templateParams["articoli"] = $dbh->getSellerProducts($id[0]["ID"]);

        require "template/temp-amministrazione.php";
    }
} else {
    
    $id = $dbh->getIdSeller($_SESSION["email"]);
    
    $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
    $templateParams["nome"] = "temp-amministrazione.php";
    $templateParams["articoli"] = $dbh->getSellerProducts($id[0]["ID"]);

    require "template/temp-amministrazione.php";
}


?>