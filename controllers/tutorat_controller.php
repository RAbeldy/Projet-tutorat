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
           
          $libelle= htmlspecialchars($_POST['libelle']);
          $code_postal= htmlspecialchars($_POST['code_postal']);
          $adresse= htmlspecialchars($_POST['adresse']);
          $nb_tuteurs= htmlspecialchars($_POST['nb_tuteurs']);
          $nb_tutores= htmlspecialchars($_POST['nb_tutores']);
          $id_typeTutorat= htmlspecialchars($_POST['id_typeTutorat']);

          // une instance de la classe tuteur
    
            $tutorat = new Tutorat();
            $tutorat->setLibelle($libelle);
            $tutorat->setCode_postal($code_postal);
            $tutorat->setAdresse($adresse);
            $tutorat->setNb_tuteurs($nb_tuteurs);
            $tutorat->setNb_tutores($nb_tutores);
            $tutorat->setId_typeTutorat($id_typeTutorat);
      

          if($tutorat->Create_center() == 0)
            {
              if(preg_match('#^ADMIN#',$_SESSION['statut']))
              {
                  set_donnees(Tutorat::tutorat_center_list($_SESSION['id_statut']));

                  set_controller_report('admin');
                  set_fonction_back('interface_tutorat');

                  set_route('views/admin/tutorat_center_list.php');
                }
                else
                {
                  set_donnees(Tutorat::Get_all_tutorat());  // on charge l'interface de création de tutorat

                  set_controller_report('superadmin');
                  set_fonction_back('interface_tutorat');

                  set_route('views/superadmin/tutorat_center_list.php');
                }

            }
          else
          {
            $message = ' Un tutorat avec ce libellé a déja été crée pour ce type de tutorat, pour vous en rassurez rendez-vous à la page "les centres de tutorat" ';
            set_controller_report('superadmin');
            set_fonction_back('create_center');

            set_route('views/system/error.php');
          }
       }
          else
                set_route('views/login.php');
     }

  public function create_type_center() // ils 'agit de l'action de créer à ne pas confondre dans le controller admin
     {
       if( isset($_SESSION['id_statut']))
       {
            
          if(Tutorat::Create_type_center($_POST['type_tutorat'])== 0)
          {
            set_controller_report('admin');
            set_fonction_back('interface_tutorat');

            set_route('views/superadmin/interface_tutorat.php');
          }
          else
          {
            $message = ' Un type de tutorat avec ce libellé a déja été crée , pour vous en rassurez rendez-vous à la page "les types de tutorat" ';
            set_controller_report('superadmin');
            set_fonction_back('create_type_center');

            set_route('views/system/error.php');
          }
       }
          else
                set_route('views/login.php');
     }

  public function delete_tutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
     $id_t= htmlspecialchars($_POST['id_t']);
     
     if($id_t!="")
     {
       Tutorat::Delete_tutorat($id_t);

       set_controller_report('superadmin');
       set_fonction_back('interface_tutorat');
       
       set_donnees(Tutorat::Get_all_tutorat());  // on recharge les données
       set_route('views/superadmin/tutorat_center_list.php');
     }
    else
      set_route('views/login.php');
     
    }
    else
      set_route('views/login.php');
  }
  public function delete_typeTutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
    $id_type= htmlspecialchars($_POST['id_type']);
    
    if($id_type!="")
    {
       Tutorat::Delete_typeTutorat($id_type);

       set_controller_report('superadmin');
       set_fonction_back('interface_tutorat');
       
       set_donnees(Tutorat::Get_all_type_tutorat()); // on recharge les données
       set_route('views/superadmin/typeTutorat_center_list.php');
    }
    else
      set_route('views/login.php');
    }
    else
      set_route('views/login.php');
  }
  
  public function remove_tutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
    $id_t= htmlspecialchars($_POST['id_t']);
    $id_admin= htmlspecialchars($_POST['id_admin']);
    
       if(Tutorat::Remove_tutorat($id_t,$id_admin) == 0)
         {
       set_controller_report('superadmin');
       set_fonction_back('interface_tutorat');
       
       
       set_route('views/superadmin/interface_tutorat.php');
        }
        else
        {
          $message = ' Opération impossible, un compte administrateur doit au minimum gérer un tutorat ';
          set_controller_report('superadmin');
          set_fonction_back('interface_tutorat');

          set_route('views/system/error.php');
        }
    }
    else
      set_route('views/login.php');
  }
  public function add_tutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
    $id_t= htmlspecialchars($_POST['id_t']);
    $id_admin= htmlspecialchars($_POST['id_admin']);
     if($id_t!="" && $id_admin!="")
     {
       Tutorat::Add_tutorat($id_t,$id_admin);

       set_controller_report('superadmin');
       set_fonction_back('interface_tutorat');
       
       
       set_route('views/superadmin/interface_tutorat.php');
     }
    }
    else
      set_route('views/login.php');
  }

  public function account_affectation()
  {
    if( isset($_SESSION['id_statut']))
    {
    
    $id_u= htmlspecialchars($_POST['id_u']);
    $id_admin= htmlspecialchars($_POST['id_admin']);
    if($id_u!="" && $id_admin!="")
     {
       Tutorat::Account_affectation($id_u,$id_admin);

       set_controller_report('superadmin');
       set_fonction_back('interface_tutorat');
      
       set_route('views/superadmin/interface_tutorat.php');
     }
    }
    else
      set_route('views/login.php');
  }
   
     











}