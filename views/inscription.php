    <!-- Start: Pretty Login Form -->
    <div class="row login-form">
        <div class="col-md-4 offset-md-4">
            <hr>
            <h2 class="text-center form-heading">Formulaire d'inscription </h2>
            <form class="custom-form" method="post" action="?controller=users&action=save_user">
             <hr>   

                <div class="form-group">
                    <input class="form-control" name="nom" type="text" placeholder="Nom">
                </div>

                <div class="form-group">
                    <input class="form-control" name="prenom" type="text" placeholder="Prénom">
                </div>

                <div class="form-group">
                    <input class="form-control" name="date_naiss" type="date" placeholder="date de naissance">
                </div>

                <div class="form-group">
                    <input class="form-control" name="mail" type="email" placeholder="Email">
                </div>                

                <div class="form-group">
                    <input class="form-control" name="pwd" type="password" placeholder="Mot de passe">
                </div> 

                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Confirmer mot passe">
                </div>                                                                 

                <button class="btn btn-light btn-block submit-button" type="submit">Valider
                </button>
            </form>
        </div>
    </div>