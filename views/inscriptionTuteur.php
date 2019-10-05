       
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
            var email = document.getElementById('numero1');
            var  re =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))+@[A-Z0-9.-]+\.yncrea.fr/igm;
            if (!re.test(email.value)) {
            alert('Entrer une adresse email valide');
            email.focus();
            return false;
         }
}

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

        <!-- TUTEUR -->
<div class="login-dark">        
    <form method="post" onsubmit='javascript:validateForm();' action="createAccount.php">
     <div class="form-group" id="Yes" name="text1" style="display:block;">
                <div class="illustration">
                  <i class="icon ion-person-add"></i>
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="nom" id="a" placeholder="Nom" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="prenom" id="b" placeholder="Prénom" >
                </div>
                
                <div class="form-group">
                    <input class="form-control" type="number" minlength="10" id="c" maxlength="14" name="phone" id="b" placeholder="tel"
                        >
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="date_naiss" id="d" placeholder="Date de naissance" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="numero1" placeholder="Email" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" id="passworde" placeholder="Mot de passe"       
                    onkeyup='javascript:checke();' >
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="confirmer_password" id="confirme_password" placeholder="Confirmer mot de passe" onkeyup='javascript:checke();'  >
                 <span id='mess'></span>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="ecole" id="e" placeholder="École" >
                </div>
                
                <div class="form-group">
                    <input class="form-control" type="text" name="adresse" id="f" placeholder="Adresse" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="complement_adresse" id="g" placeholder="Complément Adresse" >               
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="ville" id="h" placeholder="Ville" >
                </div>    
                <div class="form-group">
                    <input class="form-control" type="number" name="code_postal" id="i" placeholder="code postal" >
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" 
                    onclick='javascript:checkEmail();javascript:validateForm();'>sign up</button>
                </div>
      </div>
    </form> 
</div>