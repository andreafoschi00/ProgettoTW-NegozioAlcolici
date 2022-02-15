<?php
    require_once 'bootstrap.php';
    if(isset($_GET["id"])) {
        $dbh->markNotificationAsReadWithID($_GET["id"]);
    }
    require 'profilo.php';
?>