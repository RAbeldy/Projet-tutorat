
    <div class="container debut" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
            <div class="card" style="display:flex; flex-direction:row; padding-top: 60px; padding-bottom: 60px;">
                <div class="col-md-8 profil">
                    <h1>Profile </h1>
                    <hr>
                    <div class="form-row">
					    <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
								<label class="form-control"><?php echo $donnees->getNom()?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Prenom</label>
								<label class="form-control"><?php echo $donnees->getPrenom();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Mail</label>
								<label class="form-control"><?php echo $donnees->getEmail();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Niveau</label>
								<label class="form-control"><?php echo $donnees->getNiveau();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ecole</label>
								<label class="form-control"><?php echo $donnees->getEcole();?></label>
                            </div>
                        </div>
					    <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Date de naissance</label>
								<label class="form-control"><?php echo $donnees->getDate_naissance();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Telephone</label>
								<label class="form-control"><?php echo $donnees->getPhone();?></label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Adresse</label>
								<label class="form-control"><?php echo $donnees->getAdress();?></label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Complément D'Adresse</label>
								<label class="form-control"><?php echo $donnees->getCom_adress();?></label>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ville</label>
								<label class="form-control"><?php echo $donnees->getVille();?></label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Code Postal</label>
								<label class="form-control"><?php echo $donnees->getCode_postal();?></label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
					    <div class="col-3 offset-2" style="text-align: initial;">
                            <form method="post" action="?controller=admin&action=wait_compte">
                                <button class="btn form-btn profil" type="reset" name="annulertuteur">Annuler</button>
								<input type="hidden" name="id_user" value="<?=$donnees->getId_user()?>">
                            </form>
                        </div>
                        <div class="col-4 offset-2" style="text-align: initial;">
                            <form method="post" action="?controller=admin&action=valider_account">
                                <button onclick="alert();" class="btn form-btn profil" name="validertuteur" type="submit">Valider</button>
								 <input type="hidden" name="id_user" value="<?=$donnees->getId_user()?>" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
