<?php 
header('Access-Control-Allow-Origin: *');
//Connection à la base de donnée
include('connexion.php');
require 'PHPMailer/PHPMailerAutoload.php';
//Données pour se connecter au compte mail
require 'connectToMail.php';

$bdd = Db::getInstance();


$resultat = ""; //stocke le résultat de l'opération!
if (isset($_POST['reset_email']) AND isset($_POST['password']) AND isset($_POST['confirm_password']) ) {
	$login_mail = $_POST["reset_email"]; //adreese mail du destinataire
	$pwd1= $_POST['password'];
	$pwd2= $_POST['confirm_password'];
	    if($pwd1 == $pwd2) // mot de passe identiques
	    {
		$req= $bdd->prepare('SELECT u.id_user from user as u, avoir_statut as av, statut_compte as s  WHERE u.id_user = av.id_user and av.id_statut_compte = s.id_statut_compte and s.libelle <>"ATTENTE_VALIDATION" and u.email= ?');
			$req->execute(array($login_mail)); 
			if ($req->rowCount() == 1) { // on regarde si le compte est activé ou non

			
			

			//Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
			$message_txt = 'Bonjour,\nVotre mot de passe a été réinitialisé.\n Votre nouveau mot de passe est : "'.$pwd1.'"\nCe message est généré automatiquement, veuillez ne pas répondre.';
			$message_html ='<html><head></head><body><p>Bonjour, </p><p>Votre mot de passe a été réinitialisé.</p><p>Votre nouveau mot de passe est : <b>"'.$pwd1.'"</b></p><p>Ce message est généré <b>automatiquement</b>, veuillez <b>ne pas répondre</b>.</p></body></html>';
			//Sujet
			$sujet = "[Yncrea tutorat] Réinitialisation du mot de passe";
			//envoie du mail
			include('send_mail.php');
	        
			//On enregistre le nouveau mot de passe dans la bdd
			$updatePWD = $bdd->prepare('UPDATE user SET password=? WHERE email=?');
			$updatePWD->execute(array(password_hash($pwd1, PASSWORD_DEFAULT), $login_mail));
			$resultat="1";
			//header('location:index.php');
		}
		else
		{
         $resultat="0 doesn't exist in database";
		//header('location:index.php');

		}
}
else {
		$resultat="0 password doesn't match";
		//header('location:index.php');
	}
echo ($resultat);
}
?>