<?php
    require_once 'bootstrap.php';

    $templateParams["titolo"] = "Profilo - Negozio Alcolici";
    $templateParams["nome"] = "temp-profilo.php";

    $id = $dbh->getIDfromMail($_SESSION["email"], $_SESSION["rank"]);
    $templateParams["dati_anagrafici"] = $dbh->getPersonalInformationFromID($id, $_SESSION["rank"]);

    if($_SESSION["rank"] == "cliente") {
        $templateParams["titolo_ordini"] = "I miei ordini";   
        $templateParams["ordini"] = $dbh->getOrdersFromID($id);

    } else {
        $templateParams["titolo_ordini"] = "Ordini effettuati oggi";
        $templateParams["ordini"] = $dbh->getLast24hoursOrders();
    }

    if(count($templateParams["ordini"]) == 0) {
        $templateParams["emptyOrdini"] = "Non ci sono ordini";
    }

    $templateParams["notifiche"] = $dbh->getNotificationsFromID($id, $_SESSION["rank"]);
    require 'template/temp-profilo.php';
?>