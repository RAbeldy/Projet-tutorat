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
        	
        	
        	$req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutores,nb_tuteurs,nb_places,id_planning,id_statut_evenement,id_typeTutorat,id_user) VALUES(?,?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),(SELECT id_typeTutorat FROM type_tutorat as t WHERE t.libelle = "TUTORAT_PERSONNALISE"),?)');
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

   public function Admin_set_event($id_admin) // créer un évènement
    {
        // une instance de la classe tuteur
        $db = Db::getInstance();
      $statut = new Tuteurs(); 
        $req= $db->prepare("SELECT id_evenement FROM evenement WHERE date_evenement = ? AND id_user = ? ");
        $req->execute(array($this->getDate_evenement(),$id_admin));
        if( $req->rowcount() == 0 ) // aucun évènement crée le meme jour meme heure par cette personne
        {
            if( $_SESSION['id_statut'] == '11') // un admin MEF crée un évènement
            {
             $db = Db::getInstance();
          $req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutores,nb_tuteurs,nb_places,id_planning,id_statut_evenement,id_typeTutorat,id_user) VALUES(?,?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),(SELECT id_typeTutorat FROM type_tutorat as t WHERE t.libelle = "MEF"),'.$id_admin.')');
          $req->execute(array($this->getDate_evenement(),$this->getLieu(),$this->getNb_tutores(),$this->getNb_tuteurs(),$this->getNb_tuteurs(),$this->getDuree())); 

            echo('1 crée');
            }
            elseif( $_SESSION['id_statut'] == '11')
            {
              $db = Db::getInstance();
              $req= $db->prepare( 'INSERT INTO evenement(date_evenement,lieu,nb_tutorés,nb_tuteurs,id_planning,id_statut_evenement,id_typeTutorat,id_user) VALUES(?,?,?,?,(SELECT id_planning from planning_event as pe WHERE pe.duree= ?),(SELECT id_statut_evenement from statut_evenement as se WHERE se.libelle= "A_VENIR"),(SELECT id_typeTutorat FROM type_tutorat as t WHERE t.libelle = "MEF"),'.$id_admin.'))');
            $req->execute($this->getDate_evenement(),$this->getLieu(),$this->getNb_tutores(),$this->getNb_tuteurs());  
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
        $req= $db->query(" SELECT t.libelle,e.id_evenement,e.date_evenement,e.lieu,pe.valide as validé,p.duree as duree  FROM evenement as e INNER JOIN type_tutorat as t ON e.id_typeTutorat= t.id_typeTutorat INNER JOIN participer_evenement as pe ON e.id_evenement = pe.id_evenement INNER JOIN planning_event as p ON e.id_planning = p.id_planning WHERE pe.date_evenement < NOW() AND pe.id_user= ".$id_user." ORDER BY e.date_evenement DESC");
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
          
         
          $list []= array('evenement' => $event,'type_tutorat' => $data['libelle'],'participer_evenement' => $data['validé'],'planning_event' => $data['duree']);
        }
        return $list; 
    }
    public  function Get_future_events($id_user) // afficher les evenements à venir qui ne sont pas des tutorats personnalises 
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare(' SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e INNER JOIN type_tutorat as t ON e.id_typeTutorat= t.id_typeTutorat INNER JOIN planning_event as p ON e.id_planning = p.id_planning WHERE t.libelle <> "TUTORAT_PERSONNALISE" AND e.date_evenement > NOW() AND e.id_evenement NOT IN (SELECT id_evenement FROM participer_evenement WHERE id_user = ?) ORDER BY  e.date_evenement DESC');
        $req->execute(array($id_user));
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
         
          $list []= array('evenement' => $event,'type_tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list; 
        
       
    }
    public  function Get_subscribed_events($id_user) // récupérer la liste des évènements auxquels il a souscrit (il va participer )
    {
        
       $db = Db::getInstance();
       $list=[];
        $req= $db->query(" SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu  FROM evenement as e, type_tutorat as t, participer_evenement as pe WHERE e.id_evenement=pe.id_evenement  AND e.id_typeTutorat= t.id_typeTutorat   AND e.date_evenement > NOW() AND pe.id_user= ".$id_user." ORDER BY e.date_evenement DESC" );
        
        
        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
         
          $list []= array('evenement' => $event,'type_tutorat' => $data['libelle']);
        }
        return $list; 
        
    
    }
    public function Subscribe_to_event($id_user,$id_evenement) // souscrire à un évènement
    {
       $db = Db::getInstance();
       

        $req= $db->prepare('INSERT INTO participer_evenement (id_evenement,id_user,date_evenement) VALUES(?,?,(SELECT date_evenement FROM evenement WHERE id_evenement=?))');

        $req->execute(array($id_evenement, $id_user, $id_evenement));
 
    }

    public static function Future_events_list($id_admin) // liste des évènements à venir crées par un admin
    {
       $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(' SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e INNER JOIN type_tutorat as t ON e.id_typeTutorat= t.id_typeTutorat INNER JOIN planning_event as p ON e.id_planning = p.id_planning  WHERE  e.id_user = ? AND e.date_evenement > NOW()  ORDER BY  e.date_evenement DESC');
        $req->execute(array($id_admin));

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
         
          $list []= array('evenement' => $event,'type_tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }
    public static function Pasts_events_list($id_admin) // liste des évènements passés crées par un admin
    {
       $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(' SELECT t.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,e.nb_tuteurs,e.nb_places,p.duree as duree FROM evenement as e INNER JOIN type_tutorat as t ON e.id_typeTutorat= t.id_typeTutorat INNER JOIN planning_event as p ON e.id_planning = p.id_planning  WHERE  e.id_user = ? AND e.date_evenement > NOW()  ORDER BY  e.date_evenement DESC');
        $req->execute(array($id_admin));

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setNb_tuteurs($data['nb_tuteurs']);
          $event->setLieu($data['lieu']);
          $event->setNb_places($data['nb_places']);
         
          $list []= array('evenement' => $event,'type_tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }

    public static function Subscription_list($id_evenement) // liste des participants à un évènement qu'un admin a crée
    {
       $db = Db::getInstance();
       
       $list=[];
       
       $req= $db->prepare("SELECT u.id_user,u.nom,u.prenom,u.email,u.phone,c.niveau,c.ecole FROM user as u, classe as c, participer_evenement as pe WHERE u.id_classe = c.id_classe AND u.id_user = pe.id_user AND pe.id_evenement = ?");

        $req->execute(array($id_evenement));  
       
       foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setId_user($temp['id_user']);
        $user->setNom($temp['nom']);
        $user->setPrenom($temp['prenom']);
        $user->setEmail($temp['email']);
        $user->setPhone($temp['phone']);

        $list[]=array('user'=>$user,'classe'=>$temp['niveau'],'classe'=>$temp['ecole']);
      }
      return $list;

    }

    public static function Get_informations_on_events($id_evenement)
    {
       $db = Db::getInstance();
       $req= $db->query("SELECT tt.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu,pe.duree as duree FROM type_tutorat as tt, evenement as e,planning_event as pe WHERE e.id_planning= pe.id_planning AND e.id_typeTutorat = tt.id_typeTutorat AND e.id_evenement = ".$id_evenement." ");

       foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
          
         
          $list []= array('evenement' => $event,'type_tutorat' => $data['libelle'],'planning_event' => $data['duree']);
        }
        return $list;

    }

    public static function Get_informations_events_on_user($id_tuteur)
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT tt.libelle as libelle,e.id_evenement,e.date_evenement,e.lieu ,p.duree as duree,p.valide as validé FROM type_tutorat as tt,evenement as e, planning_event as pe, participer_evenement as p WHERE tt.id_typeTutorat = e.id_typeTutorat AND e.id_planning= pe.id_planning AND p.id_evenement = e.id_evenement AND p.id_user= ? ORDER BY e.date_evenement DESC  ");
        $req->execute(array($id_tuteur));

        foreach($req->fetchAll() as $data)
        { 
          $event= new Evenements();
          $event->setId_evenement($data['id_evenement']);
          $event->setDate_evenement($data['date_evenement']);
          $event->setLieu($data['lieu']);
          
         
          $list []= array('evenement' => $event,'type_tutorat' => $data['libelle'],'participer_evenement' => $data['validé'],'planning_event' => $data['duree']);
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
        if( $_SESSION['id_statut'] == 13) // la table évènement contient l'évènement et celui qui l'a crée donc on supprime quand les deux coincident( c'est magnifique ) si c'est le tutoré qui veut supprimer on s'en va chercher dans la table match le tuteur qui lui est associé
        $req= $db->query("DELETE FROM evenement WHERE id_evenement= $id_evenement AND id_user= $id_user ");
      
        else // on rajoutera peut etre une condition au cas ou un admin voudrait supprimer cet evenement
        {
           $req= $db->query("DELETE FROM evenement WHERE id_evenement= $id_evenement AND id_user = (SELECT id_tuteurs FROM matchs WHERE id_tutores = $id_user) "); 
        }
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