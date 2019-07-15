<?php
  class Users 
  {
    private $id_user;
    private $nom;
    private $prenom;
    private $email;
    private $chemin_photo;
    private $date_naissance;
    private $password;

    public function __construct(){}

    public function getId_user()
    {
    return $this->id_user;
    }    

    public function getNom()
    {
    return $this->Nom;
    }

    public function getPrenom()
    {
    return $this->Prenom;
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

    // les settes                 

    public function setId_user($user_id)
    {
    $this->id_user=$user_id;
    }

    public function setNom($Nom)
    {
    $this->nom=$Nom;
    }

    public function setPrenom($Prenom)
    {
    $this->prenom=$Prenom;
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
public function connexion($email, $pwd)
    {
        $db = Db::getInstance();

        $request = $db->prepare('SELECT u.id_user as id from user as u, avoir_statut as av, statut_compte as Scpte  WHERE u.email=? and u.password=? and u.id_user = av.id_user and av.id_statut = Scpte.id_statut_compte and Scpte.libelle <> "ATTENTE_VALIDATION" ');
        $request->execute(array($email,$pwd));
        if ($request->rowCount() == 1)
        {
             echo('1 vous êtes connecté !');
             $_SESSION['user_id']=$request->fetch()['id'];
             
             
             //on recupere l'ID du statut de l'user
             $request=$db->query('SELECT avst.id_statut as id_statut,us.nom as nom,us.prenom as prenom,us.email as mail from user as us, avoir_statut as avst WHERE  avst.id_user=us.id_user and avst.id_user = '.$_SESSION['user_id'].'');
             $res = $request->fetch();

             $_SESSION['mail']=$res['mail'];
             $_SESSION['nom']=$res['nom'];
             $_SESSION['prenom']=$res['prenom'];
             $_SESSION['statut_id']=$res['id_statut'];

        } else {
            echo('0  echec de connexion !');
        }  
    }
 public  function Create_user()
     {
         $db = Db::getInstance();
          $req = $db->query("INSERT INTO  user (nom, prenom, email, date_naissance, password) VALUES('".$this->nom."','".$this->prenom."','".$this->email."','".$this->date_naissance."','".$this->password."')");
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