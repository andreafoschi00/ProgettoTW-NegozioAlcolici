<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"];?></title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <meta charset="UTF-8"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" >
    <script src="./js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="./js/registrazione.js" type="text/javascript"></script>
</head>
<body class="bg-secondary">
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
            <div class="col-12 col-md-6">
                <form action="#" method="POST">
                    <fieldset class="bg-info bg-opacity-10 border mt-4 mb-4 field_border">
                        <label>Nome</label>
                        <br/><br/>
                        <input type="text" name="nome" id="nomeReg">
                        <?php if(isset($templateParams["checkNome"])): ?>
                        <p><?php echo "Devi inserire almeno 2 caratteri e non sono ammessi numeri!"; ?></p>
                        <?php endif; ?>
                        <br/><br/>            
                        <label>Cognome</label>
                        <br/><br/>
                        <input type="text" name="cognome" id="cognomeReg">
                        <?php if(isset($templateParams["checkCognome"])): ?>
                        <p><?php echo "Devi inserire almeno 2 caratteri e non sono ammessi numeri!"; ?></p>
                        <?php endif; ?>
                        <br/><br/>
                        <label>Data di nascita</label>
                        <br/><br/>
                        <input type="date" name="dataNascita" id="dataNascitaReg">
                        <?php if(isset($templateParams["checkData"])): ?>
                        <p><?php echo "Devi essere maggiorenne per poterti registrare!"; ?></p>
                        <?php endif; ?>
                        <br/><br/>
                        <label>E-mail</label>
                        <br/><br/>
                        <input type="text" name="e-mail" id="emailReg">
                        <?php if(isset($templateParams["checkE-mail"])): ?>
                        <p><?php echo "Devi inserire una e-mail valida!"; ?></p>
                        <?php endif; ?>
                        <br/><br/>
                        <label>Password</label>
                        <br/><br/>
                        <div class="row">
                         <div class="col-12 col-md-4">
                            <input type="password" name="password" id="passwordReg">
                         </div>
                         <div class="col-5 col-md-3">
                            <label>Sicurezza password:</label>
                            <?php if(isset($templateParams["checkPassword"])): ?>
                            <p><?php echo "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character."; ?></p>
                            <?php endif; ?>
                         </div>
                         <div class="col-4 col-md-3 mt-1">
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width:25%">25%</div>
                            </div>
                         </div>   
                        </div>
                        <br/><br/>
                        <label><input type="checkbox">Mostra password</label>
                        <br/><br/>
                        <input type="submit" name="submit" value="Registrati" class="btn btn-primary regist" id="regist">
                    </fieldset>
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