<?php

require_once "bootstrap.php";

if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["dataNascita"])){
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

}

if(isset($templateParams["checkNome"]) || isset($templateParams["checkCognome"]) || isset($templateParams["checkData"])){
    $templateParams["errore"] = "Dati inseriti errati!";
} else {
    $dbh->updatePersonalInfo($_POST["nome"], $_POST["cognome"], $_POST["dataNascita"], $_SESSION["email"], $_SESSION["rank"]);
}
    require 'profilo.php';
?>