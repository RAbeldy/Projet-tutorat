<?php
require_once('models/users.php');
/* Définition du controller */
class UsersController
{

// page d'authentification
public function login()  
	{
	  require_once('views/login.php');
	}

public function inscription()
	{
	 require_once('views/inscription.php');	
	}

public function save_user()
	{
		       //intance e la classe modele
        $user= new Users();
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setDate_naissance($_POST['date_naiss']);
        $user->setEmail($_POST['mail']);
        $user->setPassword($_POST['pwd']);       

        $user->Create_user();
	}	

}
?>