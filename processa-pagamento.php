<?php
    require_once 'bootstrap.php';

    if(isset($_POST["indirizzo"]) && isset($_POST["pagamento"])) {
        if($_POST["pagamento"] == "Carta di credito" && !isCreditCardSelected()) {
            if(intval($_POST["numero"]) || intval($_POST["cvv"])) {
                $templateParams["errorelogin"] = "Errore! Controlla di aver inserito correttamente la carta di credito!";
                require 'pagamento.php';
            }
        } else if(isset($_POST["indirizzo"]) && isset($_POST["pagamento"])) {
            $prodottiEsauriti = array();
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
                $quantità = $dbh->getActualQuantityFromID($prodotto["id"]);
                if($quantità == 0) {
                    array_push($prodottiEsauriti, $dbh->getProductByID($prodotto["id"]));
                }
            }
            $message = "Il tuo ordine con ID ".$id." è in transito presso: ".$_POST["indirizzo"].". Se hai deciso di pagare in contanti, ricordati che l'importo da pagare alla consegna è di ".number_format(floatval($_SESSION["costoCarrello"]), 2)."€.";
            $dbh->sendNotificationToClient($message, $clientID);
            if(count($prodottiEsauriti) != 0) {
                foreach($prodottiEsauriti[0] as $prodotto) {
                    $message = "Il prodotto: ".$prodotto["nomeProdotto"]." con ID ".$prodotto["IDprodotto"]." è sold-out.";
                    $dbh->sendNotificationToSeller($message, $prodotto["IDvenditore"]);
                }
            }
            $_SESSION["carrello"] = array();
            $templateParams["messaggio"] = "Il tuo ordine è avvenuto con successo! Controlla la sezione profilo per ricevere aggiornamenti sull'ordine.";
            $templateParams["numNotifiche"] = $dbh->getNumberOfUnderadNotification($_SESSION["email"], $_SESSION["rank"]);
            require("index.php");
        }
    }
?>