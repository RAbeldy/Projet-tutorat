<?php
require_once('models/evenements.php');
require_once('models/users.php');
require_once('models/tutorat.php');
require_once('models/admin.php');

$indice= $_GET['indice'];

switch ($indice) {
	case '1': // évènements à venir
				$tab = Evenements::Future_events_list_superadmin();
                $donnees= Evenements::Find_occurrences_date($tab,$_POST['string'],$_POST['date1'],$_POST['date2']);

                $controller_report='superadmin'; 
              	$fonction_back='events';

               require_once('views/superadmin/future_events_list.php');
		break;

	case '2': // évènements passés
				$tab = Evenements::Pasts_events_list_superadmin();
                $donnees= Evenements::Find_occurrences_date($tab,$_POST['string'],$_POST['date1'],$_POST['date2']);

                $controller_report='superadmin'; 	
              	$fonction_back='events';

               require_once('views/superadmin/pasts_events_list.php');
		break;

	case '3': // liste des tuteurs
				$tab = Admin::Get_all_tuteurs();
                $donnees= Evenements::Find_occurrences_name_etat($tab,$_POST['name'],$_POST['etat']);

                $controller_report='superadmin'; 
             	$fonction_back='interface_tuteur';

               require_once('views/superadmin/tuteurs_list.php');
		break;

	case '4': // liste des tutorés
				$tab = Admin::Get_all_tutores();
                $donnees= Evenements::Find_occurrences_name_etat($tab,$_POST['name'],$_POST['etat']);

                $controller_report='superadmin'; 
             	$fonction_back='interface_tutore';

               require_once('views/superadmin/tutores_list.php');
		break;

	case '5': // liste des tuteurs qui appartiennent à un tutorat
				$tab = Superadmin::All_selected_tuteurs();
                $donnees= Evenements::Find_occurrences_name($tab,$_POST['name'],$_POST['etat']);

                $controller_report='superadmin'; 
             $fonction_back='interface_tuteur';

             require_once('views/superadmin/tuteurs_belonging_list.php');
		break;

	case '6': // liste des tutorés qui appartiennent à un tutorat 
				$tab = Superadmin::All_selected_tutores();               
                $donnees= Evenements::Find_occurrences_name_etat($tab,$_POST['name'],$_POST['etat']);

                $controller_report='superadmin'; 
             	$fonction_back='interface_tutore';

               require_once('views/superadmin/tutores_belonging_list.php');
		break;

	case '7': // liste des centres de tutorat
				$tab = Tutorat::Get_all_tutorat();
                $donnees= Evenements::Find_occurrences_tutorat($tab,$_POST['tutorat']);

                $controller_report='superadmin';
          		$fonction_back='interface_tutorat';
          
          require_once('views/superadmin/tutorat_center_list.php');
		break;
	case '8': // liste des tuteurs pour affectation de gestion de compte admin
				$tab = Admin::Get_all_tuteurs();
           		$data= Tutorat::Get_available_account();
 				$donnees= Evenements::Find_occurrences_name_etat($tab,$_POST['name'],$_POST['etat']);

           		$controller_report='superadmin'; 
           		$fonction_back='interface_tutorat';

           require_once('views/superadmin/admin_affectation.php');
		break;
	case '9':   // liste des comptes admin statiques
				$tab = Tutorat::Get_static_account();
           		
 				$donnees= Evenements::Find_occurrences_type_tutorat($tab,$_POST['type']);

           		$controller_report='superadmin'; 
           		$fonction_back='interface_tutorat';

           require_once('views/superadmin/static_account.php');
		break;
	case '10': // cumul des heures impayées
				$tab = Users::Get_unpaidHours_tuteurs(); // liste des tuteurs qui ont des heures impayees
                $donnees= Evenements::Find_occurrences_name($tab,$_POST['name']);

                $controller_report='superadmin'; 
          		$fonction_back='interface_hours';

          		require_once('views/superadmin/validated_history.php');
		break;

	case '11': // cumul des heures payées 

				$tab = Users::Get_paidHours_tuteurs(); // liste des tuteurs et de leurs heures deja payées
                $donnees= Evenements::Find_occurrences_name($tab,$_POST['name']);

                $controller_report ='superadmin'; 
          		$fonction_back ='interface_hours';

          		require_once('views/superadmin/paid_history.php');
		break;

	default:
				UsersController::deconnexion();
		break;
}
































?>
