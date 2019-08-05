<?php

require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/admin.php');
require_once('models/tutorat.php');
require_once('models/evenements.php');
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

       public function admin_set_event()
       {
          if( isset($_SESSION['id_statut']))
          {    
             $donnees= Tutorat::Get_lieu_tutorat($_SESSION['id_user']);
              
             $controller_report='admin';
             $fonction_back='interface_admin';

              require_once('views/admin/admin_set_event.php');
          }
            else
                require_once('views/login.php');
       }
     
     public static function tuteurs_list() // lsite des tuteurs 
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            
            $donnees= Admin::Get_all_tuteurs();
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
                      
                      Admin::Choose_tuteur($_POST['id_u_c'],$_POST['tutorat']);
                      
                      $controller_report='admin';
                      $fonction_back='interface_admin';

                      AdminController::tuteurs_list();
                 }
           elseif(isset($_POST['id_u_d']))
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                      
                      Admin::Cancel_tuteur($_POST['id_u_d']);
                      
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

     public function interface_tutorat_mef()
     {
         if( isset($_SESSION['id_statut']))
         {
            $controller_report='admin';
            $fonction_back='interface_admin';

                require_once('views/admin/mef/interface_tutorat_mef.php');
         }
          else
                require_once('views/login.php');
     }

     public function sign_up()
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
          $fonction_back='interface_tutorat_mef';

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
          $fonction_back='interface_tutorat_mef';

          require_once('views/admin/tutorat_center_list.php');
       }
       else
          require_once('views/login.php');
     }

     
       
     public  function validate_hours()  // on valide les heures concernant un évènement
    {
      if( isset($_SESSION['id_statut']))
       {
           Admin::Validate_hours($_POST['id_e'],$_POST['id_t'],$_POST['duree']);

          AdminController::show_informations(); // on recharge. la page show_informations.php 
       }
       else
          require_once('views/login.php');
    }

    public static function show_informations()
    {
      if( isset($_SESSION['id_statut']))
       {
           $data= Users::Get_informations_on_user($_POST['id_u']); // on récupère les info du user en question
           $donnees = Evenements::Get_informations_events_on_user($_POST['id_u']);

            $controller_report='evenements';
            $fonction_back='subscription_list';

        
          require_once('views/admin/show_informations.php');
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
          $fonction_back='interface_tutorat_mef';

          AdminController:: tutores_list(); // on charge la liste des tu
       }
       else
          require_once('views/login.php');
     }
    
    public function future_events_list()
    {
        if( isset($_SESSION['id_statut']))
        {
          $donnees = Evenements::Future_events_list($_SESSION['id_user']);

          $controller_report='admin';
          $fonction_back='interface_admin';

          require_once('views/admin/interface_admin_mef.php');
        }
        else
          require_once('views/login.php');
    }

    public function pasts_events_list()
    {
        if( isset($_SESSION['id_statut']))
        {
          $donnees = Evenements::Pasts_events_list($_SESSION['id_user']);

          $controller_report='admin';
          $fonction_back='interface_admin';

          require_once('views/admin/events_list.php');
        }
        else
          require_once('views/login.php');
    }


}