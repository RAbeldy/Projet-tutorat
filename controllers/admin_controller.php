<?php

require_once('models/evenements.php');
require_once('models/tutores.php');
require_once('models/tuteurs.php');
require_once('models/users.php');
require_once('models/admin.php');
require_once('models/tutorat.php');
require_once('controllers/users_controller.php');




/* Définition du controller */
class AdminController
{

     public function interface_admin()
     {
            if( isset($_SESSION['id_statut']))
            {
                switch ($_SESSION['statut']) 
                {
                   case 'MEF':
                      require_once('views/admin/mef/interface_admin_mef.php');
                    break;
                    case 'IMMERSION':
                      require_once('views/admin/immersion/interface_admin.php');
                    break;
                    case 'PERSONNALISE':
                      require_once('views/admin/personnalise/interface_admin.php');
                    break;
                    case 'ADMIN_GESTION':
                      require_once('views/admin/gestion/interface_gestionnaire.php');
                    break;
                    default:
                      require_once('views/admin/interface_admin.php'); // interface_admin
                    break;
                }  
            }
            else
                UsersController::deconnexion();
       }
      
       public function events()
       {
          if( isset($_SESSION['id_statut']))
            { 
                $controller_report='admin';
                $fonction_back='interface_admin';
                require_once('views/admin/events.php');
            }
          else
                UsersController::deconnexion();
       }
       public function admin_set_event()
       {
          if( isset($_SESSION['id_statut']))
          {    
             $donnees= Tutorat::Get_tutorat($_SESSION['id_user']); // on récupère la liste des tutorats qu'il administre
              
             $controller_report='admin';
             $fonction_back='events';

              require_once('views/admin/admin_set_event.php');
          }
            else
                UsersController::deconnexion();
       }

       public function modify_event()
       {
        if( isset($_SESSION['id_statut']))
          {  
           $id_e = htmlspecialchars($_POST['id_e']);
    
            
           if( isset($_POST['modifier']))
           {
             //$donnees= Tutorat::Get_tutorat($_SESSION['id_user']); // on récupère la liste des tutorats qu'il administre
             $tab= Evenements::Get_informations_on_events($id_e);
              
             $controller_report='admin';
             $fonction_back='events';

             require_once('views/admin/modify_event.php');
            }
            elseif( isset($_POST['consulter']))  // on va plutot consulter la liste des tuteurs inscrits pour cet évènement
            {
              $donnees = Evenements::Subscription_list($id_e); // on récupère la liste des participants

              $data= Evenements::Get_informations_on_events($id_e);  // on récupère la date, le. lieu etc sur l'évenement

              $controller_report='admin';
              $fonction_back='future_events_list';

               if( preg_match('#PERSONNALISE#', $_SESSION['statut']) )
                  require_once('views/admin/personnalise/subscription_list.php');
              else
                 require_once('views/admin/subscription_list.php');
            }
            elseif( isset($_POST['supprimer']))  // on va plutot supprimer cet évènement
            {
               Evenements::Delete_event($_SESSION['id_user'],$id_e); // on supprime
       
               AdminController::future_events_list();
            
            }
            elseif( isset($_POST['imprimer']))  // on va plutot supprimer cet évènement
            {
             $header= array('tutorat','date','adresse','nombre de places','duree');
             $path="http://localhost:8888/tests/steve/PDF/future_events_list.txt";
             

              AdminController::export(); 
   
           //AdminController::future_events_list();
        
            }
         }
       
            else
                UsersController::deconnexion();
       
          }
            

       public static function future_events_list()
       {
          if( isset($_SESSION['id_statut']))
          { 
            
           if(preg_match('#IMMERSION#', $_SESSION['statut'])) 
            {
                  $donnees = Evenements::Future_events_list($_SESSION['id_user']);
                 
                  $controller_report='admin';
                  $fonction_back='events';

                require_once('views/admin/immersion/future_events_list_immerssion.php');
             }
             elseif(preg_match('#PERSONNALISE#', $_SESSION['statut'])) 
            {
                
                $donnees = Evenements::Future_events_list_admin($_SESSION['id_user']);

                $controller_report='admin';
                $fonction_back='interface_admin';

                require_once('views/admin/personnalise/future_events_list.php');
              }
              elseif(preg_match('#MEF#', $_SESSION['statut'])) 
              {
                
                  $donnees = Evenements::Future_events_list_admin($_SESSION['id_user']);

                $controller_report='admin';
                $fonction_back='events';

                require_once('views/admin/personnalise/future_events_list.php');
              }
              else
              {
                  $donnees = Evenements::Future_events_list($_SESSION['id_user']);
                  $controller_report='admin';
                 $fonction_back='events';
                require_once('views/admin/future_events_list.php');
              }
          }

          else
            UsersController::deconnexion();
      }

    public static function pasts_events_list()
    {
        if( isset($_SESSION['id_statut']))
        {
          if(preg_match('#IMMERSION#', $_SESSION['statut'])) 
            {
                $donnees = Evenements::Pasts_events_list($_SESSION['id_user']);
                
                $controller_report='admin';
                $fonction_back='interface_admin';

                require_once('views/admin/immersion/pasts_events_list_immerssion.php');
            }
            elseif(preg_match('#PERSONNALISE#', $_SESSION['statut'])) 
            {
                $donnees = Evenements::Pasts_events_list_admin($_SESSION['id_user']);
                
                $controller_report='admin';
                $fonction_back='interface_admin';

                require_once('views/admin/personnalise/pasts_events_list.php');
            }
            elseif(preg_match('#MEF#', $_SESSION['statut'])) 
            {
                $donnees = Evenements::Pasts_events_list_admin($_SESSION['id_user']);
                
                $controller_report='admin';
                $fonction_back='interface_admin';

                require_once('views/admin/personnalise/pasts_events_list.php');
            }
          else
            {
                $donnees = Evenements::Pasts_events_list_admin($_SESSION['id_user']);

                $controller_report='admin';
                $fonction_back='interface_admin';

                require_once('views/admin/pasts_events_list.php');
             }
        }
        else
          UsersController::deconnexion();
    }
     
     
     public static function tuteurs_list() // liste des tuteurs 
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            if(preg_match('#PERSONNALISE#', $_SESSION['statut']))
            {
              $donnees= Admin::Get_all_tuteurs($_SESSION['id_user']);
              

              $controller_report='admin';
              $fonction_back='interface_selection';

              require_once('views/admin/personnalise/state_tuteurs_list.php');
            }
            else
            {
              $donnees= Admin::Not_selected_tuteurs($_SESSION['id_user']);
              $req= Tutorat::Get_tutorat($_SESSION['id_user']);  // on récupère la liste des tutorats qu'il administre pour affecter des tuteurs pour un tutorat en particulier

              $controller_report='admin';
              $fonction_back='interface_admin';

              require_once('views/admin/tuteurs_list.php'); 
            }
        }
        else
            UsersController::deconnexion();  
    }

    public static function tutores_list()  // liste des tutprézs qui font partie de son tutorat( type de tutorat )
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
              if(preg_match('#IMMERSION#', $_SESSION['statut'])) 
              {
                $donnees= Admin::Get_tutores_signedUp_event($_SESSION['id_user']); // liste des tutorés qui sont inscrits à ses evenements

                $controller_report='admin';
                $fonction_back='interface_admin';

                require_once('views/admin/immersion/tutores_signedUp_event.php');
              }

              elseif(preg_match('#PERSONNALISE#',$_SESSION['statut'])) 
              {
                $donnees= Admin::Get_all_tutores();

                $controller_report='admin';
                $fonction_back='interface_selection';

                require_once('views/admin/personnalise/state_tutores_list.php');
              }
         
              elseif(preg_match('#MEF#', $_SESSION['statut']))
               {
                    $donnees= Admin::Get_my_tutores($_SESSION['id_user']);
                    $data= Admin::Get_free_tuteurs();

                    $controller_report='admin';
                    $fonction_back='interface_tutores_mef';

                    require_once('views/admin/personnalise/state_tutores_list.php');
                }
         
    }
    else
            UsersController::deconnexion(); 
}
   
   public function interface_tutores_mef()
    {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
           
            $controller_report='admin';
            $fonction_back='interface_admin';

            require_once('views/admin/mef/interface_tutores_mef.php');
        }
        else
            UsersController::deconnexion();
    }

    public function choose_tuteur() // l'admin sélectionne ses tuteurs
    { 
      if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
      
      
      $tutorat= htmlspecialchars($_POST['tutorat']);

      
           if($_POST['id_u_c'] !="")
                 {
                  $id_u_c= htmlspecialchars($_POST['id_u_c']);
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_c'];
                      
                      Admin::Send_proposal($id_u_c,$tutorat);
                      $donnees= Admin::Get_sent_proposal($id_u_c,$tutorat,$_SESSION['id_user']); // on récupère les informations sur la proposition de sélection envoyée

                      $controller_report='admin';
                      $fonction_back='interface_admin';
                      
                      Admin::Send_selection_mail($donnees[0]->getPrenom(),$donnees[0]->getNom(),$donnees[0]->getEmail(),$donnees[1],$donnees[2]) ;// on envoi le mail de confirmation de sélection

                      AdminController::tuteurs_list(); // on charge la vue adéquates
                 }
           elseif($_POST['id_u_d']!="")
                 {
                  $id_u_d= htmlspecialchars($_POST['id_u_d']);
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                      
                      Admin::Cancel_proposal($id_u_d,$tutorat);
                      
                      $controller_report='admin';
                      $fonction_back='interface_admin';

                      AdminController::tuteurs_list();
                 }
           else
                {   
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                    $controller_report='admin';
                    $fonction_back='interface_admin';
                    require_once('views/system/error.php');
                }
             
        }
        else
            UsersController::deconnexion(); 
    }

     public function interface_tutorat()  
     {
         if( isset($_SESSION['id_statut']))
         {
            $controller_report='admin';
            $fonction_back='interface_admin';

                require_once('views/admin/mef/interface_tutorat.php');
         }
          else
                UsersController::deconnexion();
     }

     public function sign_up()  // inscription d'un tutoré par un admin
     {
         if( isset($_SESSION['id_statut']))
         {
            $donnees= Tutorat::Get_tutorat($_SESSION['id_user']); // on récupère les lieux de tutorat qu'il dirige

            $controller_report='admin';
            $fonction_back='interface_admin';

                require_once('views/admin/signup_by_admin.php');
         }
          else
                UsersController::deconnexion();
     }

     public function create_center()  // il s'agit de la vue de création d'un centre
     {
       if( isset($_SESSION['id_statut']))
       {
          $donnees=Tutorat::Get_all_type_tutorat();  // on charge l'interface de création de tutorat

          $controller_report='admin';
          $fonction_back='interface_tutorat';

          require_once('views/admin/create_tutorat_center.php');
       }
          else
                UsersController::deconnexion();
     }

     public function tutorat_center_list() // liste des tutorats que je dirige
     {
       if( isset($_SESSION['id_statut']))
       {
          $donnees= Tutorat::tutorat_center_list($_SESSION['id_user']);

          $controller_report='admin';
          $fonction_back='interface_tutorat';

          require_once('views/admin/tutorat_center_list.php');
       }
       else
          UsersController::deconnexion();
     }


    public static function show_informations()
    {
      if( isset($_SESSION['id_statut']))
       {
         $id_u= htmlspecialchars($_POST['id_u']);
         $id_e_c= htmlspecialchars($_POST['id_e_c']);
       
          
           if( isset($_POST['consulter']))
           {
               $data= Users::Get_info($id_u); // on récupère les info du user en question
               if(preg_match('#MEF#', $_SESSION['statut']))
                  $donnees = Evenements::Get_my_events_list($id_u,$_SESSION['id_user']);
               else
               $donnees = Evenements::Get_informations_events_on_user($id_u,$_SESSION['id_user']); // on récupère les évènements que le tuteur a effectué quand c'est un admin en particulier qui l'a crée 

                $controller_report='admin';
                $fonction_back='interface_admin';

              
               require_once('views/admin/show_informations.php');
           }
          elseif(isset($_POST['annuler']))
          {

              $event= new Evenements();
              $event->Cancel_participation($id_u,$id_e_c);
              if( $_POST['statut'] == 'TUTEUR')
                 $event->updateNombrePlaces($id_e_c,1);
              else
                Evenements::Update_nbplacesTutores($id_e_c,-1); // on met à jour le nombre de tutorés inscrits

              $donnees = Evenements::Subscription_list($id_e_c); // on récupère la liste des participants

              $data= Evenements::Get_informations_on_events($id_e_c);  // on récupère la date, le. lieu etc sur l'évenement

              $controller_report='admin';
              $fonction_back='future_events_list';

                if(preg_match('#PERSONNALISE#', $_SESSION['statut']))
                  require_once('views/admin/personnalise/subscription_list.php');
                else
                require_once('views/admin/subscription_list.php');

            }
       }
       else
          UsersController::deconnexion();
    }

    public  function validate_hours()  // on valide les heures concernant un évènement
    {
      if( isset($_SESSION['id_statut']))
       {
       $id_e= htmlspecialchars($_POST['id_e']);
       $id_t= htmlspecialchars($_POST['id_t']);
       $duree= htmlspecialchars($_POST['duree']);
       
       
         Admin::Validate_hours($id_e,$id_t,$duree);

         AdminController::pasts_events_list(); // on recharge. la page show_informations.php 
     
       }
       else
          UsersController::deconnexion();
    }
    
    public static function declared_hours()  // on affiche les heures déclarées par un admin
    {
      if( isset($_SESSION['id_statut']))
       {
           $donnees = Evenements::Get_past_events($_SESSION['id_user']);

           $controller_report='admin';
           $fonction_back='interface_hours';

           require_once('views/admin/declared_hours.php');
       }
       else
          UsersController::deconnexion();
    }
    
    public static function declare_hours()  // on affiche le formulaire de déclaration des heures pour un admin
    {
      if( isset($_SESSION['id_statut']))
       {
           $donnees= Tutorat::Get_tutorat($_SESSION['id_user']);  // on récupère la liste des tutorats qu'il administre
           $controller_report='admin';
           $fonction_back='interface_hours';

           require_once('views/admin/declare_hours.php');
       }
       else
          UsersController::deconnexion();
    }
    public static function interface_hours()  // interface de déclaration(consultation) des heures pour un admin
    {
      if( isset($_SESSION['id_statut']))
       {
           $controller_report='admin';
           $fonction_back='interface_admin';

           require_once('views/admin/interface_hours.php');
       }
       else
          UsersController::deconnexion();
    }

    public function link()
     {
       if( isset($_SESSION['id_statut']))
       {  
            $id_tuteur= htmlspecialchars($_POST['id_tuteur']);
            $id_tutore= htmlspecialchars($_POST['id_tutore']);
        //$id_e= htmlspecialchars($_POST['id_e']);
   
           if( isset($_POST['lier']))
           {
            if(Admin::link($id_tuteur,$id_tutore) == 0)
              AdminController:: tutores_list(); // on charge la liste des tu
            else
            {
                $message = 'Cette liaison est impossible, ce tuteur a atteint son quota maximum de liaison';
                $controller_report='admin';
                $fonction_back='tutores_list';
                require_once('views/system/error.php');
            }

           }
          elseif(isset($_POST['supprimer']))
          { 
             if($id_tutore!="")
             {
               Admin::Delete_link($id_tutore);
               AdminController:: tutores_list(); // on charge la liste des tu
             }
             elseif($id_tuteur!="")
             {
               Admin::Delete_link($id_tuteur);
               AdminController:: tuteurs_list(); // on charge la liste des tu
             }

         }
         elseif(isset($_POST['consulter']))
         {
            if($id_tutore!="")
            {
              $donnees= Tutores::Get_working_list($id_tutore);
              $data= Users::Get_info($id_tutore);

              $controller_report='admin';
              $fonction_back='tutores_list';

              require_once("views/admin/show_tutores_links.php");
            }
            elseif($id_tuteur!="")
            {
              $donnees= Tuteurs::Get_working_list($id_tuteur);
              $data= Users::Get_info($id_tuteur);

              $controller_report='admin';
              $fonction_back='tuteurs_list';

              require_once("views/admin/show_tuteurs_links.php");
         }
        }
       }
       else
          UsersController::deconnexion();
     }

    
    public function interface_selection()
    {
      if( isset($_SESSION['id_statut']) )
       {
          if(preg_match('#PERSONNALISE#',$_SESSION['statut']))
          {
            $controller_report='admin';
            $fonction_back='interface_admin';

           require_once('views/admin/personnalise/interface_selection.php') ;
         }
         else
         {
            $controller_report='admin';
            $fonction_back='interface_admin';

           require_once('views/admin/interface_selection.php') ;
         }
       }
       else
          UsersController::deconnexion();
    }
    
    public static function selected_tuteurs() // la liste de ceux qui ont été sélectionné et qui ont accepté
    {
        if( isset($_SESSION['id_statut']))
        {
          $donnees = Admin::Selected_tuteurs($_SESSION['id_user']);

          $controller_report='admin';
          $fonction_back='interface_selection';

          require_once('views/admin/selected_tuteurs.php');
        }
        else
          UsersController::deconnexion();
    }

    public static function Sfuture_events_list() // liste des évènements passés( pour pouvoir faire la sélection de tuteurs d'ou le préfixe S)
    {
        if( isset($_SESSION['id_statut']))
        {
          $donnees = Evenements::Future_events_list($_SESSION['id_user']);
          $data= Admin::Selected_tuteurs($_SESSION['id_user']);

          $controller_report='admin';
          $fonction_back='interface_selection';

          require_once('views/admin/Sfuture_events_list.php');
        }
        else
          UsersController::deconnexion();
    }
    
    public function Schoose_tuteur() // l'admin sélectionne ses tuteurs( d'ou le préfixe S)
    {
      if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
       $id_u_c= htmlspecialchars($_POST['id_u_c']);
       $tutorat= htmlspecialchars($_POST['tutorat']);
       $id_user= htmlspecialchars($_POST['id_user']);
       $id_u_d= htmlspecialchars($_POST['id_u_d']);
      
           if($id_u_c!="")
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_c'];
                      
                      Admin::Send_proposal($id_u_c,$tutorat);
                      $donnees= Admin::Get_sent_proposal($id_u_c,$tutorat,$id_user); // on récupère les informations sur la proposition de sélection envoyée

                      $controller_report='admin';
                      $fonction_back='Sfuture_events_list';
                      
                      Admin::Send_selection_mail($donnees[0]->getPrenom(),$donnees[0]->getNom(),$donnees[0]->getEmail(),$donnees[1],$donnees[2]) ;// on envoi le mail de confirmation de sélection

                      
                      AdminController::Sfuture_events_list();
                 }
           elseif($id_u_d!="")
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                      
                      Admin::Cancel_proposal($id_u_d,$tutorat);
                      
                      $controller_report='admin';
                      $fonction_back='Sfuture_events_list';
                      

                      AdminController::Sfuture_events_list();
                 }
           else
                {   
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                    $controller_report='admin';
                    $fonction_back='interface_admin';
                    require_once('views/system/error.php');
                }
             
        }
        else
            UsersController::deconnexion(); 
    }
    
    public static function show_all_proposal()
    {
      if( isset($_SESSION['id_statut']))
       {
         
          $donnees=Admin::Get_all_proposal($_SESSION['id_user']); // on récupère toutes les propositions faites  à des tuteurs

          $controller_report='admin';
          $fonction_back='interface_selection';

          require_once('views/admin/sent_proposal.php');
       }
       else
          UsersController::deconnexion();
    }

    public function cancel_proposal() // on annule une proposition faite à un tuteur concernant un tutorat particulier
    {
      if( isset($_SESSION['id_statut']))
       {
         
      $id_u= htmlspecialchars($_POST['id_u']);
      $id_t= htmlspecialchars($_POST['id_t']);
     
       Admin::Cancel_proposal($id_u,$id_t);

        AdminController::show_all_proposal();
    
     
       }
       else
          UsersController::deconnexion();
    }

    public function end_contract()// l'admin met fin au contrat qui le lie à un tuteur(supprimer de la iste de sélection automatique ) pour un tutorat donné 
    {
      if( isset($_SESSION['id_statut']))
       {
       
      $id_u= htmlspecialchars($_POST['id_u']);
      $id_t= htmlspecialchars($_POST['id_t']);
      
    
        Admin::Cancel_proposal($id_u,$id_t);

        
        $controller_report='admin';
        $fonction_back='interface_selection';

        AdminController::selected_tuteurs(); // on recharge la vue de sélectio des tuteurs
      

       }
       else
          UsersController::deconnexion();
    }

public  function export()
  {
    if (isset($_SESSION['id_user'])) {
        $donnees = Users::Get_unpaidHours_tuteurs();
       

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

      $header = array('Nom du tutorat'=>'string','Date'=>'string','Lieu du déroulement'=>'string','Nombre de tutorés'=>'string','Nombre de tuteurs'=>'string','Nombre de places'=>'string','Nombre heures'=>'string',
      );

        $data1 = [];
        foreach($donnees as $data)
          { 
            $data1 [] = array($data['tutorat'],$data['evenement']->getDate_evenement(),$data['evenement']->getLieu(),$data['evenement']->getNb_places_tutores(),$data['evenement']->getNb_tuteurs(),$data['evenement']->getNb_places(),$data['planning_event']);
          }
        $writer = new XLSXWriter();
        $writer->writeSheetHeader('Sheet1', $header);
        foreach($data1 as $row){
          $writer->writeSheetRow('Sheet1', $row);
        }
        $writer->writeToFile($filename);
      //include_once('PHP_XLSXWriter-master/examples/ex00-simple.php');
      $this->future_events_list();
    }
    else{
        echo "échec d'exportation de données";
    }
  }
    
    
 public static function contact()
 {
  if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
  { 
      $data= Users::Get_all_contact_admin($_SESSION['id_user']);
      require_once('views/admin/contacter.php');
  }
  else
      UsersController::deconnexion();
  }

  public function message() // à completer lors de la création de la table de suivi des admin
      {
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {    

                require ('PHPMailer/PHPMailerAutoload.php');
                require ('connectToMail.php');
                $mailAccount = 'contact_admin@tutorat-yncrea.fr';

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

                $controller_report='admin';
                $fonction_back='contact';
          
                require_once('views/mail_send_ok.php');  
        }
        else
                UsersController::deconnexion();
      }

      // gestion de compte 









   
  public function  wait_compte()
  {
    if(isset($_SESSION['id_statut']))//verifie la connexion 
    {
      if(isset($_POST['tuteur']) || isset($_POST['annulertuteur']))
      {
        $donnees=Admin::WaitCompte(13);
        $controller_report='admin';
        $fonction_back='interface_admin'; 
        require_once('views/admin/gestion/user_list.php');
      }
      
      elseif(isset($_POST['tutore'])  || isset($_POST['annulertutore']))
      {
        $donnees=Admin::WaitCompte(16);
        $controller_report='admin';
        $fonction_back='interface_admin'; 

        require_once('views/admin/gestion/user_list.php');
      }
    }
    else
       UsersController::deconnexion();
  }

  public function my_account()
  {
    if(isset($_SESSION['id_statut']))//verifie la connexion 
    {
     
      if(isset($_POST['id_user']) && isset($_POST['statut']))
      {
        if($_POST['statut']==13)
        {
          $id_user= htmlspecialchars($_POST['id_user']);
          $donnees=Admin::TuteurCompte($id_user);
          $controller_report='admin';
          $fonction_back='wait_compte'; 

          require_once('views/admin/gestion/valide_account_tuteur.php');
        }
        elseif($_POST['statut']==16)
        {
          $id_user= htmlspecialchars($_POST['id_user']);
          $donnees=Admin::TutoreCompte($id_user);
          $controller_report='admin';
          $fonction_back='wait_compte'; 

          require_once('views/admin/gestion/valide_account_tutore.php');
        }
      }
      else
         UsersController::deconnexion();
      
    }
    else
      UsersController::deconnexion();
    
  }
  
  public function valider_account()
  {
    if(isset($_SESSION['id_statut']))//verifie la connexion 
    {
      if(isset($_POST['validertuteur']))
      {
        $id_user= htmlspecialchars($_POST['id_user']);
    
    
        Admin::ValiderCompte($id_user);
        $donnees=Admin::WaitCompte(13);
          
        require_once('views/admin/gestion/user_list.php');
   
      }
      elseif(isset($_POST['validertutore']))
      {
          $id_user= htmlspecialchars($_POST['id_user']);
      
             Admin::ValiderCompte($id_user);
              
            $donnees=Admin::WaitCompte(16);
              
            require_once('views/admin/gestion/user_list.php');
            
      }
      elseif(isset($_POST['annulertuteur']))
      {
        $id_user= htmlspecialchars($_POST['id_user']);
      
          $donnees=Admin::TuteurCompte($id_user);
          $controller_report='admin';
          $fonction_back='wait_compte'; 
          require_once('views/admin/gestion/valide_account_tuteur.php');
      
      }
      else
      {
        $id_user= htmlspecialchars($_POST['id_user']); 
    
            
          $donnees=Admin::TutoreCompte($id_user);
          $controller_report='admin';
          $fonction_back='wait_compte'; 
          require_once('views/admin/gestion/valide_account_tutore.php');

      }
      
    }
    else
      UsersController::deconnexion();
  }
  
  public function interface_tutore_bourse()
  {
    if(isset($_SESSION['id_statut']))//verifie la connexion 
    {
      require_once('views/admin/gestion/tutore_bourse.php');
    }
    else
       UsersController::deconnexion();
  }
  
  public function tutore_bourse()
  {
    if(isset($_SESSION['id_statut']))//verifie la connexion 
    {
      if(isset($_POST['sans']))
      {
        $donnees=Admin::WihtOutBourse();
        $controller_report='admin';
        $fonction_back='interface_tutore_bourse';
        
        require_once('views/admin/gestion/bourse.php');
      }
      elseif(isset($_POST['avec']))
      {
        $donnees=Admin::WithBourse();
        $controller_report='admin';
        $fonction_back='interface_tutore_bourse';

        require_once('views/admin/gestion/bourse.php');
      }
      else
       UsersController::deconnexion();
    }
    else
       UsersController::deconnexion();
  }
  
   public function bourse_account()
  {
    if(isset($_SESSION['id_user']))//verifie la connexion 
    {
    $id_user= htmlspecialchars($_POST['id_user']);
    
    
      $donnees=Admin::TutoreCompte($id_user); 
      $controller_report='admin';
      $fonction_back='interface_tutore_bourse';
      
      require_once('views/admin/gestion/bourse_account.php');
    }
    else
       UsersController::deconnexion();
  }
  
  
  public function valider_bourse()
  {
    if(isset($_SESSION['id_statut']))//verifie la connexion 
    {
          if(isset($_POST['validerbourse']))
          {
            $id_user= htmlspecialchars($_POST['id_user']);
        
        
            Admin::ValiderBourse($id_user);
            
            $donnees=Admin::WihtOutBourse();
            
            require_once('views/admin/gestion/bourse.php');
          }
          else
          UsersController::deconnexion();
            
  }
  elseif(isset($_POST['annulerbourse']))
  {
      $donnees=Admin::WihtOutBourse();      
      require_once('views/admin/gestion/bourse.php');
  }
  else
    UsersController::deconnexion();
  }
  
  
   public function interface_account_valid()
   {
      if(isset($_SESSION['id_statut']))//verifie la connexion 
      {
        require_once('views/admin/gestion/user_choice.php');  
      }
      else
        UsersController::deconnexion();
   }
   
   
   public function account_valid()
   {
     if(isset($_SESSION['id_statut']))//verifie la connexion 
     {
        if(isset($_POST['tuteur']) )
        {
          $donnees=Admin::Compte(13);
          $controller_report='admin';
          $fonction_back='interface_account_valid';

          require_once('views/admin/gestion/account_valid.php');
        }
        elseif(isset($_POST['tutore']) )
        {
          $donnees=Admin::Compte(16);
          $controller_report='admin';
          $fonction_back='interface_account_valid';

          require_once('views/admin/gestion/account_valid.php');
        }
     }
     else
       UsersController::deconnexion();
   }
  
   public function annul_account()
   {
    $id_user= htmlspecialchars($_POST['id_user']);
   
       if(isset($_POST['desactiver']))
       { 
          Admin::AnnulCompte($id_user);
          
          if(isset($_POST['statut']) && $_POST['statut']==13)
          {
            $donnees=Admin::Compte(13);
              
            require_once('views/admin/gestion/account_valid.php');
          }
          elseif(isset($_POST['statut']) && $_POST['statut']==16)
          {
              $donnees=Admin::Compte(16);
              
              require_once('views/admin/gestion/account_valid.php');
          }
      }
      elseif(isset($_POST['activer']))
      {
        Admin::ValiderCompte($id_user);
      
        if(isset($_POST['statut']) && $_POST['statut']==13)
          {
            $donnees=Admin::Compte(13);
            require_once('views/admin/gestion/account_valid.php');
          }
          
        elseif(isset($_POST['statut']) && $_POST['statut']==16)
          {
            $donnees=Admin::Compte(16);
            
            require_once('views/admin/gestion/account_valid.php');
          }
      } 
      else
         UsersController::deconnexion();
    }
     


}