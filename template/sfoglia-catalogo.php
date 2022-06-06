<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"];?></title>
    <link rel="icon" type="image/x-icon" href=<?php echo UPLOAD_DIR."favicon.ico"?>>
    <meta charset="utf-8"/>
    <meta name="viewport"content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
                    <h2 class="text-center">Catalogo</h2>
            </div>
            <div class="col-md-8"></div>   
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-12 col-md-10">
                <form action="catalogo-filtrato.php" method="GET">
                    <fieldset class="bg-danger bg-opacity-25 border my-4">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="container col-5 col-md-5">
                                <label class="form-label my-2">Categorie:</label>
                                <div class="row"></div>
                                <?php foreach($templateParams["categorie"] as $categoria):?>
                                    <input class="form-check-input" type="checkbox" id="cat-<?php echo $categoria["nome"];?>" name="<?php echo $categoria["nome"];?>" value="yes"/>
                                    <label class="form-check-label" for="cat-<?php echo $categoria["nome"];?>"><?php echo $categoria["nome"];?></label>
                                    <div class="row"></div>
                                <?php endforeach;?>
                            </div>
                            <div class="container col-5 col-md-5 form-group">
                                <label class="my-2">Ordina per:</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio1" name="filtro" value="piurecenti" checked>
                                    <label class="form-check-label" for="radio1">Prodotti più recenti</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio2" name="filtro" value="menorecenti">
                                    <label class="form-check-label" for="radio2">Prodotti meno recenti</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio3" name="filtro" value="alfabetico">
                                    <label class="form-check-label" for="radio3">Venditore (ordine alfabetico)</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio4" name="filtro" value="moltidisponibili">
                                    <label class="form-check-label" for="radio4">Grossa disponibilità</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio5" name="filtro" value="pochidisponibili">
                                    <label class="form-check-label" for="radio5">In esarimento</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input my-2" type="checkbox" id="switchEsauriti" name="esauriti" value="yes">
                                    <label class="form-check-label my-1" for="switchEsauriti">Non mostrare i prodotti esauriti</label>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-md-5"></div>
                            <button type="submit" class="btn btn-primary col-4 col-md-2 my-3">Filtra</button>
                            <div class="col-4 col-md-5"></div>
                        </div>
                    </fieldset>
                </form>
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