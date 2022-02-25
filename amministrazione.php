<?php

require_once "bootstrap.php";

if(!isUserLoggedIn()){
    header("location: login.php");
}

if($_SESSION["rank"] != "venditore"){
    header("location: profilo.php");
}

    $templateParams["titolo"] = "Amministrazione - Negozio Alcolici";
    $templateParams["nome"] = "temp-amministrazione.php";
    
    $templateParams["articoli"] = $dbh->getLatestProducts();
                            
    require "template/temp-amministrazione.php";

?>