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
     $this->phone= $ville ;
    }
    public function setAdress($adress)
    {
     $this->phone= $adress ;
    }
    public function setCom_adress($com_adress)
    {
     $this->phone= $com_adress ;
    }
    public function setCode_postal($code_postal)
    {
     $this->phone= $code_postal ;
    }



    public function Modify_info($id_user) 
    {
      $db = Db::getInstance();
      $req= $db->prepare("UPDATE user as u INNER JOIN adresse as a ON a.id_adresse = u.id_adresse  SET password = ?,a.ville= ?, a.adress = ?,a.complement_adress = ?, a.code_postal = ? WHERE  u.id_user = ?");
      $req->execute(array($this->getPassword(),$this->getVille(),$this->getAdress(),$this->getCom_adress(),$this->getCode_postal(),$id_user ));
/*
      $req= $db->prepare("UPDATE adresse as a INNER JOIN  user as u ON u.id_adresse = a.id_adresse SET a.ville= ?, a.adress = ?,a.complement_adress = ?, a.code_postal = ? WHERE  u.id_user = ? ");
      $req->execute(array($this->getVille(),$this->getAdress(),$this->getCom_adress(),$this->getCode_postal(),$id_user));
      */
    }
    public function Get_info($id_user)
    {
      $db = Db::getInstance();
      $req= $db->query("SELECT ville,adress,complement_adress,code_postal FROM adresse as a,user as u WHERE a.id_adresse = u.id_adresse AND u.id_user = $id_user ");

      return $req;
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
         $request=$db->query('SELECT avst.id_statut as id_statut,e.libelle as libelle,us.nom as nom,us.prenom as prenom,us.email as mail from user as us, avoir_statut as avst, etat as e WHERE  avst.id_user=us.id_user AND e.id_etat = avst.id_etat AND avst.id_user = '.$_SESSION['id_user'].'');
         $res = $request->fetch();

         $_SESSION['mail']=$res['mail'];
         $_SESSION['nom']=$res['nom'];
         $_SESSION['prenom']=$res['prenom'];
         $_SESSION['id_statut']=$res['id_statut'];
         $_SESSION['etat']= $res['libelle'];
         //exit('authentification success');
    } 
    else
    {
      echo $request->rowCount();
        $_SESSION['alert']= "<strong>email et/ou mot de passe incorrects<strong/>";
    }
    return ($request->rowCount()) ;
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
     

     public function Get_all_tutores()
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at, etat as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND e.id_etat = at.id_etat AND e.id_etat = 'LIBRE' AND s.libelle= 'TUTORE' AND u.id_user NOT IN (SELECT id_tutores as id_user FROM matchs) ");
        
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
                $req= $db->prepare('SELECT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at, en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND e.statut_liaison = "INACTIF" AND e.provenance= "TUTORE"   AND u.id_user = m.id_tutores AND m.tuteurs = ?  ');
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
                $req= $db->prepare('SELECT u.id_user,nom,prenom,date_naissance,email,phone,a.ville as ville,a.adress as adress,a.code_postal as code_postal FROM user as u, statut as s,adresse as a, avoir_statut as at, en_attente as e WHERE at.id_statut = s.id_statut AND at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND e.statut_liaison = "INACTIF" AND e.provenance= "TUTEUR"   AND u.id_user= m.id_tuteurs AND m.id_tutores = ?  ');
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
?>