<?php 
session_start();
header('Access-Control-Allow-Origin: *');
//Connection à la base de donnée
include('connexion.php');
require 'PHPMailer/PHPMailerAutoload.php';
//Données pour se connecter au compte mail 
require 'connectToMail.php';
 
$bdd = Db::getInstance();


$resultat = ""; //stocke le résultat de l'opération!
if (isset($_POST['reset_email'])) {
	    
		$login_mail = $_POST["reset_email"]; //adreese mail du destinataire
		$req=$bdd->prepare('SELECT u.id_user from user as u, avoir_statut as av, statut_compte as s  WHERE u.id_user = av.id_user and av.id_statut_compte = s.id_statut_compte and s.libelle <> "ATTENTE_VALIDATION" and u.email= ? ');
		$req->execute(array($login_mail)); 
		if ($req->rowCount() == 1) {
		//On regarde si le compte est activé ou non

		//Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
		$message_txt = 'Bonjour,\nVous souhaitez réinitialiser votre mot de passe .\n Pour ce faire veuillez cliquez sur le lien juste en bas"\n

		<a href="https://tutorat-yncrea.fr/index.php?controller=users&action=resetPassword"> reset password</a> Ce message  est généré automatiquement, veuillez ne pas répondre.';
		$message_html ='<html><head></head><body><p>Bonjour, </p><p> Vous souhaitez réinitialiser votre mot de passe?.</p><p>Pour ce faire veuillez cliquez sur le lien juste en bas.Ce message est généré automatiquement.veuillez <b>ne pas répondre</b>,please  <b>do not answer</b></p>.<p><a href="https://tutorat-yncrea.fr/index.php?controller=users&action=resetPassword"> reset password</a></p></body></html>';
		//Sujet
		$sujet = "[Yncrea tutorat]  Mot de passe oublié";
		//envoie du mail
		include('send_mail.php');
        

	    //$resultat="1";
	   $_SESSION['alert']= "vous allez recevoir un e-mail dans quelques minutes </br>, vous n'aurez alors qu'à suivre la procédure" ;
	    header('location:index.php?controller=users&action=forgotPassword');
	}
	else {
		//$resultat="0";
		
		$_SESSION['alert']= "l'email que vous avez saisi est incorrect " ;
		header('location:index.php?controller=users&action=forgotPassword');
	}
//echo ($resultat);
}
?>