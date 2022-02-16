<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"];?></title>
    <link rel="icon" type="image/x-icon" href=<?php echo UPLOAD_DIR."favicon.ico"?>>
    <meta charset="utf-8"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" >
    <script src="./js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="./js/catalogo.js" type="text/javascript"></script>
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
            <div class="col-12 col-md-10">
                <?php foreach($templateParams["prodottiCategoria"] as $prodotto):?>
                    <div class="articles">
                        <article id="show-<?php if($templateParams["mostraEsauriti"] && $prodotto["quantitàDisponibile"]==0) echo "no"; else echo "yes";?>" class="bg-info bg-opacity-10 border mt-4 mb-4">
                            <header>
                                <img class="img-thumbnail" src="<?php echo UPLOAD_DIR.$prodotto["nomeImmagine"];?>" alt="Immagine prodotto"/>
                                <h3 class="px-5"><?php echo $prodotto["nomeProdotto"]; ?></h3>
                                <p class="px-5"><?php echo $prodotto["dataInserimento"]; ?> - <?php echo $prodotto["cognomeVenditore"];?> <?php echo $prodotto["nomeVenditore"]; ?></p>
                            </header>
                            <section class="px-5">
                                <p><?php echo $prodotto["testoMedio"];?></p>
                            </section>
                            <footer class="pb-4 px-5">
                                <a class="btn btn-light" href="prodotto.php?id=<?php echo $prodotto["IDprodotto"];?>">Mostra tutto</a>
                            </footer>
                        </article>
                    </div>
                <?php endforeach;?>
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