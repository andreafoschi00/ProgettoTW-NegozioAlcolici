<?php
    require_once 'bootstrap.php';

    if(isset($_POST["username"]) && isset($_POST["password"])){
        $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
        if(count($login_result) == 0){
            //Login fallito
            $templateParams["errorelogin"] = "Errore! Username o password errati!";
        }
        else {
            registerLoggedUser($login_result[0]);
        }
    }

    if(isUserLoggedIn()){
        $templateParams["titolo"] = "Home - Negozio Alcolici";
        $templateParams["nome"] = "home.php";
        $templateParams["prodottiRecenti"] = $dbh->getLatestProducts();
        $templateParams["prodottiCasuali"] = $dbh->getRandomProducts(2);
        $templateParams["categorie"] = $dbh->getCategories();

        require 'template/home.php';

    } else {
        $templateParams["titolo"] = "Login - Negozio Alcolici";
        $templateParams["nome"] = "login-form.php";

        require 'template/login-form.php';
    }

    
?>