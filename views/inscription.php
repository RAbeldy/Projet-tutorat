<!-- Js function for control -->
<script type="text/javascript">
    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
            
        }
        else{ document.getElementById('ifYes').style.display = 'none';
              
}
      if (document.getElementById('noCheck').checked) {
        document.getElementById('Yes').style.display ='block';
      }
      else document.getElementById('Yes').style.display = 'none';
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
 function checkEmailt() {
            var email = document.getElementById('numero2');
            var re =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
            if (!re.test(email.value)) {
            alert("Entrer une adresse email valide");
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
    if (document.getElementById("numero2").value == "") 
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
    return true; 
} 
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
        <form method="post" name="myForm" onsubmit='javascript:validateForm();' action="createAccount.php">
 
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <i class="icon ion-person-add"></i>
            </div>
            <div class="lala" >
            <p>Veuillez sélectionner votre statut</p>
            <p>Bénéficiaires<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"> </p> 
            <p>Tuteur       <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck"> </p> 
            </div>
 <!-- TUTEUR -->
 <div class="form-group" id="Yes" name="text1" style="display:none">
            <div class="form-group">
                <input class="form-control" type="text" name="nom" id="a" placeholder="Nom">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="prenom" id="b" placeholder="Prénom">
            </div>
            
            <div class="form-group">
                <input class="form-control" type="number" minlength="10" id="c" maxlength="14" name="phone" id="b" placeholder="tel">
            </div>
            <div class="form-group">
                <input class="form-control" type="date" name="date_naiss" id="d" placeholder="Date de naissance">
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" id="numero1" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" id="passworde" placeholder="Mot de passe"       onkeyup='javascript:checke();'>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="confirmer_password" id="confirme_password" placeholder="Confirmer mot de passe" onkeyup='javascript:checke();'>
             <span id='mess'></span>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="ecole" id="e" placeholder="École">
            </div>
            
            <div class="form-group">
                <input class="form-control" type="text" name="adresse" id="f" placeholder="Adresse">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="complement_adresse" id="g" placeholder="Complément Adresse">               
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="ville" id="h" placeholder="Ville" >
            </div>    
            <div class="form-group">
                <input class="form-control" type="number" name="code_postal" id="i" placeholder="code postal">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" 
                onclick='javascript:checkEmail();'>sign up</button>
            </div>
    </div>
<!-- TUTORE-->
        <div class="form-group" id="ifYes" style="display:none">
        
            <div class="form-group">
                <input class="form-control" type="text" name="nom" id="a" placeholder="Nom">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="prenom" id="b" placeholder="Prénom">
            </div>
            <div class="form-group">
                <input class="form-control" type="date" name="date_naiss" id="c" placeholder="Date de naissance">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="nationalite" id="d" placeholder="Nationalité">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="phone" id="e" placeholder="tel">
            </div>
            <div class="form-group">
                <input class="form-control"  type="email" name="email" id="numero2" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe" onkeyup='javascript:check();'>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="confirmer_password" id="confirm_password" placeholder="Confirmer mot de passe" onkeyup='javascript:check();'>
            <span id='message'></span>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="ecole" id="f" placeholder="École">
            </div>
            
            <div class= "form-group"> 
                 <select name=niveau id="g">
                     <option value="TROISIEME">TROISIEME</option>
                     <option value="SECONDE">SECONDE</option>
                     <option value="PREMIERE">PREMIERE</option>
                     <option value="TERMINALE">TERMINALE</option>
                     <option value="BAC+1">BAC+1</option>
                     <option value="BAC+2">BAC+2</option>
                     <option value="BAC+3">BAC+3</option>
                     <option value="BAC+4">BAC+4</option>
                     <option value="PROFESSEUR">PROFESSEUR</option>
                     <option value="AUTRE">AUTRE</option>
                 </select>  
                 
            </div>
            <div class= "form-group">
                <input class="form-control" type="text" name="adresse" id="h" placeholder="Adresse">
            </div>            
            <div class= "form-group">
                <input class="form-control" type="text" name="complement_adresse" id="i" placeholder="Complément Adresse">               
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="ville" id="j" placeholder="Ville">
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="code_postal" id="k" placeholder="code postal">
            </div>
                                                             
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" 
                onclick='javascript:checkEmailt();'>sign up</button>
            </div>
            
        </div>
           </form>
</div>