<?php
    require_once 'bootstrap.php';

    /*echo password_verify("Takoz2356", "$2y$10$pJUGZzAujgei.0Dgu0VZ.e8XenPUH7gixYBzqF92RKJUYdilC40Iq");
    echo $_POST["password"];
    echo "        "   . password_hash($_POST["password"], PASSWORD_DEFAULT);
    echo  "        " . password_hash($_POST["password"], PASSWORD_DEFAULT);*/
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $login_result = $dbh->checkVenditore($_POST["username"], $_POST["password"]);
        
        if(count($login_result) == 0){
            //Login fallito
            $templateParams["errorelogin"] = "Errore! Username errato";
        }
        else {
            if(password_verify($_POST["password"], $login_result[0]["password"])){
                registerLoggedUser($login_result[0]);
            } else {
                $templateParams["errorelogin"] = "Errore! Password errata";
            }
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