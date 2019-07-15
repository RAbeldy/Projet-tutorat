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

public function testConnexion(){
		       //intance e la classe modele
	if(isset($_POST['email']) && isset($_POST['password'])){
    $user= new Users();
    $user->connexion($_POST['email'], $_POST['password']);
	}	
}

public function inscription()
	{
	 require_once('inscription.php');	
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