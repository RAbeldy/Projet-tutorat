<?php
/*
	setcookie('adresse',$_POST['adresse'], time() + 365*24*3600, null, null, false, true); // On écrit un cookie
	setcookie('ville',$_POST['ville'], time() + 365*24*3600, null, null, false, true); // On écrit un cookie
	setcookie('complement_adresse',$_POST['complement_adresse'], time() + 365*24*3600, null, null, false, true); // On écrit un cookie
	setcookie('code_postal',$_POST['code_postal'], time() + 365*24*3600, null, null, false, true); // On écrit un cookie
	setcookie('password',$_POST['password'], time() + 365*24*3600, null, null, false, true); // On écrit un cookie
*/

	include('connexion.php');
	require ('PHPMailer/PHPMailerAutoload.php');
	require ('connectToMail.php');

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
    
    
	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmer_password']) && isset($_POST['nom']) && isset($_POST['prenom'])&& isset($_POST['date_naiss']) && isset($_POST['ecole'])  && isset($_POST['adresse']) && isset($_POST['complement_adresse']) && isset($_POST['ville']) && isset($_POST['code_postal'])&& isset($_POST['phone'])) {
		//Dans ce cas, les champs ont été remplis

		//tutoré
		$login_mail = $_POST['email'];
		$pwd = $_POST['password'];
		$pwd2 = $_POST['confirmer_password'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$date_naiss = $_POST['date_naiss'];
		$ecole = $_POST['ecole'];
		$adress = $_POST['adresse'];
		$com_adress = $_POST['complement_adresse'];
		$ville = $_POST['ville'];
		$code_postal = $_POST['code_postal'];
		$phone = $_POST['phone']; 

		if(is_null($_POST['nationalite']) && is_null($_POST['niveau']) )
		{
	        $nationa = null;
	        $niveau = null;
        }
        else
        {
           $niveau = $_POST['niveau'];
		   $nationa = $_POST['nationalite'];
        }
		// tuteur

		if ($pwd === $pwd2) {
		
			$request = $bd->prepare('SELECT u.email from user as u WHERE u.email = ?');
			$request->execute(array($login_mail));

			//On regarde si le mail n'est pas déjà utilisé pour un compte valide!
			if ($request->rowCount() == 0 /*aucun compte avec ce login*/) 
			{  
				//On créer un nouveau compte (nouvealle ligne dans bd)
				// on insère son adresse
				$req = $bd->prepare("INSERT INTO adresse (ville,adress,complement_adress,code_postal) VALUES(?,?,?,?)");
				$code_postal= intval($code_postal);
                $req->execute(array($ville,$adress,$com_adress,$code_postal));

                // puis son nom et prénom dans la table user
				$addCompte = $bd->prepare('INSERT INTO user (nom, prenom, date_naissance,ecole,niveau, email, password,phone,id_adresse) VALUES (?,?,?,?,?,?,?,?,(SELECT id_adresse FROM adresse WHERE ville= ? AND adress = ? AND complement_Adress = ? AND code_postal = ?))');
				//$date_naiss= DATE_FORMAT($date_naiss, "%M %d %Y");
				$addCompte->execute(array($nom, $prenom,$date_naiss, $ecole,$niveau, $login_mail, $pwd, $phone, $ville, $adress, $com_adress, $code_postal));   // rajouter une exception à ce niveau
                
                
               
                
		                //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
				$message_txt = 'Bonjour,\nVous avez entamé la procédure de création de votre compte et nous vous en remercions .\n Actuellement le statut de votre compte est en attente de validation. Nous vous enverrons un mail dès qu\'il sera validé. Le délai de traitement est de quelques jours. \n\n Cordialement, Mr/Mme "'.$nom.'" "'.$prenom.'"\n

				<a href http://localhost:8888/tests/PlateFormTutorat/index.php?controller=users&action=resetPassword> reset password</a> Ce message  est généré automatiquement, veuillez ne pas répondre.';
				$message_html ='<html><head></head><body><p>Bonjour, </p><p> Vous avez entamé la procédure de création de votre compte et nous vous en remercions .</p><p>Actuellement le statut de votre compte est en attente de validation.Nous vous enverrons un mail dès qu\'il sera validé. Le délai de traitement est de quelques jours.</p><p> Cordialement, Mr/Mme "'.$nom.'" "'.$prenom.'"</p></body></html>';
				//Sujet
				$sujet = "[Yncrea tutorat]  Création de compte";
                // on envoie un email de confirmation
                include('send_mail.php');

                if(is_null($niveau) && is_null($nationa)) // c'est un tuteur dans ce cas 
   					 {
   					 	// on insère son école
   					 	$req = $bd->prepare("INSERT INTO classe (ecole) VALUES(?)");
                		$req->execute(array($ecole));
                // on insère dans la table tuteur
		                $req = $bd->prepare("INSERT INTO tuteurs (id_tuteurs,nb_max_mef,nb_max_perso) VALUES((SELECT id_user FROM user  WHERE email =?),3,2)");
		                $req->execute(array($login_mail));

                // initialise le statut_compte du nouveau user dans avoir_statut
				         $req = $bd->prepare("INSERT INTO avoir_statut (id_user,id_statut_compte,id_statut,id_etat) VALUES ((SELECT id_user FROM user  WHERE email =?),(SELECT id_statut_compte FROM statut_compte  WHERE libelle = 'ATTENTE_VALIDATION'),(SELECT id_statut FROM statut WHERE libelle = 'TUTEUR' ),(SELECT id_etat FROM etat as e WHERE e.libelle = 'LIBRE')) ");
				         $req->execute(array($login_mail));

                        
						header('location:index.php?controller=users&action=connexion');

						// on insère. l'id_classe  dans la table user
		                //$req= $bd->prepare("INSERT INTO user(id_classe) VALUES(SELECT id_classe from classe WHERE ecole=? AND niveau= 'NULL' )");
		                //$re->execute(array($ecole,$niveau));
					}
				else
					{   
						if( isset($_SESSION['id_statut']) && $_SESSION['id_statut'] == 11)
						{
							// on insère dans la table tutoré
			                $addtutoré = $bd->prepare("INSERT INTO tutores(id_tutores,nationalite,id_typeTutorat) VALUES((SELECT id_user FROM user  WHERE email = ?),?,(SELECT id_typeTutorat FROM type_tutorat WHERE libelle = 'MEF'))");
			                $addtutoré->execute(array($login_mail, $nationa));
		                }
		                else // c'est un tuteur normal qui fait l'inscription
		                {
		                	$addtutoré = $bd->prepare("INSERT INTO tutores(id_tutores,nationalite) VALUES((SELECT id_user FROM user  WHERE email = ?),?)");
			                $addtutoré->execute(array($login_mail, $nationa));
		                }

		                // on insère son niveau
		                $req = $bd->prepare("INSERT INTO classe (niveau,ecole) VALUES(?,?)");
               			$req->execute(array($niveau,$ecole));
               
                // initialise le statut_compte du nouveau user dans avoir_statut
                   
				         $req = $bd->prepare("INSERT INTO avoir_statut (id_user,id_statut_compte,id_statut,id_etat) VALUES ((SELECT id_user FROM user  WHERE email =?),(SELECT id_statut_compte FROM statut_compte  WHERE libelle = 'ATTENTE_VALIDATION' ),(SELECT id_statut FROM statut WHERE libelle = 'TUTORE' ),(SELECT id_etat FROM etat as e WHERE e.libelle = 'LIBRE')) ");
				         $req->execute(array($login_mail));

				         // on insère. l'id_classe  dans la table user
                        //$req= $bd->prepare("INSERT INTO user(id_classe) VALUES(SELECT id_classe from classe WHERE niveau= ? AND ecole= ? )");
                        //$req->execute(array($niveau,$ecole;));
                         if( isset($_SESSION['id_statut']) && $_SESSION['id_statut'] == 11)
				         	header('location:index.php?controller=users&action=redirection');
				         else
				         	header('location:index.php?controller=users&action=connexion');
					}


				
			}
			else 
			{
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
