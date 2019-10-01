
    <div class="container debut" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
		<?php
		  foreach ($donnees as $elt) 
          {
        ?>
        <form method="post" action="?controller=admin&action=valider_account" class="card-container" enctype="multipart/form-data">			
            <div class="card" style="display:flex; flex-direction:row; padding-top: 60px; padding-bottom: 60px;">
                <div class="col-md-8 profil">
                    <h1>Profile </h1>
                    <hr>
                    <div class="form-row">
					    <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
								<label class="form-control"><?=$elt['user']->getNom()?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Prenom</label>
								<label class="form-control"><?=$elt['user']->getPrenom();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Mail</label>
								<label class="form-control"><?=$elt['user']->getEmail();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Niveau</label>
								<label class="form-control"><?=$elt['user']->getNiveau();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ecole</label>
								<label class="form-control"><?=$elt['user']->getEcole();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Bourse</label>
								<label class="form-control"><?=$elt['bourse'];?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Nationalite</label>
								<label class="form-control"><?=$elt['nationalite'];?></label>
                            </div>
                        </div>
					    <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Date de naissance</label>
								<label class="form-control"><?=$elt['user']->getDate_naissance();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Telephone</label>
								<label class="form-control"><?=$elt['user']->getPhone();?></label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Adresse</label>
								<label class="form-control"><?=$elt['user']->getAdress();?></label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Complément D'Adresse</label>
								<label class="form-control"><?=$elt['user']->getCom_adress();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ville</label>
								<label class="form-control"><?=$elt['user']->getVille();?></label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Code Postal</label>
								<label class="form-control"><?=$elt['user']->getCode_postal();?></label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
					    <div class="col-3 offset-2" style="text-align: initial;">
                            <button class="btn form-btn profil" type="reset" name="annulertutore">Annuler</button>
						    <input type="hidden" name="id_user" value="<?=$elt['user']->getId_user()?>" >
                        </div>
                        <div class="col-4 offset-2" style="text-align: initial;">
                           <button onclick="alert();" class="btn form-btn profil" name="validertutore" type="submit">Valider</button>
						   <input type="hidden" name="id_user" value="<?=$elt['user']->getId_user()?>" >
                        </div>
                    </div>
					<?php
		               }
					 ?>
                </div>
            </div>
        </form>
    </div>
   
   <script type="text/javascript">
       function alert()
       {
        confirm('etes vous sur de vouloir modifier');
       }
       //Control password
var checke = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('mess').style.color = 'green';
    document.getElementById('mess').innerHTML = 'matching';
  } else {
    document.getElementById('mess').style.color = 'red';
    document.getElementById('mess').innerHTML = 'not matching';
  }
}
   </script>
