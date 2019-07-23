
<script type="text/javascript">
//Control password
var checke = function() {
  if (document.getElementById('passworde').value ==
    document.getElementById('confirme_password').value) {
    document.getElementById('mess').style.color = 'green';
    document.getElementById('mess').innerHTML = 'matching';
  } else {
    document.getElementById('mess').style.color = 'red';
    document.getElementById('mess').innerHTML = 'not matching';
  }
}

</script>

<div class="login-dark">
        <form method="post" action="resetPassword.php">
            <h2 class="sr-only">Réinitialiser le mot de passe </h2>
            <div class="illustration">
                <i class="icon ion-person-add"></i>
            </div>
           
          
            <div class="form-group">
                <input  class="form-control" type="text" name="reset_email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" id="passworde" placeholder="Mot de passe"       onkeyup='javascript:checke();' required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="confirmer_password" id="confirme_password" placeholder="Confirmer mot de passe" onkeyup='javascript:checke();'  required>
             <span id='mess'></span>
            </div>
            <div class="form-group">
            <button class="btn btn-primary btn-block" id="submit">Réinitialiser</button>
            <div><a href="index.php?controller=users&action=login" class="forgot">Se Connecter ?</a></div>
            </div>

          </form>
          
     </div>


