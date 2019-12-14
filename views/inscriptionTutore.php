

<div class="login-clean">
        <form method="post" class="envoi" action="createAccount.php">

            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <i class="icon ion-person-add"></i>
            </div>

<!-- TUTORE-->

            <div class="form-group">
                <input class="form-control complete" type="text" name="nom" id="a" placeholder="Nom" >
            </div>
            <div class="form-group">
                <input class="form-control complete" type="text" name="prenom" id="b" placeholder="Prénom" >
            </div>
            <div class="form-group">
                <input class="form-control complete" type="date" name="date_naiss" id="c" placeholder="Date de naissance" >
            </div>
            <div class="form-group">
                <input class="form-control complete" type="text" name="nationalite" id="d" placeholder="Nationalité" >
            </div>
            <div class="form-group">
                <input class="form-control complete" type="text" name="phone" id="e" placeholder="Téléphone" >
            </div>
            <div class="form-group">
                <input class="form-control complete"  type="email" name="email" id="numero2" placeholder="Email" >
            </div>
            <div class="form-group">
                <input class="form-control complete" type="password" name="password" id="password" placeholder="Mot de passe"  >
            </div>
            <div class="form-group">
                <input class="form-control complete" type="password" name="confirmer_password" id="cpassword" placeholder="Confirmer mot de passe"  >
            <span id='message'></span>
            </div>
            <div class="form-group">
                <input class="form-control complete" type="text" name="ecole" id="f" placeholder="École" >
            </div>

            <div class= "form-group">
                  <input class="form-control complete" type="text" name="niveau" id="g" placeholder="Niveau scolaire" >
            </div>
            <div class= "form-group">
                <input class="form-control complete" type="text" name="adresse" id="h" placeholder="Adresse" >
            </div>
            <div class= "form-group">
                <input class="form-control complete" type="text" name="complement_adresse" id="i" placeholder="Complément Adresse" >
            </div>
            <div class="form-group">
                <input class="form-control complete" type="text" name="ville" id="j" placeholder="Ville" >
            </div>
            <div class="form-group">
                <input class="form-control complete" type="number" name="code_postal" id="k" placeholder="Code postal" >
            </div>

            <div class="form-group">
                <button class="btn-login btn-primary btn-block" type="submit">sign up</button>
            </div>

        </div>
           </form>

<!-- Js function for control -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

        var complete= document.querySelectorAll(".complete");
        var pwd= document.getElementById('password');
        var cpwd= document.getElementById('cpassword');
        var bool= true;

//Control password
var checke = function() {
          if (pwd.value ==  cpwd.value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
          } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
          }
        }



function checkEmail() {
                    var email = document.getElementById('numero2');
                    var re =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
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


    

</script>