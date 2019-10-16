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
                  $donnees= Tutorat::tutorat_center_list($_SESSION['id_statut']);

                  $controller_report='admin';
                  $fonction_back='interface_tutorat';

                  require_once('views/admin/tutorat_center_list.php');
                }
                else
                {
                  $donnees= Tutorat::Get_all_tutorat();  // on charge l'interface de création de tutorat

                  $controller_report='superadmin';
                  $fonction_back='interface_tutorat';

                  require_once('views/superadmin/tutorat_center_list.php');
                }

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
     $id_t= htmlspecialchars($_POST['id_t']);
     
     if($id_t!="")
     {
       Tutorat::Delete_tutorat($id_t);

       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       $donnees= Tutorat::Get_all_tutorat();  // on recharge les données
       require_once('views/superadmin/tutorat_center_list.php');
     }
    else
      require_once('views/login.php');
     
    }
    else
      require_once('views/login.php');
  }
  public function delete_typeTutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
    $id_type= htmlspecialchars($_POST['id_type']);
    
    if($id_type!="")
    {
       Tutorat::Delete_typeTutorat($id_type);

       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       $donnees= Tutorat::Get_all_type_tutorat(); // on recharge les données
       require_once('views/superadmin/typeTutorat_center_list.php');
    }
    else
      require_once('views/login.php');
    }
    else
      require_once('views/login.php');
  }
  
  public function remove_tutorat()
  {
    if( isset($_SESSION['id_statut']))
    {
    $id_t= htmlspecialchars($_POST['id_t']);
    $id_admin= htmlspecialchars($_POST['id_admin']);
    
       if(Tutorat::Remove_tutorat($id_t,$id_admin) == 0)
         {
       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       
       require_once('views/superadmin/interface_tutorat.php');
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
    $id_t= htmlspecialchars($_POST['id_t']);
    $id_admin= htmlspecialchars($_POST['id_admin']);
     if($id_t!="" && $id_admin!="")
     {
       Tutorat::Add_tutorat($id_t,$id_admin);

       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
       
       
       require_once('views/superadmin/interface_tutorat.php');
     }
    }
    else
      require_once('views/login.php');
  }

  public function account_affectation()
  {
    if( isset($_SESSION['id_statut']))
    {
    
    $id_t= htmlspecialchars($_POST['id_u']);
    $id_admin= htmlspecialchars($_POST['id_admin']);
    if($id_t!="" && id_admin!="")
     {
       Tutorat::Account_affectation($id_t,$id_admin);

       $controller_report='superadmin';
       $fonction_back='interface_tutorat';
      
       require_once('views/superadmin/interface_tutorat.php');
     }
    }
    else
      require_once('views/login.php');
  }
   
     











}