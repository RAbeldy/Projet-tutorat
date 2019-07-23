
    <div class="container profile profile-view" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form method="get" action="?controller=tuteurs&action=modify_account&adresse=<?=$donnees['adress']?>&ville">
            <div class="form-row profile-row profile">
                <div class="col-md-4 relative profile">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div>
                </div>
                <div class="col-md-8 profil">
                    <h1>Profile </h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Adresse</label><input class="form-control" type="text" name="adresse" value="<?=$donnees['adress']?>"autofocus required></div>
                           

                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Complément D'Adresse&nbsp;</label><input class="form-control" type="text" name="complement_adresse" value=" <?= $donnees['complement_adress'] ;?> "  ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Ville</label><input class="form-control" type="text" name="ville" value="<?=$donnees['ville']?>" ></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Code Postal</label><input class="form-control" type="text" name="code_postal" value="<?=$donnees['code_postal'];?>" ></div>
                        </div><?php   ?>
                        <div class="col">
                            <div class="form-group"><label>Mot de Passe</label><input class="form-control" type="password" name="password"  onkeyup='javascript:check();' ></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Confirmer Mot de Passe&nbsp;</label><input class="form-control" type="password" name="confirmer_password"  onkeyup='javascript:check();' ></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><button onclick="alert();" class="btn btn-primary form-btn profil" type="submit">Sauvegarder</button><a href="views/tuteurs/interface_tuteur.php"><button class="btn btn-danger form-btn profil" type="reset">Annuler</button></a></div>
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

       var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirmer_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
   </script>

