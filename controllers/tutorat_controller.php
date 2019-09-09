<?php

require_once('models/users.php');
require_once('models/admin.php');
require_once('models/tutorat.php');


/* Définition du controller */
class TutoratController
{

   public function create_center() // ils 'agit de l'action de créer à ne pas confondre dans le controller admin
     {
       if( isset($_SESSION['id_statut']))
       {

       	  // une instance de la classe tuteur
            $tutorat = new Tutorat();
            $tutorat->setLibelle($_POST['libelle']);
            $tutorat->setCode_postal($_POST['code_postal']);
            $tutorat->setAdresse($_POST['adresse']);
            $tutorat->setNb_tuteurs($_POST['nb_tuteurs']);
            $tutorat->setNb_tutores($_POST['nb_tutores']);
            $tutorat->setId_typeTutorat($_POST['id_typeTutorat']);
          

          if($tutorat->Create_center() == 0)
            {
              $donnees= Tutorat::tutorat_center_list($_SESSION['id_statut']);

              $controller_report='admin';
              $fonction_back='interface_tutorat';

              require_once('views/admin/tutorat_center_list.php');
            }
          else
          {
            $message = ' Un tutorat avec ce libellé a déja été crée pour ce type de tutorat, pour vous en rassurez rendez-vous à la page "les centres de tutorat" ';
            $controller_report='superadmin';
            $fonction_back='create_center';

            require_once('views/system/error.php');
          }
       }
          else
                require_once('views/login.php');
     }

  public function create_type_center() // ils 'agit de l'action de créer à ne pas confondre dans le controller admin
     {
       if( isset($_SESSION['id_statut']))
       {
            
          if(Tutorat::Create_type_center($_POST['type_tutorat'])== 0)
          {
            $controller_report='admin';
            $fonction_back='interface_tutorat';

            require_once('views/superadmin/interface_tutorat.php');
          }
          else
          {
            $message = ' Un type de tutorat avec ce libellé a déja été crée , pour vous en rassurez rendez-vous à la page "les types de tutorat" ';
            $controller_report='superadmin';
            $fonction_back='create_type_center';

            require_once('views/system/error.php');
          }
       }
          else
                require_once('views/login.php');
     }

  public function delete_tutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
       Tutorat::Delete_tutorat($_POST['id_t']);

       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       $donnees= Tutorat::Get_all_tutorat();  // on recharge les données
       require_once('views/superadmin/tutorat_center_list.php');
    }
    else
      require_once('views/login.php');
  }
  public function delete_typeTutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
       Tutorat::Delete_typeTutorat($_POST['id_type']);

       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       $donnees= Tutorat::Get_all_type_tutorat(); // on recharge les données
       require_once('views/superadmin/typeTutorat_center_list.php');
    }
    else
      require_once('views/login.php');
  }
  
  public function remove_tutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
       if(Tutorat::Remove_tutorat($_POST['id_t'],$_POST['id_admin']) == 0)
         {
       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       
       header('location:?controller=superadmin&action=static_account');
        }
        else
        {
          $message = ' Opération impossible, un compte administrateur doit au minimum gérer un tutorat ';
          $controller_report='superadmin';
          $fonction_back='interface_tutorat';

          require_once('views/system/error.php');
        }
    }
    else
      require_once('views/login.php');
  }
  public function add_tutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
       Tutorat::Add_tutorat($_POST['id_t'],$_POST['id_admin']);

       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       
       header('location:?controller=superadmin&action=static_account');
    }
    else
      require_once('views/login.php');
  }

  public function account_affectation()
  {
    if( isset($_SESSION['id_statut']))
    {
       Tutorat::Account_affectation($_POST['id_admin'],$_POST['id_u']);

       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       
       require_once('views/superadmin/interface_tutorat.php');
    }
    else
      require_once('views/login.php');
  }
   
     











}