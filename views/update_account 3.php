
    <div class="container debut" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form method="post" action="?controller=users&action=modify_account" class="card-container" enctype="multipart/form-data">

            <div class="card" style="display:flex; flex-direction:row; padding-top: 60px; padding-bottom: 60px;">
                <div class="col-md-4">
                    <div class="avatar">
                        <div id="profilPic">
                            <img src='<?=$donnees->getChemin_photo() ;?>' />
                        </div>
						<div class="photo-chooser">
							<input type="file" class="photo-chooser-input" id="photoChooser"/>
							<label class="custom-file-label" for="customFile">Choisir une photo</label>
						</div>
                    </div>
                </div>
                <div class="col-md-8 profil">
                    <h1>Profil </h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Adresse</label>
                                <input class="form-control" type="text" value="<?php echo $donnees->getAdress();?>" name="adresse" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Complément D'Adresse&nbsp;</label>
                                <input class="form-control" type="text" value="<?php echo $donnees->getCom_adress();?>"   name="complement_adresse">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ville</label>
                                <input class="form-control" type="text" value="<?php echo $donnees->getVille();?>"  name="ville"   required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Code Postal</label>
                                <input class="form-control" type="text" value="<?php echo $donnees->getCode_postal();?>"  name="code_postal" value="" >
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Niveau scolaire</label>
                                <input class="form-control" type="text" value="<?php echo $donnees->getNiveau();?>"  name="code_postal" value="" >
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ecole</label>
                                <input class="form-control" type="text" value="<?php echo $donnees->getEcole();?>"  name="code_postal" value="" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Mot de Passe</label>
                                <input class="form-control" type="password" name="password" id="password"onkeyup='javascript:checke();' required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Confirmer Mot de Passe&nbsp;</label> <!-- &nbsp permet de forcer un blanc -->
                                <input class="form-control" type="password" name="confirmer_password" id="confirm_password" onkeyup='javascript:checke();' required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-3 offset-2" style="text-align: initial;">
                            <a href="#" class="">
                                <button class="btn " type="reset"> Annuler </button>
                            </a>
                        </div>
                        <div class="col-4 offset-2" style="text-align: initial;">
                            <a href="#" class="">
                                <button onclick="alert();" class="btn " name="sauvegarder" type="submit">Sauvegarder</button>
                            </a>
                        </div>
                    </div>
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
