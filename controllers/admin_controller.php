<?php
require_once('models/tuteurs.php');
require_once('models/tutores.php');
require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/admin.php');

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
                require_once('views/admin/admin_set_event.php');
            else
                require_once('views/login.php');
       }
     
     public static function tuteurs_list() // lsite des tutorés 
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            
            $donnees= Admin::Get_all_tuteurs();

            $controller_report='admin';
            $fonction_back='interface_admin';

            require_once('views/admin/tuteurs_list.php');
        }
        else
            require_once('views/login.php');  
    }

    public function tutores_list()  // liste des tutprézs qui font partie de son tutorat( type de tutorat )
    {
        
        if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
           
            $donnees= Admin::Get_all_tutores();

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
                      
                      Admin::Choose_tuteur($_POST['id_u_c']);
                      
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

       
}