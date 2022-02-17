<?php
    require_once 'bootstrap.php';

    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["dataNascita"]) && isset($_POST["e-mail"]) && isset($_POST["password"])) {
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
        
    }
    
        $templateParams["titolo"] = "Registrazione - Negozio Alcolici";
        $templateParams["nome"] = "registrazione-form.php";
        $templateParams["titolo-pagina"] = "Registrati";

    require 'template/registrazione-form.php';
?>