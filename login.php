<?php
    require_once 'bootstrap.php';

    if(isset($_POST["username"]) && isset($_POST["password"])){
        $login_result = $dbh->checkVenditore($_POST["username"], $_POST["password"]);
        if(count($login_result) == 0){
            $login_result = $dbh->checkCliente($_POST["username"], $_POST["password"]);
            if(count($login_result) == 0){
                $templateParams["errorelogin"] = "Errore! Username errato";
            }
            else{
                if(password_verify($_POST["password"], $login_result[0]["password"])){
                    registerLoggedUser($login_result[0]);
                    $_SESSION["rank"] = "cliente";
                } else {
                    $templateParams["errorelogin"] = "Errore! Password errata";
                }        
            }
        }
        else {
            if(password_verify($_POST["password"], $login_result[0]["password"])){
                registerLoggedUser($login_result[0]);
                $_SESSION["rank"] = "venditore";
            } else {
                $templateParams["errorelogin"] = "Errore! Password errata";
            }
        }
    }


    if(isUserLoggedIn()){
        require 'index.php';
    } else {
        $templateParams["titolo"] = "Login - Negozio Alcolici";
        $templateParams["nome"] = "login-form.php";

        require 'template/login-form.php';
    }
?>