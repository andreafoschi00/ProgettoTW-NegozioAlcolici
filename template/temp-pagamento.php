<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"];?></title>
    <link rel="icon" type="image/x-icon" href=<?php echo UPLOAD_DIR."favicon.ico"?>>
    <meta charset="utf-8"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="./js/pagamento.js" type="text/javascript"></script>
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
                    <a class="nav-link mt-2 mx-2 text-center text-white bg-dark" href="<?php echo buttonLink();?>"><?php echo buttonText();?></a>
                </li>
                <li class="nav-item col-6 col-md-3">
                    <a class="nav-link mt-2 mx-2 text-center text-white bg-dark" href="<?php echo buttonLoginLink();?>"><?php echo buttonLoginText();?></a>
                </li>
            </ul> 
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>   
        <div class="col-5 col-md-3 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10">
            <h2 class="text-center"><?php echo $templateParams["titolo_pagina"];?></h2>
        </div>
        <div class="col-1 col-md-4"></div>
        <div class="col-5 col-md-3 mt-3">
            <a id="annulla" class="btn btn-danger text-center" href="carrello.php">Torna al carrello</a>
        </div>
        <div class="col-md-1"></div>   
    </div>
    <div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-11">
            <?php if(isset($templateParams["errorelogin"])): ?>
                <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <form class="my-3" action="processa-pagamento.php" method="POST">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4 my-2" id="indirizzo">
            <p class="h3">Scegliere l'indirizzo di spedizione:</p>
                <?php foreach($templateParams["indirizzi"] as $indirizzo): ?>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="indirizzo" id="indirizzo" value="<?php echo $indirizzo;?>" required/>
                    <label class="form-check-label" for="indirizzo"><?php echo $indirizzo;?></label>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-3 my-2" id="metodo">
                <p class="h3">Scegliere come pagare:</p>
                <?php foreach($templateParams["metodi_pagamento"] as $pagamento): ?>
                    <div class="form-check" id="met">
                        <input type="radio" class="form-check-input" name="pagamento" id="pagamento" value="<?php echo $pagamento;?>" required/>
                        <label class="form-check-label" for="pagamento"><?php echo $pagamento;?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4 my-2" id="carta">
                <div class="form-group my-1">
                    <label class="form-label" for="num-carta">Numero di carta:</label>
                    <input class="form-control" type="tel" id="num-carta" name="numero" placeholder="1234123412341234" pattern="[0-9]{16}">
                </div>
                <div class="form-group my-1">
                    <label class="form-label" for="data-carta">Data di scadenza:</label>
                    <input class="form-control" type="date" id="data-carta" name="scadenza">
                </div>
                <div class="form-group my-1">
                    <label class="form-label" for="cvv-carta">CVV:</label>
                    <input class="form-control" type="tel" id="cvv-carta" name="cvv" placeholder="123" pattern="[0-9]{3}">
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row my-5">
            <div class="col-md-1"></div>
            <div class="col-md-10 col-sm-12 table-responsive" id="prodotti">
                <table class="table table-bordered table-striped border-dark">
                    <thead>
                        <tr>
                            <th>Immagine</th>
                            <th>Prodotto</th>
                            <th>Quantità</th>
                            <th>Prezzo</th>
                        </tr>    
                    </thead>
                    <tbody>
                        <?php foreach($templateParams["prodottiNelCarrello"] as $prodotto):?>
                            <tr>
                                <td class="text-center"><img src="<?php echo UPLOAD_DIR.$prodotto["nomeImmagine"];?>" alt="Immagine prodotto" id="thumb-prodotto"/></td>
                                <td><?php echo $prodotto["nomeProdotto"];?></td>
                                <td><?php foreach($_SESSION["carrello"] as $prodotto2) {
                                            if($prodotto["IDprodotto"] == $prodotto2["id"]) {
                                                echo $prodotto2["quantità"];
                                                }
                                            }?></td>
                                <td id="prezzoProdotto"><?php foreach($_SESSION["carrello"] as $prodotto2) {
                                        if($prodotto["IDprodotto"] == $prodotto2["id"]) {
                                            echo $prodotto["prezzoUnitario"]*$prodotto2["quantità"];
                                        }
                                    }?>€</td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="row" id="finalRow">
                <div class="col-md-1"></div>
                <div class="col-6 col-md-5 my-2">
                    <label class="h3" id="prezzoTotale" class="my-4">Prezzo totale: <?php echo $templateParams["prezzoTotale"]; ?>€</label>
                </div>
                <div class="col-6 col-md-5 py-3">
                    <button type="submit" id="paga" href="processa-pagamento.php" class="btn-lg btn-success">Procedi all'ordine</button>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </form>
        <div class="row">
            <div class="col-12">
                    <footer class="mt-4 py-1 text-dark bg-info bg-opacity-25">
                        <p class="text-center">Tecnologie Web - A.A. 2021/2022</p>
                    </footer>   
            </div>   
        </div>
</div>
</body>
</html>