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
      $req= $db->prepare("UPDATE user as u INNER JOIN adresse as a ON a.id_adresse = u.id_adresse  SET password = ?,a.ville= ?, a.adress = ?,a.complement_adress = ?, a.code_postal = ? WHERE  u.id_user = ?");
      $req->execute(array($this->getPassword(),$this->getVille(),$this->getAdress(),$this->getCom_adress(),$this->getCode_postal(),$id_user ));
/*
      $req= $db->prepare("UPDATE adresse as a INNER JOIN  user as u ON u.id_adresse = a.id_adresse SET a.ville= ?, a.adress = ?,a.complement_adress = ?, a.code_postal = ? WHERE  u.id_user = ? ");
      $req->execute(array($this->getVille(),$this->getAdress(),$this->getCom_adress(),$this->getCode_postal(),$id_user));
      */
    }
    public static function Get_info($id_user) // pour la page de modification de compte
    {
      $db = Db::getInstance();
      $req= $db->query("SELECT ville,adress,complement_adress,code_postal,u.chemin_photo as chemin_photo,u.nom as nom,u.prenom as prenom,u.email as email,u.niveau as niveau, u.ecole as ecole FROM adresse as a,user as u WHERE a.id_adresse = u.id_adresse AND u.id_user = $id_user ");

      foreach ($req->fetchAll() as $temp) 
      {
        $user= new Users();
        $user->setAdress($temp['adress']);
        $user->setCode_postal($temp['code_postal']);
        $user->setVille($temp['ville']);
        $user->setCom_adress($temp['complement_adress']); 
        $user->setChemin_photo($temp['chemin_photo']); 
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

    }


 public function Connexion($email,$pwd)
 {  
      
    $db = Db::getInstance();

    $request = $db->prepare('SELECT u.id_user as id from user as u, avoir_statut as av, statut_compte as s  WHERE u.email=? and u.password=? and u.id_user = av.id_user and av.id_statut_compte = s.id_statut_compte and s.libelle <> "ATTENTE_VALIDATION" ');
    $request->execute(array($email,$pwd));
    if ($request->rowCount() == 1)
    {
         //echo('1');
         $_SESSION['id_user']=$request->fetch()['id'];
         
         
         //on recupere l'ID du statut de l'user
         $request=$db->query('SELECT avst.id_statut as id_statut,e.libelle as libelle,s.libelle as libelle_statut,us.nom as nom,us.prenom as prenom,us.email as mail from user as us, avoir_statut as avst, etat as e,statut as s WHERE  avst.id_user=us.id_user AND e.id_etat = avst.id_etat AND avst.id_statut = s.id_statut AND avst.id_user = '.$_SESSION['id_user'].'');
         $res = $request->fetch();

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
      $req->execute(array( $this->chemin_photo));
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
    $req= $db->prepare("SELECT u.nom,u.prenom,u.email,s.libelle as libelle FROM user as u,administrer as a,se_destine as se, avoir_statut as at, statut as s WHERE se.id_tutorat = a.id_tutorat AND se.id_typeTutorat = a.id_typeTutorat AND u.id_user= a.id_admin AND u.id_user= at.id_user AND at.id_statut = s.id_statut AND se.id_user= ? UNION 
        SELECT u.nom,u.prenom,u.email,s.libelle as libelle FROM user as u , avoir_statut as at , statut as s WHERE u.id_user = at.id_user AND at.id_statut= s.id_statut  AND s.libelle = 'ADMIN_IMMERSION' UNION
        SELECT u.nom,u.prenom,u.email,s.libelle  as libelle FROM user as u , avoir_statut as at , statut as s WHERE u.id_user = at.id_user AND at.id_statut= s.id_statut AND s.libelle = 'ADMIN_TUTORAT_PERSO' UNION
         SELECT u.nom,u.prenom,u.email,s.libelle  as libelle FROM user as u , avoir_statut as at , statut as s WHERE u.id_user = at.id_user AND at.id_statut= s.id_statut AND s.libelle = 'GESTIONNAIRE_COMPTE' ORDER BY nom ");
    $req->execute(array($id_user));
     
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
     

     
    
  }
?>