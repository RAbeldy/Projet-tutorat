<?php
require_once('models/tuteurs.php');
require_once('models/evenements.php');
require_once('models/tutorat.php');
require_once('controllers/admin_controller.php');
class EvenementsController
{

	public function tuteur_set_event() // créer un évènement
    {
      if( isset($_SESSION['id_statut']))
        {
            // une instance de la classe tuteur
            $event = new Evenements(); 
            $event->setDate_evenement( $_POST['date_creation']);
            $event->setLieu( $_POST['lieu']);
            $event->setDuree( $_POST['duree']);
            
            var_dump($_POST['id_2']); 
            if(is_null($_GET['id'] ))
            {
              if($_POST['id_2'] == "") // le tuteur crée un évènement avec un seul de ses tutorés
              {
                if( $event->Tuteur_set_event($_SESSION['id_user'],$_POST['id_1']) == 0) // on a récupéré l'identifiant de celui avec qui il aura un tutorat personnalisé ou alors l'identifiant du lieu
                {   
                    require_once('views/tuteurs/interface_tuteur.php');
                  
                } 
                else
                {
                    $message = 'Vous avez déja un évènement prévu à cette date et à cette heure, rendez vous dans la rubrique "je me suis inscrit à " pour le supprimer, puis dans "créer évènement", créer en un nouveau si vous le souhaitez';
                    $controller_report='tuteurs';
                    $fonction_back='tuteurs_set_event';
                    require_once('views/system/error.php');
                } 
              }
              else // le tuteur crée un évènement avec 2 de ses tutorés
              {
                if( $event->Tuteur_set_event_withBoth($_SESSION['id_user'],$_POST['id_1'],$_POST['id_2']) == 0) // on a récupéré l'identifiant de celui avec qui il aura un tutorat personnalisé ou alors l'identifiant du lieu
                {   
                    require_once('views/tuteurs/interface_tuteur.php');
                  
                } 
                else
                {
                    $message = 'Vous avez déja un évènement prévu à cette date et à cette heure, rendez vous dans la rubrique "je me suis inscrit à " pour le supprimer, puis dans "créer évènement", créer en un nouveau si vous le souhaitez';
                    $controller_report='tuteurs';
                    $fonction_back='tuteurs_set_event';

                    require_once('views/system/error.php');
                } 
              }
            }
            else
            {
              if($_POST['id_2'] == "") // le tuteur crée un évènement avec un seul de ses tutorés
              {
                if( $event->Tuteur_set_specific_event($_SESSION['id_user'],$_POST['id_1'],$_GET['id']) == 0) // on a récupéré l'identifiant de celui avec qui il aura un tutorat personnalisé ou alors l'identifiant du lieu
                {   
                    require_once('views/tuteurs/interface_tuteur.php');
                } 
                else
                {
                    $message = 'Vous avez déja un évènement prévu à cette date et à cette heure, rendez vous dans la rubrique "je me suis inscrit à " pour le supprimer, puis dans "créer évènement", créer en un nouveau si vous le souhaitez';
                    $controller_report='tuteurs';
                    $fonction_back='tuteurs_set_event';
                    require_once('views/system/error.php');
                } 
              }
              else // le tuteur crée un évènement avec 2 de ses tutorés
              {
                if( $event->Tuteur_set_specific_event_withBoth($_SESSION['id_user'],$_POST['id_1'],$_POST['id_2'],$_GET['id']) == 0) // on a récupéré l'identifiant de celui avec qui il aura un tutorat personnalisé ou alors l'identifiant du lieu
                {   
                    require_once('views/tuteurs/interface_tuteur.php');
                  
                } 
                else
                {
                    $message = 'Vous avez déja un évènement prévu à cette date et à cette heure, rendez vous dans la rubrique "je me suis inscrit à " pour le supprimer, puis dans "créer évènement", créer en un nouveau si vous le souhaitez';
                    $controller_report='tuteurs';
                    $fonction_back='tuteurs_set_event';

                    require_once('views/system/error.php');
                } 
              }
            }
    }
      else
           require_once('views/login.php'); 
    }

    public function admin_set_event()
    {
      // une instance de la classe tuteur
            $event = new Evenements(); 
            $event->setDate_evenement( $_POST['date_creation']);
            $event->setDuree( $_POST['duree']);
            $event->setNb_tuteurs($_POST['nb_tuteurs']);
            $event->setNb_tutores($_POST['nb_tutores']);

            if( $event->Admin_set_event($_SESSION['id_user'],$_POST['id_t']) == 0) // on a récupéré l'identifiant de celui avec qui il aura un tutorat personnalisé ou alors l'identifiant du lieu
            {    
              if($_SESSION['id_statut'] == 11)
                require_once('views/admin/mef/interface_admin_mef.php');
              elseif($_SESSION['id_statut'] == 17)
                require_once('views/admin/immersion/interface_admin.php');
              else
                require_once('views/admin/interface_admin.php');
            } 
            else
            {
                $message = 'Vous avez déja un évènement prévu à cette date et à cette heure, rendez vous dans la rubrique "je me suis inscrit à " pour le supprimer, puis dans "créer évènement", créer en un nouveau si vous le souhaitez';
                $controller_report='admin';
                $fonction_back='admin_set_event';
                require_once('views/system/error.php');
            }
            
    }
    public function superadmin_set_event()
    {
      // une instance de la classe tuteur
            $event = new Evenements(); 
            $event->setDate_evenement( $_POST['date_creation']);
            $event->setDuree( $_POST['duree']);
            $event->setNb_tuteurs($_POST['nb_tuteurs']);
            $event->setNb_tutores($_POST['nb_tutores']);
            
            $data= Tutorat::Get_idAdmin_tutorat($_POST['id_t']); // on récupère l'id de l'admin qui gère ce tutorat
            
            if(!is_null($data)) // le tutorat n'est pas affilié à un compte
            {
              if( $event->Admin_set_event($data->getId_user(),$_POST['id_t']) == 0) // on a récupéré l'identifiant de celui avec qui il aura un tutorat personnalisé ou alors l'identifiant du lieu
              {    
                  require_once('views/superadmin/events.php');
              } 
              else
              {
                  $message = 'Vous avez déja un évènement prévu à cette date et à cette heure, rendez vous dans la rubrique "je me suis inscrit à " pour le supprimer, puis dans "créer évènement", créer en un nouveau si vous le souhaitez';
                  $controller_report='admin';
                  $fonction_back='admin_set_event';
                  require_once('views/system/error.php');
              }
            }
            else
            {
              $message = 'Vous avez tenté de créer un évènement pour un tutorat dont la gestion n\'est pas encore affiliée:
              rendez-vous donc dans la rubrique <strong> tutorats =>les comptes admin </strong> et faites affecter et tout ira pour le mieux après';
                  $controller_report='admin';
                  $fonction_back='admin_set_event';
                  require_once('views/system/error.php');
            }
            
    }
    public function modify_event()
    {
      // une instance de la classe tuteur
            $event = new Evenements(); 
            $event->setDate_evenement( $_POST['date_creation']);
            
            $event->setDuree( $_POST['duree']);
            

            $event->setNb_tuteurs($_POST['nb_tuteurs']);
            $event->setNb_tutores($_POST['nb_tutores']);

            $event->Modify_event($_POST['id_e'],$_POST['id_t']); // on a récupéré l'identifiant de celui avec qui il aura un tutorat personnalisé ou alors l'identifiant du lieu

            $controller_report='admin';
            $fonction_back='future_events_list';
               
              
            AdminController::future_events_list();
                     
    }
    public function display_pasts_events() // afficher les evenements passés auxquels il a participé
    {echo "l'identifiant du statut est ".$_SESSION['id_statut'];
          echo "fgfhfhfghgngf";
        
        if( isset($_SESSION['id_statut']))
        {  
          if( preg_match('#^TUTORE#', $_SESSION['statut']) ) // une regex sur le statut du user pour savoir qui est connecté
          {   
               
              
              $donnees = Evenements::Get_past_events($_SESSION['id_user']);

              $controller_report='tutores';
              $fonction_back='interface_tutore';

              require_once('views/tutores/evenements_passes_view.php');  // on charge la vue adéquate
          }
          else
          {

              $donnees = Evenements::Get_past_events($_SESSION['id_user']);

              $controller_report='tuteurs';
              $fonction_back='interface_tuteur';
              
              require_once('views/tuteurs/evenements_passes_view.php');  // on charge la vue adéquate
          }

        }
        else
            require_once('views/login.php');
    }
    public function display_future_events() // afficher les evenements à venir auxquels je peux participer
    {
        

        if( isset($_SESSION['id_statut']))
        {
          if( preg_match('#^TUTORE#',$_SESSION['statut']) )  
          {
              $event = new Evenements();
              $donnees = $event->Get_future_events($_SESSION['id_user']);

              $controller_report='tutores';
              $fonction_back='interface_tutore';

              require_once('views/tutores/evenements_a_venir_view.php');  // on charge la vue adéquate
          }
          else
          {
              $event = new Evenements();
              $donnees = $event->Get_future_events($_SESSION['id_user']);

              $controller_report='tuteurs';
              $fonction_back='interface_tuteur';

              require_once('views/tuteurs/evenements_a_venir_view.php');  // on charge la vue adéquate
          }
        }
        else
        require_once('views/login.php');
    }
    public static function page()
    {
      require_once('views/tuteurs/evenements_inscrits_a_venir_view.php');
    }
    public static function display_subscribed_events() // afficher les evenements auxquels il va participer (deja inscrit) ( on s'en va regarder lorque l'id du tuteur est )
    {
        if( isset($_SESSION['id_statut'])) // id_statut représente l'identifiant du statut correspondant au statut en question !!! ne pas confondre
        {
         if( preg_match('#^TUTORE#', $_SESSION['statut']) ) // il s'agit d'un tutore
          {
              $event = new Evenements();
              $donnees = $event->Get_subscribed_events($_SESSION['id_user']);

              $controller_report='tutores';
              $fonction_back='interface_tutore';

              require_once('views/tutores/evenements_inscrits_a_venir_view.php');  // on charge la vue adéquate
          }
          else // il s'agit d'un tuteur dans ce cas 
          {
              $event = new Evenements();
              $donnees = $event->Get_subscribed_events($_SESSION['id_user']);

              $controller_report='tuteurs';
              $fonction_back='interface_tuteur';

              require_once('views/tuteurs/evenements_inscrits_a_venir_view.php');  // on charge la vue adéquate
          }
        }
        else
            require_once('views/login.php');
    }

    public static function subscribe_to_event()    // souscrire  à un évènement 
    {          
        if( isset($_SESSION['id_statut']))
           {   
                if( preg_match('#^TUTEUR#', $_SESSION['statut']) ) // il s'agit d'un tutore
                 {
                    $event = new Evenements();
                    if(isset($_POST['id_e']) && $event->nb_places_dispo($_POST['id_e']) > 0)
                    {       
                            
                            if($event->Subscribe_to_event($_SESSION['id_user'],$_POST['id_e'])== 0)
                            {
                            $event->updateNombrePlaces($_POST['id_e'],-1);

                            EvenementsController::display_subscribed_events();
                            }
                            else
                            {
                              $message = 'Vous etes déja inscrit à cet évènement';
                              $controller_report='tuteurs';
                              $fonction_back='display_future_events';
                              require_once('views/system/error.php');
                            }
                    }
                    else
                    {   
                        $message = 'l\'évènement est complet';
                        $controller_report='evenements';
                        $fonction_back='Display_future_events';
                        require_once('views/system/error.php');
                    }
                  }
                  elseif( preg_match('#^TUTORE#', $_SESSION['statut']) )  // il s'agit d'un tutore qui s'inscritt à un évènement
                  {
                    $event = new Evenements();
                    if($event->Subscribe_to_event($_SESSION['id_user'],$_POST['id_e']) == 0)
                    {
                        Evenements::Update_nbplacesTutores($_POST['id_e'],1);

                        EvenementsController::display_subscribed_events();
                    }
                    else
                    {
                      $message = 'Vous etes déja inscrit à cet évènement';
                      $controller_report='evenements';
                      $fonction_back='Display_future_events';
                      require_once('views/system/error.php');
                    }

                  }
                  else // il s'agit d'un admin qui inscrit un tuteur à un évènement
                  {
                     $event = new Evenements();
                    if(isset($_POST['id_e']) && $event->nb_places_dispo($_POST['id_e']) > 0)
                    {       
                            
                            if($event->Subscribe_to_event($_POST['id_u'],$_POST['id_e']) == 0)
                            {
                              $event->updateNombrePlaces($_POST['id_e'],-1);

                              AdminController::Sfuture_events_list();
                            }
                            else
                            {
                              $message = 'Ce tuteur est déja inscrit à cet évènement';
                              $controller_report='admin';
                              $fonction_back='Sfuture_events_list';
                              require_once('views/system/error.php');
                            }
                    }
                    else
                    {   
                        $message = 'l\'évènement est complet';
                        $controller_report='evenements';
                        $fonction_back='Display_future_events';
                        require_once('views/system/error.php');
                    }
                  }
            }
         else
         {
            require_once('views/login.php');
         }
    }


public function cancel_participation()
    {
     
     if( isset($_SESSION['id_statut']))
           {   
                if( preg_match('#TUTEUR#', $_SESSION['statut']) ) // il s'agit d'un tuteur
                 {
                         if(isset($_POST['id_e_c'] ))
                         {
                            //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_c'];
                              $event= new Evenements();
                              $event->Cancel_participation($_SESSION['id_user'],$_POST['id_e_c']);
                              $event->updateNombrePlaces($_POST['id_e_c'],1);
                              
                              EvenementsController::display_subscribed_events();
                         }
                         elseif(isset($_POST['id_e_d']))
                         {
                            //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                              $event= new Evenements();
                              $event->Delete_event($_SESSION['id_user'],$_POST['id_e_d']);
                              
                              EvenementsController::display_subscribed_events();
                         }
                         else
                        {   
                            //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                            $controller_report='evenements';
                            $fonction_back='Display_subscribed_events';
                            require_once('views/system/error.php');
                        }
                  }
                elseif ( preg_match('#^TUTORE#', $_SESSION['statut']) ) // il s'agit d'un tutore
                 {
                         if(isset($_POST['id_e_c'] ))
                         {
                            //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_c'];
                              $event= new Evenements();
                              $event->Cancel_participation($_SESSION['id_user'],$_POST['id_e_c']);
                              Evenements::Update_nbplacesTutores($_POST['id_e_c'],-1); // on met à joue le nombre de tutorés inscrits
                              
                              EvenementsController::display_subscribed_events(); 
                         }
                         elseif(isset($_POST['id_e_d']))
                         {
                            //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                              $event= new Evenements();
                              $event->Delete_event($_SESSION['id_user'],$_POST['id_e_d']);
                              
                              EvenementsController::display_subscribed_events();
                         }
                         else
                        {   
                            //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                            $controller_report='evenements';
                            $fonction_back='Display_subscribed_events';
                            require_once('views/system/error.php');
                        } 
                  }
                
           }
      else
      {
        require_once('views/login.php');
      }
    }



    public static function subscription_list()
    {
       if( isset($_SESSION['id_statut']))
       {
          $donnees = Evenements::Subscription_list($_POST['id_e']); // on récupère la liste des participants
          $data= Evenements::Get_informations_on_events($_POST['id_e']);  // on récupère la date, le. lieu etc sur l'évenement
          $controller_report='admin';
          $fonction_back='pasts_events_list';

          require_once('views/admin/subscription_list.php');
       }    
       else
          require_once('views/login.php');
    }
    public static function Ssubscription_list() // cette fonction est la mm que subscription_list à la seule différence qu'elle permet la sélection des tuteurs d'ou le préfixe S
    {
       if( isset($_SESSION['id_statut']))
       {
          $donnees = Evenements::Subscription_list($_POST['id_e']); // on récupère la liste des participants
          $data= Evenements::Get_informations_on_events($_POST['id_e']);  // on récupère la date, le. lieu etc sur l'évenement
          $req= Tutorat::Get_lieu_tutorat($_SESSION['id_user']); // on récupère la liste des tutorats que l'admin administre
          $controller_report='admin';
          $fonction_back='Sfuture_events_list';

          require_once('views/admin/Ssubscription_list.php');
       }    
       else
          require_once('views/login.php');
    }
    
    public function declare_hours()  // on valide les heures concernant un évènement(administration dans le cas des administrateurs)
    {
      if( isset($_SESSION['id_statut']))
       {
           // une instance de la classe evenements

            $event = new Evenements(); 
            $event->setDate_evenement( $_POST['date_creation']);
            $event->setLieu( $_POST['lieu']);
            $event->setDuree( $_POST['duree']);

           if( $event->Declare_hours($_SESSION['id_user'],$_POST['id_t']) == 0) // l'admin déclarelui memeses heures effectuées
            {
                  AdminController::interface_hours(); // on recharge. la page de déclaration d'heure
            } 
            else
            {
                $message = 'Vous avez déja un évènement prévu à cette date et à cette heure, rendez vous dans la rubrique "je me suis inscrit à " pour le supprimer, puis dans "créer évènement", créer en un nouveau si vous le souhaitez';
                $controller_report='admin';
                $fonction_back='admin_set_event';
                require_once('views/system/error.php');
            }

          

       }
       else
          require_once('views/login.php');
    }
    
    
    

}



