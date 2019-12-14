
        <!-- TUTEUR -->
<div class="login-clean">
    <form method="post" action="createAccount.php" class="envoi">
     <div class="form-group" id="Yes" name="text1" >
                <div class="illustration">
                  <i class="icon ion-person-add"></i>
                </div>

                <div class="form-group">
                    <input class="form-control complete " type="text" name="nom" id="a" placeholder="Nom" >
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="text" name="prenom" id="b" placeholder="Prénom" >
                </div>

                <div class="form-group">
                    <input class="form-control complete" type="number" minlength="10" id="c" maxlength="14" name="phone" id="b" placeholder="Téléphone"
                        >
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="date" name="date_naiss" id="d" placeholder="Date de naissance" >
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="email" name="email" id="numero1" placeholder="Email" >
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="password" name="password" id="password" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="password" name="confirmer_password" id="cpassword" placeholder="Confirmer mot de passe" >
                 <span id='mess'></span>
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="text" name="ecole" id="e" placeholder="École" >
                </div>

                <div class="form-group">
                    <input class="form-control complete" type="text" name="adresse" id="f" placeholder="Adresse" >
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="text" name="complement_adresse" id="g" placeholder="Complément Adresse" >
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="text" name="ville" id="h" placeholder="Ville" >
                </div>
                <div class="form-group">
                    <input class="form-control complete" type="number" name="code_postal" id="i" placeholder="Code postal">
                </div>
                <div class="form-group">
                    <button class="btn-login btn-primary btn-block" id="submit"type="submit">sign up</button>
                </div>
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

        function checkEmail() {
                    var email = document.getElementById('numero1');
                    var  re =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))+@[A-Z0-9.-]+\.yncrea.fr/igm;
                    if (!re.test(email.value)) {
                        alert('vous devez saisir une adresse mail yncrea valide');
                        email.focus();
                        return false;
                    }
                     else 
                        return true;
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
            if(!checkEmail())
            {
                e.preventDefault(); // on annule la fonction par défaut du bouton d'envoi 
            }
        })
})
</script>
