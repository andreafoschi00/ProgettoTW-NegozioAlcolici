<?php
    require_once 'bootstrap.php';

    if(isset($_POST["indirizzo"]) && isset($_POST["pagamento"])) {
        if($_POST["pagamento"] == "Carta di credito" && !isCreditCardSelected()) {
            if(intval($_POST["numero"]) || intval($_POST["cvv"])) {
                $templateParams["errorelogin"] = "Errore! Controlla di aver inserito correttamente la carta di credito!";
                require 'pagamento.php';
            }
        } else if(isset($_POST["indirizzo"]) && isset($_POST["pagamento"])) {
            $clientID = $dbh->getIDfromMail($_SESSION["email"], $_SESSION["rank"]);
            if($_POST["pagamento"] == "Contanti alla consegna") {
                $dbh->addOrderWithNoCreditCard($_POST["indirizzo"], $_POST["pagamento"], $_SESSION["costoCarrello"], $clientID);
            } else {
                $dbh->addOrderWithCreditCard($_POST["indirizzo"], $_POST["pagamento"], $_SESSION["costoCarrello"], intval($_POST["numero"]), $_POST["scadenza"], intval($_POST["cvv"]), $clientID);
            }
            $id = $dbh->getLastOrderID();
            foreach($_SESSION["carrello"] as $prodotto) {
                $dbh->addProductToOrder($id, $prodotto["id"], $prodotto["quantità"]);
                $quantità = $dbh->getActualQuantityFromID($prodotto["id"]);
                $dbh->updateProductAvailableQuantity($prodotto["id"], $quantità, $prodotto["quantità"]);
            }
            $_SESSION["carrello"] = array();
            $templateParams["statoOrdine"] = "Il tuo ordine è avvenuto con successo! Controlla la sezione profilo per ricevere aggiornamenti sull'ordine.";
            require("index.php");
        }
    }
?>