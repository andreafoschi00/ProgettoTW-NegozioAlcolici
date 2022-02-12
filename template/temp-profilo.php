<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"];?></title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <meta charset="utf-8"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
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
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center"><?php echo $templateParams["titolo_ordini"];?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-bordered table-striped border-dark">
                            <thead>
                                <tr>
                                    <th>IDOrdine</th>
                                    <th>Prezzo</th>
                                    <th>Data e Ora</th>
                                    <th>Azioni</th>
                                </tr>    
                            </thead>
                            <tbody>
                                <?php foreach($templateParams["ordini"] as $ordine):?>
                                    <tr>
                                        <td><?php echo $ordine["IDordine"];?></td>
                                        <td><?php echo $ordine["costoTotale"];?></td>
                                        <td><?php echo $ordine["dataOraOrdine"];?></td>
                                        <td><a href="ordine.php">Mostra</a></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center">Il mio profilo</h2>
                    </div>
                    <ul>
                        <?php foreach($templateParams["dati_anagrafici"] as $anagrafica): ?>
                        <li><?php echo $anagrafica["cognome"];?> <?php echo $anagrafica["nome"];?></li>
                        <li><?php echo $anagrafica["dataNascita"];?></li>
                        <li><?php echo $anagrafica["email"];?></li>
                        <?php endforeach;?>
                    </ul>
                    <div class="col-md-1"></div>
                    <a href="registrazione.php?action=modifica&email=<?php echo $_SESSION["email"];?>" class="my-2 col-md-4 btn btn-light">Modifica</a>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <a id="logout" class="my-2 btn btn-primary"  href="logout.php">Logout</a>
                    </div>
                    <div class="col-md-1"></div>
                </div>
             </div>
             <div class="col-12 col-md-3 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10">
                 <div class="row">
                    <h2 class="text-center">Notifiche</h2>
                    <ul>
                        <?php foreach($templateParams["notifiche"] as $notifica): ?>
                            <li>Tipo: <?php echo $notifica["tipo"];?></li>
                            <li><?php echo $notifica["testo"];?></li>
                        <?php endforeach;?>
                    </ul>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>