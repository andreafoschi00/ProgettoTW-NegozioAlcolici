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
                    <h2>Articoli</h2>
                    <a href="gestisci-articolo.php?titoloarticolo=">Inserisci Articolo</a>
            </div>
            <div class="col-md-8"></div>   
        </div>
        <div class="row">
            <div class="col-md-1"></div>   
            <div class="col-12 col-md-10 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10 table-responsive">
                <?php if(isset($templateParams["checkInserimento"])): ?>    
                <label><?php echo $templateParams["checkInserimento"]; ?></label>
                <?php endif; ?>
                <?php if(empty($templateParams["articoli"])): ?>
                    <label><?php echo "Non hai inserito nessun articolo."; ?></label>
                <?php else: ?>
                <table class="table table-bordered table-striped border-dark"> 
                    <tr>
                        <th class="text-center">Titolo</th><th class="text-center">Immagine</th><th class="text-center">Azione</th>
                    </tr>
                    <?php foreach($templateParams["articoli"] as $articoli): ?> 
                    <tr>
                        <td class="text-center"><label class="titoloProd"><?php echo $articoli["nomeProdotto"]; ?></label></td>
                        <td class="text-center"><div class="cat"><img src="<?php echo UPLOAD_DIR.$articoli["nomeImmagine"];?>" alt="" class="resize"/></div></td>
                        <td class="text-center">
                            <a href="">Modifica</a>
                            <label>|</label>
                            <a href="gestisci-articolo.php?action=3&id=<?php echo $articoli["IDprodotto"]; ?>">Cancella</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
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