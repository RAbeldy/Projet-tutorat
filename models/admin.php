<?php
require_once('connexion.php');
require_once('models/users.php');
require_once('models/evenements.php');

class Admin
{
	


    public function __construct(){}


    public static function Get_my_tutores($id_admin) // liste des tutores qui appartiennent à un type de tutorat
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal,e.libelle as libelle  FROM user as u,adresse as a, avoir_statut as at, tutores as t, se_destine as se, administrer as ad,etat as e WHERE e.id_etat= at.id_etat AND  at.id_user = u.id_user AND t.id_tutores= u.id_user AND   u.id_adresse = a.id_adresse AND t.id_tutores= se.id_user AND  se.id_tutorat= ad.id_tutorat AND se.id_typeTutorat = ad.id_typeTutorat AND ad.id_admin= ?  ORDER BY nom ASC");
        $req->execute(array($id_admin));
        
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

        $list []= array('user'=>$users,'etat'=>$data['libelle']);
      }
      return $list ;
        
    }

    public static function Get_all_tuteurs()  // liste des tuteurs 
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal,t.demande  FROM user as u,adresse as a, avoir_statut as at,tuteurs as t WHERE   at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND t.id_tuteurs= u.id_user ORDER BY nom ASC");
        
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

        $list []= array('user'=>$users,'tuteurs'=>$data['demande']);
      }
      return $list ;
        
    }

    public static function Choose_tuteur($id_tuteur,$id_tutorat) // l'admin choisit un tuteur qui sera d'office inscrit à ses évènements quand il en créera, ceci en passant l'attribut appartenance à la bonne valeur
    {
        $db = Db::getInstance();
         
        $req= $db->prepare("INSERT INTO se_destine(id_user,id_tutorat,id_typeTutorat) VALUES(?,?,(SELECT id_typeTutorat FROM tutorat WHERE id_tutorat = ?)) ");
        $req->execute(array($id_tuteur,$id_tutorat,$id_tutorat));

        $req= $db->query("UPDATE tuteurs SET demande = 'OUI' WHERE id_tuteurs= ".$id_tuteur." ");
       
    }
    
    public static function Cancel_tuteur($id_tuteur) // l'admin annule la participation d'un tuteur  à ses évènements quand il en créera, ceci en passant l'attribut appartenance à la bonne valeur
    {
        $db = Db::getInstance();

        $req = $db->query("DELETE FROM se_destine  WHERE id_user = ".$id_tuteur." ");

        $req= $db->query("UPDATE tuteurs SET demande = 'NON' WHERE id_tuteurs= ".$id_tuteur." ");
    }
    
    public static function Get_free_tuteurs() // liste des tutorés affiliés à l'admin et pouvants éffectuer des liaisons avec ses tutorés
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT u.id_user,u.nom,u.prenom FROM user as u, tuteurs as t WHERE u.id_user = t.id_tuteurs AND t.nb_linksmef <= t.nb_max_mef    ");

        foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
         $list []= array('user'=>$users);
      }
      return $list ;
    }

    public static function link($id_tuteur,$id_tutore) // lier un tuteur et un tutoré
    {
        $db = Db::getInstance();
        

        $req = $db->prepare(" INSERT INTO matchs (id_tuteurs,id_tutores) VALUES (?,?)");
        $req->execute(array($id_tuteur,$id_tutore));
        
        // l'etat du tutoré passe à occupé
        $req = $db->prepare("UPDATE avoir_statut SET id_etat = (SELECT id_etat FROM etat WHERE libelle = 'OCCUPE') WHERE id_user = ?");
        $req->execute(array($id_tutore));

        $nb= Admin::Get_nb_links($id_tuteur) ;
        $nb= $nb + 1 ;

        $req= $db->query("UPDATE tuteurs SET nb_linksmef= ".$nb." WHERE id_tuteurs= ".$id_tuteur."  ");
    }

    public static function Get_nb_links($id_tuteur) // nombre de liaisons dans le cadre de la mef
    {
        $db = Db::getInstance();

        $req= $db->query("SELECT nb_linksmef FROM tuteurs  WHERE id_tuteurs= ".$id_tuteur." ");
        
        
        return $nb= $req->fetch()['nb_linksmef'];
    }
    
    /* on ne va pas leur permmettre de mettre fin à leur collaboration seul un admin pourra le faire ou alors automatiquement à la fin d'une année*/
    public static function Delete_link($id_tutore)
    {
       $db = Db::getInstance();
       $id= $db->query("SELECT id_tuteurs FROM matchs WHERE id_tutores= ".$id_tutore.""); // on récupère l'id du tuteur avec qui il est en relation
       $nb= Admin::Get_nb_links($id->fetch()['id_tuteurs']) ;
        $nb= $nb-1;

        $req= $db->prepare("UPDATE tuteurs SET nb_linksmef= ? WHERE id_tuteurs= ? ");
        $req->execute(array($nb,$id->fetch()['id_tuteurs']));

        $req = $db->prepare(" DELETE FROM matchs WHERE id_tutores= ? ");
        $req->execute(array($id_tutore)); 

        // l'etat du tutoré passe à occupé
        $req = $db->prepare("UPDATE avoir_statut SET id_etat = (SELECT id_etat FROM etat WHERE libelle = 'LIBRE') WHERE id_user = ?");
        $req->execute(array($id_tutore));

        
    }
    
    public static function Validate_hours($id_e,$id_tuteur,$duree)
    {
        $db = Db::getInstance();

        $req= $db->prepare("UPDATE participer_evenement SET valide='OUI' WHERE id_evenement=? AND id_user= ?");
        $req->execute(array($id_e,$id_tuteur));
        
        // on insère dans la table de validation des heures
        $req= $db->prepare("INSERT INTO validation_heure(id_evenement,id_tuteurs,durée) VALUES(?,?,?)");
        $req->execute(array($id_e,$id_tuteur,$duree));
    }
    

    
    
}

    