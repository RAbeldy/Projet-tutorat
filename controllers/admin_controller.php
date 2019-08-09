<?php

require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/admin.php');
require_once('models/tutorat.php');



/* Définition du controller */
class AdminController
{

     public function interface_admin()
       {
            if( isset($_SESSION['id_statut']))
            {
                if($_SESSION['id_statut'] == 11)
                {
                  require_once('views/admin/mef/interface_admin_mef.php');
                }
                else
                  require_once('views/admin/interface_admin.php');
            }
            else
                require_once('views/login.php');
       }
      public function interface_admin_tuteur()
       {
            if( isset($_SESSION['id_statut']))
                require_once('views/admin/interface_admin_tuteur.php');
            else
                require_once('views/login.php');
       }


       public function events()
       {
          if( isset($_SESSION['id_statut']))
                require_once('views/admin/events.php');
          else
                require_once('views/login.php');
       }
       public function admin_set_event()
       {
          if( isset($_SESSION['id_statut']))
          {    
             $donnees= Tutorat::Get_lieu_tutorat($_SESSION['id_user']);
              
             $controller_report='admin';
             $fonction_back='events';

              require_once('views/admin/admin_set_event.php');
          }
            else
                require_once('views/login.php');
       }

       public function modify_event()
       {
        if( isset($_SESSION['id_statut']))
          {    
             if( isset($_POST['modifier']))
             {
             $donnees= Tutorat::Get_lieu_tutorat($_SESSION['id_user']);
             $tab= Evenements::Get_informations_on_events($_POST['id_e']);
              
             $controller_report='admin';
             $fonction_back='events';

              require_once('views/admin/modify_event.php');
            }
            elseif( isset($_POST['consulter']))  // on va plutot consulter la liste des tuteurs inscrits pour cet évènement
            {
              $donnees = Evenements::Subscription_list($_POST['id_e']); // on récupère la liste des participants

              $data= Evenements::Get_informations_on_events($_POST['id_e']);  // on récupère la date, le. lieu etc sur l'évenement

              $controller_report='admin';
              $fonction_back='future_events_list';

              require_once('views/admin/subscription_list.php');
            }
            elseif( isset($_POST['supprimer']))  // on va plutot supprimer cet évènement
            {
               Evenements::Delete_event($_SESSION['id_user'],$_POST['id_e']); // on supprime
 
               AdminController::future_events_list();
          
            }
            elseif( isset($_POST['imprimer']))  // on va plutot supprimer cet évènement
            {
               $header= array('tutorat','date','adresse','nombre de places','duree');
               $path="http://localhost:8888/tests/steve/PDF/future_events_list.txt";

               Admin::Create_pdf($path,$header); 
 
               AdminController::future_events_list();
          
            }
          }
            else
                require_once('views/login.php');
       }

       public static function future_events_list()
       {
          if( isset($_SESSION['id_statut']))
          {
            $donnees = Evenements::Future_events_list($_SESSION['id_user']);
            
            $controller_report='admin';
            $fonction_back='events';
             
             // petit code pour saisir les donnees dans un fichier pour telechargement au besoin
            $myfile = fopen("PDF/future_events_list.txt", "w") or die("Unable to open file!");
            
            foreach ($donnees as $elt)
             {
              $saut= "\n";
              $txt= $elt['tutorat'].';'.$elt['evenement']->getDate_evenement().';'.$elt['evenement']->getLieu().';'.$elt['evenement']->getNb_places().';'.$elt['planning_event'].''.$saut ;
              fwrite($myfile, $txt);
            }
            fclose($myfile);

            
            require_once('views/admin/future_events_list.php');
          }
          else
            require_once('views/login.php');
      }

    public static function pasts_events_list()
    {
        if( isset($_SESSION['id_statut']))
        {
          $donnees = Evenements::Pasts_events_list($_SESSION['id_user']);

          $controller_report='admin';
          $fonction_back='interface_admin';

          require_once('views/admin/pasts_events_list.php');
        }
        else
          require_once('views/login.php');
    }
     
     public static function tuteurs_list() // lsite des tuteurs 
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            
            $donnees= Admin::Get_all_tuteurs($_SESSION['id_user']);
            $req= Tutorat::Get_lieu_tutorat($_SESSION['id_user']);

            $controller_report='admin';
            $fonction_back='interface_admin';

            require_once('views/admin/tuteurs_list.php');
        }
        else
            require_once('views/login.php');  
    }

    public static function tutores_list()  // liste des tutprézs qui font partie de son tutorat( type de tutorat )
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
           
            $donnees= Admin::Get_my_tutores($_SESSION['id_user']);
            $data= Admin::Get_free_tuteurs();

            $controller_report='admin';
            $fonction_back='interface_tutores_mef';

            require_once('views/admin/tutores_list.php');
        }
        else
            require_once('views/login.php');  
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
            require_once('views/login.php');
    }

    public function choose_tuteur() // l'admin sélectionnes ses tuteurs
    {
      if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
           if(isset($_POST['id_u_c'] ))
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_c'];
                      
                      Admin::Send_proposal($_POST['id_u_c'],$_POST['tutorat']);
                      $donnees= Admin::Get_sent_proposal($_POST['id_u_c'],$_POST['tutorat'],$_SESSION['id_user']); // on récupère les informations sur la proposition de sélection envoyée

                      $controller_report='admin';
                      $fonction_back='interface_admin';

                      Admin::Send_selection_mail($donnees[0]->getPrenom(),$donnees[0]->getNom(),$donnees[0]->getEmail(),$donnees[1],$donnees[2]) ;// on envoi le mail de confirmation de sélection

                      AdminController::tuteurs_list(); // on charge la vue adéquate
                 }
           elseif(isset($_POST['id_u_d']))
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                      
                      Admin::Cancel_proposal($_POST['id_u_d'],$_POST['tutorat']);
                      
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
            require_once('views/login.php'); 
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
                require_once('views/login.php');
     }

     public function sign_up()  // inscription d'un tutoré par un admin
     {
         if( isset($_SESSION['id_statut']))
         {
            $donnees= Tutorat::Get_lieu_tutorat($_SESSION['id_user']); // on récupère les lieux de tutorat qu'il dirige

            $controller_report='admin';
            $fonction_back='interface_admin';

                require_once('views/admin/signup_by_admin.php');
         }
          else
                require_once('views/login.php');
     }

     public function create_center()  // il s'agit de la vue
     {
       if( isset($_SESSION['id_statut']))
       {
          $donnees=Tutorat::Get_type_tutorat();  // on charge l'interface de création de tutorat

          $controller_report='admin';
          $fonction_back='interface_tutorat';

          require_once('views/admin/create_center.php');
       }
          else
                require_once('views/login.php');
     }

     public function tutorat_center_list()
     {
       if( isset($_SESSION['id_statut']))
       {
          $donnees= Tutorat::tutorat_center_list($_SESSION['id_user']);

          $controller_report='admin';
          $fonction_back='interface_tutorat';

          require_once('views/admin/tutorat_center_list.php');
       }
       else
          require_once('views/login.php');
     }


    public static function show_informations()
    {
      if( isset($_SESSION['id_statut']))
       {
           $data= Users::Get_informations_on_user($_POST['id_u']); // on récupère les info du user en question
           $donnees = Evenements::Get_informations_events_on_user($_POST['id_u'],$_SESSION['id_user']); // on récupère les évènements que le tuteur a effectué quand c'est un admin en particulier qui l'a crée 

            $controller_report='admin';
            $fonction_back='pasts_events_list';

        
          require_once('views/admin/show_informations.php');
       }
       else
          require_once('views/login.php');
    }

    public  function validate_hours()  // on valide les heures concernant un évènement
    {
      if( isset($_SESSION['id_statut']))
       {
           Admin::Validate_hours($_POST['id_e'],$_POST['id_t'],$_POST['duree']);

          AdminController::pasts_events_list(); // on recharge. la page show_informations.php 
       }
       else
          require_once('views/login.php');
    }

    public function link()
     {
       if( isset($_SESSION['id_statut']))
       {   
           if( isset($_POST['lier']))
           Admin::link($_POST['id_tuteur'],$_POST['id_tutore']);
         elseif(isset($_POST['supprimer']))
           Admin::Delete_link($_POST['id_tutore']);

          $controller_report='admin';
          $fonction_back='interface_tutorat';

          AdminController:: tutores_list(); // on charge la liste des tu
       }
       else
          require_once('views/login.php');
     }

    
    public function interface_selection()
    {
      if( isset($_SESSION['id_statut']))
       {
           require_once('views/admin/interface_selection.php') ;
       }
       else
          require_once('views/login.php');
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
          require_once('views/login.php');
    }

    public static function Spasts_events_list() // liste des évènements passés( pour pouvoir faire la sélection de tuteurs d'ou le préfixe S)
    {
        if( isset($_SESSION['id_statut']))
        {
          $donnees = Evenements::Pasts_events_list($_SESSION['id_user']);

          $controller_report='admin';
          $fonction_back='interface_selection';

          require_once('views/admin/Spasts_events_list.php');
        }
        else
          require_once('views/login.php');
    }
    
    public function Schoose_tuteur() // l'admin sélectionne ses tuteurs( d'ou le préfixe S)
    {
      if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
           if(isset($_POST['id_u_c'] ))
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_c'];
                      
                      Admin::Send_proposal($_POST['id_u_c'],$_POST['tutorat']);
                      $donnees= Admin::Get_sent_proposal($_POST['id_u_c'],$_POST['tutorat'],$_SESSION['id_user']); // on récupère les informations sur la proposition de sélection envoyée

                      $controller_report='admin';
                      $fonction_back='Spasts_events_list';
                      
                      Admin::Send_selection_mail($donnees[0]->getPrenom(),$donnees[0]->getNom(),$donnees[0]->getEmail(),$donnees[1],$donnees[2]) ;// on envoi le mail de confirmation de sélection

                      
                      AdminController::Spasts_events_list();
                 }
           elseif(isset($_POST['id_u_d']))
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                      
                      Admin::Cancel_proposal($_POST['id_u_d'],$_POST['tutorat']);
                      
                      $controller_report='admin';
                      $fonction_back='Spasts_events_list';
                      

                      AdminController::Spasts_events_list();
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
            require_once('views/login.php'); 
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
          require_once('views/login.php');
    }

    public function cancel_proposal() // on annule une proposition faite à un tuteur concernant un tutorat particulier
    {
      if( isset($_SESSION['id_statut']))
       {
         
          Admin::Cancel_proposal($_POST['id_u'],$_POST['id_t']);

          AdminController::show_all_proposal();
       }
       else
          require_once('views/login.php');
    }

    public function end_contract()// l'admin met fin au contrat qui le lie à un tuteur(supprimer de la iste de sélection automatique ) pour un tutorat donné 
    {
      if( isset($_SESSION['id_statut']))
       {
         
          Admin::Cancel_proposal($_POST['id_u'],$_POST['id_t']);

          $controller_report='admin';
          $fonction_back='interface_selection';

          AdminController::selected_tuteurs(); // on recharge la vue de sélectio des tuteurs
       }
       else
          require_once('views/login.php');
    }


    
    


}