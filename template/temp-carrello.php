<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"];?></title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <meta charset="UTF-8"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" >
</head>
<body class="bg-primary bg-opacity-10">
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row">
            <div class="col-12">
                <header class="py-1 text-dark bg-info bg-opacity-25">
                    <h1 class="text-center">Negozio Alcolici</h1>
                </header>   
            </div>   
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-12 col-md-10">
                <ul class="nav nav-pills">
                    <li class="nav-item col-6 col-md-3">
                        <a class="nav-link mt-2 mx-2 text-center text-white bg-dark" href="index.php">Home</a>
                    </li>
                    <li class="nav-item col-6 col-md-3">
                        <a class="nav-link mt-2 mx-2 text-center text-white bg-dark" href="catalogo.php">Catalogo</a>
                    </li>
                    <li class="nav-item col-6 col-md-3">
                        <a class="nav-link mt-2 mx-2 text-center text-white bg-dark" href="carrello.php">Carrello</a>
                    </li>
                    <li class="nav-item col-6 col-md-3">
                        <a class="nav-link mt-2 mx-2 text-center text-white bg-dark" href="login.php">Login</a>
                    </li>
                </ul> 
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>   
            <div class="col-12 col-md-3 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10">
                    <h2 class="text-center"><?php echo $templateParams["titolo_pagina"];?></h2>
            </div>
            <div class="col-md-8"></div> 
        </div>  
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-12 col-md-6">
                    <ul>
                    <?php foreach($templateParams["prodottiNelCarrello"] as $prodotto):?>
                        <li class="bg-info bg-opacity-10 border mt-4 mb-4 pt-3 pb-1">
                            <div class="row col-12">
                                <div class="col-3 col-md-2 ms-2 py-2">
                                    <img src="<?php echo UPLOAD_DIR.$prodotto["nomeImmagine"];?>" alt="<?php echo $prodotto["nomeProdotto"];?>" >
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-9 col-md-7">
                                    <label><?php echo $prodotto["nomeProdotto"];?></label>
                                </br>
                                    <label>Quantità: <?php foreach($_SESSION["carrello"] as $prodotto2) {
                                                                if($prodotto["IDprodotto"] == $prodotto2["id"]) {
                                                                    echo $prodotto2["quantità"];
                                                                }
                                                            }?></label>
                                    <label>|</label>
                                    <input type="button" value="Rimuovi" class="btn btn-light">
                                </br>
                                    <p id="prezzo">Prezzo: <?php foreach($_SESSION["carrello"] as $prodotto2) {
                                        if($prodotto["IDprodotto"] == $prodotto2["id"]) {
                                            echo $prodotto["prezzoUnitario"]*$prodotto2["quantità"];
                                        }
                                    }?>€</p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <label id="totalPrice" class="bg-info bg-opacity-10 border mt-4 mb-4">Prezzo totale: <?php echo $templateParams["prezzoTotale"]; ?>€</label>
                        </div>
                        <div class="col-6 col-md-5 py-3">
                            <a id="ordina" href="pagamento.php" class="mx-5 btn btn-light">Procedi all'ordine</a>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                    <footer class="mt-4 py-1 text-dark bg-info bg-opacity-25">
                        <p class="text-center">Tecnologie Web - A.A. 2021/2022</p>
                    </footer>   
            </div>   
        </div>
    </div>    
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="./js/carrello.js" type="text/javascript"></script>
</html>