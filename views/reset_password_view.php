

<div class="login-clean">
        <form method="post" action="resetPassword.php" class="envoi">
            <h2 class="sr-only">Réinitialiser le mot de passe </h2>
            <div class="illustration">
                <i class="icon ion-person-add"></i>
            </div>
           <?php  include('views/alert_view.php'); ?>
          
            <div class="form-group">
                <input class="form-control complete" type="text" name="reset_email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input class="form-control complete" type="password" name="password" id="password" placeholder="mot de passe"  onkeyup='javascript:check();' required>
                <span id='mess'></span>
            </div>
            <div class="form-group">
            <input class="form-control complete" type="password" name="confirm_password" id="cpassword" placeholder="confirmer mot de passe"  onkeyup='javascript:check();' required>
            <span id='mess'></span>
            </div>
            <div class="form-group">
            <button class="btn btn-primary btn-block" id="submit">Réinitialiser</button>
            <div><a href="index.php?controller=users&action=login" class="forgot">Se Connecter ?</a></div>
            </div>

          </form>
        
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    //Control password
    $(document).ready(function(){

        
        var complete= document.querySelectorAll(".complete");
        var pwd= document.getElementById('password');
        var cpwd= document.getElementById('cpassword');
        var tel= document.getElementById('tel');
        var bool= true;
      

        var checke = function() {
          if (pwd.value ==  cpwd.value) {
            document.getElementById('mess').style.color = 'green';
            document.getElementById('mess').innerHTML = 'matching';
          } else {
            document.getElementById('mess').style.color = 'red';
            document.getElementById('mess').innerHTML = 'not matching';
          }
        }

        
        
        function completeFields(complete){
            for(let i=0 ; i< complete.length; i++)
            {
                if(complete[i].value == "")
                {
                    complete[i].style.borderColor= "red";
                    complete[i].style.color= "red";
                    //complete[i].placeholder= "veuillez remplir ce champ";
                    bool= false;
                }
    
            }
                if(bool)
                    return true;
                else    
                {
                    bool= true;
                    return false;
                }
            }
            
            $('#cpassword').keyup(e =>{
                checke();
            })
            
            $('.envoi').submit((e)=>{
            if(!completeFields(complete))
            {
                alert("des champs sont incomplets");
                e.preventDefault(); // on annule la fonction par défaut du bouton d'envoi
            }
           
        })
})
</script>