<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"];?></title>
    <link rel="icon" type="image/x-icon" href=<?php echo UPLOAD_DIR."favicon.ico"?>>
    <meta charset="UTF-8"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="./js/registrazione.js" type="text/javascript"></script>
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
                    <h2 class="text-center"><?php echo $templateParams["titolo-pagina"]; ?></h2>
            </div>
            <div class="col-md-8"></div>   
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-12 col-md-6 mx-3 mt-3 py-1 text-dark bg-info bg-opacity-10">
                <form action="<?php if(isset($templateParams["datiAnagrafici"])) echo "modificaDati.php";
                else echo "registrazione.php"; ?>" method="POST">
                    <ul>
                        <li class="bottomSpacing"><label class="fontBolder" for="nomeReg">Nome</label></li>
                        <li class="bottomSpacing"><input type="text" class="removeHover" name="nome" id="nomeReg" value="<?php if(isset($templateParams["datiAnagrafici"])) echo $templateParams["datiAnagrafici"][0]; ?>"></li>
                        <?php if(isset($templateParams["checkNome"])): ?>
                            <li class="bottomSpacing"><p class="msgError"><?php echo "Devi inserire almeno 2 caratteri e non sono ammessi numeri!"; ?></p></li>
                        <?php endif; ?>           
                        <li class="bottomSpacing"><label class="fontBolder" for="cognomeReg">Cognome</label></li>
                        <li class="bottomSpacing"><input type="text" class="removeHover" name="cognome" id="cognomeReg" value="<?php if(isset($templateParams["datiAnagrafici"])) echo $templateParams["datiAnagrafici"][1]; ?>"></li>
                        <?php if(isset($templateParams["checkCognome"])): ?>
                            <li class="bottomSpacing"><p class="msgError"><?php echo "Devi inserire almeno 2 caratteri e non sono ammessi numeri!"; ?></p></li>
                        <?php endif; ?>
                        <li class="bottomSpacing"><label class="fontBolder" for="dataNascitaReg">Data di nascita</label></li>
                        <li class="bottomSpacing"><input type="date" name="dataNascita" id="dataNascitaReg" value="<?php if(isset($templateParams["datiAnagrafici"])) echo $templateParams["datiAnagrafici"][2]; ?>"></li>
                        <?php if(isset($templateParams["checkData"])): ?>
                            <li class="bottomSpacing"><p class="msgError"><?php echo "Devi essere maggiorenne per poterti registrare!"; ?></p></li>
                        <?php endif; ?>
                        <li class="bottomSpacing"><label class="fontBolder" for="emailReg" <?php if(isset($templateParams["datiAnagrafici"])) echo "hidden"; ?>>E-mail</label></li>
                        <li class="bottomSpacing"><input type="text" class="removeHover" name="e-mail" id="emailReg" <?php if(isset($templateParams["datiAnagrafici"])) echo "disabled hidden"; ?>></li>
                        <?php if(isset($templateParams["checkE-mail"])): ?>
                            <li class="bottomSpacing"><p class="msgError"><?php echo "Devi inserire una e-mail valida!"; ?></p></li>
                        <?php endif; ?>
                        <li class="bottomSpacing"><label class="fontBolder" for="passInput" <?php if(isset($templateParams["datiAnagrafici"])) echo "hidden"; ?> >Password</label></li>
                        <li class="bottomSpacing"><div class="row">
                         <div class="col-12 col-md-4">
                            <input type="password" name="password" id="passInput" <?php if(isset($templateParams["datiAnagrafici"])) echo "disabled hidden"; ?>>   
                         </div>
                         <div class="col-5 col-md-3">
                            <label class="fontBolder" <?php if(isset($templateParams["datiAnagrafici"])) echo "hidden"; ?>>Sicurezza password:</label>
                            <?php if(isset($templateParams["checkPassword"]) && strcmp($templateParams["checkPassword"], "invalid") == 0): ?>
                                <p class="msgError"><?php echo "La password deve essere lunga almeno 8 caratteri, deve includere una lettera maiuscola, una lettera minuscola e un carattere speciale."; ?></p>
                            <?php elseif(isset($templateParams["checkPassword"]) && strcmp($templateParams["checkPassword"], "used") == 0): ?>
                                    <p class="msgError"><?php echo "Questa e-mail è gia stata utilizzata."; ?></p>
                            <?php endif; ?>
                         </div>
                         <div class="col-4 col-md-3 mt-1">
                            <div class="progress" <?php if(isset($templateParams["datiAnagrafici"])) echo "hidden"; ?>>
                                <div class="progress-bar"  role="progressbar" 
                                     aria-valuenow="0" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100" 
                                     style="width:0%">
                                </div>
                            </div>
                         </div>   
                        </div></li>
                        <li class="bottomSpacing"><input type="checkbox" id="showPass" <?php if(isset($templateParams["datiAnagrafici"])) echo "hidden"; ?>><label for="showPass" <?php if(isset($templateParams["datiAnagrafici"])) echo "hidden"; ?>>Mostra password</label></li>
                        <li><input id="insButton" type="submit" name="submit" value="<?php if(isset($templateParams["datiAnagrafici"])) echo "Modifica"; else echo "Registrati"; ?>" class="btn btn-primary regist"></li>
                    </ul>
                </form>
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
</html>