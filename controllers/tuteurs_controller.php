<?php

require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/tuteurs.php');
require_once('models/tutorat.php');
/* Définition du controller */
class TuteursController
{

    public function interface_tuteur()
    {   
        if( isset($_SESSION['id_statut']))
            require_once('views/tuteurs/interface_tuteur.php');
        else
            require_once('views/login.php');
    }
    public function tuteur_set_event()
    {   
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
          {
            $tuteurs = new Tuteurs();
            if(isset($_GET['id']))
            {
              $donnees = $tuteurs->Get_specific_working_list($_SESSION['id_user'],$_GET['id']); // liste des tuteurs avec qui je travaille dans un tutorat donné autre que le tutorat personnalisé
              $id= $_GET['id']; // il s'agit de l'id du tutorat pour lequel le tuteur veut créer un évènement
            }
            else // il s'agit d'un tutorat personnalisé simple
            {
              $donnees = $tuteurs->Get_working_list($_SESSION['id_user']); // liste des tuteurs avec qui je travaille
              $id= null; // il s'agit de l'id du tutorat pour lequel le tuteur veut créer un évènement
            }
 
            $controller_report='tuteurs';
            $fonction_back='events_creation';
            
            
            require_once('views/tuteurs/tuteur_set_event.php'); // on charge la vue adéquate
          }
        else
            require_once('views/login.php');
    }
    
    public function events_creation()
    {
        if(isset($_SESSION['id_statut']))
        {
            $donnees= Tutorat::Get_working_tutorat($_SESSION['id_user']); // liste des tutorats pour lequels je travaille

            $controller_report='tuteurs';
            $fonction_back='interface_tuteur';

            require_once('views/tuteurs/events_creation.php');
        }
        else
            require_once('views/login.php');
    }
    public function selection_tutores()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            require_once('views/tuteurs/interface_selection_tutores_tuteurs.php'); // on charge la vue adéquate
        else
            require_once('views/login.php');
    }

    public function tutores_list()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            $tuteurs= new Tuteurs();
            $donnees= $tuteurs->Get_free_tutores();

            $controller_report='tuteurs';
            $fonction_back='selection_tutores';

            require_once('views/tuteurs/tutores_list.php');
        }
        else
            require_once('views/login.php');  
    }
    public function notifications() // liste de demandes recues et envoyées
    {
        if( isset($_SESSION['id_statut']))
            require_once('views/tuteurs/notifications_tuteurs.php');
        else
            require_once('views/login.php');
    }
    public function waiting_list()  // on récuprère la lsite des 
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {   
            $tuteurs= new Tuteurs();
            $donnees= $tuteurs->Get_waiting_list($_SESSION['id_user']);

            $controller_report='tuteurs';
            $fonction_back='notifications';

            require_once('views/tuteurs/waiting_list.php');
        }
        else
            require_once('views/login.php'); 

    }
    public function link() // action de se lier à un tuteur ou un tutoré
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {   
             $tuteurs= new Tuteurs();
             $tuteurs->Link_with_tutores($_SESSION['id_user'],$_POST['id_u']);
            require_once('views/tuteurs/notifications_tuteurs.php');
             
        }
        else
            require_once('views/login.php'); 
    }
    public function accept_link()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {  

            $tuteurs= new Tuteurs();
            if($tuteurs->Accept_link($_SESSION['id_user'],$_POST['id_u']) == 0)
                require_once('views/tuteurs/notifications_tuteurs.php');
            else
             {
                $message = 'Cette liaison est impossible, vous avez atteint votre quota maximum de liaison';
                $controller_report='tuteurs';
                $fonction_back='notifications';
                require_once('views/system/error.php');
             }
             
        }
        else
            require_once('views/login.php'); 
    }

    public function delete_link()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
            $tuteurs= new Tuteurs();
             $tuteurs->Delete_link($_POST['id_u']);
            require_once('views/tuteurs/notifications_tuteurs.php');
             
        }
        else
            require_once('views/login.php'); 
    }

    public function working_list()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $tuteurs= new Tuteurs();
             $donnees=$tuteurs->Get_working_list($_SESSION['id_user']);

             $controller_report='tuteurs';
             $fonction_back='selection_tutores';

            require_once('views/tuteurs/working_list.php');
             
        }
        else
            require_once('views/login.php'); 
    }

    public function wish_list()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $tuteurs= new Tuteurs();
             $donnees=$tuteurs->Get_wish_list($_SESSION['id_user']);

             $controller_report='tuteurs';
             $fonction_back='notifications';

            require_once('views/tuteurs/wish_list.php');
             
        }
        else
            require_once('views/login.php'); 
    }
    public function cancel_wish()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $tuteurs= new Tuteurs();
             $donnees=$tuteurs->Cancel_wish($_SESSION['id_user'],$_POST['id_u']);
             require_once('views/tuteurs/interface_selection_tutores_tuteurs.php');
        }
        else
            require_once('views/login.php'); 
    }

    public function update_account()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            $donnees = Users::Get_info($_SESSION['id_user']);    // on récupère les info des user
            require_once('views/update_account.php');
        }
        else
            require_once('views/login.php');
    }
    public function modify_account()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            $tuteurs = new Users();
            $tuteurs->setVille($_POST['ville']);
            $tuteurs->setAdress($_POST['adresse']);
            $tuteurs->setCom_adress($_POST['complement_adresse']);
            $tuteurs->setCode_postal($_POST['code_postal']);
            $tuteurs->setPassword($_POST['password']);

            $tuteurs->Modify_info($_SESSION['id_user']);    // on update les infos du user
            require_once('views/tuteurs/interface_tuteur.php');
        }
        else
            require_once('views/login.php');
    }
    public static function contact()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                { 
                    $data= Users::Get_contact_admin($_SESSION['id_user']);
                    require_once('views/contacter.php');
                }
            else
                require_once('views/login.php');
        }
      public function message() 
      {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                require ('PHPMailer/PHPMailerAutoload.php');
                require ('connectToMail.php');

                $contacter= true;
                $nom= $_SESSION['nom']; 
                $prenom= $_SESSION['prenom'];
                
                $login_mail=  $_POST['email']; // adresse réceptrice( l'administrateur )
                //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
                $message_txt = $_POST['message'];
                
                
                $message_html = $_POST['message'];
                //Sujet
                $sujet = "[Yncrea tutorat] Message plateforme Yncrea tutorat de: ".$prenom." ".$nom." ";
                // on envoie un email de confirmation
                include('send_mail.php');

                TuteursController::contact();
            }
            else
                require_once('views/login.php');
      }
    public static function show_proposal() // on affiche les différentes propositions recues par un tuteur
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            $donnees= Tuteurs::Get_proposal($_SESSION['id_user']);

            $controller_report='tuteurs';
            $fonction_back='interface_tuteur'; 

            require_once('views/tuteurs/received_proposal.php');
        }
         else
            require_once('views/login.php');
    }

    public function accept_proposal() // il accepte une proposition recue pour un tutorat spécifique
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {   
            if( isset($_POST['accepter']))
            {
                Tuteurs::Accept_proposal($_SESSION['id_user'],$_POST['id_t']);
                TuteursController::Show_proposal();
            }
            elseif( isset($_POST['refuser']))
            {
                Tuteurs::Refuse_proposal($_SESSION['id_user'],$_POST['id_t']);
                TuteursController::Show_proposal();
            }
         }
        else
             require_once('views/login.php');
    }

}
?>