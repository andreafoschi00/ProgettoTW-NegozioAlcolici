<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"];?></title>
    <link rel="icon" type="image/x-icon" href=<?php echo UPLOAD_DIR."favicon.ico"?>>
    <meta charset="utf-8"/>
    <meta name="viewport"content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="./js/prodotto.js" type="text/javascript"></script>
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
            <div class="col-12 col-md-3 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10">
                    <h2 class="text-center"><?php echo $templateParams["titolo_pagina"]?></h2>
            </div>
            <div class="col-md-8"></div>   
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <?php foreach($templateParams["prodotto"] as $prodotto):?>
                <div class="col-12 col-md-6">
                    <article class="bg-info bg-opacity-10 border mt-4 mb-4">
                        <header>
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <img id="img-prodotto" class="img-fluid" src="<?php echo UPLOAD_DIR.$prodotto["nomeImmagine"];?>" alt="Immagine prodotto"/>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="row">
                                        <p id="quantita">Quantit?? disponibile: <?php echo $prodotto["quantit??Disponibile"];?></p>
                                    </div>
                                    <div class="row">
                                        <p id="prezzo" class="text-black">Prezzo: <?php echo $prodotto["prezzoUnitario"];?>???</p>
                                    </div>
                                    <div class="row">
                                        <form action="carrello.php" method="GET">
                                            <label for="quantit??">Quantit?? desiderata:</label>
                                            <input class="my-1 mx-3" type="number" id="quantit??" name="quantit??" min="1" max="<?php echo $prodotto["quantit??Disponibile"];?>" required>
                                            <input class="my-1" type="text" id="id-buffer" name="id" hidden/>
                                            <output id="presente" hidden><?php echo isPresent($prodotto["IDprodotto"]);?></output>
                                            <input id="aggiunta" type="submit" class="btn btn-light my-1 <?php if($prodotto["quantit??Disponibile"] == 0 || $_SESSION["rank"]=="venditore") echo "disabled";?>" value="Aggiungi al carrello"/>
                                        </form>
                                        </div>
                                        <div class="toast">
                                            <div class="toast-header bg-dark">
                                                <p id="toastTitle" class="me-auto text-light">Attenzione!</p>
                                                <button type="button" class="btn-close bg-light" data-bs-dismiss="toast"></button>
                                            </div>
                                            <div class="toast-body bg-light">
                                                <p class="text-dark">Questo prodotto ?? gi?? inserito nel carrello.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <h3 id="titleid" class="px-5"><?php echo $prodotto["nomeProdotto"];?> - ID prodotto: <?php echo $prodotto["IDprodotto"];?></h3>
                                <p class="px-5"><?php echo $prodotto["dataInserimento"];?> - <?php echo $prodotto["cognomeVenditore"];?> <?php echo $prodotto["nomeVenditore"];?></p>
                            </div>
                        </header>
                        <section class="px-5">
                            <p><?php echo $prodotto["testoLungo"];?></p>
                        </section>
                    </article>
                </div>
            <?php endforeach;?>
            <div class="col-12 col-md-4">
            <aside class="bg-info bg-opacity-10 border mt-4 px-5 py-3">
                <section>
                    <div class="row">
                        <div class="col-7 col-md-7 mx-3 my-3 py-1 text-dark">
                                <h2>Dai un'occhiata a...</h2>
                        </div>
                        <div class="col-5 col-md-5"></div>   
                    </div>
                    <ul class="nav flex-column">
                    <?php foreach($templateParams["prodottiCasuali"] as $prodottoCasuale):?>
                        <li class="nav-item border bg-light my-3">
                            <img src="<?php echo UPLOAD_DIR.$prodottoCasuale["nomeImmagine"];?>" alt="Immagine prodotto"/>
                            <h3 class="mx-1"><?php echo $prodottoCasuale["nome"];?></h3>
                            <p class="mx-1"><?php echo $prodottoCasuale["testoBreve"];?></p>
                            <a class="btn btn-link mt-2 mx-2 my-1 text-center text-white bg-primary" href="prodotto.php?id=<?php echo $prodottoCasuale["ID"];?>">Mostra</a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </section>
                <section>
                    <h2>Categorie</h2>
                    <ul class="nav flex-column">
                        <?php foreach($templateParams["categorie"] as $categoria):?>
                            <li class="nav-item"><a href="prodotti-categoria.php?id=<?php echo $categoria["ID"];?>"><?php echo $categoria["nome"];?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            </aside>
            </div>
            <div class="col-md-1"></div>
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
</html>