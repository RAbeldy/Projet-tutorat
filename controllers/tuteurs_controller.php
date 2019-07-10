<?php
require_once('models/tuteurs.php');
require_once('models/evenement.php');
/* Définition du controller */
class TuteursController
{



    public function Set_event() // créer un évènement
    {
        // une instance de la classe tuteur
        $event = new Evenements(); 
        $event->setDate_creation()= $_POST['date_creation'];
        $event->setLieu()= $_POST['lieu'];
        $event->setNb_tuteurs()= $_POST['tuteurs'];
        $event->setNb_tutorés()= $_POST['tutorés'];
        $event->Set_event();
        require_once();  // on charge la vue adéquate
        
    }
    public function Display_past_events() // afficher les evenements passés auxquels il a participé
    {
        $event = new Evenements();
        $donnees = $event->Get_past_events();
        require_once('');  // on charge la vue adéquate
        
    }
    public function Display_future_events() // afficher les evenements passés
    {
        $event = new Evenements();
        $donnees = $event->Get_future_events();
        require_once('');  // on charge la vue adéquate
      
    }
    public function Display_validated_events() // afficher les evenements validés ( on s'en va regarder lorque l'id du tuteur est )
    {
     
        $event = new Evenements();
        $donnees = $event->Get_validated_events();
        require_once('');
        return $req; 
    }
    public function Subscribe_event()     // souscrire  à un évènement 
    {
        $tuteur = new Tuteurs();
        $event = new Evenements();
        
        if( ($nb=$event->getNb_tuteurs) > 0)
       {
        $nb--;
        $event->setNb_tuteurs($nb);  // on met à jour le nombre de tuteurs pour l'évènement
        $tuteur->Subscribe_events(); // on officialise l'inscription du tuteurs
        $ajout= TRUE;
        require_once('');
       }
       else
       {
        $ajout= FALSE;
        require_once('');
       }
      
        
    }




}
?>