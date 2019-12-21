<?php
  require_once('connexion.php');
  if (isset($_GET['controller']) && isset($_GET['action']))
  {
      $controller = $_GET['controller'];
      $action     = $_GET['action'];
  }
  else
  {
        $controller = 'page';
        $action     = 'home';
  }
  session_start();
  if(!isset($_SESSION['connecté']))
        $_SESSION['connecté'] = 'non connecté';
 
?>

<!DOCTYPE html>


<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <style>
            .setup{
                color: black;
                text-align: center;
                background: orange;
            }
            .disappear{
                display: none;
            }
    
    </style>
    <title>TUTORAT</title>
    <link rel="icon" href="assets/img/logo-icon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=f20836d04db9c2e94df06e239fab9fd8">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css?h=0692f36eb27607e4837760bbbf813d92">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css?h=d15dfcb68fabe0442ff06063b052477c">
    <link rel="stylesheet" href="assets/css/styles.css?">
    <!-- sign up-->
    <!--<link rel="stylesheet" href="assets/fonts/font-awesome.min.css"> -->
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Login-screen.css">
    <!-- navbar latérale et tuteur et evenements-->
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css?h=0692f36eb27607e4837760bbbf813d92">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css?h=0692f36eb27607e4837760bbbf813d92">
    <link rel="stylesheet" href="assets/css/menu.css">
    <link rel="stylesheet" href="assets/css/tuteur.css">
    <!-- upadte account -->
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css?h=0d932fa81301936f118cc8607c135e19">
    <!-- login-->
    <link rel="stylesheet" href="assets/css/Login-Form.css?h=20d7842de129d800e792499681f0b672">
    <link rel="stylesheet" href="http://demo.themefisher.com/constra/css/owl.carousel.min.css">
    

</head>

<body id="page-top">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
    <div class="container-fluid">
   
        <a href="index.php" class="navbar-brand"> <img src="assets/img/logo1.png" style="width: 175px;"/> </a>
        <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler">
            <span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse offset-lg-2" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <!-- CONTROL  sur la navbar horizontale -->
                <?php
                if(isset($_SESSION['statut']) && ($_SESSION['statut']== 'TUTEUR')) // id_statut d'un  tuteur
                 {
                  ?>
                <li class="nav-item"><a href="?controller=tuteurs&action=interface_tuteur" class="nav-link">Mon tutorat </a>
                </li>
                 <li class="nav-item"><a href="?controller=tuteurs&action=selection_tutores" class="nav-link">Mes Tutorés </a>
                </li>
                 <li class="nav-item"><a href="?controller=tuteurs&action=savoir_tuteurs" class="nav-link">Le tutorat: ce que je dois savoir </a>
                </li>
                <?php
                }
                elseif(isset($_SESSION['statut']) && preg_match('#^TUTORE#', $_SESSION['statut']) == 1)
                {
                ?>
                    <li class="nav-item"><a href="?controller=tutores&action=interface_tutore" class="nav-link">Mon tutorat </a>
                    </li>
                     <li class="nav-item"><a href="?controller=tutores&action=selection_tuteurs" class="nav-link">Mon Tuteur </a>
                    </li>
                     <li class="nav-item"><a href="?controller=tutores&action=savoir_tutores" class="nav-link">Le tutorat: ce que je dois savoir </a>
                <?php
                }
                elseif(isset($_SESSION['statut']) && ($_SESSION['statut'] == 'SUPER_ADMIN'))
                {
                ?>
                <?php
                }
                elseif(isset($_SESSION['statut']))
                {
                ?>
                <?php
                }
                else
                {
                    ?>
                     <li class="nav-item"><a href="index.php" class="nav-link">Accueil </a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Actualités </a>
                    </li>
                    <li class="nav-item"><a href="?controller=page&action=contact" class="nav-link">Contact </a>
                    </li>

                    <?php
                }
                ?>
                </ul>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"> <i class="fa fa-user-circle" style="font-size: 40px;"></i> </button>
                    <div class="dropdown-menu" role="menu">
                        <?php
                        if($_SESSION['connecté'] == 'non connecté')
                        {
                        ?>
                        <a class="dropdown-item forgot " href="?controller=users&action=login"  role="presentation">Connexion</a>
                        <?php
                        }
                        else
                        {
                        ?>
                        <a class="dropdown-item forgot" href="?controller=users&action=profil" role="presentation">Profil</a>
                        <a class="dropdown-item forgot refresh" href="?controller=users&action=deconnexion" role="presentation">Déconnexion</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <span class="navbar-text actions">
                    <div>
                     <!-- FIN du CONTROL sur la navbar horizontale -->
                    </div>
                </span>
            </div>
        </div>
    </nav>
  
    <div id="globalContent">
        <div id="wrapper">
            <nav id="lateralSideBar"  class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 ">
                <div class="container-fluid d-flex flex-column p-0">
                    <!-- CONTROL sur la navbar verticale -->
                    <?php
                     if( isset($_SESSION['statut'])&& ($_SESSION['statut']== 'TUTEUR') )
                     {
                        ?>
                        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                            <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                            <div class="sidebar-brand-text mx-3"><span>Tuteur</span></div>
                        </a>
                        <hr class="sidebar-divider my-0">
                        <ul class="nav navbar-nav text-light" id="accordionSidebar">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="?controller=tuteurs&action=interface_tuteur">
                                    <i class="fab fa-phoenix-squadron"></i>
                                    <span>évènements</span>
                                </a>
                                <a class="nav-link" href="?controller=tuteurs&action=notifications">
                                    <i class="fab fa-phoenix-squadron"></i>
                                    <span>Notifications</span>
                                </a>
                                <a class="nav-link" href="?controller=tuteurs&action=show_proposal">
                                    <i class="fab fa-phoenix-squadron"></i>
                                    <span>Propositions</span>
                                </a>
                                <a class="nav-link" href="?controller=tuteurs&action=contact">
                                    <i class="fab fa-phoenix-squadron"></i>
                                    <span>Questions / Support</span>
                                </a>
                            </li>
                        </ul>
                    <?php
                   }
                   elseif(isset($_SESSION['statut']) && preg_match('#^TUTORE#', $_SESSION['statut']) == 1)
                    {
                     ?>
                        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                            <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                            <div class="sidebar-brand-text mx-3"><span>Tutore</span></div>
                        </a>
                        <hr class="sidebar-divider my-0">
                        <ul class="nav navbar-nav text-light" id="accordionSidebar">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="?controller=tutores&action=interface_tutore">
                                    <i class="fab fa-phoenix-squadron"></i>
                                    <span>évènements</span>
                                </a>
                                <a class="nav-link" href="?controller=tutores&action=notifications">
                                    <i class="fab fa-phoenix-squadron"></i>
                                    <span>Notifications</span>
                                </a>
                                <a class="nav-link" href="?controller=tutores&action=contact">
                                    <i class="fab fa-phoenix-squadron"></i>
                                    <span>Questions / Support</span>
                                </a>
                            </li>
                        </ul>
                <?php
                }
                elseif(isset($_SESSION['statut']) && ($_SESSION['statut']== 'ADMIN_MEF')) // menu latéral pour admin
                {
                 ?>
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>MEF</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="?controller=admin&action=interface_admin">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>évènements</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_tutorat">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Les centres de la Mef</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_hours">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes Heures</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_selection">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes listes</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=contact">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Questions / Support</span>
                            </a>
                        </li>
                    </ul>
                <?php
                }
                elseif(isset($_SESSION['statut']) && ($_SESSION['statut']== 'ADMIN_IMMERSION')) // menu latéral pour admin
                {
                 ?>
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>IMMERSION</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="?controller=admin&action=interface_admin">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>évènements</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_tutorat">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes centres de tutorat</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_hours">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes Heures</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_selection">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes listes</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=contact">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Questions / Support</span>
                            </a>
                        </li>
                    </ul>
                <?php
                }
                elseif(isset($_SESSION['statut']) && ($_SESSION['statut']== 'ADMIN_LYCEES_COLLEGES')) // menu latéral pour admin
                {
                 ?>
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>LYCEES / COLLEGES</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="?controller=admin&action=interface_admin">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>évènements</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_tutorat">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes centres de tutorat</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_hours">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes Heures</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_selection">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes listes</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=contact">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Questions / Support</span>
                            </a>
                        </li>
                    </ul>
                <?php
                }
                elseif(isset($_SESSION['statut']) && ($_SESSION['statut'] == 'ADMIN_APSCO')) // menu latéral pour admin
                {
                 ?>
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>APSCO FIVE</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="?controller=admin&action=interface_admin">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>évènements</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_tutorat">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes centres de tutorat</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_hours">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes Heures</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_selection">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes listes</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=contact">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Questions / Support</span>
                            </a>

                        </li>
                    </ul>
                <?php
                }
                elseif(isset($_SESSION['statut']) && ($_SESSION['statut']== 'ADMIN_VAUBAN')) // menu latéral pour admin
                {
                 ?>
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>VAUBAN</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="?controller=admin&action=interface_admin">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>évènements</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_tutorat">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes centres de tutorat</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_hours">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes Heures</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_selection">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes listes</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=contact">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Questions / Support</span>
                            </a>

                        </li>
                    </ul>
                <?php
                }

                elseif(isset($_SESSION['statut']) && ($_SESSION['statut']== 'ADMIN_TUTORAT_PERSONNALISE')) // menu latéral pour admin
                {
                 ?>
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>TUTORAT </br> PERSONNALISE</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="?controller=admin&action=interface_admin">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>évènements</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_hours">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes Heures</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_selection">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes listes</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=contact">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Questions / Support</span>
                            </a>

                        </li>
                    </ul>
                <?php
                }
                elseif(isset($_SESSION['statut']) && ($_SESSION['statut'] == 'SUPER_ADMIN')) // menu latéral pour admin
                {
                 ?>
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>SUPER_ADMIN</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="?controller=superadmin&action=interface_superadmin">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>évènements</span>
                            </a>
                            <a class="nav-link" href="?controller=superadmin&action=interface_tuteur">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Tuteur</span>
                            </a>
                            <a class="nav-link" href="?controller=superadmin&action=interface_tutore">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Tutoré</span>
                            </a>
                            <a class="nav-link" href="?controller=superadmin&action=interface_tutorat">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Tutorats</span>
                            </a>
                            <a class="nav-link" href="?controller=superadmin&action=interface_hours">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Déclaration / heure</span>
                            </a>
                            <a class="nav-link" href="?controller=superadmin&action=contact">
                                    <i class="fab fa-phoenix-squadron"></i>
                                    <span>Questions / Support</span>
                            </a>

                        </li>
                    </ul>
                <?php
                }
                elseif(isset($_SESSION['statut']) && ($_SESSION['statut']== 'ADMIN_GESTION')) // menu latéral pour admin
                {
                 ?>
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-id-card"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>GESTION DES COMPTES</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="?controller=admin&action=interface_admin">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Comptes en attente</span>
                            </a>
                            <a class="nav-link" href="?controller=superadmin&action=interface_tutorat">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Tutorat</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_tutore_bourse">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Boursiers</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_account_valid">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes Utilisateurs</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=interface_hours">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Mes Heures</span>
                            </a>
                            <a class="nav-link" href="?controller=admin&action=contact">
                                <i class="fab fa-phoenix-squadron"></i>
                                <span>Questions / Support</span>
                            </a>
                        </li>
                    </ul>
                <?php
                }
                else //  on bloque l'afficahge de la navbar si pas connecté
                {
                  ?>
                    <script type="text/javascript">
                    document.getElementById("lateralSideBar").style.display = "none";
                    </script>
                <?php
                }
                ?>
                </div>
            </nav>
            <!-- FIN de CONTROL sur la navbar verticale -->
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-2">
                            <button type="button" id="sidebarCollapse" class="btn ">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                        <?php
                        require_once('arbre_navigation.php');
                        ?>
                    </div>
                </div>
                <div id="message_avertissement_javascript" >
                <?php //require_once('alert_javascript_not_enable.php'); ?>
                </div>
                <?php
                require_once('routes.php');
                ?>
            </div>
        </div>
    </div>

    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="#"><i class="icon ion-social-facebook"></i></a>
            </div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="index.php">Accueil</a></li>
                <li class="list-inline-item"><a href="#">Actualités</a></li>
                <li class="list-inline-item"><a href="?controller=page&action=contact">Contact</a></li>
            </ul>
            <p class="copyright">Tutorat YNCREA © 2019</p>
        </footer>
    </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=63715b63ee49d5fe4844c2ecae071373"></script>
    <script src="assets/js/Navbarbuttonsignupsignin-modal-form.js?h=9ce049da3c28fd2ded69977163ac47a3"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js?h=6d33b44a6dcb451ae1ea7efc7b5c5e30"></script>
    <script src="assets/js/dynmenu.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            
             //si javascript actif  => alors on désactive le message d'alerte
             alert_javascript = document.getElementById('message_avertissement_javascript');
             alert_javascript.parentNode.removeChild(alert_javascript);
            
            var refresh= document.getElementsByClassName('refresh')[0];
            var doc= document;
            if (window.XMLHttpRequest)
            {
                // code for modern browsers
                var  xhttp = new XMLHttpRequest();
            }   
            else 
            {
                // code for old IE browsers
                var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var ajax= function(e){
                
                
                // prompt("ajax");
                e.preventDefault();
                    xhttp.open("GET","index.php?controller=users&action=deconnexion",true);
                    xhttp.send(); 
                xhttp.onreadystatechange= ()=>{
                            if(xhttp.readyState === 4 && xhttp.status== 200)
                            {  
                                var previous = doc.getElementById('page-top');
                                //var child = xhttp.responseText.getElementById('page-top');
                                document.body.innerHTML= xhttp.responseText;
                              
                                //prompt(xhttp.responseText);
                            }
                        }
                        document.getElementById("lateralSideBar").style.display = "none";
                    }

                    document.getElementsByClassName('refresh')[0].addEventListener('click',ajax);
            //document.getElementsByClassName('refresh')[0].onclick=  aj();

            $('#sidebarCollapse').on('click', function () {
                $('#lateralSideBar').toggleClass('active');
                $(this).toggleClass('active');
                $('#content-wrapper').toggleClass('hide');
                $('#navigation_tree').toggleClass('hide');
            });
        });
    </script>



</body>

</html>
