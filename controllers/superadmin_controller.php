<?php

require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/admin.php');
require_once('models/superadmin.php');
require_once('models/tutorat.php');
require_once('controllers/users_controller.php');
include_once ("PHP_XLSXWriter-master/xlsxwriter.class.php");


/* Définition du controller */
class SuperadminController
{

     public function interface_superadmin()
       {
            if( isset($_SESSION['id_statut']))
            {
              if($_SESSION['id_statut']== 1)
                set_route('views/superadmin/interface_superadmin.php');
              else if($_SESSION['id_statut']== 26)
                set_route('views/admin/gestion/interface_gestionnaire.php');
              else 
                UsersController::deconnexion();
            }
            else
                set_route('views/Login.php');
       }
     public function interface_tutore()
     {
           if( isset($_SESSION['id_statut']) )
            {
                if( $_SESSION['id_statut'] == 1)
                   set_route('views/superadmin/interface_tutore.php');
                else
                   UsersController::deconnexion();
            }
            else
                set_route('views/Login.php');
     }
     public function interface_tuteur()
     {
           if( isset($_SESSION['id_statut']) )
            {
              if( $_SESSION['id_statut'] == 1)
                set_route('views/superadmin/interface_tuteur.php');
              else
              UsersController::deconnexion();
            }
            else
                set_route('views/Login.php');
     } 

     public function interface_tutorat()  
     {
         if( isset($_SESSION['id_statut']))
         {

            set_controller_report('superadmin'); 
            set_fonction_back('interface_superadmin');

                set_route('views/superadmin/interface_tutorat.php');
         }
          else
                set_route('views/Login.php');
     }
     public function interface_set_event()  
     {
         if( isset($_SESSION['id_statut'])  )
         {
            if( $_SESSION['id_statut'] == 1)
            {
              set_donnees(Tutorat::Get_all_type_tutorat());  // on charge l'interface de création de tutorat 
              
              set_controller_report('superadmin'); 
              set_fonction_back('interface_superadmin');

                  set_route('views/superadmin/interface_set_event.php');
            }
            else
                UsersController::deconnexion();
         }
          else
                set_route('views/Login.php');
     }
     public function interface_account_creation()  
     {
         if( isset($_SESSION['id_statut']) )
         {
            if( $_SESSION['id_statut'] == 1)
            {
              set_donnees(Tutorat::Get_all_type_tutorat());  // on charge l'interface de création de tutorat
              set_controller_report('superadmin'); 
              set_fonction_back('interface_tutorat');

                  set_route('views/superadmin/interface_account_creation.php');
            }
            else
                UsersController::deconnexion();
         }
          else
                set_route('views/Login.php');
     }
     public function interface_hours()  
     {
         if( isset($_SESSION['id_statut']) )
         {
            if( $_SESSION['id_statut'] == 1)
            {
              set_controller_report('superadmin'); 
              set_fonction_back('interface_tutorat');

                  set_route('views/superadmin/interface_hours.php');
            }
            else
                UsersController::deconnexion();

         }
          else
                set_route('views/Login.php');
     }
     public function tuteurs_list()
     {
        if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
             set_donnees(Admin::Get_all_tuteurs());

             set_controller_report('superadmin'); 
             set_fonction_back('interface_tuteur');

             set_route('views/superadmin/tuteurs_list.php');
           }
           else
              UsersController::deconnexion();
         }
         else
           set_route('views/Login.php');
     }

     public function tutores_list()
     {
        if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
          {
             set_donnees(Admin::Get_all_tutores());

             set_controller_report('superadmin'); 
             set_fonction_back('interface_tutore');

             set_route('views/superadmin/tutores_list.php');
           }
           else
              UsersController::deconnexion();
         }
         else
           set_route('views/Login.php');
     }
     public function tuteurs_belonging_list()
     {
        if( isset($_SESSION['id_statut']) )
         {
            if( $_SESSION['id_statut'] == 1)
            {
              set_donnees(Superadmin::All_selected_tuteurs());

              set_controller_report('superadmin'); 
              set_fonction_back('interface_tuteur');

              set_route('views/superadmin/tuteurs_belonging_list.php');
            }
            else
                UsersController::deconnexion();
         }
         else
           set_route('views/Login.php');
     }
     public function tutores_belonging_list()
     {
        if( isset($_SESSION['id_statut']) )
         {
            if( $_SESSION['id_statut'] == 1)
            {
              set_donnees(Superadmin::All_selected_tutores());

              set_controller_report('superadmin'); 
              set_fonction_back('interface_tutore');

              set_route('views/superadmin/tutores_belonging_list.php');
            }
            else
                UsersController::deconnexion();
         }
         else
           set_route('views/Login.php');
     }
     public function events()
     {
        if( isset($_SESSION['id_statut']) )
         {
            if( $_SESSION['id_statut'] == 1)
            {
              set_controller_report('superadmin'); 
              set_fonction_back('interface_superadmin');

              set_route('views/superadmin/events.php');
            }
            else
                UsersController::deconnexion();
         }
         else
           set_route('views/Login.php');
     } 
     public function future_events_list()
     {
       if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
            {
               set_donnees(Evenements::Future_events_list_superadmin());

               set_controller_report('superadmin'); 
               set_fonction_back('events');

               set_route('views/superadmin/future_events_list.php');
             }
             else
              UsersController::deconnexion();
         }
         else
           set_route('views/Login.php');
     }

     public function pasts_events_list()
     {
      if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
            {
               set_donnees(Evenements::Pasts_events_list_superadmin());

               set_controller_report('superadmin'); 
               set_fonction_back('events');

               set_route('views/superadmin/pasts_events_list.php');
             }
             else
              UsersController::deconnexion();
         }
         else
           set_route('views/Login.php');
     }
     
     public function set_event() // il s'agit de la vue de création ici, l'insertion se fait dans le controller evenement
     {
       if( isset($_SESSION['id_statut']) )
         {
          if( $_SESSION['id_statut'] == 1)
            {
               $id= htmlspecialchars($_GET['id']);

               set_controller_report('superadmin'); 
               set_fonction_back('interface_set_event');
               
                 
                   set_donnees(Tutorat::Get_specific_tutorat_list($id)); // on récupère la liste des tutorats associés à ce type de tutorat
                   if($donnees != 0)
                   {
                      set_route('views/superadmin/superadmin_set_event.php');
                   }
                   else
                   {
                    $message = 'aucun tutorat associé à ce type, la création d\'évènement n\'est pas possible dans l\'état actuel,
                    veuillez créer dans la rubrique tutorat un un centre associé à ce type de tutorat';
                    
                    set_route('views/system/error.php');
                   }
    
             }
             else
              UsersController::deconnexion();
           
         }
         else
           set_route('views/Login.php');
     }
     
     public function modify_event()
       {
        if( isset($_SESSION['id_statut']) && $_SESSION['id_statut'] == 1)
          {   
             $id_e= htmlspecialchars($_POST['id_e']);
                          
      
           
             if( isset($_POST['modifier']))
             {
             set_donnees(Tutorat::Get_tutorat($_SESSION['id_user'])); // on récupère la liste des tutorats qu'il administre
             $tab= Evenements::Get_informations_on_events($id_e);
              
             set_controller_report('superadmin');
             set_fonction_back('events');

              set_route('views/admin/modify_event.php');
            }
            elseif( isset($_POST['consulter']))  // on va plutot consulter la liste des tuteurs inscrits pour cet évènement
            {
              set_donnees(Evenements::Subscription_list($id_e)); // on récupère la liste des participants

              $data= Evenements::Get_informations_on_events($id_e);  // on récupère la date, le. lieu etc sur l'évenement

              set_controller_report('superadmin');
              set_fonction_back('future_events_list');
               
              set_route('views/superadmin/subscription_list.php');
            }
            elseif( isset($_POST['supprimer']))  // on va plutot supprimer cet évènement
            {
               Evenements::Delete_event($_SESSION['id_user'],$id_e); // on supprime
       
               SuperadminController::future_events_list();
            
            }
            
       
          }
            else
                set_route('views/Login.php');
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

                 set_donnees(Evenements::Get_past_events($id_u)); // on récupère les évènements que le tuteur a effectué 

                 set_controller_report('superadmin');
                 set_fonction_back('events');

              
                 set_route('views/superadmin/show_informations.php');
                }
          
              elseif(isset($_POST['rompre']))
              {
          
                  $event= new Evenements();
                  $event->Cancel_participation($id_u,$id_e_c);
                  if( $_POST['statut'] == 'TUTEUR')
                  $event->updateNombrePlaces($id_e_c,1);
                  else
                    Evenements::Update_nbplacesTutores($id_e_c,-1); // on met à jour le nombre de tutorés inscrits

                  set_donnees(Evenements::Subscription_list($d_e_c)); // on récupère la liste des participants

                  $data= Evenements::Get_informations_on_events($id_e_c);  // on récupère la date, le. lieu etc sur l'évenement

                  set_controller_report('superadmin');
                  set_fonction_back('future_events_list');

                  set_route('views/superadmin/subscription_list.php');
            
   
              }
             
             else 
                  set_route('views/Login.php');
           }
           else
              set_route('views/Login.php');
        }

     public static function future_subscription_list()
      {
         if( isset($_SESSION['id_statut']) )
         {
       $id_e= htmlspecialchars($_POST['id_e']);
       
          if( $_SESSION['id_statut'] == 1 )
            {
              set_donnees(Evenements::Subscription_list($id_e)); // on récupère la liste des participants
              $data= Evenements::Get_informations_on_events($id_e);  // on récupère la date, le. lieu etc sur l'évenement
              set_controller_report('superadmin');
              set_fonction_back('future_events_list');

              set_route('views/superadmin/subscription_list.php');
            }
            else
              UsersController::deconnexion();
         }    
         else
            set_route('views/Login.php');
      }

     public static function pasts_subscription_list()
      {
         if( isset($_SESSION['id_statut']) )
         {
       $id_e= htmlspecialchars($_POST['id_e']);
       
            if( $_SESSION['id_statut'] == 1 )
            {
              set_donnees(Evenements::Subscription_list($id_e)); // on récupère la liste des participants
              $data= Evenements::Get_informations_on_events($id_e);  // on récupère la date, le. lieu etc sur l'évenement
              set_controller_report('superadmin');
              set_fonction_back('pasts_events_list');

              set_route('views/superadmin/subscription_list.php');
            }
            else
              UsersController::deconnexion();
         }    
         else
            set_route('views/Login.php');
      }

     public function create_center()  // il s'agit de la vue de création d'un centre
     {
       if( isset($_SESSION['id_statut']) )
       {
          set_donnees(Tutorat::Get_all_type_tutorat());  // on charge l'interface de création de tutorat

          set_controller_report('superadmin');
          set_fonction_back('interface_tutorat');

          set_route('views/superadmin/create_tutorat_center.php');
       }
        else
          set_route('views/Login.php');
     }

     public function create_type_center()  // il s'agit de la vue de création d'un centre
     {
       if( isset($_SESSION['id_statut']))
       {
          
          set_controller_report('superadmin');
          set_fonction_back('interface_tutorat');

          set_route('views/superadmin/create_typeTutorat_center.php');
       }
        else
          set_route('views/Login.php');
     }

     public function tutorat_center_list() // liste des tous les tutorats 
     {
       if( isset($_SESSION['id_statut']))
       {
          set_donnees(Tutorat::Get_all_tutorat());

          set_controller_report('superadmin');
          set_fonction_back('interface_tutorat');
          
          set_route('views/superadmin/tutorat_center_list.php');
       }
       else
          set_route('views/Login.php');
     }

     public function typeTutorat_center_list() // liste des tous les tutorats 
     {
       if( isset($_SESSION['id_statut']))
       {
          set_donnees(Tutorat::Get_all_type_tutorat());

          set_controller_report('superadmin');
          set_fonction_back('interface_tutorat');
          
          set_route('views/superadmin/typeTutorat_center_list.php');
       }
       else
          set_route('views/Login.php');
     }

     public function admin_tutorat_list() // liste des administrateurs de tutorat
     {
       if(isset($_SESSION['id_statut']))
       {
          set_donnees(Tutorat::Get_all_trueAdmin_tutorat()); 

          set_controller_report('superadmin');
          set_fonction_back('interface_tutorat');
          
          set_route('views/superadmin/admin_center_list.php');
       }
       else
          set_route('views/Login.php');
     }

     public function create_account() // il s'agit de la vue de création ici, l'insertion se fait dans le controller evenement
     {
       if( isset($_SESSION['id_statut']))
         {
           $id= htmlspecialchars($_GET['id']);

           set_controller_report('superadmin'); 
           set_fonction_back('interface_account_creation');

        
               set_donnees(Tutorat::Get_specific_tutorat_list($id)); // on récupère la liste des tutorats associés à ce type de tutorat
               if($donnees != 0)
                  set_route('views/superadmin/create_account.php'); 
                else
                {
                  $message = 'aucun tutorat associé à ce type, la création d\'évènement n\'est pas possible dans l\'état actuel,
                    veuillez créer dans la rubrique tutorat un un centre associé à ce type de tutorat';
                    
                    set_route('views/system/error.php');
                }
             
           }
           else
           set_route('views/Login.php');
           
         }

     public function account_affectation() // tracabilité sur les utilisateurs des comptes admin
     {
      if( isset($_SESSION['id_statut']))
         {
           set_donnees(Admin::Get_all_tuteurs($_SESSION['id_user']));
           $data= Tutorat::Get_available_account();

           set_controller_report('superadmin'); 
           set_fonction_back('interface_tutorat');

           set_route('views/superadmin/admin_affectation.php');
         }
         else
           set_route('views/Login.php');
     }

     public function static_account()
     {
      if( isset($_SESSION['id_statut']))
         {
           
           set_donnees(Tutorat::Get_static_account());
          
           set_controller_report('superadmin'); 
           set_fonction_back('interface_tutorat');

           set_route('views/superadmin/static_account.php');
         }
         else
           set_route('views/Login.php');
     }

     public static function working_account()
     {
       if( isset($_SESSION['id_statut']))
       { 
       $id_u= htmlspecialchars($_POST['id_u']);
       
         set_donnees(Tutorat::Get_working_account($_POST['id_u']));
         $data= Users::Get_admin($_POST['id_u']); // on récupère les informations de ce compte admin

         set_controller_report('superadmin'); 
         set_fonction_back('interface_tutorat');

         set_route('views/superadmin/working_account.php');
       }
         else
           set_route('views/Login.php');
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

              set_route('views/superadmin/interface_tutorat.php');
             }
             else if(isset($_POST['supprimer']))
             {

                if(Tutorat::Delete_static_account($id_type,$id_admin) == 1)
                  set_route('views/superadmin/interface_tutorat.php');
                else
                {
                  set_controller_report('superadmin'); 
                  set_fonction_back('static_account');

                  $message= 'tentative de suppression du compte associé à ce type de tutorat: opération impossible';
                  set_route('views/system/error.php');
                }
             }
             else
             {
               set_donnees(Tutorat::Get_tutorat($id_admin)); // on récupère la liste des tutorats associiés à ce compte statique admin
               $data= Users::Get_admin($id_admin); // on récupère les informations de ce compte admin
               $res= Tutorat::Get_available_tutorat($id_type); // on récupère la liste des tutorats qui ne sont pas encore affectés

               set_controller_report('superadmin'); 
               set_fonction_back('static_account');

               set_route('views/superadmin/associated_tutorat.php');
             }
      
          }
         else
           set_route('views/Login.php');
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
        set_route('views/Login.php');
     }

     public function validated_hours() // liste des tuteurs et du cumul de leurs heures sur la période
     {
      if(isset($_SESSION['id_statut']) )// on vérifie que seul un utilisateur connecté peut accéder à ces pages
      { 
        if( $_SESSION['id_statut'] == 1)
        {
          set_donnees(Users::Get_unpaidHours_tuteurs()); // liste des tuteurs qui ont des heures impayees 
          
          set_controller_report('superadmin'); 
          set_fonction_back('interface_hours');

          set_route('views/superadmin/validated_history.php');
        }
        else
          UsersController::deconnexion();
      }
      else
        set_route('views/Login.php');
     }

     public function validatedHours_history()  // détails sur les  evenements validés en fonction des tuteurs
     {
      if(isset($_SESSION['id_statut']) )// on vérifie que seul un utilisateur connecté peut accéder à ces pages
      { 
          
    
        if( $_SESSION['id_statut'] == 1 )
        {
          $id_u= htmlspecialchars($_POST['id_u']);
          set_donnees(Evenements::Get_validated_events($id_u)); // liste des tuteurs qui ont déja été payé au moins une fois

          set_controller_report('superadmin'); 
          set_fonction_back('validated_hours');

          set_route('views/superadmin/hours_history.php');
        }
        else
          UsersController::deconnexion();
      }
      else 
        set_route('views/Login.php');
     }

     public function paidHours_history()  // détails sur les evenements validés et payés en fonction des tuteurs
     {
      if(isset($_SESSION['id_statut']) )// on vérifie que seul un utilisateur connecté peut accéder à ces pages
      { 
        
        if( $_SESSION['id_statut'] == 1 )
        {
          $id_u= htmlspecialchars($_POST['id_u']);

          set_donnees(Evenements::Get_paid_events($id_u)); // liste des tuteurs qui ont déja été payé au moins une fois

          set_controller_report('superadmin'); 
          set_fonction_back('paid_hours');

          set_route('views/superadmin/hours_history.php');
        }
        else
          UsersController::deconnexion();
      }
      else 
        set_route('views/Login.php');
     }

     public function paid_hours()  // HISTORIQUE des evenements validés et payés en fonction des tuteurs
     {
      if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
      { 
        if( $_SESSION['id_statut'] == 1)
        {
          set_donnees(Users::Get_paidHours_tuteurs()); // liste des tuteurs et de leurs heures deja payées

          set_controller_report('superadmin'); 
          set_fonction_back('interface_hours');

          set_route('views/superadmin/paid_history.php');
        }
        else
          UsersController::deconnexion();
      }
      else 
        set_route('views/Login.php');
     }
     public function search()
      {
        if (isset($_SESSION['id_user'])) 
        {
          set_route('views/superadminSearch.php');
        }
        else
          set_route('views/Login.php');

      }

public  function export() // fonction d'exportation fichier excel
  {
    if (isset($_SESSION['id_user'])) {
        set_donnees(Users::Get_unpaidHours_tuteurs());
       
        Evenements::payUnpaidHours(); // on passe la liste des évènements impayés à payer

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
        $this->validated_hours();
    }
  }
    
 public static function contact()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
                { 
                    $data= Users::Get_all_contact_admin($_SESSION['id_user']); // on récupère le contact de tous les admin du site(ceux qui en ont la gestion)
                    set_route('views/superadmin/contacter.php');
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
                $mailAccount = 'superadmin@tutorat-yncrea.fr';
                
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

                set_controller_report('superadmin');
                set_fonction_back('contact');
          
                set_route('views/mail_send_ok.php');
        }
        else
                set_route('views/Login.php');
      }   


}