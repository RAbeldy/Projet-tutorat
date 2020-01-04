<?php


require_once('models/users.php');
/* Définition du controller */
class UsersController
{


public function choixStatut()
{
	set_route('views/choix_statut_signup.php');
}
// page d'authentification
public function login()
{
	  set_route('views/Login.php');
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
	           set_route('views/Login.php');
   		}
	    else
	    {
	    	if(isset($_SESSION['connecté']))
	    		$this->redirection();	// on appelle la fonction de redirection
	    	else
	    		set_route('views/Login.php');
	    }
}

public function redirection() // redirection vers interface en fonction du statut
{
  if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
  {
        switch ($_SESSION['id_statut'])
	    {
	       case 13:
		   		header('Location: ?controller=tuteurs&action=interface_tuteur'); // interface tuteur
	        break;
	        case 16:
	        	header('Location: ?controller=tutores&action=interface_tutore'); // interface tutore
	        break;
	        case 21:
	        	header('Location: ?controller=admin&action=interface_admin'); // interface_gestionnaire
	        	//set_route('views/admin/gestion/interface_gestionnaire.php');
	        break;
	        case 1:
	        	header('Location: ?controller=superadmin&action=interface_superadmin'); // interface superadmin
	        break;
	        default:
	        	header('Location: ?controller=admin&action=interface_admin'); // interface_admin
	        break;
	    }
	}
	else
		set_route('views/Login.php');


}

public function resetPassword()
{
	set_route('views/reset_password_view.php');
}

public function forgotPassword()
{
	set_route('views/forgot_password_view.php');
}

public function inscription()
	{
		if (isset($_POST['Tuteur'])) {
			set_route('views/inscriptionTuteur.php');
		}
		if (isset($_POST['Tutore'])) {
			set_route('views/inscriptionTutore.php');
		}
	}

public function profil()
{
	if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
        {
            set_data( Users::Get_info($_SESSION['id_user']));    // on récupère les info des user
            set_route('views/mon_profil.php');
        }
     else
       set_route('views/Login.php');
}
public static function update_account()
        {
            if(isset($_SESSION['id_statut']))// on vérifie que seul un utilisateur connecté peut accéder à ces pages
            {
                set_donnees(Users::Get_info($_SESSION['id_user']));    // on récupère les info des user
                if($_SESSION['id_statut'] == 1)
                	set_route('views/superadmin/update_account.php');
            	else
            		set_route('views/update_account.php');
            }
            else
                set_route('views/Login.php');
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
                set_route('views/Login.php');
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

			   set_route('views/superadmin/interface_tutorat.php');
			  }
			  else
			  {
				$message = ' Un administrateur est déja en charge de ce tutorat, pour affecter sa gestion à une autre personne, il est primordial de rompre le contrat avec l\'administrateur actuel. Rendez-vous donc dans la page "les centres de tutorat" si tel est votre souhait ';
				set_controller_report('superadmin');
				set_fonction_back('interface_account_creation');

				set_route('views/system/error.php');
			  }

       }
          else
            set_route('views/Login.php');
     }
public static function deconnexion()
{
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // on effectue un traitement spécifique pour l'ajax

		echo "je fais de l'ajax";

			//set_route('index.php?controller=page?action=home');

	}
	else{
		//echo "je fais de l'ajax";
	$user= new Users();
	$user->Deconnexion();

	set_route('views/Login.php');
	}
}

}

?>
