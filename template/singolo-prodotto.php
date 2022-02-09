<!DOCTYPE html>
<html lang="it">
<head>
    <title>Home - Negozio Alcolici</title>
    <link rel="icon" type="image/x-icon" href=<?php echo UPLOAD_DIR."favicon.ico"?>>
    <meta charset="utf-8"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" >
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
                    <h2 class="text-center">Prodotti recenti</h2>
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
                                <img id="img-prodotto" class="img-fluid" src="<?php echo UPLOAD_DIR.$prodotto["nomeImmagine"];?>" alt="<?php echo $prodotto["nomeProdotto"];?>"/>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="row">
                                    <p id="quantita">Quantità disponibile: <?php echo $prodotto["quantitàDisponibile"];?></p>
                                </div>
                                <div class="row">
                                    <p class="text-black">Prezzo: <?php echo $prodotto["prezzoUnitario"];?>€</p>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <p><label for="quantity">Quantità desiderata:</label></p>
                                    </div>
                                    <div class="col-2 col-md-2">
                                        <input type="number" id="quantity" name="quantity" min="0" max="<?php echo $prodotto["quantitàDisponibile"];?>">
                                    </div>
                                    <div class="col-3 col-md-3"></div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4">
                                        <input class="btn btn-light" type="submit" value="Aggiungi al carrello">
                                    </div>
                                    <div class="col-8 col-md-8"></div>
                                </div>
                            </div>
                        </div>
                        <h3 class="px-5"><?php echo $prodotto["nomeProdotto"];?></h3>
                        <p class="px-5"><?php echo $prodotto["dataInserimento"];?> - <?php echo $prodotto["cognomeVenditore"];?> <?php echo $prodotto["nomeVenditore"];?></p>
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
                            <img src="<?php echo UPLOAD_DIR.$prodottoCasuale["nomeImmagine"];?>" alt="<?php echo $prodottoCasuale["nome"];?>"/>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>