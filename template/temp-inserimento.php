<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="icon" type="image/x-icon" href=<?php echo UPLOAD_DIR."favicon.ico"?>>
    <meta charset="UTF-8"/>
    <meta name="viewport"content="width=device-width, initial-scale=1.0"/>
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
        <form action="<?php if(isset($templateParams["prodotto"])) echo "modifica-articolo.php"; 
        else echo "inserisci-articolo.php"; ?>" method="GET">
        <fieldset>
            <legend>Campi</legend>
                <div class="row">
                    <div class="col-md-1"></div>   
                    <div class="col-12 col-md-5 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10">
                            <ul>
                                <li class="bottomSpacing">
                                    <label class="fontBolder" for="titoloarticolo">Titolo:</label><input type="text" value="<?php if(isset($templateParams["prodotto"])) echo $templateParams["prodotto"][0]["nomeProdotto"]; ?>" id="titoloarticolo" name="titoloarticolo" required class="removeHover"/>
                                </li>
                                <li class="bottomSpacing">
                                    <label class="fontBolder" for="testoarticolo">Testo Breve:</label><input type="text" value="<?php if(isset($templateParams["prodotto"])) echo $templateParams["prodotto"][0]["testoBreve"]; ?>" id="testoarticolo" name="testoarticolo" required class="removeHover"/>        
                                </li>
                                <li class="bottomSpacing">
                                    <label class="fontBolder" for="imgarticolo">Immagine Articolo</label><input type="file" name="imgarticolo" id="imgarticolo" required class="removeHover"/>   
                                </li>
                                <?php if(isset($templateParams["checkImgExt"])): ?>    
                                <li class ="bottomSpacing"><p class="msgError"><?php echo $templateParams["checkImgExt"]; ?></p></li>
                                <?php endif; ?>
                                <li class="bottomSpacing">
                                    <label class="fontBolder" for="prezzoarticolo">Prezzo:</label><input type="text" value="<?php if(isset($templateParams["prodotto"])) echo $templateParams["prodotto"][0]["prezzoUnitario"]; ?>" name="prezzoarticolo" id="prezzoarticolo" required class="removeHover"/>
                                </li>
                                <?php if(isset($templateParams["checkPrezzo"])): ?>    
                                <li class ="bottomSpacing"><p class="msgError"><?php echo $templateParams["checkPrezzo"]; ?></p></li>
                                <?php endif; ?>
                                <li class="bottomSpacing">
                                    <label class="fontBolder" for="quantit&agrave;articolo">Quantit&agrave;:</label><input type="text" value="<?php if(isset($templateParams["prodotto"])) echo $templateParams["prodotto"][0]["quantitàDisponibile"]; ?>" name="quantit&agrave;articolo" id="quantit&agrave;articolo" required class="removeHover"/>
                                </li>
                                <?php if(isset($templateParams["checkQuantità"])): ?>    
                                <li class ="bottomSpacing"><p class="msgError"><?php echo $templateParams["checkQuantità"]; ?></p></li>
                                <?php endif; ?>
                                <li class="bottomSpacing">
                                    <label class="fontBolder" for="sel1">Disponibilit&agrave;:</label>  
                                    <select class="form-select" id="sel1" name="disponibilit&agrave;articolo" required size="4">
                                        <option id="immediata" <?php if(isset($templateParams["prodotto"]) && $templateParams["prodotto"][0]["tipoDisponibilità"] == "Immediata")  echo "selected=selected"; ?>><label for="immediata">Immediata</label></option>
                                        <option id="5giorni" <?php if(isset($templateParams["prodotto"]) && $templateParams["prodotto"][0]["tipoDisponibilità"] == "5 giorni")  echo "selected=selected"; ?>><label for="5giorni">5 giorni</label></option>
                                        <option id="10giorni" <?php if(isset($templateParams["prodotto"]) && $templateParams["prodotto"][0]["tipoDisponibilità"] == "10 giorni")  echo "selected=selected"; ?>><label for="10giorni">10 giorni</label></option>
                                        <option id="1mese" <?php if(isset($templateParams["prodotto"]) && $templateParams["prodotto"][0]["tipoDisponibilità"] == "1 mese")  echo "selected=selected"; ?>><label for="1mese">1 mese</label></option>
                                    </select>
                                </li>
                            </ul>
                    </div>
                    <div class="col-12 col-md-5 mt-3 py-1 text-dark bg-info bg-opacity-10">
                            <ul>
                                <li>
                                    <div class="row"><label class="fontBolder" for="testomedio">Testo medio:</label></div>
                                    <div class="row"><textarea id="testomedio" name="testomedio" required><?php if(isset($templateParams["prodotto"])) echo $templateParams["prodotto"][0]["testoMedio"]; ?></textarea></div>
                                </li>
                                <li>
                                    <div class="row"><label class="fontBolder" for="testolungo">Testo lungo:</label></div>
                                    <div class="row"><textarea id="testolungo"  name="testolungo" required><?php if(isset($templateParams["prodotto"])) echo $templateParams["prodotto"][0]["testoLungo"]; ?></textarea></div>        
                                </li>
                                <li>
                                    <label class="fontBolder">Categoria:</label>
                                    <?php foreach($templateParams["categorie"] as $categorie): ?>
                                    <div class="form-check">
                                        <input type="radio" id="<?php echo $categorie["nome"];?>" <?php if(isset($templateParams["prodotto"]) && $templateParams["prodotto"][0]["nomeCategoria"] == $categorie["nome"])  echo "checked"; ?> class="form-check-input" name="optradio" value="<?php echo $categorie["nome"]; ?>"  required>
                                        <label class="form-check-label" for="<?php echo $categorie["nome"]; ?>"><?php echo $categorie["nome"]; ?></label>
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
                    <input type="submit" name="submit" value="<?php echo $_SESSION["azione"]; ?>" class="btn btn-primary" />
                </div>
                <div class="col-md-1"></div>
            </div>
        </fieldset>
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
