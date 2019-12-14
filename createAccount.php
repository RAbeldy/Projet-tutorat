	<?php
    session_start();
	include('connexion.php');
	require ('PHPMailer/PHPMailerAutoload.php');
	require ('connectToMail.php');

	$bd = Db::getInstance();
    
    $error= 0;

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
    
    
	if ($_POST['email']!="" && $_POST['password']!="" && $_POST['confirmer_password']!="" && $_POST['nom']!="" && $_POST['prenom']!="" && $_POST['date_naiss']!="" && $_POST['ecole']!=""  && $_POST['adresse']!="" && $_POST['complement_adresse']!="" && $_POST['ville']!="" && $_POST['code_postal']!="" && $_POST['phone']!="") {
		//Dans ce cas, les champs ont été remplis

		//tutoré
		$login_mail = htmlspecialchars($_POST['email']);
		$pwd = htmlspecialchars($_POST['password']);
		$pwd2 = htmlspecialchars($_POST['confirmer_password']);
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$date_naiss = htmlspecialchars($_POST['date_naiss']);
		$ecole = htmlspecialchars($_POST['ecole']);
		$adress = htmlspecialchars($_POST['adresse']);
		$com_adress = htmlspecialchars($_POST['complement_adresse']);
		$ville = htmlspecialchars($_POST['ville']);
		$code_postal = htmlspecialchars($_POST['code_postal']);
		$phone = htmlspecialchars($_POST['phone']); 
		

		if($_POST['nationalite']=="" && $_POST['niveau']=="" )
		{
	        $nationa = null;
	        $niveau = null;
        }
        else
        {
           $niveau = htmlspecialchars($_POST['niveau']);
		   $nationa = htmlspecialchars($_POST['nationalite']);
        }
		// tuteur

		if ($pwd === $pwd2) {
		
			$request = $bd->prepare('SELECT u.email from user as u WHERE u.email = ?');
			$request->execute(array($login_mail));

			
			//On regarde si le mail n'est pas déjà utilisé pour un compte valide!
			if ($request->rowCount() == 0 /*aucun compte avec ce login*/) 
			{  


		                //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
				$message_txt = 'Bonjour,\nVous avez entamé la procédure de création de votre compte et nous vous en remercions .\n Actuellement le statut de votre compte est en attente de validation. Nous vous enverrons un mail dès qu\'il sera validé. Le délai de traitement est de quelques jours. \n\n Cordialement, Mr/Mme "'.$nom.'" "'.$prenom.'"\n

				<a href http://localhost:8888/tests/PlateFormTutorat/index.php?controller=users&action=resetPassword> reset password</a> Ce message  est généré automatiquement, veuillez ne pas répondre.';
				$message_html ='<html><head></head><body><p>Bonjour, </p><p> Vous avez entamé la procédure de création de votre compte et nous vous en remercions .</p><p>Actuellement le statut de votre compte est en attente de validation.Nous vous enverrons un mail dès qu\'il sera validé. Le délai de traitement est de quelques jours.</p><p> Cordialement, Mr/Mme "'.$nom.'" "'.$prenom.'"</p></body></html>';
				//Sujet
				$sujet = "[Yncrea tutorat]  Création de compte";
                // on envoie un email de confirmation
                include('send_mail.php');

                if($error == 0)
                {

		                if(is_null($niveau) && is_null($nationa)) // c'est un tuteur dans ce cas 
		   				{
							if( preg_match('#^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))+@[A-Z0-9.-]+\.yncrea.fr#',$login_mail))
							{
							   //On créer un nouveau compte (nouvelle ligne dans bd)
								// on insère son adresse
								$req = $bd->prepare("INSERT INTO adresse (ville,adress,complement_adress,code_postal) VALUES(?,?,?,?)");
								$code_postal= intval($code_postal);
								$req->execute(array($ville,$adress,$com_adress,$code_postal));

								// puis son nom et prénom dans la table user
								$addCompte = $bd->prepare('INSERT INTO user (nom, prenom, date_naissance,ecole,niveau, email, password,phone,id_adresse) VALUES (?,?,?,?,?,?,?,?,(SELECT id_adresse FROM adresse WHERE ville= ? AND adress = ? AND complement_Adress = ? AND code_postal = ?))');
								//$date_naiss= DATE_FORMAT($date_naiss, "%M %d %Y");
								$addCompte->execute(array($nom, $prenom,$date_naiss, $ecole,$niveau, $login_mail, $pwd, $phone, $ville, $adress, $com_adress, $code_postal));   // rajouter une exception à ce niveau
								
		   					 	// on insère son école
		   					 	$req = $bd->prepare("INSERT INTO classe (ecole) VALUES(?)");
		                		$req->execute(array($ecole));
		                // on insère dans la table tuteur
				                $req = $bd->prepare("INSERT INTO tuteurs (id_tuteurs,nb_linksmef,nb_max_mef,nb_linksperso,nb_max_perso) VALUES((SELECT id_user FROM user  WHERE email =?),0,3,0,2)");
				                $req->execute(array($login_mail));

		                // initialise le statut_compte du nouveau user dans avoir_statut
						         $req = $bd->prepare("INSERT INTO avoir_statut (id_user,id_statut_compte,id_statut,id_etat) VALUES ((SELECT id_user FROM user  WHERE email =?),(SELECT id_statut_compte FROM statut_compte  WHERE libelle = 'ATTENTE_VALIDATION'),(SELECT id_statut FROM statut WHERE libelle = 'TUTEUR' ),(SELECT id_etat FROM etat as e WHERE e.libelle = 'LIBRE')) ");
						         $req->execute(array($login_mail));

		                        $_SESSION['alert']='inscription réussie,vous recevrez un e-mail de confirmation dans un instant';
								header('location:index.php?controller=users&action=login');

								// on insère. l'id_classe  dans la table user
				                //$req= $bd->prepare("INSERT INTO user(id_classe) VALUES(SELECT id_classe from classe WHERE ecole=? AND niveau= 'NULL' )");
				                //$re->execute(array($ecole,$niveau));
							}
							else{
								//login déjà utilisé pour un compte valide
								$_SESSION['alert']= "&nbsp <strong>une inscription en tant que tuteur requiert une adresse mail YNCREA </strong>";
								header('location:index.php?controller=users&action=choixStatut');
								//On le redirige vers la page de login
							}
						}
						else
						{   
								if(isset($_SESSION['id_statut']) && $_SESSION['id_statut'] == 11 ) // c'est l'admin MEF qui fait l'inscription
								{
									//On créer un nouveau compte (nouvelle ligne dans bd)
									// on insère son adresse
									$req = $bd->prepare("INSERT INTO adresse (ville,adress,complement_adress,code_postal) VALUES(?,?,?,?)");
									$code_postal= intval($code_postal);
									$req->execute(array($ville,$adress,$com_adress,$code_postal));

									// puis son nom et prénom dans la table user
									$addCompte = $bd->prepare('INSERT INTO user (nom, prenom, date_naissance,ecole,niveau, email, password,phone,id_adresse) VALUES (?,?,?,?,?,?,?,?,(SELECT id_adresse FROM adresse WHERE ville= ? AND adress = ? AND complement_Adress = ? AND code_postal = ?))');
									//$date_naiss= DATE_FORMAT($date_naiss, "%M %d %Y");
									$addCompte->execute(array($nom, $prenom,$date_naiss, $ecole,$niveau, $login_mail, $pwd, $phone, $ville, $adress, $com_adress, $code_postal));   // rajouter une exception à ce niveau
									
									$addtutoré = $bd->prepare("INSERT INTO tutores(id_tutores,nationalite) VALUES((SELECT id_user FROM user  WHERE email = ?),?)");
					                $addtutoré->execute(array($login_mail, $nationa));

					                // on insère dans la table se_destine 
					                $addtutoré = $bd->prepare("INSERT INTO se_destine(id_user,id_tutorat,id_typeTutorat,liaison) VALUES((SELECT id_user FROM user  WHERE email = ?),?,(SELECT id_typeTutorat FROM administrer WHERE id_admin= ? AND id_admin= ".$_SESSION['id_user']."),'OUI')");
					                $addtutoré->execute(array($login_mail,2,$_SESSION['id_user']));
					               

								}
								else // c'est un étudiant normal qui fait l'inscription 
								{
									//On créer un nouveau compte (nouvelle ligne dans bd)
									// on insère son adresse
									$req = $bd->prepare("INSERT INTO adresse (ville,adress,complement_adress,code_postal) VALUES(?,?,?,?)");
									$code_postal= intval($code_postal);
									$req->execute(array($ville,$adress,$com_adress,$code_postal));

									// puis son nom et prénom dans la table user
									$addCompte = $bd->prepare('INSERT INTO user (nom, prenom, date_naissance,ecole,niveau, email, password,phone,id_adresse) VALUES (?,?,?,?,?,?,?,?,(SELECT id_adresse FROM adresse WHERE ville= ? AND adress = ? AND complement_Adress = ? AND code_postal = ?))');
									//$date_naiss= DATE_FORMAT($date_naiss, "%M %d %Y");
									$addCompte->execute(array($nom, $prenom,$date_naiss, $ecole,$niveau, $login_mail, $pwd, $phone, $ville, $adress, $com_adress, $code_postal));   // rajouter une exception à ce niveau
									
									$addtutoré = $bd->prepare("INSERT INTO tutores(id_tutores,nationalite) VALUES((SELECT id_user FROM user  WHERE email = ?),?)");
					                $addtutoré->execute(array($login_mail, $nationa));
								}
				                	
				                

				                // on insère son niveau
				                //$req = $bd->prepare("INSERT INTO classe (niveau,ecole) VALUES(?,?)");
		               			//$req->execute(array($niveau,$ecole));
		               
		                // initialise le statut_compte du nouveau user dans avoir_statut
		                   
						         $req = $bd->prepare("INSERT INTO avoir_statut (id_user,id_statut_compte,id_statut,id_etat) VALUES ((SELECT id_user FROM user  WHERE email =?),(SELECT id_statut_compte FROM statut_compte  WHERE libelle = 'ATTENTE_VALIDATION' ),(SELECT id_statut FROM statut WHERE libelle = 'TUTORE' ),(SELECT id_etat FROM etat as e WHERE e.libelle = 'LIBRE')) ");
						         $req->execute(array($login_mail));

						         // on insère. l'id_classe  dans la table user
		                        //$req= $bd->prepare("INSERT INTO user(id_classe) VALUES(SELECT id_classe from classe WHERE niveau= ? AND ecole= ? )");
		                        //$req->execute(array($niveau,$ecole;));

		                         if( isset($_SESSION['id_statut']) && $_SESSION['id_statut'] == 11)
						         	header('location: index.php?controller=users&action=redirection');
						         else
						         	header('location: index.php?controller=users&action=login');
						}
				}
				else
				{
					echo $error;
					//adresse  mail invalide envoi de mail echoué
				$_SESSION['alert']= "&nbsp <strong>cette adresse e-mail est incorrecte, remplissez à nouveau le formulaire</strong>";
				header('location:index.php?controller=users&action=choixStatut');
				//On le redirige vers la page de login
				}

			}
			else 
			{
				//login déjà utilisé pour un compte valide
				$_SESSION['alert']= "&nbsp <strong>Cette adresse e-mail ne vous appartient pas.
				il se pourrait que vous ou un autre utilisateur se soit deja incrit en utilisant cette adresse mail.
				S'il s'agit de vous, alors rendez-vous dans la rubrique mot de passe oublié.
				si tel n'est pas le cas utilisez une autre adresse email \"valide\" cela va de soi</strong>";
				header('location:index.php?controller=users&action=choixStatut');
				//On le redirige vers la page de login
			}
		
		}
		else {
			//pwd et confirmation différente
			//login déjà utilisé pour un compte valide
			$_SESSION['alert']= "&nbsp &nbsp &nbsp &nbsp<strong>  Mots de passe différents</strong>";
			header('location:index.php?controller=users&action=choixStatut');
		     }
	}
	else{
		//Champs non remplis
		//login déjà utilisé pour un compte valide
		$_SESSION['alert']= "&nbsp <strong>Champs non remplis</strong>";
		header('location:index.php?controller=users&action=choixStatut');
	}
?>
