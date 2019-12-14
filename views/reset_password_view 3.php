<script type="text/javascript">
//Control password
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}

</script>

<div class="login-dark">
        <form method="post" action="resetPassword.php">
            <h2 class="sr-only">Réinitialiser le mot de passe </h2>
            <div class="illustration">
                <i class="icon ion-person-add"></i>
            </div>
           <?php  include('views/alert_view.php'); ?>
          
            <div class="form-group">
                <input class="form-control" type="text" name="reset_email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" id="password" placeholder="mot de passe"  onkeyup='javascript:check();' required>
            </div>
            <div class="form-group">
            <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="confirmer mot de passe"  onkeyup='javascript:check();' required>
            </div>
            <div class="form-group">
            <button class="btn btn-primary btn-block" id="submit">Réinitialiser</button>
            <div><a href="index.php?controller=users&action=login" class="forgot">Se Connecter ?</a></div>
            </div>

          </form>
        
</div>


