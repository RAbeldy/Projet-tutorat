<?php
	include('connexion.php');
	require ('PHPMailer/PHPMailerAutoload.php');
	//require ('connectToMail.php');

	$bd = Db::getInstance();

	//Déclaration d'une clé de sécurité'
	function randomKey() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $key = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $key[] = $alphabet[$n];
	    }
	    return implode($key); //turn the array into a string thanks to implode function
	}

	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPWD']) && isset($_POST['nom']) && isset($_POST['prenom'])) {
		//Dans ce cas, les champs ont été remplis
		$email = $_POST['email'];
		$pwd = $_POST['password'];
		$pwd2 = $_POST['confirmPWD'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$date_naiss = $_POST['date_naiss'];
		$Nphone = $_POST['phone'];

		//les champs de la tables adresse
		$ville = $_POST['ville'];
		$adresse = $_POST['adressCom'];
		$complmnt = $_POST['adressCom'];
		$codePost = $_POST['codePostal'];

		//les champs de la tables classe
		$niveau = $_POST['nivo'];
		$ecole = $_POST['ecole'];

		//on recupère la nationalité du tutoré
		$nationalite = $_POST['nitiona'];		

		if ($pwd === $pwd2) {
			//Le mot de passe a été saisi deux fois de la même façon. On envoie le mail pour finaliser l'inscription
			$request = $bd->prepare('SELECT u.email from user as u WHERE u.email = ?');
			$request->execute(array($email));

			//On regarde si le mail n'est pas déjà utilisé pour un compte valide!
			if ($request->rowCount() == 0 /*aucun compte avec ce login*/) { 
				//On créer un nouveau compte (nouvealle ligne dans bd)
				$addCompte = $bd->prepare('INSERT INTO user (nom, prenom, date_naissance, email, password, phone) VALUES (?,?,?,?,?,?)');
				$addCompte->execute(array($nom, $prenom, $date_naiss, $email, $pwd, $Nphone));
				//On ajoute aussi le code de validité pour le mail
				$addStatut = $bd->prepare('INSERT INTO avoir_statut (id_user, id_statut, id_statut_compte, confirmCode) VALUES ((SELECT id_user from user WHERE email=? and password=?),(SELECT id_statut from statut WHERE libelle="TUTORE_PRREL"), (SELECT id_statut_compte from statut_compte WHERE libelle="ATTENTE_VALIDATION"),?)');
				$key = randomKey();
				$addStatut->execute(array($email,$pwd, $key));

				//On remplir la table adress avec les information récupéerer du formulaire
				$addAdress = $bd->prepare('INSERT INTO adresse (ville, Adress, Complement_Adress, code_postal) VALUES (?,?,?,?)');
				$addAdress->execute(array($ville, $adresse, $complmnt, $codePost));

				//On remplir la table classe 
				$addClass = $bd->prepare('INSERT INTO classe (niveau, ecole) VALUES (?,?)');
				$addClass->execute(array($niveau, $ecole));								

				//On insert la nationalité du tutoré dans la table "tutoré" 
				$addNationTutore = $bd->prepare('INSERT INTO tutores (nationalite, id_user) VALUES (?, (SELECT id_user from user WHERE email=? and password=?))');
				$addNationTutore->execute(array($nationalite, $email, $pwd));
				exit("Success");
			}
			else {
				//login déjà utilisé pour un compte valide
				exit("Failed_login");
				//On le redirige vers la page d'accueil
			}
		}
		else {
			//pwd et confirmation différente
			//login déjà utilisé pour un compte valide
			exit("Failed_password");
		}
	}
	else{
		//Champs non remplis
		//login déjà utilisé pour un compte valide
		exit("Failed");
	}
?>
