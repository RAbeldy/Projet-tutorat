<?php

require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/admin.php');
require_once('models/superadmin.php');
require_once('models/tutorat.php');
require_once('controllers/users_controller.php');



/* Définition du controller */
class SuperadminController
{

     public function interface_superadmin()
       {
            if( isset($_SESSION['id_statut']))
            {
              if($_SESSION['id_statut']== 1)
                require_once('views/superadmin/interface_superadmin.php');
              else
                require_once('views/admin/gestion/interface_gestionnaire.php');
            }
            else
                require_once('views/login.php');
       }
     public function interface_tutore()
     {
           if( isset($_SESSION['id_statut']) )
            {
                if( $_SESSION['id_statut'] == 1)
                   require_once('views/superadmin/interface_tutore.php');
                else
                   UsersController::deconnexion();
            }
            else
                require_once('views/login.php');
     }
     public function interface_tuteur()
     {
           if( isset($_SESSION['id_statut']) )
            {
              if( $_SESSION['id_statut'] == 1)
                require_once('views/superadmin/interface_tuteur.php');
              else
              UsersController::deconnexion();
            }
            else
                require_once('views/login.php');
     } 

     public function interface_tutorat()  
     {
         if( isset($_SESSION['id_statut']))
         {

            $controller_report='superadmin'; 
            $fonction_back='interface_superadmin';

                require_once('views/superadmin/interface_tutorat.php');
         }
          else
                require_once('views/login.php');
     }
     public function interface_set_event()  
     {
         if( isset($_SESSION['id_statut'])  )
         {
          if( $_SESSION['id_statut'] == 1)
          {
            $donnees=Tutorat::Get_all_type_tutorat();  // on charge l'interface de création de tutorat 
            
            $controller_report='superadmin'; 
            $fonction_back='interface_superadmin';

                require_once('views/superadmin/interface_set_event.php');
          }
          else
              UsersController::deconnexion();
         }
          else
                require_once('views/login.php');
     }
     public function interface_account_creation()  
     {
         if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
            $donnees=Tutorat::Get_all_type_tutorat();  // on charge l'interface de création de tutorat
            $controller_report='superadmin'; 
            $fonction_back='interface_tutorat';

                require_once('views/superadmin/interface_account_creation.php');
          }
          else
              UsersController::deconnexion();
         }
          else
                require_once('views/login.php');
     }
     public function interface_hours()  
     {
         if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
            $controller_report='superadmin'; 
            $fonction_back='interface_tutorat';

                require_once('views/superadmin/interface_hours.php');
          }
          else
              UsersController::deconnexion();

         }
          else
                require_once('views/login.php');
     }
     public function tuteurs_list()
     {
        if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
             $donnees= Admin::Get_all_tuteurs();

             $controller_report='superadmin'; 
             $fonction_back='interface_tuteur';

             require_once('views/superadmin/tuteurs_list.php');
           }
           else
              UsersController::deconnexion();
         }
         else
           require_once('views/login.php');
     }

     public function tutores_list()
     {
        if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
             $donnees= Admin::Get_all_tutores();

             $controller_report='superadmin'; 
             $fonction_back='interface_tutore';

             require_once('views/superadmin/tutores_list.php');
           }
           else
              UsersController::deconnexion();
         }
         else
           require_once('views/login.php');
     }
     public function tuteurs_belonging_list()
     {
        if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
             $donnees= Superadmin::All_selected_tuteurs();

             $controller_report='superadmin'; 
             $fonction_back='interface_tuteur';

             require_once('views/superadmin/tuteurs_belonging_list.php');
           }
           else
              UsersController::deconnexion();
         }
         else
           require_once('views/login.php');
     }
     public function tutores_belonging_list()
     {
        if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
             $donnees= Superadmin::All_selected_tutores();

             $controller_report='superadmin'; 
             $fonction_back='interface_tutore';

             require_once('views/superadmin/tutores_belonging_list.php');
           }
           else
              UsersController::deconnexion();
         }
         else
           require_once('views/login.php');
     }
     public function events()
     {
        if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
             $controller_report='superadmin'; 
             $fonction_back='interface_superadmin';

             require_once('views/superadmin/events.php');
           }
           else
              UsersController::deconnexion();
         }
         else
           require_once('views/login.php');
     } 
     public function future_events_list()
     {
       if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
            {
               $donnees= Evenements::Future_events_list_superadmin();

               $controller_report='superadmin'; 
               $fonction_back='events';

               require_once('views/superadmin/future_events_list.php');
             }
             else
              UsersController::deconnexion();
         }
         else
           require_once('views/login.php');
     }

     public function pasts_events_list()
     {
      if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
            {
               $donnees= Evenements::Pasts_events_list_superadmin();

               $controller_report='superadmin'; 
               $fonction_back='events';

               require_once('views/superadmin/pasts_events_list.php');
             }
             else
              UsersController::deconnexion();
         }
         else
           require_once('views/login.php');
     }
     
     public function set_event() // il s'agit de la vue de création ici, l'insertion se fait dans le controller evenement
     {
       if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
            {
               $type= htmlspecialchars($_GET['type']);

               $controller_report='superadmin'; 
               $fonction_back='interface_set_event';
               switch ($type) {
                 case 'VAUBAN':
                   $donnees= Tutorat::Get_specific_tutorat_list(8); // on récupère la liste des tutorats associés à ce type de tutorat
                   require_once('views/superadmin/superadmin_set_event.php');
                   break;
                 
                 case 'IMMERSION':
                   $donnees= Tutorat::Get_specific_tutorat_list(1); // on récupère la liste des tutorats associés à ce type de tutorat
                   require_once('views/superadmin/superadmin_set_event.php');
                   break;
                 case 'APSCO':
                   $donnees= Tutorat::Get_specific_tutorat_list(5); // on récupère la liste des tutorats associés à ce type de tutorat
                   require_once('views/superadmin/superadmin_set_event.php');
                   break;
                 case 'LYCEES':
                   $donnees= Tutorat::Get_specific_tutorat_list(6); // on récupère la liste des tutorats associés à ce type de tutorat
                   require_once('views/superadmin/superadmin_set_event.php');
                   break;
                 case 'COLLEGE':
                   $donnees= Tutorat::Get_specific_tutorat_list(7); // on récupère la liste des tutorats associés à ce type de tutorat
                   require_once('views/superadmin/superadmin_set_event.php');
                   break;
                 default:
                   require_once('views/superadmin/interface_set_event.php');
                   break;
               }
             }
             else
              UsersController::deconnexion();
           
         }
         else
           require_once('views/login.php');
     }
     
     public function modify_event()
       {
        if( isset($_SESSION['id_statut']) && $_SESSION['id_statut'] == 1)
          {   
             $id_e= htmlspecialchars($_POST['id_e']);
                          
      
           
             if( isset($_POST['modifier']))
             {
             $donnees= Tutorat::Get_tutorat($_SESSION['id_user']); // on récupère la liste des tutorats qu'il administre
             $tab= Evenements::Get_informations_on_events($id_e);
              
             $controller_report='superadmin';
             $fonction_back='events';

              require_once('views/admin/modify_event.php');
            }
            elseif( isset($_POST['consulter']))  // on va plutot consulter la liste des tuteurs inscrits pour cet évènement
            {
              $donnees = Evenements::Subscription_list($id_e); // on récupère la liste des participants

              $data= Evenements::Get_informations_on_events($id_e);  // on récupère la date, le. lieu etc sur l'évenement

              $controller_report='superadmin';
              $fonction_back='future_events_list';
               
              require_once('views/superadmin/subscription_list.php');
            }
            elseif( isset($_POST['supprimer']))  // on va plutot supprimer cet évènement
            {
               Evenements::Delete_event($_SESSION['id_user'],$id_e); // on supprime
       
               SuperadminController::future_events_list();
            
            }
            
       
          }
            else
                require_once('views/login.php');
       }

       public static function show_informations()
        {
          if( isset($_SESSION['id_statut']) )
           {
             $id_u= htmlspecialchars($_POST['id_u']);
             $id_e_c= htmlspecialchars($_POST['id_e_c']);
         
            
                 
               if( isset($_POST['consulter']))
               {
                 $data= Users::Get_info($id_u); // on récupère les info du user en question

                 $donnees = Evenements::Get_past_events($id_u); // on récupère les évènements que le tuteur a effectué 

                 $controller_report='superadmin';
                 $fonction_back='events';

              
                 require_once('views/superadmin/show_informations.php');
                }
          
              elseif(isset($_POST['rompre']))
              {
          
                  $event= new Evenements();
                  $event->Cancel_participation($id_u,$id_e_c);
                  if( $_POST['statut'] == 'TUTEUR')
                  $event->updateNombrePlaces($id_e_c,1);
                  else
                    Evenements::Update_nbplacesTutores($id_e_c,-1); // on met à jour le nombre de tutorés inscrits

                  $donnees = Evenements::Subscription_list($d_e_c); // on récupère la liste des participants

                  $data= Evenements::Get_informations_on_events($id_e_c);  // on récupère la date, le. lieu etc sur l'évenement

                  $controller_report='superadmin';
                  $fonction_back='future_events_list';

                  require_once('views/superadmin/subscription_list.php');
            
   
              }
             
             else 
                  require_once('views/login.php');
           }
           else
              require_once('views/login.php');
        }

     public static function future_subscription_list()
      {
         if( isset($_SESSION['id_statut']) )
         {
       $id_e= htmlspecialchars($_POST['id_e']);
       
          if( $_SESSION['id_statut'] == 1 )
            {
              $donnees = Evenements::Subscription_list($id_e); // on récupère la liste des participants
              $data= Evenements::Get_informations_on_events($id_e);  // on récupère la date, le. lieu etc sur l'évenement
              $controller_report='superadmin';
              $fonction_back='future_events_list';

              require_once('views/superadmin/subscription_list.php');
            }
            else
              UsersController::deconnexion();
         }    
         else
            require_once('views/login.php');
      }

     public static function pasts_subscription_list()
      {
         if( isset($_SESSION['id_statut']) )
         {
       $id_e= htmlspecialchars($_POST['id_e']);
       
            if( $_SESSION['id_statut'] == 1 )
            {
              $donnees = Evenements::Subscription_list($id_e); // on récupère la liste des participants
              $data= Evenements::Get_informations_on_events($id_e);  // on récupère la date, le. lieu etc sur l'évenement
              $controller_report='superadmin';
              $fonction_back='pasts_events_list';

              require_once('views/superadmin/subscription_list.php');
            }
            else
              UsersController::deconnexion();
         }    
         else
            require_once('views/login.php');
      }

     public function create_center()  // il s'agit de la vue de création d'un centre
     {
       if( isset($_SESSION['id_statut']) )
       {
          $donnees=Tutorat::Get_all_type_tutorat();  // on charge l'interface de création de tutorat

          $controller_report='superadmin';
          $fonction_back='interface_tutorat';

          require_once('views/superadmin/create_tutorat_center.php');
       }
        else
          require_once('views/login.php');
     }

     public function create_type_center()  // il s'agit de la vue de création d'un centre
     {
       if( isset($_SESSION['id_statut']))
       {
          
          $controller_report='superadmin';
          $fonction_back='interface_tutorat';

          require_once('views/superadmin/create_typeTutorat_center.php');
       }
        else
          require_once('views/login.php');
     }

     public function tutorat_center_list() // liste des tous les tutorats 
     {
       if( isset($_SESSION['id_statut']))
       {
          $donnees= Tutorat::Get_all_tutorat();

          $controller_report='superadmin';
          $fonction_back='interface_tutorat';
          
          require_once('views/superadmin/tutorat_center_list.php');
       }
       else
          require_once('views/login.php');
     }

     public function typeTutorat_center_list() // liste des tous les tutorats 
     {
       if( isset($_SESSION['id_statut']))
       {
          $donnees= Tutorat::Get_all_type_tutorat();

          $controller_report='superadmin';
          $fonction_back='interface_tutorat';
          
          require_once('views/superadmin/typeTutorat_center_list.php');
       }
       else
          require_once('views/login.php');
     }

     public function admin_tutorat_list() // liste des administrateurs de tutorat
     {
       if(isset($_SESSION['id_statut']))
       {
          $donnees= Tutorat::Get_all_trueAdmin_tutorat(); 

          $controller_report='superadmin';
          $fonction_back='interface_tutorat';
          
          require_once('views/superadmin/admin_center_list.php');
       }
       else
          require_once('views/login.php');
     }

     public function create_account() // il s'agit de la vue de création ici, l'insertion se fait dans le controller evenement
     {
       if( isset($_SESSION['id_statut']))
         {
           $type= htmlspecialchars($_GET['type']);

           $controller_report='superadmin'; 
           $fonction_back='interface_account_creation';

         switch ($type) {
             case 'VAUBAN':
               $donnees= Tutorat::Get_specific_tutorat_list(8); // on récupère la liste des tutorats associés à ce type de tutorat
               require_once('views/superadmin/create_account.php'); 
               break;
             case 'IMMERSION':
               $donnees= Tutorat::Get_specific_tutorat_list(1); // on récupère la liste des tutorats associés à ce type de tutorat
               require_once('views/superadmin/create_account.php');
               break;
             case 'APSCO':
               $donnees= Tutorat::Get_specific_tutorat_list(5); // on récupère la liste des tutorats associés à ce type de tutorat
               require_once('views/superadmin/create_account.php');
               break;
             case 'LYCEES':
               $donnees= Tutorat::Get_specific_tutorat_list(6); // on récupère la liste des tutorats associés à ce type de tutorat
               require_once('views/superadmin/create_account.php');
               break;
             case 'COLLEGE':
               $donnees= Tutorat::Get_specific_tutorat_list(7); // on récupère la liste des tutorats associés à ce type de tutorat
               require_once('views/superadmin/create_account.php');
               break;
             case 'MEF':
               $donnees= Tutorat::Get_specific_tutorat_list(4); // on récupère la liste des tutorats associés à ce type de tutorat
               require_once('views/superadmin/create_account.php');
               break;
             default:
               require_once('views/superadmin/interface_account_creation.php');
               break;
           }
           
         }
         else
           require_once('views/login.php');
     }

     public function account_affectation() // tracabilité sur les utilisateurs des comptes admin
     {
      if( isset($_SESSION['id_statut']))
         {
           $donnees= Admin::Get_all_tuteurs($_SESSION['id_user']);
           $data= Tutorat::Get_available_account();

           $controller_report='superadmin'; 
           $fonction_back='interface_tutorat';

           require_once('views/superadmin/admin_affectation.php');
         }
         else
           require_once('views/login.php');
     }
     public function static_account()
     {
      if( isset($_SESSION['id_statut']))
         {
           
           $donnees= Tutorat::Get_static_account();
          
           $controller_report='superadmin'; 
           $fonction_back='interface_tutorat';

           require_once('views/superadmin/static_account.php');
         }
         else
           require_once('views/login.php');
     }

     public static function working_account()
     {
       if( isset($_SESSION['id_statut']))
       { 
       $id_u= htmlspecialchars($_POST['id_u']);
       
         $donnees= Tutorat::Get_working_account($_POST['id_u']);
         $data= Users::Get_admin($_POST['id_u']); // on récupère les informations de ce compte admin

         $controller_report='superadmin'; 
         $fonction_back='interface_tutorat';

         require_once('views/superadmin/working_account.php');
       }
         else
           require_once('views/login.php');
     }

     public function show_associated_tutorat()
     {
       if( isset($_SESSION['id_statut']))
         {
             $id_admin= htmlspecialchars($_POST['id_admin']);
             $id_type= htmlspecialchars($_POST['id_type']);
             
        
             if(isset($_POST['retirer']))
             {
              Tutorat::Delete_affectation($id_admin);

              require_once('views/superadmin/interface_tutorat.php');
             }
             else if(isset($_POST['supprimer']))
             {

                if(Tutorat::Delete_static_account($id_type,$id_admin) == 1)
                  require_once('views/superadmin/interface_tutorat.php');
                else
                {
                  $controller_report='superadmin'; 
                  $fonction_back='static_account';

                  $message= 'tentative de suppression du compte associé à ce type de tutorat: opération impossible';
                  require_once('views/system/error.php');
                }
             }
             else
             {
               $donnees= Tutorat::Get_tutorat($id_admin); // on récupère la liste des tutorats associiés à ce compte statique admin
               $data= Users::Get_admin($id_admin); // on récupère les informations de ce compte admin
               $res= Tutorat::Get_available_tutorat($id_type); // on récupère la liste des tutorats qui ne sont pas encore affectés

               $controller_report='superadmin'; 
               $fonction_back='static_account';

               require_once('views/superadmin/associated_tutorat.php');
             }
      
          }
         else
           require_once('views/login.php');
     }

     public function update_password() // interface pour mettre à jour le mot de passe d'un compte statique admin
     {
       if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
       {  
          $id_admin= htmlspecialchars($_POST['id_admin']);
          Users::update_password($id_admin);
          SuperadminController::static_account();   
       }
       else
        require_once('views/login.php');
     }

     public function validated_hours() // liste des tuteurs et du cumul de leurs heures sur la période
     {
      if(isset($_SESSION['id_statut']) )// on vérifie que seul un utilisateur connecté peut accéder à ces pages
      { 
        if( $_SESSION['id_statut'] == 1)
        {
          $donnees= Users::Get_unpaidHours_tuteurs(); // liste des tuteurs qui ont des heures impayees 
          
          $controller_report='superadmin'; 
          $fonction_back='interface_hours';

          require_once('views/superadmin/validated_history.php');
        }
        else
          UsersController::deconnexion();
      }
      else
        require_once('views/Login.php');
     }

     public function validatedHours_history()  // détails sur les  evenements validés en fonction des tuteurs
     {
      if(isset($_SESSION['id_statut']) )// on vérifie que seul un utilisateur connecté peut accéder à ces pages
      { 
          $id_u= htmlspecialchars($_POST['id_u']);
    
        if( $_SESSION['id_statut'] == 1 )
        {
          $donnees= Evenements::Get_validated_events($id_u); // liste des tuteurs qui ont déja été payé au moins une fois

          $controller_report='superadmin'; 
          $fonction_back='validated_hours';

          require_once('views/superadmin/hours_history.php');
        }
        else
          UsersController::deconnexion();
      }
      else 
        require_once('views/Login.php');
     }

     public function paidHours_history()  // détails sur les evenements validés et payés en fonction des tuteurs
     {
      if(isset($_SESSION['id_statut']) )// on vérifie que seul un utilisateur connecté peut accéder à ces pages
      { 
        $id_u= htmlspecialchars($_POST['id_u']);
        if( $_SESSION['id_statut'] == 1 )
        {
          $donnees= Evenements::Get_paid_events($id_u); // liste des tuteurs qui ont déja été payé au moins une fois

          $controller_report='superadmin'; 
          $fonction_back='paid_hours';

          require_once('views/superadmin/hours_history.php');
        }
        else
          UsersController::deconnexion();
      }
      else 
        require_once('views/login.php');
     }

     public function paid_hours()  // HISTORIQUE des evenements validés et payés en fonction des tuteurs
     {
      if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
      { 
        if( $_SESSION['id_statut'] == 1)
        {
          $donnees= Users::Get_paidHours_tuteurs(); // liste des tuteurs et de leurs heures deja payées

          $controller_report='superadmin'; 
          $fonction_back='interface_hours';

          require_once('views/superadmin/paid_history.php');
        }
        else
          UsersController::deconnexion();
      }
      else 
        require_once('views/login.php');
     }
     public function search()
      {
        if (isset($_SESSION['id_user'])) 
        {
          require_once('views/superadminSearch.php');
        }
        else
          require_once('views/login.php');

      }

public  function export() // fonction d'exportation fichier excel
  {
    if (isset($_SESSION['id_user'])) {
        $donnees = Users::Get_unpaidHours_tuteurs();
       
      // Evenements::payUnpaidHours(); // on passe la liste des évènements impayés à payer

        set_include_path( get_include_path().PATH_SEPARATOR."..");
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
        error_reporting(E_ALL & ~E_NOTICE);

        $today = date("Y-m-d");
        $filename = "Export".$today.".xlsx";
        header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');


      $header = array('Nom du user'=>'string','Prénom'=>'string','Email'=>'string','phone'=>'string','ville'=>'string','adresse'=>'string','code_postal'=>'string','Nombre d\'heures'=>'string'
      );

        $data1 = [];
        foreach($donnees as $data)
          { 
            $data1 [] = array($data['user']->getNom(),$data['user']->getPrenom(),$data['user']->getEmail(),$data['user']->getPhone(),$data['user']->getVille(),$data['user']->getAdress(),$data['user']->getCode_postal(),$data['heure'],);
          }
        $writer = new XLSXWriter();
        $writer->writeSheetHeader('Sheet1', $header);
        foreach($data1 as $row){
          $writer->writeSheetRow('Sheet1', $row);
        }
        $writer->writeToFile($filename);

        //$writer->writeToStdOut();
      //include_once('PHP_XLSXWriter-master/examples/ex00-simple.php');
      $this->validated_hours();
    }
    else{
        echo "échec d'exportation de données";
    }
  }
    
 public static function contact()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                { 
                    $data= Users::Get_all_contact_admin($_SESSION['id_user']); // on récupère le contact de tous les admin du site(ceux qui en ont la gestion)
                    require_once('views/superadmin/contacter.php');
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

                $controller_report='superadmin';
                $fonction_back='contact';
          
                require_once('views/mail_send_ok.php');
        }
        else
                require_once('views/login.php');
      }   


}