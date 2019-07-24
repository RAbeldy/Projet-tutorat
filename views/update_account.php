
    <div class="container profile profile-view" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form method="post" action="?controller=tuteurs&action=modify_account">
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
                            <div class="form-group">
                                <label>Adresse</label>
                                <input class="form-control" type="text" name="adresse" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Complément D'Adresse&nbsp;</label>
                                <input class="form-control" type="text" name="complement_adresse">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ville</label>
                                <input class="form-control" type="text" name="ville"   required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Code Postal</label>
                                <input class="form-control" type="text" name="code_postal" value="" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Mot de Passe</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Confirmer Mot de Passe&nbsp;</label>
                                <input class="form-control" type="password" name="confirmer_password" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><a href="#"><button onclick="alert();" class="btn btn-primary form-btn profil" type="submit">Sauvegarder</button></a><a href="views/tuteurs/interface_tuteur.php"><button class="btn btn-danger form-btn profil" type="reset">Annuler</button></a></div>
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
   </script>
