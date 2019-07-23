<?php
require_once('connexion.php');
require('users.php');
require('evenements.php');
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

   
    
    
    public function Link_with_tutores($id_user)
    {
        $db = Db::getInstance();
        $req = $db->prepare(" INSERT INTO en_attente (id_tuteurs,id_tutores,provenance) VALUES (?,?,'TUTEUR')");
        $req->execute(array($_SESSION['id_user'],$id_user));
    }
    
    /* on ne va pas leur permmettre de mettre fin à leur collaboration seul un admin pourra le faire ou alors automatiquement à la fin d'une année
    public function Delete_link($id_user)
    {
       $db = Db::getInstance();
        $req = $db->prepare(" DELETE FROM matchs WHERE id_tuteurs =? AND id_tutores= ? ");
        $req->execute(array($_SESSION['id_user'],$id_user)); 
    }
    */
    public function Cancel_wish($id_user)
    {
        $db = Db::getInstance();
        $req = $db->prepare(" DELETE FROM en_attente WHERE id_tuteurs = ? AND id_tutores= ? AND provenance ='TUTEUR' AND statut_liaison='INACTIF'");
        $req->execute(array($_SESSION['id_user'],$id_user));
    }

    public function Get_wish_list()
    {
       $db = Db::getInstance();
       $list=[];
       $req = $db->prepare(" SELECT   u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at,en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND u.id_user= e.id_tutores AND e.id_tuteurs=  ? AND e.provenance = 'TUTEUR' AND e.statut_liaison= 'INACTIF'");
        $req->execute(array($_SESSION['id_user']));

        $users= new Users();
      foreach ($req->fetchAll() as $data)
      {
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

    public function Accept_link($id_user)
    {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE en_attente SET statut_liaison ='ACTIF',date_debut = NOW() WHERE id_tuteurs =? AND id_tutores = ? AND provenance='TUTORE' ");
        $req->execute(array($_SESSION['id_user'],$id_user));

        $req = $db->prepare(" INSERT INTO matchs (id_tuteurs,id_tutores) VALUES (?,?)");
        $req->execute(array($_SESSION['id_user'],$id_user));
    }

    public function Get_working_list()
    {
        $db = Db::getInstance();
        $list=[];
        $req = $db->prepare(" SELECT DISTINCT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at,matchs as m WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND u.id_user= m.id_tutores AND m.id_tuteurs =  ? ");
        $req->execute(array($_SESSION['id_user']));

        $users= new Users();
      foreach ($req->fetchAll() as $data)
      {
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
    public function Get_all_tutores()
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT DISTINCT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at, etat as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND e.id_etat = at.id_etat AND e.libelle = 'LIBRE' AND s.libelle= 'TUTORE' AND u.id_user NOT IN (SELECT id_tutores as id_user FROM matchs) AND u.id_user NOT IN (SELECT id_tutores as id_user FROM en_attente)");
        
        $users= new Users();
      foreach ($req->fetchAll() as $data)
      {
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

    public function Get_waiting_list()
    {
        $db = Db::getInstance();
        $list=[];

         if( $_SESSION['id_statut'] == 13)
            {
                $req= $db->prepare('SELECT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at, en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse  AND e.provenance= "TUTORE" AND e.statut_liaison="INACTIF"  AND u.id_user = e.id_tutores AND e.id_tuteurs = ?  ');
                $req->execute(array($_SESSION['id_user']));
                    $users= new Users();
                  foreach ($req->fetchAll() as $data)
                  {
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
          else
             {
                $req= $db->prepare('SELECT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at, en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse  AND e.provenance= "TUTEUR" AND e.statut_liaison="INACTIF"  AND u.id_user= e.id_tuteurs AND e.id_tutores = ?  ');
                $req->execute(array($_SESSION['id_user']));

                    $users= new Users();
                  foreach ($req->fetchAll() as $data)
                  {
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
        
        
    }
    

}