<?php

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}

function registerLoggedUser($user){
    if($_SESSION["rank"] == "venditore") {
        unset($_SESSION["carrello"]);
    }
    $_SESSION["email"] = $user["email"];
}

function isPresent($id) {
    $presente = false;
    foreach($_SESSION["carrello"] as $prodotto) {
        if($prodotto["id"] == $id) {
            $presente = true;
            break;
        }
    }
    return $presente==true ? "true" : "false";
}

function buttonText() {
    if($_SESSION["rank"] == "venditore") {
        return "Amministrazione";
    }
    else return "Carrello";
}

function buttonLink() {
    if($_SESSION["rank"] == "venditore") {
        return "amministrazione.php";
    }
    else return "carrello.php";
}

function buttonLoginText() {
    return isUserLoggedIn() ? "Profilo" : "Login";
}

function buttonLoginLink() {
    return isUserLoggedIn() ? "profilo.php" : "login.php";
}

function isCreditCardSelected() {
    return isset($_POST["numero"]) && isset($_POST["scadenza"]) && isset($_POST["cvv"]);
}
?>