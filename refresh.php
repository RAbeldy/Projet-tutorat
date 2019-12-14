<?php
	if($_GET['controller'] == 'users' && $_GET['action']== 'connexion')
		{ ?>
			<form method="post" action="index.php?controller=users&action=connexion">
				<input type="hidden" name="email" value="<?=$_POST['email']?>">
				<input type="hidden" name="password" value="<?=$_POST['password']?>">
			</form>

<?php
	}


if($_GET['controller'] == 'users' && $_GET['action']== 'deconnexion')
	header('location:index.php?controller=users&action=deconnexion');
?>