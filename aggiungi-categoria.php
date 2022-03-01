<?php

require_once "bootstrap.php";

if(isset($_GET["insCategoria"]) && ctype_alpha($_GET["insCategoria"])){
    $categories = $dbh->getCategories();
    $present = false;
    
    $_GET["insCategoria"] = ucfirst($_GET["insCategoria"]);

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
        $templateParams["checkInsCategoria"] = "La categoria è già presente.";

        $id = $dbh->getIdSeller($_SESSION["email"]);
    
        $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
        $templateParams["nome"] = "temp-amministrazione.php";
        $templateParams["articoli"] = $dbh->getSellerProducts($id[0]["ID"]);

        require "template/temp-amministrazione.php";
    }
} else {
    
    if(!ctype_alpha($_GET["insCategoria"])){
        $templateParams["checkInsCategoria"] = "Non sono accettati caratteri numerici o speciali.";
    }
    $id = $dbh->getIdSeller($_SESSION["email"]);
    
    $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
    $templateParams["nome"] = "temp-amministrazione.php";
    $templateParams["articoli"] = $dbh->getSellerProducts($id[0]["ID"]);

    require "template/temp-amministrazione.php";
}


?>