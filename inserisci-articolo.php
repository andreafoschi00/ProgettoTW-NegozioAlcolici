<?php 

require_once "bootstrap.php";


$templateParams["categorie"] = $dbh->getCategories();
require "template/temp-inserimento.php";

?>