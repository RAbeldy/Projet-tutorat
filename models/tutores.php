<?php
require_once('connexion.php');
require_once('models/users.php');

class Tutores 
{
	private $id_tutore;
	private $charte;


    public function __construct(){}


    public function getId_tutores()
    {
    	return $this->id_tutores ;
    }
    public function getCharte()
    {
    	return $this->charte ;
    }
    public function setId_tutore($id_tutore)
    {
    	 $this->$id_tutore= $id_tutore ;
    }
    public function setCharte($charte)
    {
    	 $this->$charte= $charte ;
    }

    public function Link_with_tuteurs($id_tutore,$id_tuteur)
    {
        $db = Db::getInstance();
        $req = $db->prepare(" INSERT INTO en_attente (id_tuteurs,id_tutores,provenance) VALUES (?,?,'TUTORE')");
        $req->execute(array($id_tuteur,$id_tutore));
    }
    
    /* on ne va pas leur permmettre de mettre fin à leur collaboration seul un admin pourra le faire ou alors automatiquement à la fin d'une année
    public function Delete_link($id_user)
    {
       $db = Db::getInstance();
        $req = $db->prepare(" DELETE FROM matchs WHERE id_tuteurs =? AND id_tutores= ? ");
        $req->execute(array($_SESSION['id_user'],$id_user)); 
    }
    */
    public function Cancel_wish($id_tutore,$id_tuteur)
    {
        $db = Db::getInstance();
        $req = $db->prepare(" DELETE FROM en_attente WHERE id_tuteurs = ? AND id_tutores= ? AND provenance ='TUTORE' AND statut_liaison='INACTIF'");
        $req->execute(array($id_tuteur,$id_tutore));
    }

    public function Get_wish_list($id_user)
    {
       $db = Db::getInstance();
       $list=[];
       $req = $db->prepare(" SELECT   u.id_user,nom,prenom,date_naissance,email,phone,a.ville ,a.adress ,a.code_postal  FROM user as u, statut as s,adresse as a, avoir_statut as at,en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND u.id_user= e.id_tuteurs AND e.id_tutores=  ? AND e.provenance = 'TUTORE' AND e.statut_liaison= 'INACTIF' ORDER BY nom ASC");
        $req->execute(array($id_user));

        
      foreach ($req->fetchAll() as $data)
      {
            $users= new Users();
            $users->setId_user($data['id_user']);
            $users->setNom($data['nom']);
            $users->setPrenom($data['prenom']);
            $users->setDate_naissance($data['date_naissance']);
            $users->setEmail($data['email']);
            $users->setPhone($data['phone']);
            $users->setAdress($data['adress']);
            $users->setVille($data['ville']);
            $users->setCode_postal($data['code_postal']);

            $list []=  $users;
      }
      return $list ;
    }

    public function Accept_link($id_tutore,$id_tuteur)
    {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE en_attente SET statut_liaison ='ACTIF',date_debut = NOW() WHERE id_tuteurs =? AND id_tutores = ? AND provenance='TUTEUR' ");
        $req->execute(array($id_tuteur,$id_tutore));
        // l'etat du tutoré passe à occupé
        $req = $db->prepare("UPDATE avoir_statut SET id_etat = (SELECT id_etat FROM etat WHERE libelle = 'OCCUPE') WHERE id_user = ?");
        $req->execute(array($id_tutore));

        $req = $db->prepare(" INSERT INTO matchs (id_tuteurs,id_tutores) VALUES (?,?)");
        $req->execute(array($id_tuteur,$id_tutore));
        
        // on met à jour le nombre de liaisons
        $nb= Admin::Get_nb_links($id_tuteur) + 1;

        $req= $db->query("INSERT INTO tuteurs(nb_linksperso) VALUES( ".$nb.")  ");

    }

    public static function Get_nb_links($id_tuteur) // nombre de liaisons dans le cadre du tutorat personnalisé
    {
        $db = Db::getInstance();

        $req= $db->query("SELECT nb_linksperso FROM tuteurs  WHERE id_tuteurs= ".$id_tuteur." ");

        return $req;
    }

    public function Get_working_list($id_user)
    {
        $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(" SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal  FROM user as u, statut as s,adresse as a, avoir_statut as at,matchs as m WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND u.id_user= m.id_tuteurs AND m.id_tutores =  ? ORDER BY nom ASC ");
        $req->execute(array($id_user));

        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= $users;
      }
      return $list ;
    }

    public function Get_free_tuteurs()  // la liste des tuteurs disponibles
    {
        $db = Db::getInstance();
        $list=[];
        
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at,tuteurs as t WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND t.id_tuteurs = u.id_user AND t.nb_linksperso <= t.nb_max_perso AND  u.id_adresse = a.id_adresse AND s.libelle= 'TUTEUR'  ORDER BY nom ASC");
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= $users;
      }
      return $list ;
        
    }
    
    
    public function Get_waiting_list($id_user)
    {
        $db = Db::getInstance();
        $list=[];

         
                $req= $db->prepare('SELECT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at, en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse  AND e.provenance= "TUTEUR" AND e.statut_liaison="INACTIF"  AND u.id_user= e.id_tuteurs AND e.id_tutores = ? ORDER BY nom ASC ');
                $req->execute(array($id_user));

                   
                  foreach ($req->fetchAll() as $data)
                  {
                    $users= new Users();
                    $users->setId_user($data['id_user']);
                    $users->setNom($data['nom']);
                    $users->setPrenom($data['prenom']);
                    $users->setDate_naissance($data['date_naissance']);
                    $users->setEmail($data['email']);
                    $users->setPhone($data['phone']);

                    $list []= array('user' => $users,'adresse'=>$data['ville'],'adresse'=>$data['adress'],'adresse'=>$data['code_postal']);
                  }
                  return $list ;
    }
    public function Validate_hours($id_e,$duree)
    {
        $db = Db::getInstance();

        $req= $db->prepare("UPDATE participer_evenement SET valide='OUI' WHERE id_evenement=?");
        $req->execute(array($id_e));
        
        // on insère dans la table de validation des heures
        $req= $db->prepare("INSERT INTO validation_heure(id_evenement,id_tuteurs,durée) VALUES(?,(SELECT id_user FROM evenement WHERE id_evenement= ?),?)");
        $req->execute(array($id_e,$id_e,$duree));


    }
        
        
}

    