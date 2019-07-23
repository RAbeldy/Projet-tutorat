


<div class="login-dark">
        <form method="post" action="reset_password_link_sentbymail.php">
            <h2 class="sr-only">Mot de passe oublié </h2>
            <div class="illustration">
                <i class="icon ion-person-add"></i>
            </div>
            <?php  include('views/alert_view.php'); ?>
          
            <div class="form-group">
                <input class="form-control" type="text" name="reset_email" placeholder="Email" required>
            </div>
            <div class="form-group">
            <button class="btn btn-primary btn-block" id="submit">Réinitialiser</button>
            <div><a href="index.php?controller=users&amp;action=login" class="forgot">Se Connecter ?</a></div>
            </div>

          </form>
          
     </div>

