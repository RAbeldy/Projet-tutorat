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

          $tutorat->Create_center();

          $donnees= Tutorat::tutorat_center_list($_SESSION['id_statut']);

          $controller_report='admin';
          $fonction_back='interface_tutorat_mef';

          require_once('views/admin/tutorat_center_list.php');
       }
          else
                require_once('views/login.php');
     }
     

     











}