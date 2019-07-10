<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>TUTORAT</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=f20836d04db9c2e94df06e239fab9fd8">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css?h=0692f36eb27607e4837760bbbf813d92">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css?h=d15dfcb68fabe0442ff06063b052477c">
    <link rel="stylesheet" href="assets/css/Navbarbuttonsignupsignin-modal-form-1.css?h=051c6d9e28b7c3d5e3836f24f2502d7d">
    <link rel="stylesheet" href="assets/css/Navbarbuttonsignupsignin-modal-form-2.css?h=b486ae8ecf6c38e7b0073c57ef30f22f">
    <link rel="stylesheet" href="assets/css/Navbarbuttonsignupsignin-modal-form.css?h=6363a7a5e162c8842a20a60ee778a476">
    <link rel="stylesheet" href="assets/css/styles.css?h=1637acf6632f17b3758401ceb35eb91e">
</head>

<body><nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
    <div class="container"><a href="#" class="navbar-brand"> LOGO </a><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item"><a href="#" class="nav-link">Accueil </a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">Equipe </a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">Contact </a>
                </li>
            </ul>
            <span class="navbar-text actions">
                <div>
                    <button class="btn btn-light action-button" type="button" id="modal-btn" data-toggle="modal" data-target="#signmodal"> Connexion </button>
                    <div class="modal" id="signmodal">
                        <div class="container" id="container">
                            <div class="form-container sign-up-container">
                                <form action="routes.php?action=save_user" method="post">
                                    <h3>S'INSCRIRE</h3>
                                    <input type="text" name="nom" placeholder="Nom" />
                                    <input type="text" name="prenom" placeholder="prénom" />
                                    <input type="date" name="date_naiss" placeholder="date de naissance" /> 
                                    <input type="text" name="nationalite" placeholder="Nationalité" />
                                    <input type="email" name="mail" placeholder="Email" />
                                    <input type="password" name="pwd" placeholder="Mot de passe" />
                                    <input type="password" name="pwd" placeholder="Confimer mot de passe" />
                                   <?php /* <input type="text" name="ecole" placeholder="École" />
                                    <input type="text" name="niveau" placeholder="Niveau" />
                                    <input type="text" name="adresse" placeholder="Adresse" />
                                    <input type="text" name="complement_adresse" placeholder="Complèment d'adresse" />
                                    <input type="number" name="code_postal" placeholder="Code postal" />
                                    <input type="text" name="ville" placeholder="Ville" />  */?>
                                    <button class="bouton">INSCRIPTION</button>
                                </form>
                            </div>
                            <div class="form-container sign-in-container">
                                <form action="routes.php?action=connexion" method="post">
                                    <h3>SE CONNECTER</h3>
                                    <input type="email" name="login"placeholder="Email" />
                                    <input type="password" name="password" placeholder="Password" />
                                    <a href="#">Mot de passe oublié?</a>
                                    <button class="bouton">CONNEXION</button>
                                </form>
                            </div>
                            <div class="overlay-container">
                                <div class="overlay">
                                    <div class="overlay-panel overlay-left">
                                        <h1>Bienvenue!</h1>
                                        <p>Connecte toi pour profiter comme il se doit du tutorat</p>
                                        <button class="ghost" id="signIn">SE CONNECTER</button>
                                    </div>
                                    <div class="overlay-panel overlay-right">
                                        <h1>Salut, l'ami!</h1>
                                        <p>Tu n'as pas encore de compte? Crée-en un maintenant!</p>
                                        <button class="ghost" id="signUp">S'INSCRIRE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </span>
        </div>
    </div>
</nav>
    <div id="content"></div>
    <div class="footer-basic">
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Accueil</a></li>
                <li class="list-inline-item"><a href="#">Equipe</a></li>
                <li class="list-inline-item"><a href="#">Contact</a></li>
            </ul>
            <p class="copyright">Tutorat YNCREA © 2019</p>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js?h=1dd785e1de9a32e236b624ae268bb803"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=63715b63ee49d5fe4844c2ecae071373"></script>
    <script src="assets/js/Navbarbuttonsignupsignin-modal-form.js?h=9ce049da3c28fd2ded69977163ac47a3"></script>
</body>

</html>
