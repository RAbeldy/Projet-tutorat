<?php
require_once('connexion.php');
class Evenements 
{
	private $date_creation;
	private $lieu;
	private $nb_tutorés;
    private $nb_tuteurs;

    public function __construct(){}


    public function getDate_creation()
    {
    	return $this->nb_max_mef ;
    }
    public function getLieu()
    {
    	return $this->nb_max_perso ;
    }
    public function getNb_tutorés()
    {
    	return $this->prioritaire ;
    }
    public function getNb_tuteurs()
    {
        return $this->prioritaire ;
    }
    public function setDate_creation($date)
    {
    	 $this->$nb_max_mef= $date ;
    }
    public function setLieu($lieu)
    {
    	 $this->$nb_max_mef= $lieu ;
    }
    public function setNb_tutorés($nb)
    {
    	 $this->prioritaire = $nb ;
    }
    public function setNb_tuteurs($nb)
    {
         $this->prioritaire = $nb ;
    }


    public function Set_event() // créer un évènement
    {
        // une instance de la classe tuteur
    	$statut = new Tuteurs(); 
    	if( $statut->Select_statut() == 'tuteur')
    	{
    	$db = Db::getInstance();
    	$req= $db->prepare( "INSERT INTO evenement(date_creation,lieu,nb_tutorés,nb_tuteurs) VALUES(?,?,1,1)");
    	$req-><execute($_POST['date_creation'],$_POST['lieu']);
        }
        else
        {
         $db = Db::getInstance();
    	$req= $db->prepare( "INSERT INTO evenement(date_creation,lieu,nb_tutorés,nb_tuteurs) VALUES(?,?,?,?)");
    	$req-><execute($_POST['date_creation'],$_POST['lieu'],$_POST['nb_tutorés'],$_POST['nb_tuteurs']);	
        }
    }
   



}