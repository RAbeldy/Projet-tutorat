<?php
require_once('connexion.php');
class Evenements 
{
	private $date_evenement;
	private $lieu;
	private $nb_tutores;
    private $nb_tuteurs;
    private $id_evenement;
    private $duree;
    private $nb_places;
    private $nb_places_tutores;

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
    public function getNb_tutores()
    {
    	return $this->nb_tutores ;
    }
    public function getNb_tuteurs()
    {
        return $this->nb_tuteurs ;
    }
    public function getNb_places()
    {
        return $this->nb_places;
    }
    public function getNb_places_tutores()
    {
        return $this->nb_places_tutores;
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
    
    public function setNb_tutores($nb_tutores)
    {
    	 $this->nb_tutores = $nb_tutores ;
    }
    public function setNb_tuteurs($nb_tuteurs)
    {
         $this->nb_tuteurs = $nb_tuteurs ;
    }
    public function setNb_places($nb_places)
    {
        $this->nb_places = $nb_places ;
    }
    public function setNb_places_tutores($nb_places_tutores)
    {
        $this->nb_places_tutores= $nb_places_tutores;
    }
    public function setDuree($duree) 
    {
        $this->Duree= $duree;
    }


    public function Tuteur_set_event($id_tuteur,$id_tutore) // créer un évènement
    {
        // une instance de la classe tuteur
        $db = Db::getInstance();
    	$statut = new Tuteurs(); 
        $req= $db->prepare("SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ");
        $req->execute(array($this->getDate_evenement(),$id_tuteur));
        if( $req->rowcount() == 0 ) // aucun évènement crée le meme jour meme heure par cette personne
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
            
            
            return 0;
    }
    else // un évènement au meme jour à la meme heure a déja été crée
    {
        return 1; 
    }
    }

    public function Tuteur_set_specific_event($id_tuteur,$id_tutore,$id_tutorat) // créer un évènement concernant un tutorart particulier
    {
        // une instance de la classe tuteur
        $db = Db::getInstance();
      $statut = new Tuteurs(); 
        $req= $db->prepare("SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ");
        $req->execute(array($this->getDate_evenement(),$id_tuteur));
        if( $req->rowcount() == 0 ) // aucun évènement crée le meme jour meme heure par cette personne
        {
          
          
          $req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutores,nb_tuteurs,nb_places,id_planning,id_statut_evenement,id_tutorat,id_user) VALUES(?,?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),?,?)');
          $req->execute(array($this->getDate_evenement(),$this->getLieu(),'0','0','0',$this->getDuree(),$id_tutorat,$id_tuteur));
            
            // on insère directement un tutorat personnalisé dans les évènements auxquels il s'est inscrit
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tuteur,$this->getDate_evenement()));

            // on insère le tutoré avec lequel il va faire cette séance juste apres
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tutore,$this->getDate_evenement()));

            echo('1 crée');
            
            
            return 0;
    }
    else // un évènement au meme jour à la meme heure a déja été crée
    {
        return 1; 
    }
    }
    
    public function Tuteur_set_event_withBoth($id_tuteur,$id_tutore1,$id_tutore2) // créer un évènement
    {
        // une instance de la classe tuteur
        $db = Db::getInstance();
      $statut = new Tuteurs(); 
        $req= $db->prepare("SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ");
        $req->execute(array($this->getDate_evenement(),$id_tuteur));
        if( $req->rowcount() == 0 ) // aucun évènement crée le meme jour meme heure par cette personne
        {
          
          
          $req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutores,nb_tuteurs,nb_places,id_planning,id_statut_evenement,id_tutorat,id_user) VALUES(?,?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),(SELECT id_tutorat FROM tutorat as t WHERE t.libelle = "TUTORAT_PERSONNALISE"),?)');
          $req->execute(array($this->getDate_evenement(),$this->getLieu(),'0','0','0',$this->getDuree(),$id_tuteur));
            
            // on insère directement un tutorat personnalisé dans les évènements auxquels il s'est inscrit
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tuteur,$this->getDate_evenement()));

            // on insère le tutoré 1 avec lequel il va faire cette séance juste apres
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tutore1,$this->getDate_evenement()));

            // on insère le tutoré 2 avec lequel il va faire cette séance juste apres
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tutore2,$this->getDate_evenement()));

            echo('1 crée');
            
            
            return 0;
    }
    else // un évènement au meme jour à la meme heure a déja été crée
    {
        return 1; 
    }
    }
    
    public function Tuteur_set_specific_event_withBoth($id_tuteur,$id_tutore1,$id_tutore2,$id_tutorat) // créer un évènement. concernant un tutorat particulier
    {
        // une instance de la classe tuteur
        $db = Db::getInstance();
      $statut = new Tuteurs(); 
        $req= $db->prepare("SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ");
        $req->execute(array($this->getDate_evenement(),$id_tuteur));
        if( $req->rowcount() == 0 ) // aucun évènement crée le meme jour meme heure par cette personne
        {
          
          
          $req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutores,nb_tuteurs,nb_places,id_planning,id_statut_evenement,id_tutorat,id_user) VALUES(?,?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),?,?)');
          $req->execute(array($this->getDate_evenement(),$this->getLieu(),'0','0','0',$this->getDuree(),$id_tutorat,$id_tuteur));
            
            // on insère directement un tutorat personnalisé dans les évènements auxquels il s'est inscrit
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tuteur,$this->getDate_evenement()));

            // on insère le tutoré 1 avec lequel il va faire cette séance juste apres
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tutore1,$this->getDate_evenement()));

            // on insère le tutoré 2 avec lequel il va faire cette séance juste apres
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_tuteur,$id_tutore2,$this->getDate_evenement()));

            echo('1 crée');
            
            
            return 0;
    }
    else // un évènement au meme jour à la meme heure a déja été crée
    {
        return 1; 
    }
    }

   public function Admin_set_event($id_admin,$id_tutorat) // créer un évènement
    { 
       
        // une instance de la classe tuteur
        $db = Db::getInstance();
      $statut = new Tuteurs(); 
        $req= $db->prepare("SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ");
        $req->execute(array($this->getDate_evenement(),$id_admin));
        if( $req->rowcount() == 0 ) // aucun évènement crée le meme jour meme heure par cette personne
        {
            
             $db = Db::getInstance();
          $req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutores,nb_tuteurs,nb_places,id_planning,id_statut_evenement,id_tutorat,id_user) VALUES(?,(SELECT adresse FROM tutorat WHERE id_tutorat = ?),?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"), ?,'.$id_admin.')');
          $req->execute(array($this->getDate_evenement(),$id_tutorat,$this->getNb_tutores(),$this->getNb_tuteurs(),$this->getNb_tuteurs(),$this->getDuree(),$id_tutorat)); 

            echo('1 crée');
          
            
            return 0;
    }
    else // un évènement au meme jour à la meme heure a déja été crée
    {
        return 1; 
    }
    }
    public function Modify_event($id_evenement,$id_tutorat)
    {
      $db = Db::getInstance();

      $req= $db->prepare("UPDATE evenement SET date_evenement=?, lieu=(SELECT adresse FROM tutorat WHERE id_tutorat = ?),nb_tutores=?,nb_tuteurs=?,nb_places=?,id_tutorat= ? WHERE id_evenement= ?");
      $req->execute(array($this->getDate_evenement(),$id_tutorat,$this->getNb_tutores(),$this->getNb_tuteurs(),$this->getNb_tuteurs(),$id_tutorat,$id_evenement));
    }

    public function Declare_hours($id_admin,$id_tutorat)
    {
      $db = Db::getInstance();
      $req= $db->prepare("SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ");
        $req->execute(array($this->getDate_evenement(),$id_admin));
        if( $req->rowcount() == 0 ) // aucun évènement crée le meme jour meme heure par cette personne
        {
          
          
          $req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutores,nb_places_tutores,nb_tuteurs,nb_places,id_planning,id_statut_evenement,id_tutorat,id_user) VALUES(?,?,?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),?,?)');
          $req->execute(array($this->getDate_evenement(),$this->getLieu(),'0','0','0','0',$this->getDuree(),$id_tutorat,$id_admin));
            
            // on insère directement un tutorat personnalisé dans les évènements auxquels il s'est inscrit
            $req = $db->prepare('INSERT INTO participer_evenement(id_evenement,id_user,date_evenement) VALUES((SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ),?,?)') ;
            $req->execute(array($this->getDate_evenement(), $id_admin,$id_admin,$this->getDate_evenement()));

            

            echo('1 crée');
            
            
            return 0;
        }
        else // un évènement au meme jour à la meme heure a déja été crée
        {
        return 1; 
        }
    }

    public static function Get_past_events($id_user) // afficher les evenements passés auxquels il a participé
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare(" SELECT t.libelle,tt.libelle as libelle_type,e.id_evenement,e.date_evenement,e.lieu,pe.valide as validé,p.duree as duree  FROM evenement as e,tutorat as t,participer_evenement as pe, planning_event as p,type_tutorat as tt WHERE e.id_tutorat= t.id_tutorat AND e.id_evenement = pe.id_evenement AND e.id_planning = p.id_planning AND t.id_typeTutorat= tt.id_typeTutorat AND  pe.date_evenement < NOW() AND pe.id_user= ? ORDER BY e.date_evenement DESC");
        $req->execute(array($id_user));
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
          
         
          $list []= array('evenement' => $event,'type_tutorat'=>$data['libelle_type'],'tutorat' => $data['libelle'],'participer_evenement' => $data['validé'],'planning_event' => $data['duree']);
        }
        return $list; 
    }
    
    public static function Get_future_events($id_user) // afficher les evenements à venir qui ne sont pas des tutorats personnalisés
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare(' SELECT t.libelle as libelle,tt.libelle as libelle_type,e.id_evenement,e.date_evenement,e.lieu,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e, tutorat as t,planning_event as p,type_tutorat as tt WHERE e.id_planning= p.id_planning AND t.id_tutorat= e.id_tutorat AND t.id_typeTutorat= tt.id_typeTutorat AND e.date_evenement > NOW()  AND e.id_evenement NOT IN (SELECT id_evenement FROM participer_evenement WHERE id_user= ? ) ORDER BY date_evenement DESC  ' );
        $req->execute(array($id_user));
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
         
          $list []= array('evenement' => $event,'type_tutorat'=>$data['libelle_type'],'tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list; 
        
       
    }
    public  function Get_subscribed_events($id_user) // récupérer la liste des évènements auxquels il a souscrit (il va participer )
    {
        
       $db = Db::getInstance();
       $list=[];
        $req= $db->prepare(" SELECT t.libelle as libelle,tt.libelle as libelle_type,e.id_evenement,e.date_evenement,e.lieu  FROM evenement as e, tutorat as t, participer_evenement as pe,type_tutorat as tt WHERE e.id_evenement=pe.id_evenement  AND e.id_tutorat= t.id_tutorat AND t.id_typeTutorat = tt.id_typeTutorat   AND e.date_evenement > NOW() AND pe.id_user= ? ORDER BY e.date_evenement DESC" );
        $req->execute(array($id_user));
        
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
         
          $list []= array('evenement' => $event,'type_tutorat'=>$data['libelle_type'],'tutorat' => $data['libelle']);
        }
        return $list; 
        
    
    }
    public function Subscribe_to_event($id_user,$id_evenement) // souscrire à un évènement
    {
       $db = Db::getInstance();
       
        $req= $db->prepare("SELECT * FROM participer_evenement WHERE id_user = ? AND id_evenement =?");
        $req->execute(array($id_user,$id_evenement));

        if($req->rowcount()== 0) // on vérifie s'il n'est pas déja inscrit à ect évènement 
        {
          $req= $db->prepare('INSERT INTO participer_evenement (id_evenement,id_user,date_evenement) VALUES(?,?,(SELECT date_evenement FROM evenement WHERE id_evenement=?))');

          $req->execute(array($id_evenement, $id_user, $id_evenement));
          return 0;
       }
       else
        return 1;
 
    }
    
    public static function Future_events_list_admin($id_admin) // liste des evenements qu'un tuteur à crée et va de ce fait y participer quand. l'évènement en question correspond à un tutorat d'un type de tutorat que je dirige 
    {
      $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(' SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_places_tutores,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e,tutorat as t,planning_event as p, administrer as ad ,participer_evenement as pe,tuteurs as tu WHERE e.id_tutorat= t.id_tutorat AND e.id_planning = p.id_planning AND e.id_evenement= pe.id_evenement AND e.id_user= pe.id_user AND pe.id_user= tu.id_tuteurs AND t.id_tutorat= ad.id_tutorat AND t.id_typeTutorat= ad.id_typeTutorat AND ad.id_admin= ? AND e.date_evenement > NOW()  ORDER BY  e.date_evenement DESC');
        $req->execute(array($id_admin));

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
          $event->setNb_places_tutores($data['nb_places_tutores']);
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }
    public static function Pasts_events_list_admin($id_admin) // liste des evenements que les tutores de la mef vont faire(tutorats personnalisés)
    {
      $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(' SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_places_tutores,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e,tutorat as t,planning_event as p, administrer as ad ,participer_evenement as pe,tuteurs as tu WHERE e.id_tutorat= t.id_tutorat AND e.id_planning = p.id_planning AND e.id_evenement= pe.id_evenement AND e.id_user= pe.id_user AND pe.id_user= tu.id_tuteurs AND t.id_tutorat= ad.id_tutorat AND t.id_typeTutorat= ad.id_typeTutorat AND ad.id_admin= ? AND e.date_evenement < NOW()  ORDER BY  e.date_evenement DESC');
        $req->execute(array($id_admin));

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
          $event->setNb_places_tutores($data['nb_places_tutores']);
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }
    public static function Future_events_list($id_admin) // liste des évènements à venir crées par un admin
    {
       $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(' SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_places_tutores,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e INNER JOIN tutorat as t ON e.id_tutorat= t.id_tutorat INNER JOIN planning_event as p ON e.id_planning = p.id_planning  WHERE  e.id_user = ? AND e.date_evenement > NOW()  ORDER BY  e.date_evenement DESC');
        $req->execute(array($id_admin));

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
          $event->setNb_places_tutores($data['nb_places_tutores']);
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }
    public static function Pasts_events_list($id_admin) // liste des évènements passés crées par un admin
    {
       $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(' SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_places_tutores,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e INNER JOIN tutorat as t ON e.id_tutorat= t.id_tutorat INNER JOIN planning_event as p ON e.id_planning = p.id_planning  WHERE  e.id_user = ? AND e.date_evenement > NOW()  ORDER BY  e.date_evenement DESC');
        $req->execute(array($id_admin));

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
          $event->setNb_places_tutores($data['nb_places_tutores']);
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }

    public static function Future_events_list_superadmin() // liste des évènements à venir  
    {
       $db = Db::getInstance();
        $list=[];
        $req = $db->query(' SELECT DISTINCT tt.libelle as libelle_type ,t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_places_tutores,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e,tutorat as t,planning_event as p,type_tutorat as tt WHERE e.id_tutorat= t.id_tutorat AND e.id_planning = p.id_planning AND t.id_typeTutorat= tt.id_typeTutorat AND e.date_evenement > NOW()  ORDER BY  e.date_evenement DESC');
        

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
          $event->setNb_places_tutores($data['nb_places_tutores']);
         
          $list []= array('evenement' => $event,'type_tutorat'=>$data['libelle_type'],'tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }

    public static function Pasts_events_list_superadmin() // liste des évènements passés 
    {
       $db = Db::getInstance();
        $list=[];
        $req = $db->query(' SELECT tt.libelle as libelle_type ,t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_places_tutores,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e,participer_evenement as pe,tutorat as t,planning_event as p,type_tutorat as tt WHERE e.id_evenement= pe.id_evenement AND e.id_tutorat= t.id_tutorat AND e.id_planning = p.id_planning AND t.id_typeTutorat= tt.id_typeTutorat AND e.date_evenement < NOW()  ORDER BY  e.date_evenement DESC');
        

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
          $event->setNb_places_tutores($data['nb_places_tutores']);
         
          $list []= array('evenement' => $event,'type_tutorat'=>$data['libelle_type'],'tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }


    public static function Subscription_list($id_evenement) // liste des participants à un évènement qu'un admin a crée 
    {
       $db = Db::getInstance();
       
       $list=[];
       
       $req= $db->prepare("SELECT u.id_user, u.nom, u.prenom, u.email, u.phone, u.niveau, u.ecole,s.libelle as libelle FROM user as u, participer_evenement as pe,avoir_statut as at , statut as s WHERE  at.id_user= u.id_user AND at.id_statut= s.id_statut  AND u.id_user = pe.id_user AND pe.id_evenement = ?  ORDER BY u.nom ");

        $req->execute(array($id_evenement));  
       
       foreach ($req->fetchAll() as $temp) 
      {
        $user = new Users();
        $user->setId_user($temp['id_user']);
        $user->setNom($temp['nom']);
        $user->setPrenom($temp['prenom']);
        $user->setEmail($temp['email']);
        $user->setPhone($temp['phone']);
        $user->setNiveau($temp['niveau']);
        $user->setEcole($temp['ecole']);

        $list []= array('user'=>$user,'statut'=>$temp['libelle']);
      }
      return $list;

    }

    public static function Get_informations_on_events($id_evenement)
    {
       $db = Db::getInstance();
       $req= $db->query("SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,pe.duree,e.nb_tutores,e.nb_tuteurs, pe.duree as duree FROM tutorat as t, evenement as e,planning_event as pe WHERE e.id_planning= pe.id_planning AND e.id_tutorat = t.id_tutorat AND e.id_evenement = ".$id_evenement." ");

       foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
          $event->setNb_tutores($data['nb_tutores']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          
         
          $list= array( $event,$data['libelle'], $data['duree']);
        }
        return $list;

    }

    public static function Get_informations_events_on_user($id_tuteur,$id_admin) // liste des evenements éffectués par un tuteur ou tutoré que j'administre(évènements que j'ai crée)
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,pe.duree as duree,p.valide as validé FROM tutorat as t,evenement as e, planning_event as pe, participer_evenement as p WHERE t.id_tutorat = e.id_tutorat AND e.id_planning= pe.id_planning AND p.id_evenement = e.id_evenement AND e.id_user= ? AND p.id_user= ? ORDER BY e.date_evenement DESC  ");
        $req->execute(array($id_admin,$id_tuteur));

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
    public static function Get_my_events_list($id_tuteur,$id_admin) // liste des evenements éffectués par un tuteur ou tutoré que j'administre(évènements qu'il a crée)
    {
        $db = Db::getInstance();
        $list = [];
        $req= $db->prepare("SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,pe.duree as duree,p.valide as validé FROM tutorat as t,evenement as e, planning_event as pe, participer_evenement as p,administrer as ad WHERE t.id_tutorat = e.id_tutorat AND t.id_tutorat= ad.id_tutorat AND t.id_typeTutorat = ad.id_typeTutorat AND ad.id_admin= ? AND e.id_planning= pe.id_planning AND p.id_evenement = e.id_evenement AND e.id_user= ? AND p.id_user= ? ORDER BY e.date_evenement DESC  ");
        $req->execute(array($id_admin,$id_tuteur,$id_tuteur));

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
    public function Cancel_participation($id_user,$id_evenement) // annuler sa particpation a un évènement
    {
        $db = Db::getInstance();
        $event = new Evenements();

        $req= $db->query("DELETE FROM participer_evenement WHERE id_evenement= $id_evenement  AND id_user= $id_user ");
       
    }

    public static function Delete_event($id_user,$id_evenement)
    {   
        require 'connectToMail.php';
        require 'PHPMailer/PHPMailerAutoload.php';

        $db = Db::getInstance();

        $data= Evenements::Subscription_list($id_evenement); // on récupère la liste des inscrits à cet évènement 
        $tab= Evenements:: Get_informations_on_events($id_evenement); // on récupère les inforamtions concernant un évènement
         
         foreach ($data as $elt) 
         {
           //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
        $message_txt = 'Bonjour Mr/Mme '.$elt['user']->getPrenom().' '.$elt['user']->getNom().',\nNous vous annoncons que l\'évènement '.$tab[1].'prévu le '.$tab[0]->getDate_evenement().' pour lequel vous vous etes inscrit a été annulé.\n Connectez-vous sur votre espace pour constater cela.\nCe message est généré automatiquement, veuillez ne pas répondre.';
        $message_html ='<html><head></head><body><p>Bonjour Mr/Mme '.$elt['user']->getPrenom().' '.$elt['user']->getNom().', </p><p>Nous vous annoncons avec infortune que l\'évènement<b>'.$tab[1].'</b> prévu le <b>'.$tab[0]->getDate_evenement().'</b> pour lequel vous vous etes inscrit a été annulé pour des raisons logistiques,et nous vous prions de nous escuser.</p><p>Connectez-vous sur votre espace pour constater cela.</b></p><p>Ce message est généré <b>automatiquement</b>, veuillez <b>ne pas répondre</b>.</p></body></html>';
                //Sujet
        $sujet = "[Yncrea tutorat] Evènement annulé ".$tab[1]." ";
                //envoie du mail
         
        $login_mail= $elt['user']->getEmail();
        include('send_mail.php');
         }

        if( preg_match('#^TUTORE#', $_SESSION['statut']) ) // la table évènement contient l'évènement et celui qui l'a crée donc on supprime quand les deux coincident( c'est magnifique ) si c'est le tutoré qui veut supprimer on s'en va chercher dans la table match le tuteur qui lui est associé
        {
         $req= $db->prepare("DELETE FROM evenement WHERE id_evenement= ? AND id_user=(SELECT id_user FROM participer_evenement WHERE id_user <> ? AND. id_evenement = ?) ");
         $req->execute(array($id_evenement,$id_user,$id_evenement));
        }
        else // c'est un tuteur ou un administrateur
        {
          $req= $db->prepare("DELETE FROM evenement WHERE id_evenement= ? AND id_user=? ");
          $req->execute(array($id_evenement,$id_user));
        }
        $req= $db->query("DELETE FROM participer_evenement WHERE id_evenement= ".$id_evenement." "); // dans ce cas on supprime en meme tant le tuteur et le tutoré s'il s'était inscrit à cet évènement
    }
    

    public static function Get_validated_events($id_tuteur)  // liste des évènements qui ont déja été validés(pour le super-admin)
    {

      $db=Db::getInstance();
      $list = [];
      $req= $db->prepare("SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,pe.duree as duree,vh.payer as payé FROM evenement as e, validation_heure as vh, planning_event as pe, tutorat as t WHERE t.id_tutorat = e.id_tutorat AND  e.id_evenement= vh.id_evenement AND vh.id_tuteurs= ? AND vh.payer = 'NON' AND  e.id_planning= pe.id_planning  " );
      $req->execute(array($id_tuteur));

      foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
          
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'planning_event' => $data['duree'],'payé'=>['payé']);
        }

        return $list;

    }
    public static function Get_paid_events($id_tuteur)  // liste des évèenements qui ont déja été payés (pour le super-admin)
    {

      $db=Db::getInstance();
      $list = [];
      $req= $db->prepare("SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,pe.duree as duree,vh.payer as payé FROM evenement as e, validation_heure as vh, planning_event as pe, tutorat as t WHERE t.id_tutorat = e.id_tutorat AND  e.id_evenement= vh.id_evenement AND vh.id_tuteurs= ?  AND vh.payer= 'OUI' AND e.id_planning= pe.id_planning  " );
      $req->execute(array($id_tuteur));

      foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
          
         
          $list []= array('evenement' => $event,'tutorat' => $data['libelle'],'planning_event' => $data['duree'],'payé'=>['payé']);
        }

        return $list;

    }
    public static function payUnpaidHours() // on met à jour la liste des evenements impayés (lors de l'export du fichier excel)
    {
        $db=Db::getInstance();
        $date= 
        $req= $db->prepare("UPDATE validation_heure SET payer= 'OUI' WHERE payer='NON'");
        $req->execute(array());
    
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
    
    public static function Update_nbplacesTutores($id_evenement,$a)
    {
      $db = Db::getInstance();
      $req= $db->query("SELECT nb_places_tutores FROM evenement WHERE id_evenement = ".$id_evenement."");
      $nb_places=($req->fetch()['nb_places_tutores'] + $a);

      $req= $db->prepare("UPDATE evenement SET nb_places_tutores =?  WHERE id_evenement= ? ");
      $req->execute(array($nb_places,$id_evenement));
    }
    
    public static function Find_occurrences_name($tab,$name,$etat) // recherche par nom et/ou état
    {
      $data= [];
      $result= [];
      //var_dump($tab);
      if($name=="" && $etat== "") // tri par rapport à l'état
      {
        return $tab;
      }
      else 
      {
        if($name =="")
        {
            foreach ($tab as $elt)
          {
           if(preg_match('#'.$etat.'#i', $elt['etat']))
            $data[]= $elt;
          } 
          //var_dump($data);
          return $data ;
        }
        else if($etat=="")
        {
              foreach ($tab as $elt)
              {
               if(preg_match('#'.$name.'#i', $elt['user']->getNom()))
                $data[]= $elt;
              } 
              //var_dump($data);
              return $data ;
        } 
        else // recherche par rapport aux deux 
        {
           
                echo($name);
               foreach ($tab as $elt) // première recherche par rapport au tutorat 
               {
                    if(preg_match('#'.$name.'#i', $elt['user']->getNom()))
                    $data[]= $elt;
                } 
               foreach ($data as $elt) // deuxième recherche par rapport à la date
               {
                    if(preg_match('#'.$etat.'#i', $elt['etat']))
                    $result[]= $elt;
                }
                 var_dump($result);
                return $result ; // on retourne le résultat final   
    }
}
}
    public static function Find_occurrences($tab,$string)
    {
      $data= [];
      //var_dump($tab);
      foreach ($tab as $elt)
      {
       if(preg_match('#'.$string.'#i', $elt['tutorat']))
        $data[]= $elt;
      } 
      return $data ;
    }

    public static function Find_occurrences_date($tab,$string,$date1,$date2)
    {
      $data= [];
      $result= [];

      if($date1== "" && $date2== "") // recherche unique par rapport au tutorat
      {
          //echo 'recherhce par string';
          foreach ($tab as $elt)
          {
            if(preg_match('#'.$string.'#i', $elt['tutorat']))
            $data[]= $elt;
          } 
        return $data ;
      }
      else // recherche par rapport à la date et/ou au tutorat
      {
        if($string == "")
        {
          //echo 'recherhce par date';
            foreach ($tab as $elt)
            {
              if(($elt['evenement']->getDate_evenement() >= $date1) && ($elt['evenement']->getDate_evenement() <= $date2))
              $data[]= $elt;
            }
            return $data ;
        }
        else
        {
          //echo 'recherche par les 2';
          foreach ($tab as $elt) // première recherche par rapport au tutorat 
          {
            if(preg_match('#'.$string.'#i', $elt['tutorat']))
            $data[]= $elt;
          } 
          foreach ($data as $elt) // deuxième recherche par rapport à la date
          {
            if(($elt['evenement']->getDate_evenement() >= $date1) && ($elt['evenement']->getDate_evenement() <= $date2))
            $result[]= $elt;
          }
          return $result ; // on retourne le résultat final
        }
      }
      
    }
    


}