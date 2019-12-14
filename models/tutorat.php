<?php
require_once('connexion.php');
class Tutorat
{

	private $libelle;
	private $id_tutorat;
	private $id_typeTutorat;
	private $adresse;
	private $code_postal;
	private $nb_tuteurs;
	private $nb_tutores;


    public function __construct(){}
    
	public function getLibelle()
	{
		return $this->libelle;
	}

	public function getId_tutorat()
	{
		return $this->id_tutorat;
	}
	public function getId_typeTutorat()
	{
		return $this->id_typeTutorat;
	}

	public function getAdresse()
	{
		return $this->adresse;
	}
	public function getCode_postal()
	{
		return $this->code_postal;
	}
	public function getNb_tuteurs()
	{
		return $this->nb_tuteurs;
	}
    
    public function getNb_tutores()
	{
		return $this->nb_tutores;
	}
    
	public function setLibelle($libelle)
	{
	 	$this->libelle= $libelle;
	}

	public function setId_tutorat($id_tutorat)
	{
		$this->id_tutorat= $id_tutorat;
	}

	public function setId_typeTutorat($id_typeTutorat)
	{
		$this->id_typeTutorat= $id_typeTutorat;
	}
	public function setAdresse($adresse)
	{
		$this->adresse= $adresse;
	}

	public function setCode_postal($code_postal)
	{
		$this->code_postal= $code_postal;
	}
	public function setNb_tuteurs($nb_tuteurs)
	{
		 $this->nb_tuteurs= $nb_tuteurs;
	}
    
    public function setNb_tutores($nb_tutores)
	{
		 $this->nb_tutores= $nb_tutores;
	}



	public static function Get_tutorat($id_admin)  // liste des lieux(tutorats) où se passe un type de tutorat en particulier( IL NE L'AURA QUE LORQUE LE SUPERAMIN LUI AURA DONNE LA GESTION DU TUTORAT EN QUESTION)
    {
        $db = Db::getInstance();
        $list=[];
        $req = $db->query("SELECT tt.libelle as libelle_type,tt.id_typeTutorat as id_typeTutorat,t.libelle as libelle,t.id_tutorat as id_tutorat, t.adresse as adresse,t.code_postal as code_postal FROM tutorat as t, administrer as a,type_tutorat as tt WHERE tt.id_typeTutorat = t.id_typeTutorat AND t.id_tutorat =   a.id_tutorat AND t.id_typeTutorat= a.id_typeTutorat AND  a.id_admin= ".$id_admin." ");

      foreach ($req->fetchAll() as $data)
      {
        $tutorat= new Tutorat();
        
        $tutorat->setId_tutorat($data['id_tutorat']);
        $tutorat->setId_typeTutorat($data['id_typeTutorat']);
        $tutorat->setLibelle($data['libelle']);
        $tutorat->setAdresse($data['adresse']);
        $tutorat->setCode_postal($data['code_postal']);

        $list []= array('tutorat'=>$tutorat,'type_tutorat'=>$data['libelle_type']);
      }
      return $list ;
    }

    public static function Get_specific_tutorat_list($id_typeTutorat) // liste des tutorats d'un type de tutorat en particulier(utilisée dans le superadmin controller)
    {
      $db = Db::getInstance();
        $list=[];
        $req = $db->prepare("SELECT t.libelle as libelle,t.id_tutorat as id_tutorat FROM tutorat as t WHERE t.id_typeTutorat= ? ");
        $req->execute(array($id_typeTutorat));

        if($req->rowCount() != 0)
        {
          foreach ($req->fetchAll() as $data)
          {
           $list []= array($data['libelle'],$data['id_tutorat']);
          }
          return $list ;
        }
        else 
          return 0;
      
    }
    
    public static function Get_working_tutorat($id_tuteur)  // liste des tutorats pour lesquels un tuteur travaille( ceux pour lesquels il a été choisi)
    {
        $db = Db::getInstance();
        $list=[];
        $req = $db->query("SELECT t.libelle as libelle,t.id_tutorat as id_tutorat FROM tutorat as t, se_destine as se WHERE t.id_tutorat =   se.id_tutorat AND t.id_typeTutorat= se.id_typeTutorat AND  se.id_user= ".$id_tuteur." ");

      foreach ($req->fetchAll() as $data)
      {
       $list []= array($data['libelle'],$data['id_tutorat']);
      }
      return $list ;
    }
    
    public static function Get_all_tutorat() // liste de tous les tutorats qui existent et leur administrateurs respectifs
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT tt.libelle as libelle_type,tt.id_typeTutorat as id_typeTutorat,t.id_tutorat as id_tutorat,t.libelle as libelle, t.adresse as adresse,t.code_postal as code_postal FROM tutorat as t, type_tutorat as tt WHERE tt.id_typeTutorat = t.id_typeTutorat  ORDER BY libelle_type ASC ");

        foreach($req->fetchAll() as $data)
      {
        $tutorat= new Tutorat();
        

        $tutorat->setId_tutorat($data['id_tutorat']);
        $tutorat->setId_typeTutorat($data['id_typeTutorat']);
        $tutorat->setLibelle($data['libelle']);
        $tutorat->setAdresse($data['adresse']);
        $tutorat->setCode_postal($data['code_postal']);
       

        $list []= array('tutorat'=>$tutorat,'type_tutorat'=>$data['libelle_type']);
      }
      return $list ;

    }

    public static function Get_available_account() // liste de tous les tutorats qui ne sont pas administrés par quelqu'un (on verifie que l'id du compte statiue n'est pas présent dans la table suivi admin )
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom FROM user as u,administrer as ad WHERE u.id_user= ad.id_admin AND ad.id_admin NOT IN (SELECT sa.id_admin FROM suivi_administrateurs as sa )  ORDER BY prenom ASC ");

        foreach($req->fetchAll() as $data)
      {
        
        $user= new Users();
        $user->setId_user($data['id_user']);
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        

        $list []= array('user'=>$user);
      }
      return $list ;

    }
    public static function Get_working_account($id_user) // liste des comptes que cet utilisateur administre
    {
      $db = Db::getInstance();
        $list=[];
        $req = $db->prepare("SELECT DISTINCT tt.libelle , tt.id_typeTutorat,ad.id_admin,u.nom,u.prenom  FROM user as u,type_tutorat as tt, suivi_administrateurs as sa,administrer as ad WHERE u.id_user= ad.id_admin AND  sa.id_user = ? AND sa.id_admin= ad.id_admin AND ad.id_typeTutorat= tt.id_typeTutorat ");
        $req->execute(array($id_user));

        foreach ($req->fetchAll() as $data)
      {
        $tutorat= new Tutorat();
        $user= new Users();

        $user->setId_user($data['id_admin']);
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);

         $tutorat->setId_typeTutorat($data['id_typeTutorat']);
        $tutorat->setLibelle($data['libelle']);

        $list []= array('user'=>$user,'tutorat'=>$tutorat);
      }
      return $list ;
    }

    public static function Account_affectation($id_admin,$id_user)
    {
        require 'connectToMail.php';
        require 'PHPMailer/PHPMailerAutoload.php';

     $db = Db::getInstance();
     $req= $db->prepare("INSERT INTO suivi_administrateurs(id_admin,id_user)VALUES(?,?) ");
     $req->execute(array($id_admin,$id_user));

     $data= Users::Get_info($id_user);
     $donnees= Users::Get_admin($id_admin);
     $tab= Tutorat::Get_specific_static_account($id_admin);
     
     //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
        $message_txt = 'Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().',\nVous etes à présent adminsitrateur du type de tutorat '.$tab['type_tutorat'].' .\n Vous pouvez donc dès à présent vous connecter et prendre compte des taches qui sont désormais les votres.les identifiants de connexion sont les suivants\n Email= '.$donnees->getEmail().'\n Mot de passe= '.$donnees->getPassword().' .\nCe message est généré automatiquement, veuillez ne pas répondre.';
        $message_html ='<html><head></head><body><p>Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().', </p><p>Vous etes à présent adminsitrateur du type de tutorat  <b>'.$tab['type_tutorat'].'</b>.</p><p>Vous pouvez donc dès à présent vous connecter et prendre compte des taches qui sont désormais les votres. les identifiants de connexion sont les suivants:  <p>Email:  '.$donnees->getEmail().'</p> <p>Mot de passe: '.$donnees->getPassword().' </p></b></p><p>Ce message est généré <b>automatiquement</b>, veuillez <b>ne pas répondre</b>.</p></body></html>';
                //Sujet
        $sujet = "[Yncrea tutorat] Vous etes administrateur ".$tab['type_tutorat']." ";
                //envoie du mail
        
        $login_mail= $data->getEmail();
        include('send_mail.php');


    }

    public static function Delete_affectation($id_admin)
    {
        require 'connectToMail.php';
        require 'PHPMailer/PHPMailerAutoload.php';

         $db = Db::getInstance();
         $req= $db->prepare("SELECT u.id_user as id_user,u.email as email FROM user as u,suivi_administrateurs as su WHERE su.id_user= u.id_user AND  su.id_admin= ?");
         $req->execute(array($id_admin));
         if($req->rowCount() == 1)
         {
           while( $elt= $req->fetch())
           {
             $email= $elt['email'];
             $id_user=$elt['id_user'];
           }
           

           $data= Users::Get_info($id_user); // info sur la le tuteur
           $tab= Tutorat::Get_specific_static_account($id_admin); // info sur le compte statique 

           //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
          $message_txt = 'Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().',\nVous n\'etes à compter de ce jour plus adminsitrateur du type de tutorat '.$tab['type_tutorat'].' .\n Vous ne pourez donc plus vous connecter avec les identifiants que vous aviez recu.\nCe message est généré automatiquement, veuillez ne pas répondre.';
          $message_html ='<html><head></head><body><p>Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().', </p><p>Vous n\'etes à compter de ce jour plus adminsitrateur du type de tutorat  <b>'.$tab['type_tutorat'].'</b>.</p><p>Vous ne pourez donc plus vous connecter avec les identifiants que vous aviez recu. </p></b></p><p>Ce message est généré <b>automatiquement</b>, veuillez <b>ne pas répondre</b>.</p></body></html>';
                  //Sujet
          $sujet = "[Yncrea tutorat] Vous etes destitué  ";
                  //envoie du mail
          
           $req= $db->prepare("DELETE FROM suivi_administrateurs WHERE id_admin=? ");
           $req->execute(array($id_admin)); // on supprime de la table suivi_administrateurs

          $login_mail= $email;
          include('send_mail.php');
      }

         
    }

    public static function Get_available_tutorat($id_typeTutorat) // liste de tous les tutorats qui ne sont pas administrés par quelqu'un et qui correspondent au type de tutorat du compte statique
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT t.id_tutorat as id_tutorat,t.libelle as libelle, t.adresse as adresse,t.code_postal as code_postal FROM tutorat as t WHERE t.id_typeTutorat= ? AND t.id_tutorat NOT IN (SELECT id_tutorat FROM administrer)  ORDER BY libelle ASC ");
        $req->execute(array($id_typeTutorat));

        foreach($req->fetchAll() as $data)
      {
        $tutorat= new Tutorat();
        

        $tutorat->setId_tutorat($data['id_tutorat']);
        $tutorat->setLibelle($data['libelle']);
        $tutorat->setAdresse($data['adresse']);
        $tutorat->setCode_postal($data['code_postal']);
        
        

        $list []= array('tutorat'=>$tutorat);
      }
      return $list ;

    }
    public static function Get_static_account() // on récupère la liste des comptes statiques présents dans la table administrer
    {
      $db = Db::getInstance();
      $req= $db->query("SELECT DISTINCT u.nom,u.prenom,u.id_user,ad.id_typeTutorat as id_typeTutorat,tt.libelle as libelle_type  FROM user as u,type_tutorat as tt,administrer as ad WHERE u.id_user= ad.id_admin  AND ad.id_typeTutorat= tt.id_typeTutorat  ORDER BY libelle_type");

      foreach($req->fetchAll() as $data)
      {
        $tutorat= new Tutorat();
        $user= new Users();

        
        $tutorat->setId_typeTutorat($data['id_typeTutorat']);
        
        
        $user->setId_user($data['id_user']);
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        

        $list []= array('tutorat'=>$tutorat,'user'=>$user,'type_tutorat'=>$data['libelle_type']);
      }
      return $list ;
    }
    public static function Delete_static_account($id_type,$id_admin) // on supprime un compte statique
    {
      $db = Db::getInstance();
      

       $req= $db->prepare("SELECT COUNT(id_admin) as nb FROM administrer WHERE id_typeTutorat = ?");
       $req->execute(array($id_type));

        if($req-> fetch()['nb'] != 1)
        {
           Tutorat::Delete_affectation($id_admin); // on destitue le tuteur qui gérait le compte et tout le nécessaire

          $req= $db->prepare("DELETE FROM suivi_administrateurs WHERE id_admin= ? ");
          $req->execute(array($id_admin));

          $req= $db->prepare("DELETE FROM administrer WHERE id_admin= ? ");
          $req->execute(array($id_admin));

          $req= $db->prepare("DELETE FROM user  WHERE id_user= ?");
          $req->execute(array($id_admin));
          return 1;
        }
        else
          return 0;
    }

    public static function Get_specific_static_account($id_admin) // on récupère la liste des comptes statiques présents dans la table administrer
    {
      $db = Db::getInstance();
      $req= $db->prepare("SELECT DISTINCT u.nom,u.prenom,ad.id_admin as id_admin,ad.id_typeTutorat as id_typeTutorat,tt.libelle as libelle_type  FROM user as u,type_tutorat as tt,administrer as ad WHERE u.id_user= ad.id_admin  AND ad.id_typeTutorat= tt.id_typeTutorat AND ad.id_admin= ? ");
      $req->execute(array($id_admin));

      foreach($req->fetchAll() as $data)
      {
        $tutorat= new Tutorat();
        $user= new Users();

        
        $tutorat->setId_typeTutorat($data['id_typeTutorat']);
        
        
        $user->setId_user($data['id_admin']);
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        

        $list= array('tutorat'=>$tutorat,'user'=>$user,'type_tutorat'=>$data['libelle_type']);
      }
      return $list ;
    }

    public static function Get_all_type_tutorat() // récupère tous les types de tutorat existants
    {
    	$db = Db::getInstance();
        $list=[];
        $req = $db->query("SELECT libelle , id_typeTutorat  FROM type_tutorat  ");

        foreach ($req->fetchAll() as $data)
      {
       $list []= array($data['libelle'],$data['id_typeTutorat']);
      }
      return $list ;
    }
    
    public static function Get_all_trueAdmin_tutorat() // récupère la liste de tous les admin de tutorat
    {
      $db = Db::getInstance();
        $list=[];
        $req = $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.ecole,u.niveau,u.email,u.phone,a.ville ,a.adress ,a.code_postal FROM user as u,adresse as a,suivi_administrateurs as sa WHERE  u.id_adresse = a.id_adresse AND  u.id_user = sa.id_user ORDER BY nom ASC ");

        foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEcole($data['ecole']);
        $users->setNiveau($data['niveau']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= array('user'=>$users);
      }
      return $list ;
    }
    public static function Get_idAdmin_tutorat($id_tutorat) // récupère l'id d'un admin de tutorat(compte statique)
    {
      $db = Db::getInstance();
        $list= null;
        $req = $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.ecole,u.niveau,u.email,u.phone FROM user as u,administrer as ad WHERE  ad.id_tutorat= ? AND u.id_user= ad.id_admin  ORDER BY nom ASC ");
        $req->execute(array($id_tutorat));

        foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEcole($data['ecole']);
        $users->setNiveau($data['niveau']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        

        $list= $users;
      }
      
      return $list ;
    }
    
    
    public static function Get_type_tutorat($id_admin) // récupère tous les types de tutorat qu'un admin  gère
    {
    	$db = Db::getInstance();
        $list=[];
        $req = $db->prepare("SELECT libelle , id_typeTutorat  FROM type_tutorat as tt, administrer as a WHERE tt.id_typeTutorat = a.id_typeTutorat AND a.id_admin = ? ORDER BY  libelle ");
        $req->execute(array($id_admin));

        foreach ($req->fetchAll() as $data)
      {
       $list []= array($data['libelle'],$data['id_typeTutorat']);
      }
      return $list ;
    }

    public function Create_center()
    {
        $db = Db::getInstance();
        $req= $db->prepare("SELECT id_tutorat FROM tutorat WHERE libelle= ?");
        $req->execute(array($this->getLibelle()));
        
        if($req->rowCount() == 0)
        {
        $req= $db->prepare("INSERT INTO tutorat(id_typeTutorat,libelle,adresse,code_postal,nb_tutores,nb_tuteurs)VALUES(?,?,?,?,?,?)");
        $req->execute(array($this->getId_typeTutorat(),$this->getLibelle(),$this->getAdresse(),$this->getCode_postal(),$this->getNb_tutores(),$this->getNb_tuteurs()));

        return 0;
      }
      else
        return 1;

    } 
    public static function Create_type_center($type_tutorat)
    {
        $db = Db::getInstance();
        $req= $db->prepare("SELECT id_typeTutorat FROM type_tutorat WHERE libelle= ?");
        $req->execute(array($type_tutorat));
        
        if($req->rowCount() == 0)
        {
          $req= $db->prepare("INSERT INTO type_tutorat(libelle)VALUES(?)");
          $req->execute(array($type_tutorat)); 

          $req= $db->prepare("INSERT INTO statut(libelle) VALUES(?)");
          $statut= 'ADMIN_'.$type_tutorat;
          $req->execute(array($statut));
          return 0;
        }
        else
        return 1;
    } 

    public static function Delete_tutorat($id_tutorat) // on supprime définitivement un tutorat
    {
      $db = Db::getInstance();
      $req= $db->query("DELETE FROM tutorat WHERE id_tutorat= ".$id_tutorat."");
    }

    public static function Delete_typeTutorat($id_typeTutorat) // on supprime définitivement un type de tutorat 
    {
      $db = Db::getInstance();
      $req= $db->query("DELETE FROM statut WHERE libelle LIKE (SELECT libelle FROM type_tutorat WHERE id_typeTutorat =".$id_typeTutorat.")");
      $req= $db->query("DELETE FROM type_tutorat WHERE id_typeTutorat= ".$id_typeTutorat."");


    }
    
    public static function Remove_tutorat($id_tutorat,$id_admin) // on enlève la gestion d'un tutorat à un compte admin
    {
      $db = Db::getInstance();
      $req= $db->prepare("SELECT id_tutorat FROM administrer as ad WHERE id_admin=? ");
      $req->execute(array($id_admin));

      if( $req->rowCount() > 1) // on vérifie qu'un compte statique administre au moins un tutorat
      {
        $req= $db->query("DELETE FROM administrer WHERE id_tutorat= ".$id_tutorat."");
        return 0;
      }
      else
        return 1  ;
    }

    public static function Add_tutorat($id_tutorat,$id_admin) // on confie la gestion d'un tutorat à un compte admin
    {
      $db = Db::getInstance();
      $req= $db->prepare("INSERT INTO administrer(id_admin,id_tutorat,id_typeTutorat) VALUES(?,?,(SELECT id_typeTutorat FROM tutorat WHERE id_tutorat=?))");
      $req->execute(array($id_admin,$id_tutorat,$id_tutorat));
    }

    public static function Tutorat_center_list($id_admin)
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT tt.libelle as libelle_type,tt.id_typeTutorat as id_typeTutorat,t.id_tutorat as id_tutorat,t.libelle as libelle, t.adresse as adresse,t.code_postal as code_postal FROM tutorat as t, type_tutorat as tt, administrer as a WHERE tt.id_typeTutorat = t.id_typeTutorat AND a.id_typeTutorat = tt.id_typeTutorat AND a.id_tutorat = t.id_tutorat AND a.id_admin = ".$id_admin." ");

        foreach($req->fetchAll() as $data)
      {
        $tutorat= new Tutorat();
        $tutorat->setId_tutorat($data['id_tutorat']);
        $tutorat->setId_typeTutorat($data['id_typeTutorat']);
        $tutorat->setLibelle($data['libelle']);
        $tutorat->setAdresse($data['adresse']);
        $tutorat->setCode_postal($data['code_postal']);

        $list []= array('tutorat'=>$tutorat,'type_tutorat'=>$data['libelle_type']);
      }
      return $list ;

    }
}
