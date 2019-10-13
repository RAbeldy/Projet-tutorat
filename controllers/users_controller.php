<?php
require_once('models/users.php');
/* Définition du controller */
class UsersController
{


public function choixStatut()
{
	require_once('views/choix_statut_signup.php');
}
// page d'authentification
public function login()  
	{
	  require_once('views/Login.php');
	}
public function connexion()
{
	//intance e la classe modele
        $user= new Users();
		$email= htmlspecialchars($_POST['email']);
		$password= htmlspecialchars($_POST['password']);
        if($email!="" && $password!="")
        {
	        if($user->Connexion($email,$password)== 1)
	        	$this->redirection();	// on appelle la fonction de redirection
	        else
	           require_once('views/Login.php');
   		}
	    else
	    { 
	    	if(isset($_SESSION['connecté']))
	    		$this->redirection();	// on appelle la fonction de redirection
	    	else
	    		require_once('views/Login.php');
	    }
}

public function redirection() // redirection vers interface en fonction du statut
{
  if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
  {
        switch ($_SESSION['id_statut']) 
	    {
	       case 13:
	         	require_once('views/tuteurs/interface_tuteur.php'); // interface tuteur
	        break;
	        case 16:
	        	require_once('views/tutores/interface_tutore.php'); // interface tutore
	        break;
	        case 21:
	        	require_once('views/admin/gestion/interface_gestionnaire.php'); // interface_gestionnaire
	        break;
	        case 1:
	        	require_once('views/superadmin/interface_superadmin.php'); // interface superadmin
	        break;
	        default:
	        	require_once('views/admin/interface_admin.php'); // interface_admin
	        break;
	    }
	}
	else
		require_once('views/Login.php');
  
  
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
		if (isset($_POST['Tuteur'])) {
			require_once('views/inscriptionTuteur.php');	
		}
		if (isset($_POST['Tutore'])) {
			require_once('views/inscriptionTutore.php');
		}
	}

public function profil()
{
	if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        { 
            $data = Users::Get_info($_SESSION['id_user']);    // on récupère les info des user
            require_once('views/mon_profil.php');
        }
     else
       require_once('views/Login.php');
}
public static function update_account()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            { 
                $donnees = Users::Get_info($_SESSION['id_user']);    // on récupère les info des user
                if($_SESSION['id_statut'] == 1)
                	require_once('views/superadmin/update_account.php');
            	else
            		require_once('views/update_account.php');
            }
            else
                require_once('views/Login.php');
        }


public function modify_account()
    {
            if(isset($_SESSION['id_statut']))   // on vérifie que seul un utilisateur connecté peut accéder à ces pages
            { 
                $user = new Users();
				
				$ville= htmlspecialchars($_POST['ville']);
				$adresse=  htmlspecialchars($_POST['adresse']);
				$complement_adresse=  htmlspecialchars($_POST['complement_adresse']);
				$code_postal=  htmlspecialchars($_POST['code_postal']);
				$password=  htmlspecialchars($_POST['password']);
				$nom=  htmlspecialchars($_POST['nom']);
				$prenom=  htmlspecialchars($_POST['prenom']);
				
				if($ville!= "" && $adresse!="" && $complement_adresse!="" && $code_postal!="" && $password!="" && $nom!="" &&$prenom!="")
                {
	                $user->setVille($ville);
	                $user->setAdress($adresse);
	                $user->setCom_adress($complement_adresse);
	                $user->setCode_postal($code_postal);
	                $user->setPassword($password);
	              
	                $user->setNom($nom);
	                $user->setPrenom($prenom);
	            }
                
                
                $user->Modify_info($_SESSION['id_user']);    // on update les infos du user
                if(!empty($_FILES["fileToUpload"]["name"]))
                $this->upload_file();  // on va uploader la photo


                UsersController::update_account(); // on recharge pour la mise à jour
            }
            else
                require_once('views/Login.php');
    }

public function upload_file()
{
     	$target_dir = "assets/profile_pictures/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["sauvegarder"])) 
		{
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) 
		    {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } 
		    else 
		    {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		
		// Check if file already exists
			if (file_exists($target_file))
			{
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 5000000) 
			{
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			$extension= array('jpg','png','jpeg','gif');
			if (!in_array($imageFileType, $extension))
			{
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) 
			{
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} 
			else 
			{
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    } 
			    else 
			    {
			        echo "Sorry, there was an error uploading your file.";
			    }
			    
            }


       $this->set_picture_path($target_file); // on renseigne le chemin photo dans la table user
   }
}
public function set_picture_path($target_file)
{
	$user = new Users();
	$user->setChemin_photo($target_file);
	$user->Set_picture_path($_SESSION['id_user']);
}

   public function create_account() // ils 'agit de l'action de créer à ne pas confondre dans le controller admin
     {
       if( isset($_SESSION['id_statut']))
       {
            //var_dump($_POST['id_t']);
			$id_t= htmlspecialchars($_POST['id_t']);
			
			  if( Users::create_account($id_t) == 0)
			  {
			   
			   require_once('views/superadmin/interface_tutorat.php');
			  }
			  else
			  {
				$message = ' Un administrateur est déja en charge de ce tutorat, pour affecter sa gestion à une autre personne, il est primordial de rompre le contrat avec l\'administrateur actuel. Rendez-vous donc dans la page "les centres de tutorat" si tel est votre souhait ';
				$controller_report='superadmin';
				$fonction_back='interface_account_creation';

				require_once('views/system/error.php');
			  } 
			
       }
          else
            require_once('views/Login.php');
     }
public static function deconnexion()
{
	$user= new Users();
	$user->Deconnexion();
    require_once('views/Login.php');
}	

}
?>