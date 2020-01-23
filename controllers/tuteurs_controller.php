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
            set_route('views/tuteurs/interface_tuteur.php');
        else
            set_route('views/login.php');
    }
    public function tuteur_set_event()
    {   
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
          {
            
            $tuteurs = new Tuteurs();
            
            if(isset($_POST['id']))
            {
              $id= htmlspecialchars($_POST['id']); // il s'agit de l'id du tutorat pour lequel le tuteur veut créer un évènement
              set_donnees($tuteurs->Get_specific_working_list($_SESSION['id_user'],$id)); // liste des tuteurs avec qui je travaille dans un tutorat donné autre que le tutorat personnalisé
            }
            else // il s'agit d'un tutorat personnalisé simple
            {
              set_donnees($tuteurs->Get_working_list($_SESSION['id_user'])); // liste des tuteurs avec qui je travaille
              $id= null; // il s'agit de l'id du tutorat pour lequel le tuteur veut créer un évènement
            }
 
            set_controller_report('tuteurs');
            set_fonction_back('events_creation');
            
            
            set_route('views/tuteurs/tuteur_set_event.php'); // on charge la vue adéquate
          }
        else
            set_route('views/login.php');
    }
    
    public function events_creation()
    {
        if(isset($_SESSION['id_statut']))
        {
            set_donnees(Tutorat::Get_working_tutorat($_SESSION['id_user'])); // liste des tutorats pour lequels je travaille

            set_controller_report('tuteurs');
            set_fonction_back('interface_tuteur');

            set_route('views/tuteurs/events_creation.php');
        }
        else
            set_route('views/login.php');
    }
    public function selection_tutores()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            set_route('views/tuteurs/interface_selection_tutores_tuteurs.php'); // on charge la vue adéquate
        else
            set_route('views/login.php');
    }

    public function tutores_list()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            $tuteurs= new Tuteurs();
            set_donnees($tuteurs->Get_free_tutores());

            set_controller_report('tuteurs');
            set_fonction_back('selection_tutores');

            set_route('views/tuteurs/tutores_list.php');
        }
        else
            set_route('views/login.php');  
    }
    public function notifications() // liste de demandes recues et envoyées
    {
        if( isset($_SESSION['id_statut']))
            set_route('views/tuteurs/notifications_tuteurs.php');
        else
            set_route('views/login.php');
    }
    public function waiting_list()  // on récuprère la lsite des 
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {   
            $tuteurs= new Tuteurs();
            set_donnees($tuteurs->Get_waiting_list($_SESSION['id_user']));

            set_controller_report('tuteurs');
            set_fonction_back('notifications');

            set_route('views/tuteurs/waiting_list.php');
        }
        else
            set_route('views/login.php'); 

    }
    public function link() // action de se lier à un tuteur ou un tutoré
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {   
             $id_u= htmlspecialchars($_POST['id_u']);
             
             if($id_u!="")
             {
                 $tuteurs= new Tuteurs();
                 $tuteurs->Link_with_tutores($_SESSION['id_user'],$id_u);
                 set_route('views/tuteurs/notifications_tuteurs.php');
             }
             else 
                 set_route('views/login.php');
             
        }
        else
            set_route('views/login.php'); 
    }
    public function accept_link()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {  
            $id_u= htmlspecialchars($_POST['id_u']);
            
            if($id_u!="")
            {
                $tuteurs= new Tuteurs();
                if($tuteurs->Accept_link($_SESSION['id_user'],$id_u) == 0)
                    set_route('views/tuteurs/notifications_tuteurs.php');
                else
                 {
                    $message = 'Cette liaison est impossible, vous avez atteint votre quota maximum de liaison';
                    set_controller_report('tuteurs');
                    set_fonction_back('notifications');
                    set_route('views/system/error.php');
                 }
            }
        else
            set_route('views/login.php'); 
        }
        else
            set_route('views/login.php'); 
    }

    public function delete_link()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {   
            $id_u= htmlspecialchars($_POST['id_u']);
           if($id_u!="")
           {
            $tuteurs= new Tuteurs();
             $tuteurs->Delete_link($id_u);
            set_route('views/tuteurs/notifications_tuteurs.php');
           }
        }
        else
            set_route('views/login.php'); 
    }

    public function working_list()
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $tuteurs= new Tuteurs();
             set_donnees($tuteurs->Get_working_list($_SESSION['id_user']));

             set_controller_report('tuteurs');
             set_fonction_back('selection_tutores');

            set_route('views/tuteurs/working_list.php');
             
        }
        else
            set_route('views/login.php'); 
    }

    public function wish_list()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $tuteurs= new Tuteurs();
             set_donnees($tuteurs->Get_wish_list($_SESSION['id_user']));

             set_controller_report('tuteurs');
             set_fonction_back('notifications');

            set_route('views/tuteurs/wish_list.php');
             
        }
        else
            set_route('views/login.php'); 
    }
    public function cancel_wish()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    
             $id_u= htmlspecialchars($_POST['id_u']);
             if($id_u!="")
             {
             $tuteurs= new Tuteurs();
             set_donnees($tuteurs->Cancel_wish($_SESSION['id_user'],$id_u));
             set_route('views/tuteurs/interface_selection_tutores_tuteurs.php');
             }
        }
        else
            set_route('views/login.php'); 
    }

    public function update_account()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            set_donnees(Users::Get_info($_SESSION['id_user']));    // on récupère les info des user
            set_route('views/update_account.php');
        }
        else
            set_route('views/login.php');
    }
    public function modify_account()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            $ville= htmlspecialchars($_POST['ville']);
            $adresse= htmlspecialchars($_POST['adresse']);
            $complement_adresse= htmlspecialchars($_POST['complement_adresse']);
            $code_postal= htmlspecialchars($_POST['code_postal']);
            $password= htmlspecialchars($_POST['password']);
                
            $tuteurs = new Users();
            $tuteurs->setVille($ville);
            $tuteurs->setAdress($adresse);
            $tuteurs->setCom_adress($complement_adresse);
            $tuteurs->setCode_postal($code_postal);
            $tuteurs->setPassword($password);
          
            $tuteurs->Modify_info($_SESSION['id_user']);    // on update les infos du user
            set_route('views/tuteurs/interface_tuteur.php');
        
        }
        else
            set_route('views/login.php');
    }
    public static function contact()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                { 
                    $data= Users::Get_contact_admin($_SESSION['id_user']);
                    set_route('views/tuteurs/contacter.php');
                }
            else
                set_route('views/login.php');
        }
      public function message() 
      {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {  
                
                if( sizeof(Users::Get_all_contact_admin($_SESSION['id_user'])) == 0){ // si pas d'admin disponible
                    $contacter= false;
                    set_route('views/tuteurs/contacter.php');
              }
              else{
                require ('PHPMailer/PHPMailerAutoload.php');
                require ('connectToMail.php');
                $mailAccount = 'contact_tuteurs@tutorat-yncrea.fr';
                
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

                set_controller_report('tuteurs');
                set_fonction_back('contact');
          
                set_route('views/mail_send_ok.php');
            }
        }
            else
                set_route('views/login.php');
      }
    public static function show_proposal() // on affiche les différentes propositions recues par un tuteur
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            set_donnees(Tuteurs::Get_proposal($_SESSION['id_user']));

            set_controller_report('tuteurs');
            set_fonction_back('interface_tuteur'); 

            set_route('views/tuteurs/received_proposal.php');
        }
         else
            set_route('views/login.php');
    }

    public function accept_proposal() // il accepte une proposition recue pour un tutorat spécifique
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {  
            $id_t= htmlspecialchars($_POST['id_t']);
            
            if($id_t!="")
            {
            if( isset($_POST['accepter']))
            {
                Tuteurs::Accept_proposal($_SESSION['id_user'],$id_t);
                TuteursController::Show_proposal();
            }
            elseif( isset($_POST['refuser']))
            {
                Tuteurs::Refuse_proposal($_SESSION['id_user'],$id_t);
                TuteursController::Show_proposal();
            }
            }
         }
        else
             set_route('views/login.php');
    }
    public function savoir_tuteurs() // page à savoir 
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            set_route('views/tuteurs/savoir_tuteurs.php'); 
        }
        else
            set_route('views/Login.php');
    }

}
?>