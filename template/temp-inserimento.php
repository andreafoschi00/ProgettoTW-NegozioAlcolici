<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"]; ?></title>
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
            <div class="col-12 col-md-3 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10 text-center">
                    <h2>Inserisci articolo</h2>
            </div>
            <div class="col-md-8"></div>   
        </div>
        <form action="inserisci-articolo.php" method="GET">
            <div class="row">
                <div class="col-md-1"></div>   
                <div class="col-12 col-md-5 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10">
                        <ul>
                            <li class="bottomSpacing">
                                <label class="fontBolder" for="titoloarticolo">Titolo:</label><input type="text" id="titoloarticolo" name="titoloarticolo"/>
                            </li>
                            <li class="bottomSpacing">
                                <label class="fontBolder" for="testoarticolo">Testo Breve:</label><input type="text" id="testoarticolo" name="testoarticolo"/>        
                            </li>
                            <li class="bottomSpacing">
                                <label class="fontBolder" for="imgarticolo">Immagine Articolo</label><input style="" type="file" name="imgarticolo" id="imgarticolo" />   
                                <img src="" alt=""/>
                            </li>
                            <?php if(isset($templateParams["checkImgExt"])): ?>    
                            <li class ="bottomSpacing"><label><?php echo $templateParams["checkImgExt"]; ?></label></li>
                            <?php endif; ?>
                            <li class="bottomSpacing">
                                <label class="fontBolder">Prezzo:</label><input type="text" name="prezzoarticolo" id="prezzoarticolo" />
                            </li>
                            <?php if(isset($templateParams["checkPrezzo"])): ?>    
                            <li class ="bottomSpacing"><label><?php echo $templateParams["checkPrezzo"]; ?></label></li>
                            <?php endif; ?>
                            <li class="bottomSpacing">
                                <label class="fontBolder">Quantità:</label><input type="text" name="quantitàarticolo" id="quantitàarticolo" />
                            </li>
                            <?php if(isset($templateParams["checkQuantità"])): ?>    
                            <li class ="bottomSpacing"><label><?php echo $templateParams["checkQuantità"]; ?></label></li>
                            <?php endif; ?>
                            <li class="bottomSpacing">
                                <label class="fontBolder">Disponibilità:</label>  
                                <select class="form-select" id="sel1" name="disponibilitàarticolo">
                                    <option>Immediata</option>
                                    <option>5 giorni</option>
                                    <option>10 giorni</option>
                                    <option>1 mese</option>
                                </select>
                            </li>
                        </ul>
                </div>
                <div class="col-12 col-md-5 mt-3 py-1 text-dark bg-info bg-opacity-10">
                        <ul>
                            <li>
                                <div class="row"><label class="fontBolder" for="titoloarticolo">Testo medio:</label></div>
                                <div class="row"><textarea id="testomedio" name="testomedio"></textarea></div>
                            </li>
                            <li>
                                <div class="row"><label class="fontBolder" for="testoarticolo">Testo lungo:</label></div>
                                <div class="row"><textarea id="testolungo" name="testolungo"></textarea></div>        
                            </li>
                            <li>
                                <label class="fontBolder">Categoria:</label>
                                <?php foreach($templateParams["categorie"] as $categorie): ?>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio1" name="optradio" value="<?php echo $categorie["nome"]; ?>" checked>
                                    <label class="form-check-label" for="radio1"><?php echo $categorie["nome"]; ?></label>
                                </div>
                                <?php endforeach; ?>
                            </li>
                        </ul>
                </div>
                <div class="col-md-1"></div>
            </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-12 col-md-10 mx-3 px-2 mt-3 py-1 text-dark bg-info bg-opacity-10">
                <input type="submit" name="submit" value="Inserisci" class="btn btn-primary"/>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
