<?php
require_once('connexion.php');
class Evenements 
{
	private $date_evenement;
	private $lieu;
	private $nb_tutorés;
    private $nb_tuteurs;
    private $id_evenement;
    private $duree;
    private $nb_places;

    public function __construct(){}

    public function getId_evenement()
    {
        return $this->id_evenement;
    }
    public function getDate_evenement()
    {
    	return $this->date_evenement ;
    }
    public function getLieu()
    {
    	return $this->lieu ;
    }
    public function getNb_tutorés()
    {
    	return $this->nb_tutorés ;
    }
    public function getNb_tuteurs()
    {
        return $this->nb_tuteurs ;
    }
    public function getNb_places()
    {
        return $this->nb_places;
    }
   public function getDuree()
    {
        return $this->Duree;
    }
    public function setId_evenement($id_evenement)
    {
        $this->id_evenement= $id_evenement;
    }
    public function setDate_evenement($date)
    {
    	 $this->date_evenement= $date ;
    }
    public function setLieu($lieu)
    {
    	 $this->lieu= $lieu ;
    }
    
    public function setNb_tutorés($nb_tutorés)
    {
    	 $this->nb_tutorés = $nb_tutorés ;
    }
    public function setNb_tuteurs($nb_tuteurs)
    {
         $this->nb_tuteurs = $nb_tuteurs ;
    }
    public function setNb_places($nb_places)
    {
        $this->nb_places = $nb_places ;
    }
    public function setDuree($duree)
    {
        $this->Duree= $duree;
    }


    public function Set_event($id_tuteur,$id_tutore) // créer un évènement
    {
        // une instance de la classe tuteur
        $db = Db::getInstance();
    	$statut = new Tuteurs(); 
        $req= $db->prepare("SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ");
        $req->execute(array($this->getDate_evenement(),$id_tuteur));
        if( $req->rowcount() == 0 ) // aucun évènement crée le meme jour meme heure par cette personne
        {
        	if( $_SESSION['id_statut'] == '13')
        	{
        	
        	$req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutores,nb_tuteurs,nb_places,id_planning,id_statut_evenement,id_tutorat,id_user) VALUES(?,?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),(SELECT id_tutorat FROM tutorat as t WHERE t.libelle = "TUTORAT_PERSONNALISE"),?)');
        	$req->execute(array($this->getDate_evenement(),$this->getLieu(),'0','0','0',$this->getDuree(),$id_tuteur));
            
            // on insère directement un tutorat personnalisé dans les évènements auxquels il s'est inscrit
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tuteur,$this->getDate_evenement()));

            // on insère le tutoré avec lequel il va faire cette séance juste apres
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tutore,$this->getDate_evenement()));

            echo('1 crée');
            }
            else // un admin crée un évènement
            {
             $db = Db::getInstance();
        	$req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutorés,nb_tuteurs,id_planning,id_statut_evenement,id_tutorat,id_user) VALUES(?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),(SELECT id_tutorat FROM tutorat as t WHERE t.libelle = "TUTORAT_PERSONNALISE"),'.$_SESSION['id_user'].'))');
        	$req->execute($this->getDate_evenement(),$this->getLieu(),$this->getNb_tutorés(),$this->getNb_tuteurs());	
            }
            return 0;
    }
    else // un évènement au meme jour à la meme heure a déja été crée
    {
        return 1; 
    }
    }
   

    public function Get_past_events($id_user) // afficher les evenements passés auxquels il a participé
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query(" SELECT t.libelle,e.id_evenement,e.date_evenement,e.lieu,pe.valide as validé,p.duree as duree  FROM evenement as e INNER JOIN tutorat as t ON e.id_tutorat= t.id_tutorat INNER JOIN participer_evenement as pe ON e.id_evenement = pe.id_evenement INNER JOIN planning_event as p ON e.id_planning = p.id_planning WHERE pe.date_evenement < NOW() AND pe.id_user= $id_user ");
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
          
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'participer_evenement' => $data['validé'],'planning_event' => $data['duree']);
        }
        return $list; 
    }
    public  function Get_future_events() // afficher les evenements à venir qui ne sont pas des tutorats 
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query(' SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e INNER JOIN tutorat as t ON e.id_tutorat= t.id_tutorat INNER JOIN planning_event as p ON e.id_planning = p.id_planning WHERE t.libelle <> "TUTORAT_PERSONNALISE" AND e.date_evenement > NOW() AND e.id_evenement NOT IN (SELECT id_evenement FROM participer_evenement)');
        
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list; 
        
       
    }
    public  function Get_subscribed_events($id_user) // récupérer la liste des évènements auxquels il a souscrit (il va participer )
    {
        $list=[];
       $db = Db::getInstance();
        $req= $db->query(" SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu  FROM evenement as e, tutorat as t, participer_evenement as pe WHERE e.id_evenement=pe.id_evenement  AND e.id_tutorat= t.id_tutorat   AND e.date_evenement > NOW() AND pe.id_user= $id_user ");
        
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle']);
        }
        return $list; 
        
    
    }
    public function Subscribe_to_event($id_user,$id_evenement) // souscrire à un évènement
    {
       $db = Db::getInstance();
       $event = new Evenements();

        $req= $db->prepare('INSERT INTO participer_evenement (id_evenement,id_user,date_evenement) VALUES(?,?,(SELECT date_evenement FROM evenement WHERE id_evenement=?))');

        $req->execute(array($id_evenement, $id_user, $id_evenement));
 
    }

    public function Subscription_list($id_evenement)
    {
       $db = Db::getInstance();
       $event = new Evenements();
       $list=[];
       
       $req= $db->prepare('SELECT  e.nb_places,e.nb_tuteurs,e.date_evenement,e.lieu,t.libelle,u.nom,u.prenom,c.niveau,c.ecole FROM evenement as e, tutorat as t, participer_evenement as pe ,user as u, classe as c WHERE e.id_tutorat= t.id_tutorat AND e.id_evenement = pe.id_evenement AND u.id_user = pe.id_user AND c.id_classe = u.id_classe AND pe.id_evenement= ? ))');

        $req->execute(array($id_evenement));
       
       foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
    
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'classe' => $data,'user'=>$data);
        }
        return $list;

    }

    public function Cancel_participation($id_user,$id_evenement) // annuler sa particpation aun évènement
    {
        $db = Db::getInstance();
        $event = new Evenements();

        $req= $db->query("DELETE FROM participer_evenement WHERE id_evenement= $id_evenement  AND id_user= $id_user ");
       
    }

    public function Delete_event($id_user,$id_evenement)
    {
        $db = Db::getInstance();
        $req= $db->query("DELETE FROM participer_evenement WHERE id_evenement= $id_evenement "); // dans ce cas on supprime en meme tant le tutteur et le tutoré s'il c'était inscrit à cet évènement
        $req= $db->query("DELETE FROM evenement WHERE id_evenement= $id_evenement AND id_user= $id_user  ");
        // la table évènement contient l'évènement et celui qui l'a crée donc on supprime quand les deux coincident( c'est magnifique )
    }

    public  function Get_nb_inscrits($id_evenement) // le nombre de tuteurs deja. inscrits à l'évènement
    {
        $db = Db::getInstance(); 
        
        $req= $db->prepare("SELECT count(id_evenement) as rowcount FROM participer_evenement WHERE id_evenement= ?");
        $req->execute(array($id_evenement));

        return $req;
    }

    public  function nb_places_dispo($id_evenement) // nombre de places à pourvoir pour l'évènement
    {
        $db = Db::getInstance();
        
        $req= $db->prepare("SELECT nb_places FROM evenement  WHERE id_evenement= ?");
        $req->execute(array($id_evenement));

        return $req->fetch()['nb_places'];
    }

    public function updateNombrePlaces($id_evenement,$a)
    {
       $db = Db::getInstance();
       $event = new Evenements();
       $req = $db->prepare("UPDATE evenement SET nb_places= ? WHERE id_evenement= ?");
       $nbPlace = ($event->nb_places_dispo($id_evenement) + $a);
       $req->execute(array($nbPlace,$id_evenement));
    }
    

    


}