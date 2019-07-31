<?php
require_once('connexion.php');
require_once('models/users.php');

class Admin
{
	


    public function __construct(){}


    public static function Get_all_tutores() // liste des tutores qui appartiennent à un type de tutorat
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT  u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal  FROM user as u, statut as s,adresse as a, avoir_statut as at, tutores as t WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse   AND t.id_tutores = u.id_user AND t.id_typeTutorat = (SELECT id_typeTutorat FROM type_tutorat WHERE libelle = 'MEF') AND s.libelle= 'TUTORE'  ORDER BY nom ASC");
        
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

    public static function Get_all_tuteurs()  // liste des tuteurs 
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal,t.appartenance  FROM user as u, statut as s,adresse as a, avoir_statut as at,tuteurs as t WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND t.id_tuteurs = u.id_user   AND s.libelle= 'TUTEUR'  ORDER BY nom ASC");
        
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

        $list []= array('user'=>$users,'tuteurs'=>$data['appartenance']);
      }
      return $list ;
        
    }

    public static function Choose_tuteur($id_tuteur) // l'admin choisit un tuteur qui sera d'office inscrit à ses évènements quand il en créera, ceci en passant l'attribut appartenance à la bonne valeur
    {
        $db = Db::getInstance();

        $req = $db->query("UPDATE tuteurs SET appartenance= 'MEF' WHERE id_tuteurs = ".$id_tuteur." ");
    }
    
    public static function Cancel_tuteur($id_tuteur) // l'admin annule la participation d'un tuteur  à ses évènements quand il en créera, ceci en passant l'attribut appartenance à la bonne valeur
    {
        $db = Db::getInstance();

        $req = $db->query("UPDATE tuteurs SET appartenance= NULL  WHERE id_tuteurs = ".$id_tuteur." ");
    }
        
}

    