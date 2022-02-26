<?php

require_once "bootstrap.php";

if(!isUserLoggedIn()){
    header("location: login.php");
} else if($_SESSION["rank"] != "venditore"){
    header("location: index.php");
}

    $id = $dbh->getIdSeller($_SESSION["email"]);
    
    $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
    $templateParams["nome"] = "temp-amministrazione.php";
    $templateParams["articoli"] = $dbh->getSellerProducts($id[0]["ID"]);

    require "template/temp-amministrazione.php";

?>