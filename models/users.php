<?php
require_once('connexion.php');
  class Users
  {
    private $id_user;
    private $nom;
    private $prenom;
    private $email;
    private $chemin_photo;
    private $date_naissance;
    private $password;
    private $phone;
    private $ville;
    private $adress;
    private $com_adress;
    private $code_postal;
    private $niveau;
    private $ecole;

    public function __construct(){}

    public function getId_user()
    {
    return $this->id_user;
    }    

    public function getNom()
    {
    return $this->nom;
    }

    public function getPrenom()
    {
    return $this->prenom;
    }    

    public function getEmail()
    {
    return $this->email;
    }
    public function getChemin_photo()
    {
    return $this->chemin_photo;
    }
    public function getDate_naissance()
    {
    return $this->date_naissance;
    }

    public function getPassword()
    {
    return $this->password;
    }       
    public function getPhone()
    {
    return $this->phone;
    }
    public function getVille()
    {
    return $this->ville;
    }
    public function getAdress()
    {
    return $this->adress;
    }
    public function getCom_adress()
    {
    return $this->com_adress;
    }
    public function getCode_postal()
    {
    return $this->code_postal;
    }
    public function getNiveau()
    {
    return $this->niveau;
    }
    public function getEcole()
    {
    return $this->ecole;
    }
    // les set              

    public function setId_user($user_id)
    {
      $this->id_user=$user_id;
    }

    public function setNom($nom)
    {
      $this->nom=$nom;
    }

    public function setPrenom($prenom)
    {
      $this->prenom=$prenom;
    }
         
    public function setEmail($mail)
    {
      $this->email=$mail;
    }

    public function setChemin_photo($photo)
    {
      $this->chemin_photo=$photo;
    }

    public function setDate_naissance($date_naiss)
    {
      $this->date_naissance=$date_naiss;
    }         

   public function setPassword($pwd)
    {
      $this->password=$pwd;
    }
    public function setPhone($phone)
    {
     $this->phone= $phone ;
    }
    public function setVille($ville)
    {
     $this->ville= $ville ;
    }
    public function setAdress($adress)
    {
     $this->adress= $adress ;
    }
    public function setCom_adress($com_adress)
    {
     $this->com_adress= $com_adress ;
    }
    public function setCode_postal($code_postal)
    {
     $this->code_postal= $code_postal ;
    }
    public function setNiveau($niveau)
    {
     $this->niveau= $niveau ;
    }
    public function setEcole($ecole)
    {
     $this->ecole= $ecole ;
    }



    public function Modify_info($id_user) // modification de compte
    {
      $db = Db::getInstance();
      $req= $db->prepare("UPDATE user as u INNER JOIN adresse as a ON a.id_adresse = u.id_adresse  SET u.password = ?,u.ecole=?,u.niveau= ?,a.ville= ?, a.adress = ?,a.complement_adress = ?, a.code_postal = ? WHERE  u.id_user = ?");
      $req->execute(array(password_hash($this->getPassword(),PASSWORD_DEFAULT),$this->getEcole(),$this->getNiveau(),$this->getVille(),$this->getAdress(),$this->getCom_adress(),$this->getCode_postal(),$id_user ));
/*
      $req= $db->prepare("UPDATE adresse as a INNER JOIN  user as u ON u.id_adresse = a.id_adresse SET a.ville= ?, a.adress = ?,a.complement_adress = ?, a.code_postal = ? WHERE  u.id_user = ? ");
      $req->execute(array($this->getVille(),$this->getAdress(),$this->getCom_adress(),$this->getCode_postal(),$id_user));
      */
    }
    public static function Update_password($id_admin) // le super admin met à jour le mot de passe d'un compte statique d'administration
    {
      require 'connectToMail.php';
      require 'PHPMailer/PHPMailerAutoload.php';

      $db = Db::getInstance();

      $req= $db->prepare("UPDATE user as u  SET password= ? WHERE u.id_user = ?");
      $password= self::randomKey(); // on appelle la méthode random key
      $req->execute(array($password,$id_admin));

      $req= $db->prepare("SELECT u.id_user as id_user,u.email as email FROM user as u,suivi_administrateurs as su WHERE su.id_user= u.id_user AND  su.id_admin= ?");
         $req->execute(array($id_admin));
         if($req->rowCount() == 1) // on vérifie si le compte est associé à un tuteur
         {
           while( $elt= $req->fetch())
           {
             $email= $elt['email'];
             $id_user=$elt['id_user'];
           }
           

           $data= Users::Get_info($id_user); // info sur la le tuteur
           $tab= Tutorat::Get_specific_static_account($id_admin); // info sur le compte statique 
           $donnees= Users::Get_admin($id_admin);

           //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
          $message_txt = 'Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().',\nLe mot de passe adminsitrateur du type de tutorat '.$tab['type_tutorat'].' a été mis à jour.\n veuillez donc tenir compte de cette modification pour vous connecter à nouveau.\nLe nouveau mot de passe est donc: '.$donnees->getPassword().' \nCe message est généré automatiquement, veuillez ne pas répondre.';
          $message_html ='<html><head></head><body><p>Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().', </p><p>Le mot de passe administrateur  du type de tutorat  <b>'.$tab['type_tutorat'].' a été mis à jour</b>.</p><p>Veuillez donc tenir compte de cette modification pour vous connecter à nouveau.<p>Le nouveau mot de passe est donc: '.$donnees->getPassword().'</p> .</p></b></p><p>Ce message est généré <b>automatiquement</b>, veuillez <b>ne pas répondre</b>.</p></body></html>';
                  //Sujet
          $sujet = "[Yncrea tutorat] Mot de passe mis à jour ";

          $login_mail= $data->getEmail();
          include('send_mail.php');
      }

    }

    public static function Get_info($id_user) // pour la page de modification de compte
    {
      $db = Db::getInstance();
      $req= $db->query("SELECT ville,adress,complement_adress,code_postal,u.password as password,u.chemin_photo as chemin_photo,u.nom as nom,u.prenom as prenom,u.email as email,u.niveau as niveau, u.ecole as ecole FROM adresse as a,user as u WHERE a.id_adresse = u.id_adresse AND u.id_user = ".$id_user." ");

      foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setAdress($temp['adress']);
        $user->setCode_postal($temp['code_postal']);
        $user->setVille($temp['ville']);
        $user->setCom_adress($temp['complement_adress']); 
        $user->setChemin_photo($temp['chemin_photo']); 
        $user->setPassword($temp['password']); 
        $user->setNom($temp['nom']);
        $user->setPrenom($temp['prenom']);
        $user->setEmail($temp['email']);
        $user->setNiveau($temp['niveau']);
        $user->setEcole($temp['ecole']);
      }
      return $user;
    }
    
    public static function Get_admin($id_admin) // meme fonction que get_info mais adaptée aux comptes statiques( qui n'ont pas d'adresse)
    {
      $db = Db::getInstance();
      $req= $db->query("SELECT u.password as password,u.chemin_photo as chemin_photo,u.id_user,u.nom as nom,u.prenom as prenom,u.email as email,u.niveau as niveau, u.ecole as ecole FROM user as u WHERE  u.id_user = ".$id_admin." ");

      foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        
        $user->setChemin_photo($temp['chemin_photo']); 
        $user->setPassword($temp['password']);
        $user->setId_user($temp['id_user']); 
        $user->setNom($temp['nom']);
        $user->setPrenom($temp['prenom']);
        $user->setEmail($temp['email']);
        $user->setNiveau($temp['niveau']);
        $user->setEcole($temp['ecole']);
      }
      return $user;
    }

    public function Deconnexion()
    {
      session_destroy();
      header('Location: ?controller=users&action=login');
    }


 public function Connexion($email,$pwd)
 {  
      
    $db = Db::getInstance();

    
    $request = $db->prepare('SELECT u.id_user as id,u.password as mdp  FROM user as u, avoir_statut as av, statut_compte as s  WHERE u.email= ? and u.id_user = av.id_user and av.id_statut_compte = s.id_statut_compte and s.libelle <> "ATTENTE_VALIDATION" ');
    $request->execute(array($email));
    while( $elt= $request->fetch()){
      $id= $elt['id'];
      $password= $elt['mdp'];
 }
    if ($request->rowCount() == 1 && password_verify($pwd,$password))
    {
         
         $_SESSION['id_user']= $id;
         
         //on recupere l'ID du statut de l'user
         $request=$db->query('SELECT avst.id_statut as id_statut,e.libelle as libelle,s.libelle as libelle_statut, us.nom as nom,us.prenom as prenom,us.email as mail from user as us, avoir_statut as avst, etat as e,statut as s WHERE  avst.id_user=us.id_user AND e.id_etat = avst.id_etat AND avst.id_statut = s.id_statut AND avst.id_user = '.$_SESSION['id_user'].'');
         $res = $request->fetch();
         
         
         $_SESSION['connecté']='connecté';
         $_SESSION['email']=$res['mail'];
         $_SESSION['nom']=$res['nom'];
         $_SESSION['prenom']=$res['prenom'];
         $_SESSION['id_statut']=$res['id_statut'];
         $_SESSION['etat']= $res['libelle'];
         $_SESSION['statut']= $res['libelle_statut'];
         //exit('authentification success');
    } 
    else
    {
      //echo $request->rowCount();
        $_SESSION['alert']= "<strong>email et/ou mot de passe incorrects<strong/>";
    }
    return ($request->rowCount()) ;
 }

 public  function Set_picture_path($id_user)
 {
      $db=Db::getInstance();
      $req= $db->prepare("UPDATE user SET chemin_photo= ? WHERE id_user= $id_user");
      $req->execute(array( $this->getChemin_photo()));
 }

 public static function Get_informations_on_user($id_user) // la meme que get_info plus haut ( à dégager)
    {
       $db = Db::getInstance(); 
      

       $req= $db->query("SELECT id_user,nom,prenom,date_naissance,ecole,email,phone,chemin_photo FROM user WHERE id_user = ".$id_user."");

       foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setId_user($temp['id_user']);
        $user->setNom($temp['nom']);
        $user->setPrenom($temp['prenom']);
        $user->setEmail($temp['email']);
        $user->setDate_naissance($temp['date_naissance']);
        $user->setPhone($temp['phone']);
        $user->setChemin_photo($temp['chemin_photo']);
        $user->setEcole($temp['ecole']);
        
      }
      return $user;
    }
  public static function Get_contact_admin($id_user) // on récupère les contacts des admin en charge
  {
    $db = Db::getInstance(); 
    $list= [];
    $req= $db->prepare("SELECT DISTINCT u.nom,u.prenom,u.email,s.libelle as libelle FROM user as u,administrer as a,se_destine as se, avoir_statut as at, statut as s, suivi_administrateurs as sa WHERE sa.id_user = u.id_user AND se.id_tutorat = a.id_tutorat AND se.id_typeTutorat = a.id_typeTutorat AND a.id_admin= sa.id_admin AND a.id_admin= at.id_user AND at.id_statut = s.id_statut AND se.id_user= ? UNION 
        SELECT u.nom,u.prenom,u.email,s.libelle as libelle FROM user as u , avoir_statut as at , statut as s, suivi_administrateurs as sa, administrer as a WHERE sa.id_user = u.id_user AND a.id_admin= sa.id_admin AND u.id_user = at.id_user AND at.id_statut= s.id_statut  AND s.libelle = 'ADMIN_IMMERSION' UNION
        SELECT u.nom,u.prenom,u.email,s.libelle  as libelle FROM user as u , avoir_statut as at , statut as s, suivi_administrateurs as sa , administrer as a WHERE sa.id_user = u.id_user AND  a.id_admin = at.id_user AND a.id_admin= sa.id_admin AND at.id_statut= s.id_statut AND s.libelle = 'ADMIN_TUTORAT_PERSO' UNION
         SELECT u.nom,u.prenom,u.email,s.libelle  as libelle FROM user as u , avoir_statut as at , statut as s , suivi_administrateurs as sa , administrer as a WHERE sa.id_user = u.id_user AND a.id_admin = at.id_user AND a.id_admin= sa.id_admin AND at.id_statut= s.id_statut AND s.libelle = 'GESTIONNAIRE_COMPTE' ORDER BY nom ");
    $req->execute(array($id_user));
     
     foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setEmail($temp['email']);

        $list []= array($user,$temp['libelle']);
      }
    return $list;
  }
  public static function Get_all_contact_admin($id_user) // on récupère les contacts des admin en charge de tous les comptes statiques administrés  (le super admin y compris)
  {
    $db = Db::getInstance(); 
    $list= [];
    $req= $db->prepare("SELECT DISTINCT u.nom,u.prenom,u.email,s.libelle as libelle FROM user as u,suivi_administrateurs as sa,administrer as ad,avoir_statut as at, statut as s WHERE sa.id_user = u.id_user AND ad.id_admin= sa.id_admin AND at.id_user= ad.id_admin AND at.id_statut = s.id_statut AND sa.id_user <> ?UNION 
      SELECT DISTINCT u.nom,u.prenom,u.email,s.libelle as libelle FROM user as u,avoir_statut as at, statut as s WHERE u.id_user= at.id_user AND  s.id_statut = 1  AND at.id_statut = s.id_statut AND u.id_user <> ?ORDER BY nom ");
    $req->execute(array($id_user,$id_user));
    
     
     foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setEmail($temp['email']);

        $list []= array($user,$temp['libelle']);
      }
    return $list;
  }

   public static function display_all()
     {
      $list=[];
      $db=Db::getInstance();
      $req=$db->query('SELECT * FROM user');
      foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setId_user($temp['id_user']);
        $user->setNom($temp['nom']);
        $user->setPrenom($temp['prenom']);
        $user->setEmail($temp['email']);
        $user->setDate_naissance($temp['date_naissance']);
        $user->setPassword($temp['password']);
        $list[]=$user;
      }
      return $list;
     }    
    public static function create_account($id_tutorat)
    {
      $db=Db::getInstance();

      $req= $db->query("SELECT id_admin FROM administrer WHERE id_tutorat= ".$id_tutorat."");
      
      if($req->rowCount()== 0)
      { 
        $req= $db->prepare("SELECT tt.libelle as libelle FROM type_tutorat as tt,tutorat as t WHERE t.id_tutorat= ? AND t.id_typeTutorat= tt.id_typeTutorat ");
        $req->execute(array($id_tutorat));
        $res= $req->fetch()['libelle']; // libelle du type de tutorat( du type de compte)
        
                
        
        $req= $db->prepare("SELECT nom FROM user WHERE prenom= ?"); // je compte le nombre compte admin de ce type qui existent deja
        $req->execute(array($res));

        $tab= $req->fetch()['nom'];
         
        $req= $db->prepare("SELECT phone FROM user WHERE prenom = ? ORDER BY phone DESC LIMIT 1");
        $req->execute(array($res));
        $nb= $req->fetch()['phone'] + 1;

        if(is_null($nb)) // l'indice des comptes statiques commence à 1
          $nb= 1;
        
        $hash= password_hash('az',PASSWORD_DEFAULT);
        $today = date('y-m-j');
        $req= $db->prepare("INSERT INTO user(nom,prenom,date_naissance,email,phone,password) VALUES(?,?,?,?,?,'.$hash.')");

        $nom= 'ADMIN'.$nb ;
        $email= 'ADMIN'.$nb.'.'.$res.'@tutorat-yncrea.fr';
        $req->execute(array($nom,$res,$today,$email,$nb));
        
        $req= $db->prepare("INSERT INTO avoir_statut (id_user,id_statut_compte,id_statut,id_etat) VALUES ((SELECT id_user FROM user WHERE email= ? ORDER BY date_naissance DESC LIMIT 1),(SELECT id_statut_compte FROM statut_compte  WHERE libelle = 'VALIDE'),(SELECT id_statut FROM statut WHERE libelle LIKE ? ),(SELECT id_etat FROM etat as e WHERE e.libelle = 'LIBRE')) ");
        $req->execute(array($email,'%'.$res.'%'));

        $req= $db->prepare("INSERT INTO administrer(id_admin,id_tutorat,id_typeTutorat) VALUES((SELECT id_user FROM user WHERE email= ? ORDER BY date_naissance DESC LIMIT 1),?,(SELECT id_typeTutorat FROM tutorat WHERE id_tutorat= ?)) ");
        $req->execute(array($email,$id_tutorat,$id_tutorat));

        return 0;
      }
      else
        return 1;

    }

    public static function Get_unpaidHours_tuteurs()  // liste des tuteurs qui ont des heures impayees
    {

      $db=Db::getInstance();
      $list=[];
      $req= $db->query("SELECT ville,adress,complement_adress,code_postal,u.id_user,u.nom as nom,u.prenom as prenom,u.email as email,u.niveau as niveau, u.ecole as ecole,u.phone, SUM(vh.durée) as nb_heure FROM adresse as a,user as u,tuteurs as tu,validation_heure as vh WHERE a.id_adresse = u.id_adresse AND u.id_user = tu.id_tuteurs AND u.id_user = vh.id_tuteurs AND vh.payer= 'NON'  GROUP BY id_user ORDER BY nom" );

       foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setAdress($temp['adress']);
        $user->setCode_postal($temp['code_postal']);
        $user->setVille($temp['ville']);
        $user->setCom_adress($temp['complement_adress']); 
        
        
        $user->setId_user($temp['id_user']); 
        $user->setNom($temp['nom']);
        $user->setPrenom($temp['prenom']);
        $user->setEmail($temp['email']);
        $user->setNiveau($temp['niveau']);
        $user->setEcole($temp['ecole']);

        $list []= array('user' => $user,'heure'=>$temp['nb_heure']);
      }
      return $list;

    }
  
  public static function Get_paidHours_tuteurs()  // liste des tuteurs qui ont des heures impayees
    {

      $db=Db::getInstance();
      $list=[];
      $req= $db->query("SELECT ville,adress,complement_adress,code_postal,u.id_user,u.nom as nom,u.prenom as prenom,u.email as email,u.niveau as niveau, u.ecole as ecole, u.phone, SUM(vh.durée) as nb_heure FROM adresse as a,user as u,tuteurs as tu,validation_heure as vh WHERE a.id_adresse = u.id_adresse AND u.id_user = tu.id_tuteurs AND u.id_user = vh.id_tuteurs AND vh.payer= 'OUI' GROUP BY id_user ORDER BY nom" );

       foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setAdress($temp['adress']);
        $user->setCode_postal($temp['code_postal']);
        $user->setVille($temp['ville']);
        $user->setCom_adress($temp['complement_adress']); 

        $user->setId_user($temp['id_user']); 
        $user->setNom($temp['nom']);
        $user->setPrenom($temp['prenom']);
        $user->setEmail($temp['email']);
        $user->setNiveau($temp['niveau']);
        $user->setEcole($temp['ecole']);

        $list []= array('user' => $user,'heure'=>$temp['nb_heure']);
      }
      return $list;

    }
    
   static function randomKey() 
   {
      $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $key = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < 8; $i++) {
          $n = rand(0, $alphaLength);
          $key[] = $alphabet[$n];
      }
      return implode($key); //turn the array into a string thanks to implode function
  }
     
    
  }
?>