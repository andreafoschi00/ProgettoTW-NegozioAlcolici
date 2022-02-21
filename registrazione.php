<?php
    require_once 'bootstrap.php';


    $templateParams["titolo"] = "Registrazione - Negozio Alcolici";
    $templateParams["nome"] = "registrazione-form.php";
    $templateParams["titolo-pagina"] = "Registrati";

    if(isset($_GET["action"]) && $_GET["action"] == "modifica"){
        $templateParams["datiAnagrafici"] = $dbh->getPersonalInformationFromEmail($_SESSION["email"], $_SESSION["rank"]);
    } else if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["dataNascita"]) && isset($_POST["e-mail"]) && isset($_POST["password"])) {
        if(strlen($_POST["nome"]) > 1){
            for($i = 0; $i < 10 ;$i++){
                if(strpos($_POST["nome"], strval($i))){
                    $templateParams["checkNome"] = "invalid";
                    break;
                } 
            }
        } else {
            $templateParams["checkNome"] = "invalid";
        }

        if(strlen($_POST["cognome"]) > 1){
            for($i = 0; $i < 10 ;$i++){
                if(strpos($_POST["cognome"], strval($i))){
                    $templateParams["checkCognome"] = "invalid";
                    break;
                } 
            }
        } else {
            $templateParams["checkCognome"] = "invalid";
        }

        $today = date("Y-m-d");
        $diff = date_diff(date_create($_POST["dataNascita"]), date_create($today));
        $result = $diff->format('%y');
        if($result < 18){
            $templateParams["checkData"] = "invalid";
        }

        if(!filter_var($_POST["e-mail"], FILTER_VALIDATE_EMAIL)) {
            $templateParams["checkE-mail"] = "invalid";
        }

        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $_POST["password"]);
        $lowercase = preg_match('@[a-z]@', $_POST["password"]);
        $number    = preg_match('@[0-9]@', $_POST["password"]);
        $specialChars = preg_match('@[^\w]@', $_POST["password"]);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST["password"]) < 8) {
            $templateParams["checkPassword"] = "invalid";
        }
        
        if(!isset($templateParams["checkNome"]) && !isset($templateParams["checkCognome"]) && !isset($templateParams["checkData"]) 
        && !isset($templateParams["checkE-mail"]) && !isset($templateParams["checkPassword"])) {  
            $email_result = $dbh->getClientEmails();
            $find = checkIsUsed($email_result);
            if(!$find){
                $email_result = $dbh->getSellerEmails();
                $find = checkIsUsed($email_result);
            }

            if(!$find){
                $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT);
                $dbh->insertUser($_POST["nome"], $_POST["cognome"], $_POST["dataNascita"], $_POST["e-mail"], $_POST["password"]);
                $templateParams["checkRegistrazione"] = "La registrazione è avvenuta con successo! Ora puoi fare il login.";
            } else{
                $templateParams["checkPassword"] = "used";
            }
        }
    }
        if(isset($templateParams["checkRegistrazione"])){
            require "login.php";
        } else {
            require 'template/registrazione-form.php';
        }
    
?>