<?php
require_once('connexion.php');
class Tutorat
{

	private $libelle;
	private $id_tutorat;

    public function __construct(){}
    
	public function getLibelle()
	{
		return $this->libelle;
	}

	public function getId_tutorat()
	{
		return $this->id_tutorat;
	}
	public function setLibelle($libelle)
	{
	 	$this->libelle= $libelle;
	}

	public function setId_tutorat($id_tutorat)
	{
		$this->id_tutorat= $id_tutorat;
	}
}
