<?php
set_route('models/users.php');
set_route('models/tuteurs.php');
set_route('models/tutores.php');
set_route('models/evenements.php');

/* Définition du controller */
class TutoresController
{

     public function interface_tutore()
       {
            if( isset($_SESSION['id_statut']))
                set_route('views/tutores/interface_tutore.php');
            else
                set_route('views/login.php');
       }
     public function selection_tuteurs()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                set_route('views/tutores/interface_selection_tuteurs_tutores.php'); // on charge la vue adéquate
            else
                set_route('views/login.php');
        }
     public function tuteurs_list()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {
                $tuteurs= new Tutores();
                set_donnees($tuteurs->Get_free_tuteurs());

                set_controller_report('tutores');
                set_fonction_back('selection_tuteurs');

                set_route('views/tutores/tuteurs_list.php');
            }
            else
                set_route('views/login.php');  
        }
     public function notifications()
        {
            if( isset($_SESSION['id_statut']))
                set_route('views/tutores/notifications_tutores.php');
            else
                set_route('views/login.php');
        }
     public function waiting_list()  // on récuprère la lsite des 
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {   
                $tuteurs= new Tutores();
                set_donnees($tuteurs->Get_waiting_list($_SESSION['id_user']));

                set_controller_report('tutores');
                set_fonction_back('notifications');

                set_route('views/tutores/waiting_list.php');
            }
            else
                set_route('views/login.php'); 

        }
     public function link() // action de se lier à un tuteur ou un tutoré
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
              $id_u=  htmlspecialchars($_POST['id_u']);
      
                 $tuteurs= new Tutores();
                 $tuteurs->Link_with_tuteurs($_SESSION['id_user'],$id_u);
                set_route('views/tutores/notifications_tutores.php');
        
            }
            else
                set_route('views/login.php'); 
        }
     public function accept_link()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                $tutores= new Tutores();
                $id_u=  htmlspecialchars($_POST['id_u']);
        
                if($tutores->Accept_link($_SESSION['id_user'],$id_u) == 0  )
                    set_route('views/tutores/notifications_tutores.php');  
                else
                {
                    $message = 'Cette liaison est impossible, ce tuteur a atteint son quota maximum de liaison';
                    set_controller_report('tutores');
                    set_fonction_back('notifications');
                    set_route('views/system/error.php');
                }
      
            }
            else
                set_route('views/login.php'); 
        }
        
        /*
        public function delete_link()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                $tuteurs= new Tutores();
                 $tuteurs->Delete_link($_POST['id_u']);
                set_route('views/tutores/notifications_tuteurs.php');
                 
            }
            else
                set_route('views/login.php'); 
        }
        */
     public function working_list()
        {
            
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                 
                 set_donnees(Tutores::Get_working_list($_SESSION['id_user']));

                 set_controller_report('tutores');
                 set_fonction_back('selection_tuteurs');
            
                set_route('views/tutores/working_list.php');
            }
            else
                set_route('views/login.php'); 
        }

     public function wish_list()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
                 $tuteurs= new Tutores();
                 set_donnees($tuteurs->Get_wish_list($_SESSION['id_user']));

                 set_controller_report('tutores');
                 set_fonction_back('notifications');

                 set_route('views/tutores/wish_list.php');  
            }
            else
                set_route('views/login.php'); 
        }
     public function cancel_wish()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    
              $id_u=  htmlspecialchars($_POST['id_u']);
              $tuteurs= new Tutores();

              set_donnees($tuteurs->Cancel_wish($_SESSION['id_user'],$_POST['id_u']));
              set_route('views/tutores/interface_selection_tuteurs_tutores.php');
    
            }
            else
                set_route('views/Login.php'); 
        }
     public function validate_hours() // tutoré valide les heures de son tuteur 
     {
           if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
              { 
                    $duree= htmlspecialchars($_POST['duree']);
                    $tutores = new Tutores();
                    
                      $tutores->Validate_hours($_POST['id_e'],$duree); 
                      set_route('views/tutores/interface_tutore.php');
              }
            else
                set_route('views/Login.php');
     }


     
     public static function contact()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                { 
                    $data= Users::Get_contact_admin($_SESSION['id_user']);
                    set_route('views/tutores/contacter.php');
                }
            else
                set_route('views/Login.php');
        }
      public function message() // à completer lors de la création de la table de suivi des admin
      {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {    

                require ('PHPMailer/PHPMailerAutoload.php');
                require ('connectToMail.php');
                $mailAccount = 'contact_tutores@tutorat-yncrea.fr';
                
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

                set_controller_report('tutores');
                set_fonction_back('contact');
          
                set_route('views/mail_send_ok.php');
            }
            else
                set_route('views/Login.php');
      }
      public function savoir_tutores() // page à savoir
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            set_route('views/tutores/savoir_tutores.php'); 
        }
        else
            set_route('views/Login.php');
    }



       
}