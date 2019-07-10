<?php
require_once('models/users.php');
/* Définition du controller */
class UsersController
{

// page d'authentification
public function login()  
	{
	  require_once('views/Login.php');
	}

public function inscription()
	{
	 require_once('views/inscription.php');	
	}

public function save_user()
	{
		//intance de la classe modele
        $user= new Users();
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setDate_naissance($_POST['date_naiss']);
        $user->setNationalite($_POST['nationalite']);
        $user->setEmail($_POST['mail']);
        $user->setPassword($_POST['pwd']);       
        // il faudrait set son statut
        $user->Create_user();
        require_once('views/vuetest.php');
	}
public function connexion()	
	{

     //intance de la classe modele
		
        $user= new Users();
        if($user->Connexion())
        { 
        	//if(preg_match("#", "$_SESSION['id_statut']" ))
            require_once('views/vuetest.php');  // on charge son interface 
        }
        else
        {    
        	$message[]= 'erreur. d\'authentification';
        	require_once('routes.php'); 
        }
	}

}
?>