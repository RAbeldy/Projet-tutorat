<?php
	session_start();
	require_once('connexion.php');
	$db = Db::getInstance();

	$request = $db->prepare('SELECT u.id_user as id from user as u, avoir_statut as av, statut_compte as s  WHERE u.email=? and u.password=? and u.id_user = av.id_user and av.id_statut = s.id_statut and s.libelle <> "ATTENTE_VALIDATION" ');
	$request->execute(array($_POST['login'],$_POST['password']));
	if ($request->rowCount() == 1)
	{
		 echo('1');
		 $_SESSION['user_id']=$request->fetch()['id'];
		 
		 
		 //on recupere l'ID du statut de l'user
		 $request=$db->query('SELECT avst.id_statut as id_statut,us.nom as nom,us.prenom as prenom,us.email as mail from user as us, avoir_statut as avst WHERE  avst.id_user=us.id_user and avst.id_user = '.$_SESSION['user_id'].'');
		 $res = $request->fetch();

		 $_SESSION['mail']=$res['mail'];
		 $_SESSION['nom']=$res['nom'];
		 $_SESSION['prenom']=$res['prenom'];
		 $_SESSION['statut_id']=$res['id_statut'];

	} else {
		echo('0');
	}
?>


