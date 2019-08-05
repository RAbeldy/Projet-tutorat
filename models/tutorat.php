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



	public static function Get_lieu_tutorat($id_admin)  // liste des lieux où se passe un type de tutorat en particulier( IL NE L'AURA QUE LORQUE LE SUPERAMIN LUI AURA DONNE LA GESTION DU TUTORAT EN QUESTION)
    {
        $db = Db::getInstance();
        $list=[];
        $req = $db->query("SELECT t.libelle as libelle,t.id_tutorat as id_tutorat FROM tutorat as t, administrer as a WHERE t.id_tutorat =   a.id_tutorat AND a.id_admin= ".$id_admin." ");

      foreach ($req->fetchAll() as $data)
      {
       $list []= array($data['libelle'],$data['id_tutorat']);
      }
      return $list ;
    }

    public static function Get_type_tutorat()
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

    public function Create_center()
    {
        $db = Db::getInstance();
        $req= $db->prepare("INSERT INTO tutorat(id_typeTutorat,libelle,adresse,code_postal,nb_tutores,nb_tuteurs)VALUES(?,?,?,?,?,?)");
        $req->execute(array($this->getId_typeTutorat(),$this->getLibelle(),$this->getAdresse(),$this->getCode_postal(),$this->getNb_tutores(),$this->getNb_tuteurs()));

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
