<?php
require_once('connexion.php');
require('users.php');
require('evenements.php');
class Tuteurs
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

   
    
    
    public function Link_with_tutores($id_tuteur,$id_tutore)
    {
        $db = Db::getInstance();
        $req = $db->prepare(" INSERT INTO en_attente (id_tuteurs,id_tutores,provenance) VALUES (?,?,'TUTEUR')");
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
    public function Cancel_wish($id_tuteur,$id_tutore)
    {
        $db = Db::getInstance();
        $req = $db->prepare(" DELETE FROM en_attente WHERE id_tuteurs = ? AND id_tutores= ? AND provenance ='TUTEUR' AND statut_liaison='INACTIF'");
        $req->execute(array($id_tuteur,$id_tutore));
    }

    public function Get_wish_list($id_user)
    {
       $db = Db::getInstance();
       $list=[];
       $req = $db->prepare(" SELECT   u.id_user,nom,prenom,date_naissance,email,phone,a.ville ,a.adress ,a.code_postal  FROM user as u, statut as s,adresse as a, avoir_statut as at,en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND u.id_user= e.id_tutores AND e.id_tuteurs=  ? AND e.provenance = 'TUTEUR' AND e.statut_liaison= 'INACTIF' ORDER BY nom ASC");
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

    public function Accept_link($id_tuteur,$id_tutore)
    {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE en_attente SET statut_liaison ='ACTIF',date_debut = NOW() WHERE id_tuteurs =? AND id_tutores = ? AND provenance='TUTORE' ");
        $req->execute(array($id_tuteur,$id_tutore));

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

    public function Get_free_tutores()  // la liste des tuteurs disponibles
    {
        $db = Db::getInstance();
        $list=[];
        
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal  FROM user as u,adresse as a, avoir_statut as at, tutores as t, etat as e WHERE e.id_etat= at.id_etat AND e.libelle= 'LIBRE' AND  at.id_user = u.id_user AND t.id_tutores= u.id_user AND   u.id_adresse = a.id_adresse AND u.id_user NOT IN (SELECT id_tutores as id_user FROM matchs) AND u.id_user NOT IN (SELECT id_tutores as id_user FROM en_attente)  ORDER BY nom ASC");
        
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

    public function Get_working_list($id_user)
    {
        $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(" SELECT  u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal  FROM user as u,adresse as a,matchs as m WHERE   u.id_adresse = a.id_adresse AND u.id_user= m.id_tutores AND m.id_tuteurs =  ? ORDER BY nom ASC");
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
    public function Get_all_tutores()
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT  u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal  FROM user as u, statut as s,adresse as a, avoir_statut as at, etat as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND e.id_etat = at.id_etat AND e.libelle = 'LIBRE' AND s.libelle= 'TUTORE' OR s.libelle= 'TUTORE_PRREL' OR s.libelle= 'TUTORE_NONPRREL' AND u.id_user NOT IN (SELECT id_tutores as id_user FROM matchs) AND u.id_user NOT IN (SELECT id_tutores as id_user FROM en_attente) ORDER BY nom ASC");
        
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

         
                $req= $db->prepare('SELECT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at, en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse  AND e.provenance= "TUTORE" AND e.statut_liaison="INACTIF"  AND u.id_user = e.id_tutores AND e.id_tuteurs = ? ORDER BY nom ASC ');
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
        
    public static function Get_proposal($id_tuteur)
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT tt.libelle as libelle_type, t.id_tutorat as id_tutorat,t.libelle as libelle,t.adresse as adresse,t.code_postal,u.id_user,u.nom,u.prenom,u.email FROM user as u, administrer as a, type_tutorat as tt, tutorat as t,se_destine as se WHERE a.id_tutorat= se.id_tutorat AND a.id_typeTutorat= se.id_typeTutorat AND se.id_tutorat= t.id_tutorat AND se.id_typeTutorat = t.id_typeTutorat AND tt.id_typeTutorat= t.id_typeTutorat AND u.id_user= a.id_admin AND se.id_user= ? AND se.liaison='NON' ORDER BY libelle ");
        $req->execute(array($id_tuteur));

        foreach ($req->fetchAll() as $data)
                  {
                    $users= new Users();
                    $users->setId_user($data['id_user']);
                    $users->setNom($data['nom']);
                    $users->setPrenom($data['prenom']);
                    $users->setEmail($data['email']);
                   

                    $list []= array('user' => $users,'type_tutorat'=>$data['libelle_type'],'libelle'=>$data['libelle'],'tutorat'=>$data['id_tutorat'],'adresse'=>$data['adresse'],'code_postal'=>$data['code_postal']);
                  }
                  return $list ;

    }    
    
    public static function Accept_proposal($id_tuteur,$id_tutorat)
    {
      $db = Db::getInstance();
      $req= $db->prepare("UPDATE se_destine SET liaison = 'OUI' WHERE id_user= ? AND id_tutorat= ?");
      $req->execute(array($id_tuteur,$id_tutorat));

    }
    public static function Refuse_proposal($id_tuteur,$id_tutorat) // le tuteur refuse une offre faite par un admin pour  sa participation  à ses évènements quand il en créera, ceci en passant l'attribut appartenance à la bonne valeur
    {
        $db = Db::getInstance();

        $req = $db->prepare("DELETE FROM se_destine  WHERE id_user = ? AND id_tutorat=?");
        $req->execute(array($id_tuteur,$id_tutorat));

        //$req= $db->query("UPDATE tuteurs SET demande = 'NON' WHERE id_tuteurs= ".$id_tuteur." ");
    }
    

}