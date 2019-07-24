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
public function connexion()
{
	//intance e la classe modele
        $user= new Users();
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            
	        if($user->Connexion($_POST['email'],$_POST['password'])== 1)
	        { 
	        	if($_SESSION['id_statut'] == 13)
	        		require_once('views/tuteurs/interface_tuteur.php');
	        	elseif($_SESSION['id_statut'] == 16)
	        	{
	        		require_once('views/tutores/interface_tutore.php');
	        	}
	        	else
	        	{
	        		$message= 'interface pas encore crée';
	        		$controller_report='evenements';
                    $fonction_back='Display_future_events';
                    require_once('views/system/error.php');
	        	}


	        }
	        else
	        {
	 
	           require_once('views/login.php');
	        }
   		}
	    else
	    {
	    	require_once('views/login.php');
	    }
}
public function resetPassword()
{
	require_once('views/reset_password_view.php');
}
public function forgotPassword()
{
	require_once('views/forgot_password_view.php');
}
public function inscription()
	{
	 require_once('views/inscription.php');	
	}
public function deconnexion()
{
	$user= new Users();
	$user->Deconnexion();
    require_once('views/login.php');
}

	

}
?>