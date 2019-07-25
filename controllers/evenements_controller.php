<?php
require_once('models/tuteurs.php');
require_once('models/evenements.php');

class EvenementsController
{

	public function set_event() // créer un évènement
    {
      if( isset($_SESSION['id_statut']))
        {
            // une instance de la classe tuteur
            $event = new Evenements(); 
            $event->setDate_evenement( $_POST['date_creation']);
            $event->setLieu( $_POST['lieu']);
            $event->setDuree( $_POST['duree']);
            if(isset($_POST['nb_tuteurs']) && isset($_POST['nb_tutorés']) )
            {
            $event->setNb_tuteurs($_POST['nb_tuteurs']);
            $event->setNb_tutorés($_POST['nb_tutorés']);
            }
            
             
            if( $event->Set_event($_SESSION['id_user'],$_POST['id_t']) == 0) // on a récupéré l'identifiant de celui avec qui il aura un tutorat personnalisé
                require_once('views/tuteurs/interface_tuteur.php');  
            else
            {
                $message = 'Vous avez déja un évènement prévu à cette date et à cette heure, rendez vous dans la rubrique "je me suis inscrit à " pour le supprimer, puis dans "créer évènement", créer en un nouveau si vous le souhaitez';
                $controller_report='tuteurs';
                $fonction_back='interface_tuteur';
                require_once('views/system/error.php');
            } 
      }
      else
           require_once('views/login.php'); 
    }
    public function display_pasts_events() // afficher les evenements passés auxquels il a participé
    {
        
        if( isset($_SESSION['id_statut']))
        {  
          if( preg_match('#^TUTORE#', $_SESSION['statut']) ) // une regex sur le statut du user pour savoir qui est connecté
          {   
               
              $event = new Evenements();
              $donnees = $event->Get_past_events($_SESSION['id_user']);
              require_once('views/tutores/evenements_passes_view.php');  // on charge la vue adéquate
          }
          else
          {

             
              $event = new Evenements();
              $donnees = $event->Get_past_events($_SESSION['id_user']);
              require_once('views/tuteurs/evenements_passes_view.php');  // on charge la vue adéquate
          }

        }
        else
            require_once('views/login.php');
    }
    public function display_future_events() // afficher les evenements à venir
    {
        

        if( isset($_SESSION['id_statut']))
        {
          if( preg_match('#^TUTORE#',$_SESSION['statut']) )  
          {
              $event = new Evenements();
              $donnees = $event->Get_future_events($_SESSION['id_user']);
              require_once('views/tutores/evenements_a_venir_view.php');  // on charge la vue adéquate
          }
          else
          {
              $event = new Evenements();
              $donnees = $event->Get_future_events($_SESSION['id_user']);
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
              require_once('views/tutores/evenements_inscrits_a_venir_view.php');  // on charge la vue adéquate
          }
          else // il s'agit d'un admin dans ce cas 
          {
              $event = new Evenements();
              $donnees = $event->Get_subscribed_events($_SESSION['id_user']);
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
                
                if(isset($_POST['id_e']) && $event->nb_places_dispo($_POST['id_e'])>0)
                {       
                        $event = new Evenements();
                        $event->Subscribe_to_event($_SESSION['id_user'],$_POST['id_e']);
                        $event->updateNombrePlaces($_POST['id_e'],-1);

                        EvenementsController::display_subscribed_events();
                }
                else
                {   
                    $message = 'l\'évènement est complet';
                    $controller_report='evenements';
                    $fonction_back='Display_future_events';
                    require_once('views/system/error.php');
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
                 if(isset($_POST['id_e_c'] ))
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_c'];
                      $event= new Evenements();
                      $event->Cancel_participation($_SESSION['id_user'],$_POST['id_e_c']);
                      $event->updateNombrePlaces($_POST['id_e_c'],1);
                      require_once('views/tuteurs/interface_tuteur.php');
                 }
                 elseif(isset($_POST['id_e_d']))
                 {
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                      $event= new Evenements();
                      $event->Delete_event($_SESSION['id_user'],$_POST['id_e_d']);
                      require_once('views/tuteurs/interface_tuteur.php');
                 }
                 else
                {   
                    //echo "gfgfdghdfhxvvdvdfdfdkfhmdfhdmkfdhfdkmlfhdvn;vdkmbnvdfhdvfbnifldhfdklfdhfikhdg".$_POST['id_e_d'];
                    $controller_report='evenements';
                    $fonction_back='Display_subscribed_events';
                    require_once('views/system/error.php');
                }
           }
      else
      {
        require_once('views/login.php');
      }
    }
    public function subscription_list()
    {
     $event= new Evenements();
     $donnees = $event->Subscription_list($_GET['id_e']);
     if( isset($_SESSION['id_statut']))
        require_once('views/subscription_list.php');
    else
            require_once('views/login.php');
    }
}



