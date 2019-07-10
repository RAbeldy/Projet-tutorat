<?php
require_once('connexion.php');
require('users.php');
class Tuteurs extends users
{
	private $nb_max_mef;
	private $nb_max_perso;
	private $prioritaire;

    public function __construct(){}


    public function getNb_max_mef()
    {
    	return $this->nb_max_mef ;
    }
    public function getNb_max_perso()
    {
    	return $this->nb_max_perso ;
    }
    public function getPrioritaire()
    {
    	return $this->prioritaire ;
    }
    public function setNb_max_mef($nb)
    {
    	 $this->$nb_max_mef= $nb ;
    }
    public function setNb_max_perso($nb)
    {
    	 $this->$nb_max_mef= $nb ;
    }
    public function setPriotaire($statut)
    {
    	 $this->prioritaire = $statut ;
    }

   
    public function Get_past_events() // afficher les evenements passés auxquels il a participé
    {
        $db = Db::getInstance();
    	$req= $db->query( "SELECT * FROM participer_evenement WHERE id_user = $_SESSION['user_id'] AND date_event < NOW()" );
    	
    	return $req; 
    }
    public function Get_future_events() // afficher les evenements à venir
    {
        $db = Db::getInstance();
    	$req= $db->query( "SELECT * FROM participer_evenement WHERE date_event > NOW()" );
    	
    	return $req;
    }
    public function Get_validated_events() // afficher les evenements validés ( on s'en va regarder lorque l'id du tuteur est )
    {
       $db = Db::getInstance();
    	$req= $db->query( "SELECT * FROM participer_evenement INNER JOIN user ON  particper_evenement.id_user = $_SESSION['user_id'] INNER JOIN heure.id_user =$_SESSION['user_id']  WHERE  heure.date_valid <= participer_evenement.date_event");
    	
    	return $req; 
    }
    public function Subscribe_events() // souscrire à un évènement
    {
       $db = Db::getInstance();
    	$req= $db->query( "INSERT INTO participer_evenement (date_event) VALUES(NOW())") ;
    	
    	
    }



}