       
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

function checkEmail() {
            var cansubmit = true;
            var email = document.getElementById('numero1');
            var  re =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))+@[A-Z0-9.-]+\.yncrea.fr/igm;
            if (!re.test(email.value)) {
            cansubmit = false;
            document.getElementById('numero1').style.color = 'red';
            
         }
         else{
            document.getElementById('numero1').style.color = 'green';
         }

        document.getElementById('submitbutton').disabled = !cansubmit;
    }
    window.onload = checkEmail;


function validateForm() { 
        if (document.getElementById("numero1").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
       
        if (document.getElementById("a").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("b").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("c").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("d").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("e").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("f").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("g").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("h").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("password").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }   
        if (document.getElementById("passworde").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }  
        if (document.getElementById("confirm_password").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }  
        if (document.getElementById("confirme_password").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }      
        if (document.getElementById("i").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }                                       
         
    } 
</script>

    <script type="text/javascript"> 
function checkform() {
        var f = document.forms["formm"].elements;
        var cansubmit = true;

        for (var i = 0; i < f.length; i++) {
            if ("value" in f[i] && f[i].value.length == 0)
                cansubmit = false;
        }

        document.getElementById('submitbutton').disabled = !cansubmit;
    }
    window.onload = checkform; //give access to submit after filled up the form.
    
    </script> 
<script>
    $(document).ready(function()
    {
        var $phone = $('.phone'),
            $submit = $('#submitbutton');
             
              
        $submit.onclick(function(e)
        {

            if($phone.val().length < 10 )
            { // si la chaîne de caractères est inférieure à 5
                 e.preventDefault(); // on annule la fonction par défaut du bouton d'envoi
                $phone.css({
                    borderColor : 'red',
                });
                
            }
        });
    });
</script>
        <!-- TUTEUR -->
<div class="login-dark">        
    <form method="post" name="formm"  onsubmit='javascript:validateForm();' action="createAccount.php">
        <fieldset>
     <div class="form-group" id="Yes" name="text1" style="display:block;">
                <div class="illustration">
                  <i class="icon ion-person-add"></i>
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="nom" id="a" placeholder="Nom" onKeyup='javascript:checkform();'>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="prenom" id="b" placeholder="Prénom" onKeyup='javascript:checkform();'>
                </div>
                
                <div class="form-group">
                    <input class="form-control" class="phone" type="number" minlength="10" id="c" maxlength="14" name="phone" id="b" placeholder="tel" onKeyup='javascript:checkform();'>
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="date_naiss" id="d" placeholder="Date de naissance" onKeyup='javascript:checkform();'>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="numero1" placeholder="Email" onKeyup='javascript:checkform();javascript:checkEmail();' onkeyup='javascript:checke();'>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" id="passworde" placeholder="Mot de passe"       
                    onkeyup='javascript:checke();' onKeyup='javascript:checkform();'>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="confirmer_password" id="confirme_password" placeholder="Confirmer mot de passe" onkeyup='javascript:checke();' onKeyup='javascript:checkform();' >
                 <span id='mess'></span>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="ecole" id="e" placeholder="École" onKeyup='javascript:checkform();' >
                </div>
                
                <div class="form-group">
                    <input class="form-control" type="text" name="adresse" id="f" placeholder="Adresse" onKeyup='javascript:checkform();'>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="complement_adresse" id="g" placeholder="Complément Adresse" onKeyup='javascript:checkform();'>               
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="ville" id="h" placeholder="Ville" onKeyup='javascript:checkform();' >
                </div>    
                <div class="form-group">
                    <input class="form-control" type="number" name="code_postal" id="i" placeholder="code postal" onKeyup='javascript:checkform();'>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" id="submitbutton" value="submit" 
                    onclick='javascript:checkEmail();javascript:validateForm();'>sign up</button>
                </div>
      </div>
</fieldset>
    </form> 
</div>