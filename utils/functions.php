<?php

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}

function registerLoggedUser($user){
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
?>