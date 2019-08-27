<?php
require_once('models/users.php');
require_once('models/tuteurs.php');
require_once('models/tutores.php');
require_once('models/evenements.php');

/* Définition du controller */
class TutoresController
{

     public function interface_tutore()
       {
            if( isset($_SESSION['id_statut']))
                require_once('views/tutores/interface_tutore.php');
            else
                require_once('views/login.php');
       }
     public function selection_tuteurs()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                require_once('views/tutores/interface_selection_tuteurs_tutores.php'); // on charge la vue adéquate
            else
                require_once('views/login.php');
        }
     public function tuteurs_list()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {
                $tuteurs= new Tutores();
                $donnees= $tuteurs->Get_free_tuteurs();

                $controller_report='tutores';
                $fonction_back='selection_tuteurs';

                require_once('views/tutores/tuteurs_list.php');
            }
            else
                require_once('views/login.php');  
        }
     public function notifications()
        {
            if( isset($_SESSION['id_statut']))
                require_once('views/tutores/notifications_tutores.php');
            else
                require_once('views/login.php');
        }
     public function waiting_list()  // on récuprère la lsite des 
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {   
                $tuteurs= new Tutores();
                $donnees= $tuteurs->Get_waiting_list($_SESSION['id_user']);

                $controller_report='tutores';
                $fonction_back='notifications';

                require_once('views/tutores/waiting_list.php');
            }
            else
                require_once('views/login.php'); 

        }
     public function link() // action de se lier à un tuteur ou un tutoré
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {   
                 $tuteurs= new Tutores();
                 $tuteurs->Link_with_tuteurs($_SESSION['id_user'],$_POST['id_u']);
                require_once('views/tutores/notifications_tutores.php');   
            }
            else
                require_once('views/login.php'); 
        }
     public function accept_link()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                $tutores= new Tutores();
                if($tutores->Accept_link($_SESSION['id_user'],$_POST['id_u']) == 0  )
                    require_once('views/tutores/notifications_tutores.php');  
                else
                {
                    $message = 'Cette liaison est impossible, ce tuteur a atteint son quota maximum de liaison';
                    $controller_report='tutores';
                    $fonction_back='notifications';
                    require_once('views/system/error.php');
                } 
            }
            else
                require_once('views/login.php'); 
        }
        
        /*
        public function delete_link()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                $tuteurs= new Tutores();
                 $tuteurs->Delete_link($_POST['id_u']);
                require_once('views/tutores/notifications_tuteurs.php');
                 
            }
            else
                require_once('views/login.php'); 
        }
        */
     public function working_list()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                 
                 $donnees=Tutores::Get_working_list($_SESSION['id_user']);

                 $controller_report='tutores';
                 $fonction_back='selection_tuteurs';
            
                require_once('views/tutores/working_list.php');
            }
            else
                require_once('views/login.php'); 
        }

     public function wish_list()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                 $tuteurs= new Tutores();
                 $donnees=$tuteurs->Get_wish_list($_SESSION['id_user']);

                 $controller_report='tutores';
                 $fonction_back='notifications';

                 require_once('views/tutores/wish_list.php');  
            }
            else
                require_once('views/login.php'); 
        }
     public function cancel_wish()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                 $tuteurs= new Tutores();
                 $donnees=$tuteurs->Cancel_wish($_SESSION['id_user'],$_POST['id_u']);
                 require_once('views/tutores/interface_selection_tuteurs_tutores.php');
            }
            else
                require_once('views/login.php'); 
        }
     public function validate_hours() // tutoré valide les heures de son tuteur 
     {
           if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
              { 
                
                    $tutores = new Tutores();
                    $tutores->Validate_hours($_POST['id_e'],$_POST['duree']); 
                    require_once('views/tutores/interface_tutore.php');
               
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
      public function message() // à completer lors de la création de la table de suivi des admin
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
                $sujet = "[Yncrea tutorat] Message plateforme Yncrea tutorat de: ".$nom." ".$prenom." ";
                // on envoie un email de confirmation
                include('send_mail.php');
                TutoresController::contact();
            }
            else
                require_once('views/login.php');
      }



       
}